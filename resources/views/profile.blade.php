<!DOCTYPE html>
<html lang="en">
<head>
    <title>StudyFY - Perfil</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/style.css">

    <style>
        /* CORREÇÃO DO SCROLL (ESSENCIAL) */
        html, body {
            height: auto !important;
            overflow-y: auto !important;
        }

        .page-profile {
            padding: 80px 15px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .profile-card {
            background: white;
            width: 380px;
            border-radius: 20px;
            box-shadow: 0px 4px 15px rgba(0,0,0,0.1);
            padding: 30px;
            text-align: center;
        }

        .avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: #464649;
            color: white;
            font-size: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px auto;
        }

        h2 {
            color: #464649;
        }

        .email {
            color: gray;
            font-size: 14px;
            margin-bottom: 20px;
        }

        .btn {
            margin-top: 15px;
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 20px;
            font-weight: bold;
            cursor: pointer;
        }

        .edit {
            background: #464649;
            color: white;
        }

        .logout {
            background: #dc3545;
            color: white;
        }
    </style>
</head>

<body style="background-color: #868686">

 <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar ftco-navbar-light" id="ftco-navbar">
   <div class="container" >
     <a class="navbar-brand" href="#" style="font-weight: bold;"><span style="font-weight: bold;">Study</span>FY</a>
     <button  class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
       <span class="oi oi-menu"></span> Menu
   </button>

   <div class="collapse navbar-collapse" id="ftco-nav">
       <ul class="navbar-nav ml-auto">
         <li class="nav-item active"><a href="home" class="nav-link" style="color:white">Início</a></li>
         <li class="nav-item"><a href="subjects" class="nav-link">Matérias</a></li>
          <li class="nav-item"><a href="timer" class="nav-link">Cronômetro</a></li>
             <li class="nav-item"><a href="profile" class="nav-link">Perfil</a></li>
        
     </ul>
 </div>
</div>
</nav>
<!-- END nav -->

<section class="page-profile">

    <div class="profile-card">

        <div class="avatar">U</div>

        <h2>Usuário StudyFY</h2>
        <div class="email">usuario@email.com</div>

        <button class="btn edit"><a href="profile" style="color: white">Editar Perfil</a></button>
        <button class="btn logout"><a href="home" style="color: white">Sair</a></button>

    </div>

</section>

<footer style="background-color: #7A7A7C">
  <div class="container">
    <div class="row mb-5">
      <div class="col-md pt-5">
        <div class="ftco-footer-widget pt-md-5 mb-4">
          <h2 class="ftco-heading-2">Sobre</h2>
          <p>O StudyFY é uma plataforma desenvolvida para ajudar você a organizar seus estudos, acompanhar seu progresso e alcançar seus objetivos com mais foco e eficiência.</p>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12 text-center">
        <p>
          StudyFY | Estudo Para Você <i class="fa fa-heart"></i> por
          <a href="#" style="color:#999999">Livya</a>
          <br>
          Copyright ©
          <script>document.write(new Date().getFullYear());</script>
        </p>
      </div>
    </div>
  </div>
</footer>

</body>
</html>