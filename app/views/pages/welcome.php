<?php require APPROOT . '/views/inc/header.php' ?>
<?php if (!empty($_SESSION['errors'])) $error = $_SESSION['errors']; ?>

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
                <?php if (isLoggedIn()) {
                  echo 'Accéder à Doctofiche';
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
  <section id="welcome" class="container" style="min-height: 75vh; background-image: './assets/images_proto/Doctofiche-Illustration-01.png">
    <!-- <img src="/assets/images_proto/logo.jpeg" alt="Logo" style="width: 30vw" /> -->

    <div class="jumbotron bg-light shadow">
      <div class="w-100 d-flex justify-content-center">
        <img height="200" width="auto" class="center mx-auto" src="/img/service.png" />
      </div>
      <h1 class="display-3 pt-3">Bienvenue sur Doctofiche!</h1>
      <h2 class="lead pb-4">Pour mettre toutes les chances de ton côté, abonnes-toi!</h2>
      <p>En t'abonnant tu auras accès a toujours plus de fonctionnalités:</p>
      <ul>
        <li>Créé, gère et organise de nouvelles fiches!</li>
        <li>Imprime directement des fiches conseils pour tes patients.</li>
        <li>Note tes remplacements avec l'outil comptabilité.</li>
        <li>Sauvegarde des notes directement depuis la plateforme.</li>
        <li>Reste toujours informé grâce à une sélection d'articles mis à jour par l'équipe Doctofiche.</li>
        <li>Garde à portée de main toutes les sites nécessaires à ta profession!</li>
        <li>Accède aux fonctions avancées de gestion de fiches pour t'organiser comme tu le souhaites.</li>
        <li>Et bien plus encore à venir!</li>
      </ul>
      <p>Et parce que l'on souhaite vraiment que tu réussisses, on t'offre un essai <strong>COMPLET</strong>, <strong>GRATUIT</strong> et <strong>SANS ENGAGEMENT</strong>.</p>

      <div class="row">
        <div class="col-6 offset-3 my-3">
          <button id="subscription-btn" class="btn btn-primary btn-lg shadow">S'abonner et profiter de 3 mois gratuits!</button>
        </div>
      </div>
      <!-- <div class="row d-flex justify-content-between">
        <div class="col-6 offset-3 my-4">
          <div class="flex-grow-1 d-flex flex-column align-items-center bg-white shadow rounded m-2 p-4">
            <i class=" pb-4 fas fa-medkit fa-3x"></i>
            <p class="h3">Internes, étudiants ou professionnels?</p>
            <!-- <?php if (!($_SESSION['data_user']->{'ecn_year'} < date("Y") - 1) && $_SESSION['data_user']->{'ecn_year'} != 0) : ?>
            <button class="btn btn-secondary btn-lg" data-toggle="tooltip" data-placement="top" title="On dirait que tu as obtenu ton ECN il y a seulement un an. On t'offre donc un an gratuit!">3 mois offerts!</button>
          <!-- <?php else : ?> -->
      <!-- <button <?php if ($_SESSION['data_user']->{'ecn_year'} != 0) : ?>id="subscription-btn" <?php else : ?> data-toggle="modal" data-target="#extraInfoUserModal" <?php endif; ?> class="btn btn-primary btn-lg">3 mois offerts!</button> -->
      <!-- <?php endif; ?> -->
      <!-- <button id="subscription-btn" class="btn btn-primary btn-lg shadow">Essayer la plateforme</button>
    </div>
    </div> -->
      <!-- <div class="flex-grow-1 d-flex flex-column align-items-center bg-white shadow rounded m-2 p-4">
          <i class="pb-4 fas fa-user-graduate fa-3x"></i>
          <p class="h3">Tu viens juste d'avoir ton concours ?</p>
          <?php if ($_SESSION['data_user']->{'ecn_year'} < date("Y") - 1 && $_SESSION['data_user']->{'ecn_year'} != 0) : ?>
            <button class="btn btn-secondary btn-lg" data-toggle="tooltip" data-placement="top" title="On dirait que tu as obtenu ton ECN il y a maintenant plus d'un an. Ne t'en fais pas tu peux toujours avoir accès à trois mois gratuits!">Un an offert!</button>
          <?php else : ?>
            <button <?php if ($_SESSION['data_user']->{'ecn_year'} != 0) : ?> id="subscription-btn-firstYear" <?php else : ?> data-toggle="modal" data-target="#extraInfoUserModal" <?php endif; ?> class="btn btn-primary btn-lg">Un an offert!</button>
          <?php endif; ?>
        </div> -->
      <!-- </div> -->

      <p class='text-right blockquote-footer mt-2'>Tu ne souhaites pas avoir accès aux fonctionnalitées avancées? Pas de problème, <a href="/pages/fiche">clique-ici</a> pour accéder à la plateforme.</p>
      <h2 class="lead">A tout de suite sur la plateforme!</h2>
      <h2 class="quote">L'équipe Doctofiche.</h2>
    </div>
    <img src="../blops/Doctofiche Blobs_Grey blob behind docteur.png" alt="" class="blop_one">
    <img src="../blops/Doctofiche Blobs_Leftside blue blob.png" alt="" class="blop_two">
    <img src="../blops/Doctofiche Blobs_Right side blue blob.png" alt="" class="blop_three">
  </section>
  <!--     <section class="gratitude">
        <div class="section container mt-5 mb-5 pt-5 pb-5">
            <div class="wrapper pt-md-5 pb-md-5 pb-1 pt-1 m-auto">
                <h2>Créez votre compte gratuit</h2>
                <p>Commencez à utiliser Doctofiche dès aujourd'hui. Créez votre compte
                    gratuitement et accédez à des milliers de notes médicales en un seul endroit.</p>
                <div class="gratitude-button">
                    <a class="btn btn-primary mr-0 ml-auto" href="/pages/inscription">Commencez Gratuitement</a>
                </div>
            </div>
        </div>
    </section> -->
  <div id="contact" class="container footer-top">
    <div class="footer-container">
      <div class="row">
        <div class="col-s-3 custom-spaacing">
          <h3>DOCTOFICHE</h3>
          <ul class="useful-links p-0">
            <li class="item"><a href="/index#about">Pourquoi Doctofiche ?</a></li>
            <li class="item"><a href="/index#services">Nos Services</a></li>
            <li class="item"><a href="index#video">Bénéfices</a></li>
            <li class="item"><a href="#plans">Plans</a></li>
            <li class="item"><a href="/pages/about">Mentions Légales</a></li>
          </ul>
        </div>
        <div class="col-s-3 custom-spaacing">
          <h3>SUPPORT</h3>
          <p>Doctofiche@gmail.com</p>
        </div>
        <div class="col-s-6 custom-spaacing">
          <h3>Une question? N'hésitez pas à nous contacter</h3>
          <form>
            <div class="row">
              <div class="col mb-2 mt-2">
                <input type="text" class="form-control" placeholder="Nom">
              </div>
              <div class="col mb-2 mt-2">
                <input type="email" class="form-control" placeholder="Courriel">
              </div>
            </div>
            <div class="form-group mb-2 mt-2">
              <textarea class="form-control" placeholder="Message" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
            <button type="button" class="btn btn-primary w-100 footer-submit">Envoyer</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</main>
<footer class="footer-bottom" role="contentinfo">
  <div class="centering foot">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="smallprint">
            <p>
              <span class="span"> 2020 Doctofiche </span>
              &nbsp;&nbsp;&nbsp;Tout droits réservés.
            </p>
          </div>
        </div>
        <div class="col-md-6">
          <div class="smallprint">
            <ul class="d-flex mr-0 ml-auto social-icons">
              <li class="item pr-4">
                <a href="#">
                  <svg class="w-100 fb-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24" height="24" viewBox="0 0 512 512">
                    <defs>
                      <clipPath id="clip-Icon_-_Facebook">
                        <rect width="512" height="512" />
                      </clipPath>
                    </defs>
                    <g id="Icon_-_Facebook" data-name="Icon - Facebook" clip-path="url(#clip-Icon_-_Facebook)">
                      <g id="Group_17" data-name="Group 17" transform="translate(137.283 -0.927)">
                        <g id="Group_16" data-name="Group 16" transform="translate(0 0)">
                          <path id="Path_7" data-name="Path 7" d="M385.585,981.834v247.989a6.456,6.456,0,0,0,6.467,6.452h92.081a6.455,6.455,0,0,0,6.466-6.452V977.788h66.769a6.468,6.468,0,0,0,6.436-5.916l6.422-75.923a6.472,6.472,0,0,0-6.437-7.017H490.6V835.065A22.864,22.864,0,0,1,513.463,812.2h51.463a6.466,6.466,0,0,0,6.451-6.467v-75.92a6.465,6.465,0,0,0-6.451-6.467H477.98a92.391,92.391,0,0,0-92.395,92.379v73.206H339.545a6.469,6.469,0,0,0-6.466,6.467v75.935a6.456,6.456,0,0,0,6.466,6.454h46.041Z" transform="translate(-333.079 -723.348)" fill="#858585" fill-rule="evenodd" />
                        </g>
                      </g>
                    </g>
                  </svg>
                </a>
                <a href="#"></a>
              </li>
              <li class="item pr-4">
                <a href="#">
                  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24" height="24" viewBox="0 0 512 512">
                    <defs>
                      <clipPath id="clip-Icon_-_Instagram">
                        <rect width="512" height="512" />
                      </clipPath>
                    </defs>
                    <g id="Icon_-_Instagram" data-name="Icon - Instagram" clip-path="url(#clip-Icon_-_Instagram)">
                      <g id="Group_18" data-name="Group 18" transform="translate(0.001)">
                        <path id="Path_8" data-name="Path 8" d="M767.449,817.165a30.089,30.089,0,1,0,30.1,30.087A30.09,30.09,0,0,0,767.449,817.165ZM633.66,855.753c-69.695,0-126.417,56.708-126.417,126.4a126.417,126.417,0,1,0,126.417-126.4Zm0,207.384a80.974,80.974,0,1,1,80.982-80.982A81.07,81.07,0,0,1,633.66,1063.137ZM888.736,877.1A154.188,154.188,0,0,0,734.545,722.907h-203.5A154.2,154.2,0,0,0,376.84,877.1v203.529A154.187,154.187,0,0,0,531.045,1234.8h203.5a154.175,154.175,0,0,0,154.191-154.176Zm-48.292,203.529a105.888,105.888,0,0,1-105.9,105.885h-203.5a105.9,105.9,0,0,1-105.914-105.885V877.1A105.914,105.914,0,0,1,531.045,771.2h203.5a105.9,105.9,0,0,1,105.9,105.9Z" transform="translate(-376.84 -722.907)" fill="#858585" />
                      </g>
                    </g>
                  </svg>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>

<?php require APPROOT . '/views/inc/extra_information_user.php'; ?>


<script src="https://js.stripe.com/v3/"></script>
<script>
  $(function() {
    $('[data-toggle="tooltip"]').tooltip()
  })
</script>

<script>
  var stripe = Stripe('pk_live_51HCWUzFkUJgkN5qoYYqvCpKirPu8yMD0gruy1PZM3xQs8SjFPdW7JduugrdUyqzQaneun6J9ko5Xy9cU2vwMHeO000c5VwCLcB');
  let session = <?= $data['session']['session'] ?>;

  //3 months free.

  var checkoutButton = document.getElementById('subscription-btn');
  const CHECKOUT_SESSION_ID = session.id;

  checkoutButton.addEventListener('click', function() {
    stripe.redirectToCheckout({
      // Make the id field from the Checkout Session creation API response
      // available to this file, so you can provide it as argument here
      // instead of the {{CHECKOUT_SESSION_ID}} placeholder.
      sessionId: CHECKOUT_SESSION_ID
    }).then(function(result) {
      // If `redirectToCheckout` fails due to a browser or network
      // error, display the localized error message to your customer
      // using `result.error.message`.
    });
  });

  // <?php if ($_SESSION['data_user']->{'ecn_year'} < date("Y") - 1 && $_SESSION['data_user']->{'ecn_year'} != 0) : ?>
  //   var checkoutButton = document.getElementById('subscription-btn');
  //   const CHECKOUT_SESSION_ID = session.id;

  //   checkoutButton.addEventListener('click', function() {
  //     stripe.redirectToCheckout({
  //       // Make the id field from the Checkout Session creation API response
  //       // available to this file, so you can provide it as argument here
  //       // instead of the {{CHECKOUT_SESSION_ID}} placeholder.
  //       sessionId: CHECKOUT_SESSION_ID
  //     }).then(function(result) {
  //       // If `redirectToCheckout` fails due to a browser or network
  //       // error, display the localized error message to your customer
  //       // using `result.error.message`.
  //     });
  //   });

  //   //One year free.

  // <?php elseif (!($_SESSION['data_user']->{'ecn_year'} < date("Y") - 1) && $_SESSION['data_user']->{'ecn_year'} != 0) : ?>


  //   var checkoutButtonFirstYear = document.getElementById('subscription-btn-firstYear');
  //   let sessionFirstYear = <?= $data['sessionFirstYear']['session'] ?>;
  //   const CHECKOUT_SESSION_ID_FIRST_YEAR = sessionFirstYear.id;

  //   checkoutButtonFirstYear.addEventListener('click', function() {
  //     // if(($_SESSION['data_user']->{'role'})
  //     stripe.redirectToCheckout({
  //       // Make the id field from the Checkout Session creation API response
  //       // available to this file, so you can provide it as argument here
  //       // instead of the {{CHECKOUT_SESSION_ID}} placeholder.
  //       sessionId: CHECKOUT_SESSION_ID_FIRST_YEAR
  //     }).then(function(result) {
  //       // If `redirectToCheckout` fails due to a browser or network
  //       // error, display the localized error message to your customer
  //       // using `result.error.message`.
  //     });
  //   });

  // <?php endif; ?>
</script>

<!-- <?php if (!empty($_SESSION['errors'])) : ?>
<script>
    $('#extraInfoUserModal').modal('show')
</script>
<?php endif; ?> -->