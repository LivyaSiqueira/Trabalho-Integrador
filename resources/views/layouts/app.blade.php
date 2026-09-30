<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $attributes->get('title') ? 'StudyFY | '.$attributes->get('title') : 'StudyFY' }}</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}" onerror="this.onerror=null;this.href='https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css';">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        :root { --sf-dark:#464649; --sf-gray:#7A7A7C; --sf-bg:#f5f5f6; }
        html,body { min-height:100%; margin:0; }
        body { background:var(--sf-bg); font-family:'Poppins',sans-serif; color:#515152; }
        .sf-navbar { position:sticky; top:0; z-index:1050; background:#464649 !important; min-height:72px; box-shadow:0 2px 12px rgba(0,0,0,.12); }
        .sf-navbar .navbar-brand { color:#fff !important; font-size:25px; font-weight:700; }
        .sf-navbar .navbar-brand span { font-weight:400; }
        .sf-navbar .nav-link { color:#fff !important; padding:24px 14px !important; font-size:14px; transition:.2s; }
        .sf-navbar .nav-link:hover,.sf-navbar .nav-link.active { background:rgba(255,255,255,.12); }
        .sf-navbar .user-name { color:#fff; margin-left:10px; font-size:13px; }
        .sf-main { min-height:calc(100vh - 72px); padding:42px 0 70px; }
        .sf-card { background:#fff; border-radius:16px; box-shadow:0 5px 24px rgba(0,0,0,.08); padding:28px; }
        .sf-title { color:var(--sf-dark); font-weight:700; margin-bottom:8px; }
        .sf-subtitle { color:#7A7A7C; margin-bottom:25px; }
        .sf-btn { background:var(--sf-dark); color:#fff !important; border:0; border-radius:24px; padding:10px 20px; }
        .sf-btn:hover { background:#343437; }
        .sf-btn-outline { border:1px solid var(--sf-dark); color:var(--sf-dark) !important; background:#fff; border-radius:24px; padding:9px 18px; }
        .sf-table th { color:#6c6c6e; font-size:12px; text-transform:uppercase; border-top:0; }
        .sf-footer { background:#7A7A7C; color:#fff; padding:28px 0; }
        .sf-alert { border-radius:10px; }
        .sf-stat { border-left:4px solid var(--sf-dark); }
        @media(max-width:991px) {
            .sf-navbar .nav-link { padding:12px 14px !important; }
            .sf-navbar .navbar-collapse { padding-bottom:10px; }
            .sf-main { padding-top:28px; }
        }
    </style>
    @stack('styles')
</head>
<body>
<nav class="navbar navbar-expand-lg sf-navbar">
    <div class="container">
        <a class="navbar-brand" href="{{ route('dashboard') }}"><span>Study</span>FY</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sf-nav" aria-controls="sf-nav" aria-expanded="false" aria-label="Abrir menu">
            <span class="fa fa-bars" style="color:#fff"></span>
        </button>
        <div class="collapse navbar-collapse" id="sf-nav">
            <ul class="navbar-nav ml-auto align-items-lg-center">
                @if(Auth::user()->isAdmin())
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.*') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">Painel</a></li>
                @else
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">Início</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('subject.*', 'content.*') ? 'active' : '' }}" href="{{ route('subject.index') }}">Matérias</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('timer') ? 'active' : '' }}" href="{{ route('timer') }}">Cronômetro</a></li>
                @endif
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}" href="{{ route('profile.edit') }}">Perfil</a></li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}" class="m-0">
                        @csrf
                        <button class="nav-link border-0 bg-transparent" type="submit">Sair</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
<main class="sf-main">
    @isset($header)
        <div class="container mb-4">{{ $header }}</div>
    @endisset
    <div class="container">
        @if(session('msg')) <div class="alert alert-success sf-alert">{{ session('msg') }}</div> @endif
        @if(session('erro')) <div class="alert alert-danger sf-alert">{{ session('erro') }}</div> @endif
        {{ $slot }}
    </div>
</main>
<footer class="sf-footer">
    <div class="container text-center">
        <strong>StudyFY</strong> | Estudo para você · {{ date('Y') }}
    </div>
</footer>
<script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
@stack('scripts')
</body>
</html>