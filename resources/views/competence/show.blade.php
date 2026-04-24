@extends('template')
@section('title', $competence->label_comp)

@section('main')
<style>
    .show-tag {
        display: inline-block;
        background: #fff0ed; color: var(--red);
        font-size: .7rem; font-weight: 700;
        letter-spacing: 1.5px; text-transform: uppercase;
        padding: 4px 12px; border-radius: 20px; margin-bottom: 16px;
    }
    .show-title { font-size: 2rem; font-weight: 700; }
    .detail-card { background:#fff; border:1px solid #e8e8e8; border-radius:16px; overflow:hidden; }
    .detail-card-header { padding:18px 24px 14px; border-bottom:1px solid #f0f0f0;
        font-size:.72rem; font-weight:700; letter-spacing:1px; text-transform:uppercase; color:#999; }
    .detail-card-body { padding:20px 24px; }
    .meta-row { display:flex; justify-content:space-between; align-items:center;
        padding:10px 0; font-size:.875rem; border-bottom:1px solid #f5f5f5; }
    .meta-row:last-child { border-bottom:none; }
    .meta-key { color:#888; }
    .meta-val { font-weight:600; color:#1a1a1a; }
    .desc-box { background:#fafafa; border:1px solid #efefef; border-radius:10px;
        padding:20px; font-size:.9rem; color:#444; line-height:1.8; }
    .btn-tf { border-radius:20px; font-size:.85rem; font-weight:500; }
    .tf-breadcrumb { font-size:.8rem; }
    .tf-breadcrumb a { color:#888; text-decoration:none; }
    .tf-breadcrumb a:hover { color:#333; }
    .tf-breadcrumb .sep { color:#ccc; margin:0 6px; }
</style>

<div class="container py-5">

    <div class="tf-breadcrumb mb-4">
        <a href="{{ route('web.competences.index') }}">Compétences</a>
        <span class="sep">/</span>
        <span class="text-dark fw-semibold">{{ $competence->label_comp }}</span>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="detail-card mb-4">
                <div class="detail-card-body" style="padding:28px 32px;">
                    <div class="show-tag">Compétences</div>
                    <h1 class="show-title mb-3">{{ $competence->label_comp }}</h1>

                    @if($competence->description_comp)
                        <div class="desc-box mb-4">{{ $competence->description_comp }}</div>
                    @else
                        <p class="text-muted fst-italic small mb-4">Aucune description renseignée.</p>
                    @endif

                    <div class="d-flex gap-2 flex-wrap align-items-center">
                        <a href="{{ route('web.competences.edit', $competence->code_comp) }}"
                           class="btn btn-dark px-4 btn-tf">
                            <i class="bi bi-pencil me-2"></i>Modifier
                        </a>
                        <a href="{{ route('web.competences.index') }}"
                           class="btn btn-outline-secondary px-4 btn-tf">
                            <i class="bi bi-list-ul me-2"></i>Liste
                        </a>

                        {{-- Formulaire DELETE autonome, en dehors de tout autre form --}}
                        <form method="POST"
                              action="{{ url('/web/competences/' . $competence->code_comp) }}"
                              class="ms-auto"
                              onsubmit="return confirm('Supprimer cette compétence ?')">
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
                        <span class="meta-val">#{{ str_pad($competence->code_comp, 3, '0', STR_PAD_LEFT) }}</span>
                    </div>
                    <div class="meta-row">
                        <span class="meta-key">Libellé</span>
                        <span class="meta-val">{{ $competence->label_comp }}</span>
                    </div>
                    <div class="meta-row">
                        <span class="meta-key">Description</span>
                        <span class="meta-val">{{ $competence->description_comp ? 'Oui' : 'Non' }}</span>
                    </div>
                    @if($competence->created_at)
                    <div class="meta-row">
                        <span class="meta-key">Créé le</span>
                        <span class="meta-val">{{ $competence->created_at->format('d/m/Y') }}</span>
                    </div>
                    @endif
                    @if($competence->updated_at)
                    <div class="meta-row">
                        <span class="meta-key">Modifié le</span>
                        <span class="meta-val">{{ $competence->updated_at->format('d/m/Y H:i') }}</span>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
