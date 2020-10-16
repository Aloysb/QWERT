<?php require APPROOT . '/views/inc/header.php'; ?>
<?php $post = reset($data['post']);
$postId = $post->{'id'}; ?>
<?php $user = $_SESSION['data_user']; ?>

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
            <?php if ($user->{'role'} === 'ROLE_ADMIN') : ?>

              <a href="<?= '/pages/article-modification/' . $postId; ?>" class="mr-3 btn-article edit-btn"><button class="btn">Modifier</button></a>
              <a class="btn-article edit-btn btn-danger"><button onClick="deletePost(<?= $postId; ?>)" class="btn btn-danger" style="color: red; border: red 2px solid !important">Supprimer</button></a>
            <?php endif; ?>
          </li>
          <li class="login-btn btn">
            <a href='/pages/articles'>
              <button class="btn">
                <?php if (isLoggedIn()) {
                  echo 'Retour aux fiches';
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

<!-- content -->
<div id="post" class="content d-flex justify-content-center">
  <div class="blop blop__one">
    <svg viewBox="0 0 500 500" xmlns="http://www.w3.org/2000/svg" width="100%" id="blobSvg">
      <path id="blob" d="M335.5,348Q250,446,140.5,348Q31,250,140.5,142.5Q250,35,335.5,142.5Q421,250,335.5,348Z" fill="#0095d9"></path>
    </svg>
  </div>
  <div class="blop blop__two">
    <svg viewBox="0 0 500 500" xmlns="http://www.w3.org/2000/svg" width="100%" id="blobSvg">
      <path id="blob" d="M317.5,328.5Q159,407,156.5,245.5Q154,84,315,167Q476,250,317.5,328.5Z" fill="#0095d9"></path>
    </svg>
  </div>
  <div class="container container-post">
    <div class="card">
      <div class="row">
        <div class="col-12 col-md-8 d-flex justify-content-start">
          <h1 class="title "><?= $post->{'title'} ?></h1>
        </div>
        <div class="col-12 col-md-4 d-flex justify-content-end">
          <a href="<?= '/pages/articles'; ?>" class="return"><i class="fa fa-chevron-left"></i> Retour aux articles</a>
        </div>
      </div>
      <div class="row">
        <div class="col-12 d-flex justify-content-start date">Date
          <?php
          $date = date_create($post->{'date'});
          echo date_format($date, 'd/m/Y');
          ?>
        </div>
      </div>
      <div class="row">
        <div class="col-12 d-flex justify-content-start author">Par Doctofiche</div>
      </div>
      <hr>
      <div class="content docto-editor-content" id="description-show">
        <?= htmlspecialchars_decode($post->{'content'}); ?>
      </div>
    </div>
  </div>
</div>
<!-- end of content -->

<script>
  function slugify(str) {

    function decodeHtml(html) {
      var txt = document.createElement("textarea");
      txt.innerHTML = html;
      return txt.value;
    }


    var map = {
      '-': ' ',
      '-': '_',
      'a': 'á|à|ã|â|À|Á|Ã|Â',
      'e': 'é|è|ê|É|È|Ê',
      'i': 'í|ì|î|Í|Ì|Î',
      'o': 'ó|ò|ô|õ|Ó|Ò|Ô|Õ',
      'u': 'ú|ù|û|ü|Ú|Ù|Û|Ü',
      'c': 'ç|Ç',
      'n': 'ñ|Ñ'
    };

    str = str.toLowerCase()
    str = decodeHtml(str)

    for (var pattern in map) {
      str = str.replace(new RegExp(map[pattern], 'g'), pattern);
    };

    return str;
  };
  window.onload = function() {
    let text = document.getElementById('description-show').innerHTML
    const searchedDescription = (text) => {
      if (!sessionStorage.getItem('searchValue')) return text;
      else {
        let re = new RegExp(sessionStorage.getItem('searchValue'), 'gi');
        return text.replace(re, `<span style="background: gold !important">${sessionStorage.getItem("searchValue")}</span>`)
      }
    }
    document.getElementById('description-show').innerHTML = (`${searchedDescription(text)}`);
  }
</script>
<script type="text/javascript" src='/js/main3.js'></script>
<script type="text/javascript" src='/js/custom1.js'></script>