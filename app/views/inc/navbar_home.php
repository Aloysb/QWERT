<!--::header part start::-->
<header class="head" role="banner">
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
          <li class="menu-item">
            <a href="/index.html">Accueil</a>
          </li>
          <li class="menu-item">
            <a href="/pages/plans">Plans</a>
          </li>
          <li class="menu-item">
            <a href="#contact">Contactez-nous</a>
          </li>
          <li class="login-btn btn">
            <a href='/pages/connexion'>
              <button class="btn"><?php if (isLoggedIn()) {
                                    echo 'Retour aux fiches';
                                  } else {
                                    echo 'Se connecter';
                                  };
                                  ?></button>
            </a>
          </li>
          <?php if (!isLoggedIn())
            echo " <li class='signup-btn btn'>
                        <button class='btn btn-primary' onclick='document.location = `/pages/plans`'>S'inscrire</button></li>";
          ?>
        </ul>
      </div>
    </div>
  </nav>
</header>