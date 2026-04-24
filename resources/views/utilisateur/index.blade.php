@extends('template')
@section('title', 'Utilisateurs')

@section('main')

<header class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <span class="badge rounded-pill mb-3"
                      style="background:#fff0ed; color:var(--red); font-size:.75rem; letter-spacing:1px;">
                    GESTION
                </span>
                <h1 class="display-5 fw-bold mb-3" style="letter-spacing:-.5px;">Utilisateurs</h1>
                <p class="text-muted mb-0" style="font-size:.95rem; max-width:480px;">
                    Gérez les comptes techniciens, clients et administrateurs de la plateforme.
                </p>
            </div>
            <div class="col-lg-5 text-lg-end mt-4 mt-lg-0">
                <a href="{{ route('web.utilisateur.create') }}"
                   class="btn btn-dark btn-lg px-5 rounded-pill">
                    <i class="bi bi-person-plus me-2"></i>Nouvel utilisateur
                </a>
            </div>
        </div>
    </div>
</header>

<style>
    .stat-pill { background:#fff; border:1px solid #e8e8e8; border-radius:12px;
        padding:18px 24px; display:flex; align-items:center; gap:14px; }
    .stat-icon { width:44px; height:44px; border-radius:10px;
        display:flex; align-items:center; justify-content:center; font-size:1.1rem; flex-shrink:0; }
    .stat-value { font-size:1.5rem; font-weight:700; line-height:1; }
    .stat-label { font-size:.75rem; color:#888; font-weight:500; margin-top:2px; }

    .search-box { background:#fff; border:1px solid #e4e4e4; border-radius:10px;
        padding:.6rem 1rem .6rem 2.8rem; font-size:.875rem; width:280px;
        transition:border-color .2s, box-shadow .2s; outline:none; }
    .search-box:focus { border-color:#aaa; box-shadow:0 0 0 3px rgba(0,0,0,.06); }

    .table-card { background:#fff; border:1px solid #e8e8e8; border-radius:16px; overflow:hidden; }
    .table-card table { margin:0; }
    .table-card thead th { background:#fafafa; border-bottom:1px solid #eee;
        font-size:.72rem; font-weight:600; letter-spacing:1px; text-transform:uppercase;
        color:#999; padding:14px 20px; }
    .table-card tbody td { padding:14px 20px; vertical-align:middle; border-color:#f2f2f2; }
    .table-card tbody tr { transition:background .12s; }
    .table-card tbody tr:hover { background:#fafafa; }
    .table-card tbody tr:last-child td { border-bottom:none; }

    .user-avatar { width:38px; height:38px; border-radius:50%; display:flex;
        align-items:center; justify-content:center; font-weight:700; font-size:.85rem;
        flex-shrink:0; color:#fff; }

    .role-badge { display:inline-block; font-size:.68rem; font-weight:700;
        letter-spacing:.5px; text-transform:uppercase; padding:3px 10px; border-radius:20px; }
    .role-admin      { background:#fff0ed; color:var(--red); }
    .role-technicien { background:#eff6ff; color:#3b82f6; }
    .role-client     { background:#f0fdf4; color:#22c55e; }

    .etat-dot { width:8px; height:8px; border-radius:50%; display:inline-block; margin-right:6px; }
    .etat-actif   { background:#22c55e; }
    .etat-inactif { background:#d1d5db; }

    .btn-action { width:34px; height:34px; border-radius:8px; border:1px solid #e4e4e4;
        background:#fff; display:inline-flex; align-items:center; justify-content:center;
        font-size:.85rem; text-decoration:none; transition:all .15s; cursor:pointer; }
    .btn-action:hover      { background:#f2f2f2; }
    .btn-action.view:hover { background:#eff6ff; border-color:#bfdbfe; color:#3b82f6; }
    .btn-action.edit:hover { background:#fffbeb; border-color:#fde68a; color:#f59e0b; }
    .btn-action.del        { color:var(--red); }
    .btn-action.del:hover  { background:#fff1ee; border-color:#fecaca; }

    .empty-wrap { padding:64px 20px; text-align:center; }
    .modal-content { border:none; border-radius:16px; }

    /* Pagination */
    .pagination { gap: 4px; }
    .page-link {
        border-radius: 8px !important;
        border: 1px solid #e4e4e4;
        color: #555;
        font-size: .8rem;
        font-weight: 500;
        padding: 6px 12px;
        line-height: 1.4;
    }
    .page-link:hover {
        background: #f2f2f2;
        border-color: #d0d0d0;
        color: #111;
    }
    .page-item.active .page-link {
        background: var(--dark);
        border-color: var(--dark);
        color: #fff;
    }
    .page-item.disabled .page-link {
        background: #fafafa;
        border-color: #efefef;
        color: #ccc;
    }
</style>

<div class="container py-5">

    {{-- Stats --}}
    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-lg-3">
            <div class="stat-pill">
                <div class="stat-icon" style="background:#fff0ed;">
                    <i class="bi bi-people-fill" style="color:var(--red);"></i>
                </div>
                <div>
                    <div class="stat-value">{{ $utilisateurs->total() }}</div>
                    <div class="stat-label">UTILISATEURS</div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="stat-pill">
                <div class="stat-icon" style="background:#f0fdf4;">
                    <i class="bi bi-person-check-fill" style="color:#22c55e;"></i>
                </div>
                <div>
                    <div class="stat-value">{{ $utilisateurs->getCollection()->where('etat_user','actif')->count() }}</div>
                    <div class="stat-label">ACTIFS</div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="stat-pill">
                <div class="stat-icon" style="background:#eff6ff;">
                    <i class="bi bi-wrench-adjustable-circle-fill" style="color:#3b82f6;"></i>
                </div>
                <div>
                    <div class="stat-value">{{ $utilisateurs->getCollection()->where('role_user','technicien')->count() }}</div>
                    <div class="stat-label">TECHNICIENS</div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="stat-pill">
                <div class="stat-icon" style="background:#fefce8;">
                    <i class="bi bi-shield-fill-check" style="color:#eab308;"></i>
                </div>
                <div>
                    <div class="stat-value">{{ $utilisateurs->getCollection()->where('role_user','admin')->count() }}</div>
                    <div class="stat-label">ADMINS</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Toolbar --}}
    <div class="d-flex align-items-center justify-content-between mb-3 gap-2 flex-wrap">
        <div class="position-relative">
            <i class="bi bi-search position-absolute"
               style="left:10px; top:50%; transform:translateY(-50%); color:#bbb; font-size:.8rem;"></i>
            <input type="text" id="searchInput" class="search-box" placeholder="Rechercher un utilisateur…">
        </div>
        <small class="text-muted" id="resultCount">{{ $utilisateurs->total() }} résultat(s)</small>
    </div>

    {{-- Table --}}
    <div class="table-card">
        @if($utilisateurs->isEmpty())
        <div class="empty-wrap">
            <div style="width:72px;height:72px;background:#f3f3f3;border-radius:50%;
                        display:flex;align-items:center;justify-content:center;
                        font-size:1.8rem;margin:0 auto 16px;">
                <i class="bi bi-people"></i>
            </div>
            <h5 class="fw-semibold mb-1">Aucun utilisateur</h5>
            <p class="text-muted small mb-3">Créez votre premier utilisateur.</p>
            <a href="{{ route('web.utilisateur.create') }}" class="btn btn-dark rounded-pill px-4">
                <i class="bi bi-plus-lg me-1"></i>Créer
            </a>
        </div>
        @else
        <table class="table" id="userTable">
            <thead>
                <tr>
                    <th>UTILISATEUR</th>
                    <th>LOGIN</th>
                    <th>RÔLE</th>
                    <th>TÉL</th>
                    <th>ÉTAT</th>
                    <th class="text-end">ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                @foreach($utilisateurs as $user)
                @php
                    $initials = strtoupper(substr($user->prenom_user,0,1) . substr($user->nom_user,0,1));
                    $colors   = ['#f53003','#3b82f6','#22c55e','#eab308','#8b5cf6','#ec4899'];
                    $color    = $colors[crc32($user->code_user) % count($colors)];
                @endphp
                <tr>
                    <td>
                        <div class="d-flex align-items-center gap-3">
                            <div class="user-avatar" style="background:{{ $color }};">{{ $initials }}</div>
                            <div>
                                <div class="fw-semibold" style="font-size:.9rem;">
                                    {{ $user->prenom_user }} {{ $user->nom_user }}
                                </div>
                                <div class="text-muted" style="font-size:.75rem;">{{ $user->code_user }}</div>
                            </div>
                        </div>
                    </td>
                    <td><span style="font-size:.85rem; color:#555;">{{ $user->login_user }}</span></td>
                    <td>
                        <span class="role-badge role-{{ $user->role_user }}">{{ $user->role_user }}</span>
                    </td>
                    <td><span style="font-size:.85rem; color:#777;">{{ $user->tel_user ?: '—' }}</span></td>
                    <td>
                        <span style="font-size:.82rem; font-weight:500;">
                            <span class="etat-dot etat-{{ $user->etat_user }}"></span>
                            {{ ucfirst($user->etat_user) }}
                        </span>
                    </td>
                    <td>
                        <div class="d-flex gap-1 justify-content-end">
                            <a href="{{ route('web.utilisateur.show', $user->code_user) }}"
                               class="btn-action view" title="Voir"><i class="bi bi-eye"></i></a>
                            <a href="{{ route('web.utilisateur.edit', $user->code_user) }}"
                               class="btn-action edit" title="Modifier"><i class="bi bi-pencil"></i></a>
                            <button type="button" class="btn-action del" title="Supprimer"
                                    onclick="openDeleteModal('{{ $user->code_user }}', '{{ addslashes($user->prenom_user . ' ' . $user->nom_user) }}')">
                                <i class="bi bi-trash3"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>

    <div class="mt-3 d-flex justify-content-center">
        {{ $utilisateurs->links() }}
    </div>
</div>

{{-- Modal suppression --}}
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" style="max-width:400px;">
        <div class="modal-content shadow-lg">
            <div class="modal-header">
                <h6 class="modal-title fw-bold">Confirmer la suppression</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center py-4">
                <div style="width:56px;height:56px;background:#fff1ee;border-radius:50%;
                            display:flex;align-items:center;justify-content:center;
                            margin:0 auto 16px;font-size:1.4rem;color:var(--red);">
                    <i class="bi bi-person-x-fill"></i>
                </div>
                <p class="mb-1 fw-semibold">Supprimer <span id="deleteUserName" class="text-danger"></span> ?</p>
                <p class="text-muted small mb-0">Cette action est irréversible.</p>
            </div>
            <div class="modal-footer justify-content-center gap-2">
                <button type="button" class="btn btn-light px-4 rounded-pill" data-bs-dismiss="modal">Annuler</button>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger px-4 rounded-pill">
                        <i class="bi bi-trash3 me-1"></i>Supprimer
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    const input   = document.getElementById('searchInput');
    const counter = document.getElementById('resultCount');

    input?.addEventListener('input', function () {
        const q = this.value.toLowerCase();
        const rows = document.querySelectorAll('#userTable tbody tr'); {{--  userTable --}}
        let visible = 0;
        rows.forEach(row => {
            const match = row.textContent.toLowerCase().includes(q);
            row.style.display = match ? '' : 'none';
            if (match) visible++;
        });
        if (counter) counter.textContent = visible + ' résultat(s)';
    });

    window.openDeleteModal = function (id, name) {
        document.getElementById('deleteUserName').textContent = name; {{--  deleteUserName --}}
        document.getElementById('deleteForm').action = `/web/utilisateur/${id}`; {{-- utilisateur --}}
        bootstrap.Modal.getOrCreateInstance(document.getElementById('deleteModal')).show();
    };
</script>
@endpush
@endsection
