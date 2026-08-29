<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>StudyFY | Recuperar senha</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.timepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}"><span>Study</span>FY</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>
        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a href="{{ url('/') }}" class="nav-link">Início</a></li>
                <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Login</a></li>
            </ul>
        </div>
    </div>
</nav>
<!-- END nav -->

<div class="hero-wrap js-fullheight" style="background-color: #7A7A7C;">
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-center" data-scrollax-parent="true">
            <div class="col-md-7 ftco-animate">
                <span class="subheading">Bem Vindo(a) ao </span>
                <h1 class="mb-4">STUDYFY</h1>
                <p class="caps">PLANEJE, ESTUDE, EVOLUA</p>
            </div>
        </div>
    </div>
</div>

<section class="ftco-section ftco-no-pb ftco-no-pt">
    <div class="container">
        <div class="row">
            <div class="col-md-7"></div>
            <div class="col-md-5 order-md-last">
                <div class="login-wrap p-4 p-md-5">
                    <h3 style="color: #757E7F">Recuperar senha</h3>
                    <p style="color: #757E7F">Esqueceu sua senha? Sem problemas. Informe seu e-mail e enviaremos um link para você criar uma nova.</p>

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}" class="signup-form">
                        @csrf

                        <div class="form-group">
                            <label class="label" for="email">Email</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}"
                                   class="form-control @error('email') is-invalid @enderror"
                                   required autofocus>
                            @error('email')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group d-flex justify-content-end mt-4">
                            <button type="submit" class="btn submit" style="background-color: #414A4B; color: white">Enviar link de redefinição</button>
                        </div>
                    </form>

                    <p class="text-center"><a href="{{ route('login') }}" style="color: #414A4B">Voltar ao login</a></p>
                </div>
            </div>
        </div>
    </div>
</section>

<footer style="background-color: #7A7A7C">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <p>
                    StudyFY | Estudo Para Você <i class="fa fa-heart" aria-hidden="true"></i> por <a href="https://colorlib.com" target="_blank" style="color: #999999">Livya</a>
                    <br> Copyright &copy;<script>document.write(new Date().getFullYear()); </script>
                </p>
            </div>
        </div>
    </div>
</footer>

<script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('js/jquery-migrate-3.0.1.min.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>

</body>
</html>
