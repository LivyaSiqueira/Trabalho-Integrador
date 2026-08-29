<!DOCTYPE html>
<html lang="pt-br"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>StudyFY | Login</title>
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
<style>
body{margin:0;background:#f5f5f6;font-family:Poppins,sans-serif;color:#515152}
.sf-nav{background:#464649;padding:16px 0;box-shadow:0 2px 10px #0002}
.sf-nav a{color:#fff!important;text-decoration:none}
.sf-brand{font-size:25px;font-weight:700}.sf-brand span{font-weight:400}
.sf-content{min-height:calc(100vh - 66px);padding:45px 15px}
.sf-card{background:#fff;border-radius:18px;box-shadow:0 6px 25px #0001;padding:30px;max-width:520px;margin:auto}
.sf-btn{background:#464649;color:#fff;border:0;border-radius:24px;padding:11px 24px}
.sf-btn:hover{background:#343437;color:#fff}
</style></head><body>
<nav class="sf-nav"><div class="container d-flex justify-content-between align-items-center"><a class="sf-brand" href="{{ url('/') }}"><span>Study</span>FY</a><div><a class="mr-3" href="{{ route('login') }}">Login</a><a href="{{ route('register') }}">Cadastre-se</a></div></div></nav>
<div class="sf-content"><div class="sf-card"><h2 class="mb-4" style="color:#464649">Entrar no StudyFY</h2>
@if (session('status'))<div class="alert alert-success">{{ session('status') }}</div>@endif
@if ($errors->any())<div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
<form method="POST" action="{{ route('login') }}">@csrf
<div class="form-group"><label>E-mail</label><input name="email" type="email" value="{{ old('email') }}" class="form-control" required autofocus></div>
<div class="form-group"><label>Senha</label><input name="password" type="password" class="form-control" required></div>
<div class="form-check mb-3"><input class="form-check-input" id="remember" name="remember" type="checkbox"><label class="form-check-label" for="remember">Lembrar de mim</label></div>
@if(Route::has('password.request'))<div class="mb-3"><a href="{{ route('password.request') }}" style="color:#464649">Esqueci minha senha</a></div>@endif
<button class="sf-btn" type="submit">Login</button></form>
<p class="text-center mt-4 mb-0">Ainda não tem conta? <a href="{{ route('register') }}" style="color:#464649">Cadastre-se</a></p></div></div>
<script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script><script src="{{ asset('js/popper.min.js') }}"></script><script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body></html>