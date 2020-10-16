<?php require APPROOT . '/views/inc/header.php'; ?>
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
            <a href='/pages/articles'>
              <button class="btn">
                <?php if (isLoggedIn()) {
                  echo 'Retour aux articles';
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
<div class="content d-flex justify-content-center">
  <div class="container-fluid container-post">
    <div class="page-wrap">
      <div class="section-article">
        <form method="post" enctype="multipart/form-data">
          <div class="md-form input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text md-addon" id="inputGroupMaterial-sizing-default">Titre</span>
            </div>
            <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroupMaterial-sizing-default" id="myPostTitle" autocomplete="off">
          </div>
          <textarea id="add-article-form" name="content"></textarea>
        </form>
      </div>
    </div>
  </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>
<script type="text/javascript" src='/js/main3.js'></script>
<script type="text/javascript" src='/js/custom1.js'></script>