@extends('template')
@section('title', isset($competence) ? 'Modifier la compétence' : 'Nouvelle compétence')

@section('main')
<style>
    .form-card {
        background: #fff;
        border: 1px solid #e8e8e8;
        border-radius: 16px;
        overflow: hidden;
    }
    .form-card-header {
        padding: 24px 32px 20px;
        border-bottom: 1px solid #f0f0f0;
        display: flex;
        align-items: center;
        gap: 14px;
    }
    .form-card-icon {
        width: 44px; height: 44px;
        background: #fff0ed;
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        color: var(--red);
        font-size: 1.1rem;
        flex-shrink: 0;
    }
    .form-card-body { padding: 28px 32px 32px; }

    .tf-label {
        font-size: .72rem;
        font-weight: 600;
        letter-spacing: 1px;
        text-transform: uppercase;
        color: #888;
        margin-bottom: 6px;
        display: block;
    }
    .tf-label .req { color: var(--red); margin-left: 2px; }

    .tf-input {
        border: 1px solid #e2e2e2;
        border-radius: 10px;
        padding: .7rem 1rem;
        font-size: .9rem;
        font-family: 'Instrument Sans', sans-serif;
        transition: border-color .2s, box-shadow .2s;
        width: 100%;
    }
    .tf-input:focus {
        outline: none;
        border-color: #f53003;
        box-shadow: 0 0 0 3px rgba(245,48,3,.1);
    }
    .tf-input.is-invalid { border-color: #f53003; }
    textarea.tf-input { resize: vertical; min-height: 130px; }

    .field-error {
        font-size: .78rem;
        color: var(--red);
        margin-top: 5px;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    /* Tip box */
    .tip-box {
        background: #fafafa;
        border: 1px solid #efefef;
        border-radius: 12px;
        padding: 20px;
    }
    .tip-item {
        display: flex; gap: 10px;
        font-size: .82rem; color: #666;
        padding: 8px 0;
        border-bottom: 1px solid #efefef;
    }
    .tip-item:last-child { border-bottom: none; padding-bottom: 0; }
    .tip-item i { color: var(--red); flex-shrink: 0; margin-top: 1px; }

    /* Breadcrumb */
    .tf-breadcrumb { font-size: .8rem; }
    .tf-breadcrumb a { color: #888; text-decoration: none; }
    .tf-breadcrumb a:hover { color: #333; }
    .tf-breadcrumb span { color: #ccc; margin: 0 6px; }
</style>

<div class="container py-5">

    {{-- Breadcrumb --}}
    <div class="tf-breadcrumb mb-4">
        <a href="{{ route('web.competences.index') }}">Compétences</a>
        <span>/</span>
        <span class="text-dark fw-semibold">
            {{ isset($competence) ? 'Modifier' : 'Nouvelle compétence' }}
        </span>
    </div>

    <div class="row g-4">
        {{-- Form --}}
        <div class="col-lg-8">
            <div class="form-card">
                <div class="form-card-header">
                    <div class="form-card-icon">
                        <i class="bi bi-{{ isset($competence) ? 'pencil' : 'plus-lg' }}"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0">
                            {{ isset($competence) ? 'Modifier la compétence' : 'Nouvelle compétence' }}
                        </h5>
                        <p class="text-muted small mb-0">
                            Renseignez les informations ci-dessous
                        </p>
                    </div>
                </div>

                <div class="form-card-body">
                    <form method="POST"
                          action="{{ isset($competence)
                              ? route('web.competences.update', $competence->code_comp)
                              : route('web.competences.store') }}">
                        @csrf
                        @isset($competence) @method('PUT') @endisset

                        {{-- label_comp --}}
                        <div class="mb-4">
                            <label class="tf-label">
                                Libellé de la compétence <span class="req">*</span>
                            </label>
                            <input type="text"
                                   name="label_comp"
                                   class="tf-input {{ $errors->has('label_comp') ? 'is-invalid' : '' }}"
                                   value="{{ old('label_comp', $competence->label_comp ?? '') }}"
                                   placeholder="Ex: Développement Laravel, Soudure TIG, Réseau Cisco…"
                                   required>
                            @error('label_comp')
                                <p class="field-error"><i class="bi bi-exclamation-circle-fill"></i> {{ $message }}</p>
                            @enderror
                        </div>

                        {{-- description_comp --}}
                        <div class="mb-4">
                            <label class="tf-label">Description</label>
                            <textarea name="description_comp"
                                      class="tf-input {{ $errors->has('description_comp') ? 'is-invalid' : '' }}"
                                      placeholder="Décrivez en quoi consiste cette compétence, son contexte d'utilisation…">{{ old('description_comp', $competence->description_comp ?? '') }}</textarea>
                            @error('description_comp')
                                <p class="field-error"><i class="bi bi-exclamation-circle-fill"></i> {{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Actions --}}
                        <div class="d-flex gap-2 pt-2">
                            <button type="submit" class="btn btn-dark px-5 rounded-pill">
                                <i class="bi bi-check-lg me-2"></i>
                                {{ isset($competence) ? 'Enregistrer' : 'Créer la compétence' }}
                            </button>
                            <a href="{{ route('web.competences.index') }}"
                               class="btn btn-outline-secondary px-4 rounded-pill">
                                Annuler
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Sidebar tips --}}
        <div class="col-lg-4">
            <h6 class="fw-semibold mb-3 text-muted" style="font-size:.75rem; letter-spacing:1px; text-transform:uppercase;">
                Conseils
            </h6>
            <div class="tip-box">
                <div class="tip-item">
                    <i class="bi bi-lightbulb-fill"></i>
                    <span>Choisissez un libellé court et précis, reconnaissable immédiatement.</span>
                </div>
                <div class="tip-item">
                    <i class="bi bi-text-paragraph"></i>
                    <span>La description aide les techniciens et les managers à mieux identifier la compétence.</span>
                </div>
                <div class="tip-item">
                    <i class="bi bi-link-45deg"></i>
                    <span>Une compétence peut être liée à plusieurs interventions et utilisateurs.</span>
                </div>
                <div class="tip-item">
                    <i class="bi bi-shield-check"></i>
                    <span>Évitez les doublons : vérifiez qu'une compétence similaire n'existe pas déjà.</span>
                </div>
            </div>

            @isset($competence)
            <div class="mt-4 form-card p-3">
                <p class="text-muted small mb-2 fw-semibold" style="font-size:.7rem; letter-spacing:.5px; text-transform:uppercase;">
                    Informations
                </p>
                <div class="d-flex justify-content-between small text-muted py-1 border-bottom">
                    <span>Code</span>
                    <strong class="text-dark">#{{ str_pad($competence->code_comp, 3, '0', STR_PAD_LEFT) }}</strong>
                </div>
                @if($competence->created_at)
                <div class="d-flex justify-content-between small text-muted py-1 border-bottom">
                    <span>Créé le</span>
                    <strong class="text-dark">{{ $competence->created_at->format('d/m/Y') }}</strong>
                </div>
                @endif
                @if($competence->updated_at)
                <div class="d-flex justify-content-between small text-muted py-1">
                    <span>Modifié le</span>
                    <strong class="text-dark">{{ $competence->updated_at->format('d/m/Y H:i') }}</strong>
                </div>
                @endif
            </div>
            @endisset
        </div>
    </div>
</div>
@endsection
