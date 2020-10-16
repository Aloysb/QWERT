<?php require APPROOT . '/views/inc/header.php'; ?>
<html>

<body>
  <nav class="navbar navbar-connexion navbar-expand-lg">
    <a class="navbar-brand" href="/index.html">
      <img src="/assets/images_proto/logo.jpeg" alt="Logo" class="logo-img" />
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu">
        <line x1="3" y1="12" x2="21" y2="12"></line>
        <line x1="3" y1="6" x2="21" y2="6"></line>
        <line x1="3" y1="18" x2="21" y2="18"></line>
      </svg></button>
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse navbar-collapse-connexion" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <p>Pas encore inscrit ?</p>
        <a class="btn btn-primary-outline shadow" href="/pages/plans">Inscrivez-vous!</a>
      </div>
    </div>
  </nav>

  </header>
  <main class="main main--connexion container" role="main">
    <div class="col grid-xs-12 grid-md-5 login-form-1">
      <h3>Connexion</h3>
      <form class="form-layout" action="/users/connexion" method="POST">
        <div class="form-group">
          <input type="text" name="email" class="form-control" placeholder="Adresse électronique *" value="" />
        </div>
        <div class="form-group">
          <input type="password" name="password" class="form-control" placeholder="Mot de passe *" value="" />
        </div>
        <div class="form-group--right">
          <a href="/pages/renouvellement" class="ForgetPwd">Mot de passe oublié?</a>
        </div>
        <div class="form-group--left">
          <input type="submit" class="btnSubmit btn btn-primary shadow" value="Connexion" />
        </div>
      </form>
    </div>
  </main>
  <footer class="container footer-bottom-connexion" role="contentinfo">
    <div class="centering foot">
      <div class="smallprint">
        <span>Copyright &copy; 2020 Doctofiche</span>
      </div>
      <div class="ver-line">
        |
      </div>
      <div class="designby">
        <span>All rights reserved</span>
      </div>
    </div>
  </footer>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</body>

</html>

<?php require APPROOT . '/views/inc/footer.php'; ?>