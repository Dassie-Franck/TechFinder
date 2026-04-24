@extends('template')
@section('title', $utilisateur->prenom_user . ' ' . $utilisateur->nom_user)

@section('main')
<style>
    .show-tag { display:inline-block; background:#fff0ed; color:var(--red);
        font-size:.7rem; font-weight:700; letter-spacing:1.5px; text-transform:uppercase;
        padding:4px 12px; border-radius:20px; margin-bottom:16px; }
    .detail-card { background:#fff; border:1px solid #e8e8e8; border-radius:16px; overflow:hidden; }
    .detail-card-header { padding:18px 24px 14px; border-bottom:1px solid #f0f0f0;
        font-size:.72rem; font-weight:700; letter-spacing:1px; text-transform:uppercase; color:#999; }
    .detail-card-body { padding:20px 24px; }
    .meta-row { display:flex; justify-content:space-between; align-items:center;
        padding:10px 0; font-size:.875rem; border-bottom:1px solid #f5f5f5; }
    .meta-row:last-child { border-bottom:none; }
    .meta-key { color:#888; }
    .meta-val { font-weight:600; color:#1a1a1a; }
    .role-badge { display:inline-block; font-size:.68rem; font-weight:700;
        letter-spacing:.5px; text-transform:uppercase; padding:3px 10px; border-radius:20px; }
    .role-admin      { background:#fff0ed; color:var(--red); }
    .role-technicien { background:#eff6ff; color:#3b82f6; }
    .role-client     { background:#f0fdf4; color:#22c55e; }
    .btn-tf { border-radius:20px; font-size:.85rem; font-weight:500; }
    .tf-breadcrumb { font-size:.8rem; }
    .tf-breadcrumb a { color:#888; text-decoration:none; }
    .tf-breadcrumb a:hover { color:#333; }
    .tf-breadcrumb .sep { color:#ccc; margin:0 6px; }
    .user-avatar-lg { width:72px; height:72px; border-radius:50%; display:flex;
        align-items:center; justify-content:center; font-weight:700; font-size:1.5rem; color:#fff; }
</style>

<div class="container py-5">

    <div class="tf-breadcrumb mb-4">
        <a href="{{ route('web.utilisateur.index') }}">Utilisateurs</a>
        <span class="sep">/</span>
        <span class="text-dark fw-semibold">
            {{ $utilisateur->prenom_user }} {{ $utilisateur->nom_user }}
        </span>
    </div>

    @php
        $initials = strtoupper(substr($utilisateur->prenom_user,0,1) . substr($utilisateur->nom_user,0,1));
        $colors   = ['#f53003','#3b82f6','#22c55e','#eab308','#8b5cf6','#ec4899'];
        $color    = $colors[crc32($utilisateur->code_user) % count($colors)];
    @endphp

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="detail-card mb-4">
                <div class="detail-card-body" style="padding:28px 32px;">
                    <div class="d-flex align-items-center gap-4 mb-4">
                        <div class="user-avatar-lg" style="background:{{ $color }};">{{ $initials }}</div>
                        <div>
                            <div class="show-tag">Utilisateur</div>
                            <h1 class="fw-bold mb-1" style="font-size:1.8rem; letter-spacing:-.5px;">
                                {{ $utilisateur->prenom_user }} {{ $utilisateur->nom_user }}
                            </h1>
                            <span class="role-badge role-{{ $utilisateur->role_user }}">
                                {{ ucfirst($utilisateur->role_user) }}
                            </span>
                        </div>
                    </div>

                    <div class="d-flex gap-2 flex-wrap align-items-center">
                        <a href="{{ route('web.utilisateur.edit', $utilisateur->code_user) }}"
                           class="btn btn-dark px-4 btn-tf">
                            <i class="bi bi-pencil me-2"></i>Modifier
                        </a>
                        <a href="{{ route('web.utilisateur.index') }}"
                           class="btn btn-outline-secondary px-4 btn-tf">
                            <i class="bi bi-list-ul me-2"></i>Liste
                        </a>
                        <form method="POST"
                              action="{{ url('/web/utilisateur/' . $utilisateur->code_user) }}"
                              class="ms-auto"
                              onsubmit="return confirm('Supprimer cet utilisateur ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger px-4 btn-tf">
                                <i class="bi bi-trash3 me-2"></i>Supprimer
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="detail-card">
                <div class="detail-card-header">Détails</div>
                <div class="detail-card-body">
                    <div class="meta-row">
                        <span class="meta-key">Code</span>
                        <span class="meta-val">{{ $utilisateur->code_user }}</span>
                    </div>
                    <div class="meta-row">
                        <span class="meta-key">Login</span>
                        <span class="meta-val">{{ $utilisateur->login_user }}</span>
                    </div>
                    <div class="meta-row">
                        <span class="meta-key">Téléphone</span>
                        <span class="meta-val">{{ $utilisateur->tel_user ?: '—' }}</span>
                    </div>
                    <div class="meta-row">
                        <span class="meta-key">Sexe</span>
                        <span class="meta-val">{{ $utilisateur->sexe_user === 'M' ? 'Masculin' : 'Féminin' }}</span>
                    </div>
                    <div class="meta-row">
                        <span class="meta-key">État</span>
                        <span class="meta-val">{{ ucfirst($utilisateur->etat_user) }}</span>
                    </div>
                    @if($utilisateur->created_at)
                    <div class="meta-row">
                        <span class="meta-key">Créé le</span>
                        <span class="meta-val">{{ $utilisateur->created_at->format('d/m/Y') }}</span>
                    </div>
                    @endif
                    @if($utilisateur->updated_at)
                    <div class="meta-row">
                        <span class="meta-key">Modifié le</span>
                        <span class="meta-val">{{ $utilisateur->updated_at->format('d/m/Y H:i') }}</span>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
