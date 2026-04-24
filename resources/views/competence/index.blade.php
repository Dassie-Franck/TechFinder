@extends('template')
@section('title', 'Compétences')

@section('main')

<header class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <span class="badge rounded-pill mb-3"
                      style="background:#fff0ed; color:var(--red); font-size:.75rem; letter-spacing:1px;">
                    GESTION
                </span>
                <h1 class="display-5 fw-bold mb-3" style="letter-spacing:-.5px;">Compétences</h1>
                <p class="text-muted mb-0" style="font-size:.95rem; max-width:480px;">
                    Référentiel central des compétences techniques. Ajoutez, modifiez
                    et organisez les savoir-faire disponibles sur la plateforme.
                </p>
            </div>
            <div class="col-lg-5 text-lg-end mt-4 mt-lg-0">
                <a href="{{ route('web.competences.create') }}"
                   class="btn btn-dark btn-lg px-5 rounded-pill">
                    <i class="bi bi-plus-lg me-2"></i>Nouvelle compétence
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
    .table-card tbody td { padding:16px 20px; vertical-align:middle; border-color:#f2f2f2; }
    .table-card tbody tr { transition:background .12s; }
    .table-card tbody tr:hover { background:#fafafa; }
    .table-card tbody tr:last-child td { border-bottom:none; }
    .skill-label { font-weight:600; font-size:.9rem; color:#1a1a1a; }
    .skill-desc { font-size:.78rem; color:#999; margin-top:2px;
        max-width:320px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
    .code-badge { display:inline-block; background:#f3f3f3; color:#555;
        font-size:.7rem; font-weight:700; letter-spacing:.5px;
        padding:3px 10px; border-radius:20px; font-family:monospace; }
    .btn-action { width:34px; height:34px; border-radius:8px; border:1px solid #e4e4e4;
        background:#fff; display:inline-flex; align-items:center; justify-content:center;
        font-size:.85rem; text-decoration:none; transition:all .15s; cursor:pointer; }
    .btn-action:hover      { background:#f2f2f2; }
    .btn-action.view       { color:#3b82f6; }
    .btn-action.view:hover { background:#eff6ff; border-color:#bfdbfe; }
    .btn-action.edit       { color:#f59e0b; }
    .btn-action.edit:hover { background:#fffbeb; border-color:#fde68a; }
    .btn-action.del        { color:var(--red); }
    .btn-action.del:hover  { background:#fff1ee; border-color:#fecaca; }
    .empty-wrap { padding:64px 20px; text-align:center; }
    .empty-wrap .empty-icon { width:72px; height:72px; background:#f3f3f3; border-radius:50%;
        display:flex; align-items:center; justify-content:center; font-size:1.8rem; margin:0 auto 16px; }
    .modal-content { border:none; border-radius:16px; }
    .modal-header  { border-bottom:1px solid #f0f0f0; padding:20px 24px 16px; }
    .modal-body    { padding:20px 24px; }
    .modal-footer  { border-top:1px solid #f0f0f0; padding:14px 24px; }
</style>

<div class="container py-5">

    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-lg-3">
            <div class="stat-pill">
                <div class="stat-icon" style="background:#fff0ed;">
                    <i class="bi bi-award-fill" style="color:var(--red);"></i>
                </div>
                <div>
                    <div class="stat-value">{{ $competences->count() }}</div>
                    <div class="stat-label">COMPÉTENCES</div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="stat-pill">
                <div class="stat-icon" style="background:#f0fdf4;">
                    <i class="bi bi-check2-circle" style="color:#22c55e;"></i>
                </div>
                <div>
                    <div class="stat-value">{{ $competences->whereNotNull('description_comp')->count() }}</div>
                    <div class="stat-label">AVEC DESCRIPTION</div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="stat-pill">
                <div class="stat-icon" style="background:#eff6ff;">
                    <i class="bi bi-calendar3" style="color:#3b82f6;"></i>
                </div>
                <div>
                    <div class="stat-value">
                        {{ $competences->where('created_at', '>=', now()->startOfMonth())->count() }}
                    </div>
                    <div class="stat-label">CE MOIS-CI</div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="stat-pill">
                <div class="stat-icon" style="background:#fefce8;">
                    <i class="bi bi-lightning-fill" style="color:#eab308;"></i>
                </div>
                <div>
                    <div class="stat-value">
                        {{ $competences->whereNotNull('label_comp')->unique('label_comp')->count() }}
                    </div>
                    <div class="stat-label">UNIQUES</div>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex align-items-center justify-content-between mb-3 gap-2 flex-wrap">
        <div class="position-relative">
            <i class="bi bi-search position-absolute"
               style="left:10px; top:50%; transform:translateY(-50%); color:#bbb; font-size:.8rem;"></i>
            <input type="text" id="searchInput" class="search-box"
                   placeholder="Rechercher une compétence…">
        </div>
        <small class="text-muted" id="resultCount">{{ $competences->count() }} résultat(s)</small>
    </div>

    <div class="table-card">
        @if($competences->isEmpty())
        <div class="empty-wrap">
            <div class="empty-icon"><i class="bi bi-award"></i></div>
            <h5 class="fw-semibold mb-1">Aucune compétence</h5>
            <p class="text-muted small mb-3">Commencez par créer votre première compétence.</p>
            <a href="{{ route('web.competences.create') }}" class="btn btn-dark rounded-pill px-4">
                <i class="bi bi-plus-lg me-1"></i>Créer
            </a>
        </div>
        @else
        <table class="table" id="skillTable">
            <thead>
                <tr>
                    <th>CODE</th>
                    <th>COMPÉTENCE</th>
                    <th>DESCRIPTION</th>
                    <th class="text-end">ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                @foreach($competences as $comp)
                @php $label = addslashes($comp->label_comp); @endphp
                <tr>
                    <td>
                        <span class="code-badge">#{{ str_pad($comp->code_comp, 3, '0', STR_PAD_LEFT) }}</span>
                    </td>
                    <td>
                        <div class="skill-label">{{ $comp->label_comp }}</div>
                    </td>
                    <td>
                        <div class="skill-desc">{{ $comp->description_comp ?: '—' }}</div>
                    </td>
                    <td>
                        <div class="d-flex gap-1 justify-content-end">
                            <a href="{{ route('web.competences.show', $comp->code_comp) }}"
                               class="btn-action view" title="Voir">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('web.competences.edit', $comp->code_comp) }}"
                               class="btn-action edit" title="Modifier">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <button type="button" class="btn-action del" title="Supprimer"
                                    onclick="openDeleteModal({{ $comp->code_comp }}, '{{ $label }}')">
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
        {{ $competences->links() }}
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
                    <i class="bi bi-trash3-fill"></i>
                </div>
                <p class="mb-1 fw-semibold">Supprimer <span id="deleteCompName" class="text-danger"></span> ?</p>
                <p class="text-muted small mb-0">Cette action est irréversible.</p>
            </div>
            <div class="modal-footer justify-content-center gap-2">
                <button type="button" class="btn btn-light px-4 rounded-pill" data-bs-dismiss="modal">
                    Annuler
                </button>
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
        const rows = document.querySelectorAll('#skillTable tbody tr'); {{-- skillTable --}}
        let visible = 0;
        rows.forEach(row => {
            const match = row.textContent.toLowerCase().includes(q);
            row.style.display = match ? '' : 'none';
            if (match) visible++;
        });
        if (counter) counter.textContent = visible + ' résultat(s)';
    });

    window.openDeleteModal = function (id, name) {
        document.getElementById('deleteCompName').textContent = name; {{--  deleteCompName --}}
        document.getElementById('deleteForm').action = `/web/competences/${id}`; {{-- competences --}}
        bootstrap.Modal.getOrCreateInstance(document.getElementById('deleteModal')).show();
    };
</script>
@endpush

@endsection
