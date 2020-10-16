<?php require APPROOT.'/views/inc/header.php'; ?>
<?php if(isset($_SESSION['data_user'])){ $user = $_SESSION['data_user']; } ?>
<header id="navbar__compta" class="head" role="banner">
    <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand" href="/index.html">
            <img src="/assets/images_proto/logo.jpeg" alt="Logo" class="logo-img" />
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHome" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu">
                <line x1="3" y1="12" x2="21" y2="12"></line>
                <line x1="3" y1="6" x2="21" y2="6"></line>
                <line x1="3" y1="18" x2="21" y2="18"></line>
            </svg></button>
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarHome">
            <div class="navbar-nav">
                <ul class="menu">
                    <li class="login-btn btn">
                        <a href='/pages/connexion'>
                            <button class="btn">
                                <?php if(isLoggedIn()){ 
                                echo'Accéder à Doctofiche';
                            } else {
                                echo 'Se connecter';
                            };
                            ?></button>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<main>
    <div class="confetti-container">
        <div class="confetti"></div>
        <div class="confetti"></div>
        <div class="confetti"></div>
        <div class="confetti"></div>
        <div class="confetti"></div>
        <div class="confetti"></div>
        <div class="confetti"></div>
        <div class="confetti"></div>
        <div class="confetti"></div>
        <div class="confetti"></div>
        <div class="confetti"></div>
        <div class="confetti"></div>
        <div class="confetti"></div>
        <div class="confetti"></div>
        <div class="confetti"></div>
                <div class="confetti"></div>
        <div class="confetti"></div>
        <div class="confetti"></div>
        <div class="confetti"></div>
        <div class="confetti"></div>
        <div class="confetti"></div>
        <div class="confetti"></div>
        <div class="confetti"></div>
        <div class="confetti"></div>
        <div class="confetti"></div>
        <div class="confetti"></div>
        <div class="confetti"></div>
        <div class="confetti"></div>
        <div class="confetti"></div>
        <div class="confetti"></div>
    </div>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10 col-offset-1">
                <div class="jumbotron shadow" style="margin-top: 2rem; position: relative; z-index: 2001">
                <?php if(isset($user)): ?>
                    <h1 class="display-1">Merci <?= ucfirst($user->{'name'}); ?> <?= $user->{'firstname'}; ?> !</h1>
		        <?php endif; ?>
                <h2 class="subtitle">Toute l'équipe Doctofiche se mobilise pour t'apporter les meilleurs outils!</h2>
                    <p>Pour toute question, idée de développement ou avis n'hésitez pas à nous contacter à doctofiche@gmail.com!</p>
                    <p>Si vous souhaitez arrêter votre abonnement, rendez-vous sur votre page profil.</p>
                    <p>Nous sommes ravis de te compter parmis notre communauté.</p>
                        <a href="/pages/fiche" class="btn btn-primary float-right shadow">
                            Continuer
                        </a>                 
                </div>
            </div>
        </div>
    </div>
</main>
<?php require APPROOT.'/views/inc/footer.php'; ?>

<style>
        .confetti-container{
            top: 0;
            position: absolute;
            z-index: 2000;
            width: 100vw;
          height: 100vh;
        }
        .confetti {
          width: 15px;
          height: 15px;
          background-color: #f2d74e;
          position: absolute;
          left: 50%;
          animation: confetti 5s ease-in-out -2s infinite;
          transform-origin: left top;
        }
        .confetti:nth-child(1) {
          background-color: #f2d74e; left: 10%; animation-delay: 0;
        }
        .confetti:nth-child(2) {
          background-color: #95c3de; left: 20%; animation-delay: -5s;
        }
        .confetti:nth-child(3) {
          background-color: #ff9a91; left: 30%; animation-delay: -3s;
        }
        .confetti:nth-child(4) {
          background-color: #f2d74e; left: 40%; animation-delay: -2.5s;
        }
        .confetti:nth-child(5) {
          background-color: #95c3de; left: 50%; animation-delay: -4s;
        }
        .confetti:nth-child(6) {
          background-color: #ff9a91; left: 60%; animation-delay: -6s;
        }
        .confetti:nth-child(7) {
          background-color: #f2d74e; left: 70%; animation-delay: -1.5s;
        }
        .confetti:nth-child(8) {
          background-color: #95c3de; left: 80%; animation-delay: -2s;
        }
        .confetti:nth-child(9) {
          background-color: #ff9a91; left: 90%; animation-delay: -3.5s;
        }
        .confetti:nth-child(10) {
          background-color: #f2d74e; left: 100%; animation-delay: -2.5s;
        }

        @keyframes confetti {
          0% { transform: rotateZ(15deg) rotateY(0deg) translate(0,0); }
          25% { transform: rotateZ(5deg) rotateY(360deg) translate(-5vw,20vh); }
          50% { transform: rotateZ(15deg) rotateY(720deg) translate(5vw,60vh); }
          75% { transform: rotateZ(5deg) rotateY(1080deg) translate(-10vw,80vh); }
          100% { transform: rotateZ(15deg) rotateY(1440deg) translate(10vw,110vh); }
        }
        </style>