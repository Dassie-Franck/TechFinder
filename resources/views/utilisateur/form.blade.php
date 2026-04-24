@extends('template')
@section('title', isset($utilisateur) ? 'Modifier l\'utilisateur' : 'Nouvel utilisateur')

@section('main')
<style>
    .form-card { background:#fff; border:1px solid #e8e8e8; border-radius:16px; overflow:hidden; }
    .form-card-header { padding:24px 32px 20px; border-bottom:1px solid #f0f0f0;
        display:flex; align-items:center; gap:14px; }
    .form-card-icon { width:44px; height:44px; background:#fff0ed; border-radius:10px;
        display:flex; align-items:center; justify-content:center;
        color:var(--red); font-size:1.1rem; flex-shrink:0; }
    .form-card-body { padding:28px 32px 32px; }
    .tf-label { font-size:.72rem; font-weight:600; letter-spacing:1px; text-transform:uppercase;
        color:#888; margin-bottom:6px; display:block; }
    .tf-label .req { color:var(--red); margin-left:2px; }
    .tf-input { border:1px solid #e2e2e2; border-radius:10px; padding:.7rem 1rem;
        font-size:.9rem; font-family:'Instrument Sans',sans-serif;
        transition:border-color .2s, box-shadow .2s; width:100%; }
    .tf-input:focus { outline:none; border-color:#f53003; box-shadow:0 0 0 3px rgba(245,48,3,.1); }
    .tf-input.is-invalid { border-color:#f53003; }
    .field-error { font-size:.78rem; color:var(--red); margin-top:5px;
        display:flex; align-items:center; gap:4px; }
    .tip-box { background:#fafafa; border:1px solid #efefef; border-radius:12px; padding:20px; }
    .tip-item { display:flex; gap:10px; font-size:.82rem; color:#666;
        padding:8px 0; border-bottom:1px solid #efefef; }
    .tip-item:last-child { border-bottom:none; padding-bottom:0; }
    .tip-item i { color:var(--red); flex-shrink:0; margin-top:1px; }
    .tf-breadcrumb { font-size:.8rem; }
    .tf-breadcrumb a { color:#888; text-decoration:none; }
    .tf-breadcrumb a:hover { color:#333; }
    .tf-breadcrumb span { color:#ccc; margin:0 6px; }
    .gender-btn input { display:none; }
    .gender-btn label { display:flex; align-items:center; gap:8px; cursor:pointer;
        padding:.65rem 1.2rem; border:1px solid #e2e2e2; border-radius:10px;
        font-size:.9rem; transition:all .18s; user-select:none; }
    .gender-btn input:checked + label { border-color:var(--red);
        background:#fff0ed; color:var(--red); font-weight:600; }
</style>

<div class="container py-5">

    <div class="tf-breadcrumb mb-4">
        <a href="{{ route('web.utilisateur.index') }}">Utilisateurs</a>
        <span>/</span>
        <span class="text-dark fw-semibold">
            {{ isset($utilisateur) ? 'Modifier' : 'Nouvel utilisateur' }}
        </span>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="form-card">
                <div class="form-card-header">
                    <div class="form-card-icon">
                        <i class="bi bi-{{ isset($utilisateur) ? 'person-gear' : 'person-plus' }}"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0">
                            {{ isset($utilisateur) ? 'Modifier l\'utilisateur' : 'Nouvel utilisateur' }}
                        </h5>
                        <p class="text-muted small mb-0">Renseignez les informations ci-dessous</p>
                    </div>
                </div>

                <div class="form-card-body">
                    <form method="POST"
                          action="{{ isset($utilisateur)
                              ? route('web.utilisateur.update', $utilisateur->code_user)
                              : route('web.utilisateur.store') }}">
                        @csrf
                        @isset($utilisateur) @method('PUT') @endisset

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="tf-label">Prénom <span class="req">*</span></label>
                                <input type="text" name="prenom_user"
                                       class="tf-input {{ $errors->has('prenom_user') ? 'is-invalid' : '' }}"
                                       value="{{ old('prenom_user', $utilisateur->prenom_user ?? '') }}"
                                       placeholder="Jean" required>
                                @error('prenom_user')
                                    <p class="field-error"><i class="bi bi-exclamation-circle-fill"></i> {{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="tf-label">Nom <span class="req">*</span></label>
                                <input type="text" name="nom_user"
                                       class="tf-input {{ $errors->has('nom_user') ? 'is-invalid' : '' }}"
                                       value="{{ old('nom_user', $utilisateur->nom_user ?? '') }}"
                                       placeholder="Dupont" required>
                                @error('nom_user')
                                    <p class="field-error"><i class="bi bi-exclamation-circle-fill"></i> {{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="tf-label">Login <span class="req">*</span></label>
                                <input type="text" name="login_user"
                                       class="tf-input {{ $errors->has('login_user') ? 'is-invalid' : '' }}"
                                       value="{{ old('login_user', $utilisateur->login_user ?? '') }}"
                                       placeholder="jean.dupont" required>
                                @error('login_user')
                                    <p class="field-error"><i class="bi bi-exclamation-circle-fill"></i> {{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="tf-label">
                                    Mot de passe
                                    @isset($utilisateur)<span style="color:#aaa;font-weight:400;text-transform:none;letter-spacing:0;font-size:.75rem;"> (laisser vide = inchangé)</span>@endisset
                                    @empty($utilisateur)<span class="req">*</span>@endempty
                                </label>
                                <input type="password" name="password_user"
                                       class="tf-input {{ $errors->has('password_user') ? 'is-invalid' : '' }}"
                                       placeholder="••••••••"
                                       {{ isset($utilisateur) ? '' : 'required' }}>
                                @error('password_user')
                                    <p class="field-error"><i class="bi bi-exclamation-circle-fill"></i> {{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="tf-label">Téléphone</label>
                            <input type="text" name="tel_user"
                                   class="tf-input {{ $errors->has('tel_user') ? 'is-invalid' : '' }}"
                                   value="{{ old('tel_user', $utilisateur->tel_user ?? '') }}"
                                   placeholder="+237 6XX XXX XXX">
                            @error('tel_user')
                                <p class="field-error"><i class="bi bi-exclamation-circle-fill"></i> {{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Sexe --}}
                        <div class="mb-4">
                            <label class="tf-label">Sexe <span class="req">*</span></label>
                            <div class="d-flex gap-3">
                                <div class="gender-btn">
                                    <input type="radio" name="sexe_user" id="sexe_m" value="M"
                                           {{ old('sexe_user', $utilisateur->sexe_user ?? '') === 'M' ? 'checked' : '' }}>
                                    <label for="sexe_m"><i class="bi bi-gender-male"></i> Masculin</label>
                                </div>
                                <div class="gender-btn">
                                    <input type="radio" name="sexe_user" id="sexe_f" value="F"
                                           {{ old('sexe_user', $utilisateur->sexe_user ?? '') === 'F' ? 'checked' : '' }}>
                                    <label for="sexe_f"><i class="bi bi-gender-female"></i> Féminin</label>
                                </div>
                            </div>
                            @error('sexe_user')
                                <p class="field-error"><i class="bi bi-exclamation-circle-fill"></i> {{ $message }}</p>
                            @enderror
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="tf-label">Rôle <span class="req">*</span></label>
                                <select name="role_user" class="tf-input {{ $errors->has('role_user') ? 'is-invalid' : '' }}" required>
                                    <option value="">-- Choisir --</option>
                                    @foreach(['admin','technicien','client'] as $role)
                                    <option value="{{ $role }}"
                                        {{ old('role_user', $utilisateur->role_user ?? '') === $role ? 'selected' : '' }}>
                                        {{ ucfirst($role) }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('role_user')
                                    <p class="field-error"><i class="bi bi-exclamation-circle-fill"></i> {{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="tf-label">État <span class="req">*</span></label>
                                <select name="etat_user" class="tf-input {{ $errors->has('etat_user') ? 'is-invalid' : '' }}" required>
                                    <option value="">-- Choisir --</option>
                                    @foreach(['actif','inactif'] as $etat)
                                    <option value="{{ $etat }}"
                                        {{ old('etat_user', $utilisateur->etat_user ?? '') === $etat ? 'selected' : '' }}>
                                        {{ ucfirst($etat) }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('etat_user')
                                    <p class="field-error"><i class="bi bi-exclamation-circle-fill"></i> {{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex gap-2 pt-2">
                            <button type="submit" class="btn btn-dark px-5 rounded-pill">
                                <i class="bi bi-check-lg me-2"></i>
                                {{ isset($utilisateur) ? 'Enregistrer' : 'Créer l\'utilisateur' }}
                            </button>
                            <a href="{{ route('web.utilisateur.index') }}"
                               class="btn btn-outline-secondary px-4 rounded-pill">Annuler</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <h6 class="fw-semibold mb-3 text-muted"
                style="font-size:.75rem; letter-spacing:1px; text-transform:uppercase;">Conseils</h6>
            <div class="tip-box">
                <div class="tip-item">
                    <i class="bi bi-person-badge-fill"></i>
                    <span>Le login doit être unique sur la plateforme.</span>
                </div>
                <div class="tip-item">
                    <i class="bi bi-shield-lock-fill"></i>
                    <span>Le mot de passe doit contenir au moins 6 caractères.</span>
                </div>
                <div class="tip-item">
                    <i class="bi bi-diagram-3-fill"></i>
                    <span>Choisissez le rôle avec soin : il détermine les accès.</span>
                </div>
                <div class="tip-item">
                    <i class="bi bi-toggle-on"></i>
                    <span>Un compte inactif ne peut pas se connecter à la plateforme.</span>
                </div>
            </div>

            @isset($utilisateur)
            <div class="mt-4 form-card p-3">
                <p class="text-muted small mb-2 fw-semibold"
                   style="font-size:.7rem; letter-spacing:.5px; text-transform:uppercase;">Informations</p>
                <div class="d-flex justify-content-between small text-muted py-1 border-bottom">
                    <span>Code</span>
                    <strong class="text-dark">{{ $utilisateur->code_user }}</strong>
                </div>
                @if($utilisateur->created_at)
                <div class="d-flex justify-content-between small text-muted py-1 border-bottom">
                    <span>Créé le</span>
                    <strong class="text-dark">{{ $utilisateur->created_at->format('d/m/Y') }}</strong>
                </div>
                @endif
                @if($utilisateur->updated_at)
                <div class="d-flex justify-content-between small text-muted py-1">
                    <span>Modifié le</span>
                    <strong class="text-dark">{{ $utilisateur->updated_at->format('d/m/Y H:i') }}</strong>
                </div>
                @endif
            </div>
            @endisset
        </div>
    </div>
</div>
@endsection
