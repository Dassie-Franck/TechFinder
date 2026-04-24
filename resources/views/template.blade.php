<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Techfinder – @yield('title', 'Accueil')</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root { --red: #f53003; --dark: #1a1a1a; }
        body { font-family: 'Instrument Sans', sans-serif; background: #f7f7f7; }

        .navbar { border-bottom: 1px solid #e8e8e8; }
        .navbar-brand { font-weight: 700; letter-spacing: 2px; color: var(--dark) !important; }
        .navbar-brand span { color: var(--red); }
        .nav-link { font-size: .875rem; font-weight: 500; color: #555 !important;
                    padding: .45rem .9rem !important; border-radius: 6px; transition: all .18s; }
        .nav-link:hover { background: #f2f2f2; color: #111 !important; }
        .nav-link.active { background: #fff0ed; color: var(--red) !important; }

        .hero-section { background: #fff; padding: 72px 0 56px; border-bottom: 1px solid #ebebeb; }

        .flash-bar { border: none; border-left: 3px solid; border-radius: 8px;
                     font-size: .875rem; font-weight: 500; }
        .flash-bar.success { border-color: #22c55e; background: #f0fdf4; color: #166534; }
        .flash-bar.danger  { border-color: var(--red); background: #fff1ee; color: #9a1702; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="/">TECH<span>FINDER</span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="nav">
            <ul class="navbar-nav me-auto gap-1">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('web/competences*') ? 'active' : '' }}"
                       href="{{ url('/web/competences') }}">
                        <i class="bi bi-award me-1"></i>Compétences
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('web/utilisateur*') ? 'active' : '' }}"
                       href="{{ url('/web/utilisateur') }}">
                        <i class="bi bi-people me-1"></i>Users
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="bi bi-wrench-adjustable me-1"></i>Interventions
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="bi bi-person-badge me-1"></i>UserCompétences
                    </a>
                </li>
            </ul>
            <a href="#" class="btn btn-outline-dark px-4 rounded-pill" style="font-size:.85rem;">Connexion</a>
        </div>
    </div>
</nav>

@if(session('success') || session('error'))
<div class="container mt-3">
    @if(session('success'))
    <div class="alert flash-bar success d-flex align-items-center gap-2 alert-dismissible fade show">
        <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
    </div>
    @endif
    @if(session('error'))
    <div class="alert flash-bar danger d-flex align-items-center gap-2 alert-dismissible fade show">
        <i class="bi bi-exclamation-circle-fill"></i> {{ session('error') }}
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
    </div>
    @endif
</div>
@endif

@yield('main')

{{-- Bootstrap JS EN PREMIER --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

{{-- Les scripts des vues enfants s'injectent ICI, après Bootstrap --}}
@stack('scripts')

</body>
</html>
