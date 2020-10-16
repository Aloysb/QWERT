<?php require APPROOT . '/views/inc/header.php'; ?>
<?php require APPROOT . '/views/inc/navbar_home.php'; ?>
<?php if (isset($_SESSION['data_user'])) {
  $userData = $_SESSION['data_user'];
}
if (isset($_SESSION['data'])) {
  $data = $_SESSION['data'];
}
if (isset($_SESSION['errors'])) {
  $error = $_SESSION['errors'];
}
?>
<main class="main" role="main">
  <!--First section-->
  <section class="hero-section">
    <img src="assets/blops/Doctofiche Blobs_Grey blob behind docteur.png" alt="" class="blop__zero">
    <img class='blop__first' src='/assets/blops/Doctofiche Blobs_Leftside blue blob.png' />
    <div class="row grid first-sec centering container">
      <div class="col col-12 col-md-7 info">
        <h1>Tu es interne ou <br> jeune médecin?</h1>
        <p>
          Avec Doctofiche n’aie plus peur d’être seul face à ton patient en
          consultation.
        </p>
        <div class="hero-button w-100 mr-0 text-right">
          <a class="btn btn-primary mr-0 ml-auto shadow" href="/pages/plans">Commencez Gratuitement</a>
        </div>
      </div>

    </div>
  </section>

  <!--Second section-->
  <div id="video" class="video-section">
    <h1>Découvrez Doctofiche en vidéo</h1>
    <video class='video' width="auto" height="auto" controls poster="/assets/video/poster.png">
      <source poster="/assets/video/poster.png" src="/assets/video/doctofiche-presentation.mp4" type="video/mp4">
      Your browser does not support the video tag.
    </video>
    <img class='blop__second' src="/assets/blops/Doctofiche Blobs_Right side blue blob.png" />
  </div>

  <!--Third section-->
  <section id="about" class="about container">
    <div class="blops__three">
      <img class='blop' src="/assets/blops/Doctofiche Blobs_Main transparent blob.png">
      <div class="row sec-why">
        <div class="col-xs-12 col-md-8 offset-md-1 info">
          <h1>Doctofiche Pourquoi ?</h1>
          <h4>Tu connais tous tes items ECN?</h4>
          <p>Bravo, moi aussi j’étais comme toi! <br />
            Puis, avec les cours à la fac, les stages, les remplacements, j’ai vite réalisé qu’être médecin généraliste était une spécialité à part entière, bien plus complexe que je ne pouvais l'imaginer.
          </p>
          <h4>Quel genre de médecin tu veux être ? A toi de choisir !</h4>
          <p>
            Celui qui ne veut voir que de l’aigü, faire de la « bobologie », OU </br>
            Alors un médecin pluri-compétant capable de prendre en charge un patient dans sa globalité?
          </p>
          <h4>Moi, c’est Alexandre,</h4>
          <p>
            Un ancien interne et jeune médecin généraliste, et j’ai décidé de prendre la seconde option !
            C’est pourquoi, j’ai créé Doctofiche ! Créé initialement pour moi et mes anciens co-internes.
          </p>
          <h4>Mes premiers remplas ?</h4>
          <p>
            Mélange entre joie, excitation, mais aussi, nervosité, peur de l’oubli ou hésitant
            dans mes prises de décision voire même d’être jugé incompétent.</br>
            A chaque difficulté rencontrée, je créais une fiche le soir même afin de l’avoir
            toujours à portée de main. Avoir mes fiches,mes protocoles ou mes contacts de confrères
            spécialistes à portée de main, m’ont redonné confiance et assurance !
          </p>
          <h4>J’espère que cet outil t’aidera autant qu’il m’a aidé !</h4>
          <p>
            Allez, finis les cours, les livres.</br>
            Fais de tes expériences de terrain un tremplin pour devenir le médecin que tu veux devenir!
          </p>
        </div>
        <div class="col column col-xs-12 col-md-2 info portrait">
          <img src="assets/images_proto/dr_alexandre.jpg" alt="" />
          <div class="alt-text">
            <h4 class="pt-2 pb-1">Alexandre</h4>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="services" class="services pt-5">
    <!-- <img src="blops/Doctofiche Blobs_Main grey blob.png" alt="" class="blop__four"> -->
    <div class="container">

      <h1 class="text-center">Nos services</h1>
      <div class="row">
        <div class="col-sm grid-s-3">
          <div class="icon"><img src="assets/icon_proto/Icon - Un compte personnalis.svg" alt=""></div>
          <h5 class="mt-3 mb-3">Un compte personnalisé</h5>
          <p>Doctofiche vous permet d'avoir
            accès à un compte personnalisé
            dans lequel vous pourrez consulter ,
            modifier , supprimer des fiches et
            être à jour dans le domaine
            médicale sans stress!
          </p>
        </div>
        <div class="col-sm grid-s-3">
          <div class="icon"><img src="assets/icon_proto/Icon - Ajout de ses propres fiches.svg" alt=""></div>
          <h5 class="mt-3 mb-3">Ajout de ses propres fiches</h5>
          <p>Vous avez appris une nouvelle
            fiche , ajouter là , et vous pourrez la
            retrouver en quelques cliques en
            cas de trous de mémoire lors d'une
            consultation.</p>
        </div>
        <div class="col-sm grid-s-3">
          <div class="icon"><img src="assets/icon_proto/Icon - Comptabilit personnalis.svg" alt=""></div>
          <h5 class="mt-3 mb-3">Comptabilité personnalisé</h5>
          <p>Vous faites des remplacements de
            médecins , pas de problème, gérez
            la Comptabilité et restez à jour à
            partir de votre compte Doctofiche.</p>
        </div>
        <div class="col-sm grid-s-3">
          <div class="icon"><img src="assets/icon_proto/Icon - Mise jour.svg" alt=""></div>
          <h5 class="mt-3 mb-3">Mise à jour</h5>
          <p>Vous pourrez avoir accès à des
            nouvelles recommandations
            médicales et à des articles
            médicaux.Vous serez prévenu par
            une notification.</p>
        </div>
      </div>


  </section>

  <!--Last section-->
  <div id="video" class="video-section">
    <h1>Comment fonctionne Doctofiche?</h1>
    <video class='video' width="auto" height="auto" controls poster="/assets/video/poster_tuto.png">
      <source src="/assets/video/tuto.mp4" type="video/mp4">
      Your browser does not support the video tag.
    </video>
    <img class='blop__second' src="/assets/blops/Doctofiche Blobs_Right side blue blob.png" />
  </div>

  <section class="testimonials-section">
    <img src="/assets/blops/Doctofiche Blobs_Blue gradient blob.png" alt="" class="blop__five" />

    <h1 class="text-center">Témoignages d'utilisateurs</h1>
    <div class="testimony testimonials">

      <!-- Flickity HTML init -->
      <div class="carousel" data-flickity='{ "groupCells": true,"draggable":false,"wrapAround": true }'>
        <div class="carousel-cell bg-white">
          <span>
            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="quote-left" class="svg-inline--fa fa-quote-left fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
              <path fill="#0095d9" d="M464 256h-80v-64c0-35.3 28.7-64 64-64h8c13.3 0 24-10.7 24-24V56c0-13.3-10.7-24-24-24h-8c-88.4 0-160 71.6-160 160v240c0 26.5 21.5 48 48 48h128c26.5 0 48-21.5 48-48V304c0-26.5-21.5-48-48-48zm-288 0H96v-64c0-35.3 28.7-64 64-64h8c13.3 0 24-10.7 24-24V56c0-13.3-10.7-24-24-24h-8C71.6 32 0 103.6 0 192v240c0 26.5 21.5 48 48 48h128c26.5 0 48-21.5 48-48V304c0-26.5-21.5-48-48-48z"></path>
            </svg>
          </span>
          <p style="font-style: italic; font-family:'Lucida Bright'; opacity: .75; font-size: 1rem;">
            Avec Doctofiche, j’ai toujours accès à l’ensemble de mes fiches, et ça, même dans les 2 cabinets où je remplace !
          </p>
          <hr style="width:100%;text-align:center;margin-left:0">

          <div class="testimonial-image">

            <div class="alt-text ml-3">
              <h3 class="mb-0">Nicolas</h3>
              <span style="opacity: .5; font-variant: small-caps;">1ère année d’interne Med G</span>
            </div>
          </div>

        </div>


        <div class="carousel-cell bg-white">
          <span>
            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="quote-left" class="svg-inline--fa fa-quote-left fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
              <path fill="#0095d9" d="M464 256h-80v-64c0-35.3 28.7-64 64-64h8c13.3 0 24-10.7 24-24V56c0-13.3-10.7-24-24-24h-8c-88.4 0-160 71.6-160 160v240c0 26.5 21.5 48 48 48h128c26.5 0 48-21.5 48-48V304c0-26.5-21.5-48-48-48zm-288 0H96v-64c0-35.3 28.7-64 64-64h8c13.3 0 24-10.7 24-24V56c0-13.3-10.7-24-24-24h-8C71.6 32 0 103.6 0 192v240c0 26.5 21.5 48 48 48h128c26.5 0 48-21.5 48-48V304c0-26.5-21.5-48-48-48z"></path>
            </svg>
          </span>
          <p style="font-style: italic; font-family:'Lucida Bright'; opacity: .75; font-size: 1rem;">
            Je peux me lancer, plus confiant dans les remplacements car je sais qu’en moins de 3 clics j’ai accès à l’information dont j’ai besoin et que j’aurai créée moi-même !
          </p>
          <hr style="width:100%;text-align:center;margin-left:0">

          <div class="testimonial-image ">

            <div class="alt-text ml-2">
              <h3 class="mb-0">Anne Sophie</h3>
              <span style="opacity: .5; font-variant: small-caps;">Médecin généraliste thésé </span>
            </div>
          </div>

        </div>

        <div class="carousel-cell bg-white">
          <span>
            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="quote-left" class="svg-inline--fa fa-quote-left fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
              <path fill="#0095d9" d="M464 256h-80v-64c0-35.3 28.7-64 64-64h8c13.3 0 24-10.7 24-24V56c0-13.3-10.7-24-24-24h-8c-88.4 0-160 71.6-160 160v240c0 26.5 21.5 48 48 48h128c26.5 0 48-21.5 48-48V304c0-26.5-21.5-48-48-48zm-288 0H96v-64c0-35.3 28.7-64 64-64h8c13.3 0 24-10.7 24-24V56c0-13.3-10.7-24-24-24h-8C71.6 32 0 103.6 0 192v240c0 26.5 21.5 48 48 48h128c26.5 0 48-21.5 48-48V304c0-26.5-21.5-48-48-48z"></path>
            </svg>
          </span>
          <p style="font-style: italic; font-family:'Lucida Bright'; opacity: .75; font-size: 1rem;">
            Merci! enfin un outil complet pensé pour les internes ! Super la partie comptabilité, cela me facilite la vie !
          </p>
          <hr style="width:100%;text-align:center;margin-left:0">

          <div class="testimonial-image">

            <div class="alt-text ml-2">
              <h3 class="mb-0">Karim</h3>
              <span style="opacity: .5; font-variant: small-caps;">Remplaçant Med G non thésé </span>
            </div>
          </div>

        </div>

        <div class="carousel-cell bg-white">
          <span>
            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="quote-left" class="svg-inline--fa fa-quote-left fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
              <path fill="#0095d9" d="M464 256h-80v-64c0-35.3 28.7-64 64-64h8c13.3 0 24-10.7 24-24V56c0-13.3-10.7-24-24-24h-8c-88.4 0-160 71.6-160 160v240c0 26.5 21.5 48 48 48h128c26.5 0 48-21.5 48-48V304c0-26.5-21.5-48-48-48zm-288 0H96v-64c0-35.3 28.7-64 64-64h8c13.3 0 24-10.7 24-24V56c0-13.3-10.7-24-24-24h-8C71.6 32 0 103.6 0 192v240c0 26.5 21.5 48 48 48h128c26.5 0 48-21.5 48-48V304c0-26.5-21.5-48-48-48z"></path>
            </svg>
          </span>
          <p style="font-style: italic; font-family:'Lucida Bright'; opacity: .75; font-size: 1rem;">
            Je peux devant mon patient retrouver ma fiche ou mon protocole en moins de 5 secondes! Je ne perds plus de temps à faire mes recherches sur Google ou sur mes fiches Word en pleine consultation!
          </p>
          <hr style="width:100%;text-align:center;margin-left:0">

          <div class="testimonial-image ">

            <div class="alt-text ml-2">
              <h3 class="mb-0">Emilie</h3>
              <span style="opacity: .5; font-variant: small-caps;">Interne</span>
            </div>
          </div>

        </div>

        <div class="carousel-cell bg-white">
          <span>
            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="quote-left" class="svg-inline--fa fa-quote-left fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
              <path fill="#0095d9" d="M464 256h-80v-64c0-35.3 28.7-64 64-64h8c13.3 0 24-10.7 24-24V56c0-13.3-10.7-24-24-24h-8c-88.4 0-160 71.6-160 160v240c0 26.5 21.5 48 48 48h128c26.5 0 48-21.5 48-48V304c0-26.5-21.5-48-48-48zm-288 0H96v-64c0-35.3 28.7-64 64-64h8c13.3 0 24-10.7 24-24V56c0-13.3-10.7-24-24-24h-8C71.6 32 0 103.6 0 192v240c0 26.5 21.5 48 48 48h128c26.5 0 48-21.5 48-48V304c0-26.5-21.5-48-48-48z"></path>
            </svg>
          </span>
          <p style="font-style: italic; font-family:'Lucida Bright'; opacity: .75; font-size: 1rem;">
            Une mention spéciale pour la Partie « conseils », qui me permet d’imprimer directement des fiches conseils pour mes patients
          </p>
          <hr style="width:100%;text-align:center;margin-left:0">

          <div class="testimonial-image ml-2">

            <div class="alt-text">
              <h3 class="mb-0">Mathilde</h3>
              <span style="opacity: .5; font-variant: small-caps;">3eme année d’interne Med G</span>
            </div>
          </div>

        </div>

        <div class="carousel-cell bg-white">
          <span>
            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="quote-left" class="svg-inline--fa fa-quote-left fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
              <path fill="#0095d9" d="M464 256h-80v-64c0-35.3 28.7-64 64-64h8c13.3 0 24-10.7 24-24V56c0-13.3-10.7-24-24-24h-8c-88.4 0-160 71.6-160 160v240c0 26.5 21.5 48 48 48h128c26.5 0 48-21.5 48-48V304c0-26.5-21.5-48-48-48zm-288 0H96v-64c0-35.3 28.7-64 64-64h8c13.3 0 24-10.7 24-24V56c0-13.3-10.7-24-24-24h-8C71.6 32 0 103.6 0 192v240c0 26.5 21.5 48 48 48h128c26.5 0 48-21.5 48-48V304c0-26.5-21.5-48-48-48z"></path>
            </svg>
          </span>
          <p style="font-style: italic; font-family:'Lucida Bright'; opacity: .75; font-size: 1rem;">
            Je viens de faire une semaine de rempla et je l'avais toujours ouvert à côté de moi! Honnêtement, cela m'a beaucoup aidé! Merci.
          </p>
          <hr style="width:100%;text-align:center;margin-left:0">

          <div class="testimonial-image ml-2">

            <div class="alt-text">
              <h3 class="mb-0">Myriam</h3>
              <span style="opacity: .5; font-variant: small-caps;">Interne non thésée</span>
            </div>
          </div>

        </div>

      </div>


    </div>

    </div>
  </section>

  <section class="gratitude">
    <div class="section container mt-5 mb-5 pt-5 pb-5">
      <div class="wrapper pt-md-5 pb-md-5 pb-1 pt-1 m-auto">
        <h2>Créez votre compte gratuit</h2>
        <p>Commencez à utiliser Doctofiche dès aujourd'hui. Créez votre compte
          gratuitement et accédez à des milliers de notes médicales en un seul endroit.</p>

        <div class="gratitude-button">
          <a class="btn btn-primary mr-0 ml-auto shadow" href="/pages/plans">Commencez Gratuitement</a>
        </div>

      </div>

    </div>
  </section>


  <div class="container footer-top">
    <div class="footer-container">
      <div class="row">
        <div class="col-s-3 custom-spaacing">
          <h3>DOCTOFICHE</h3>
          <ul class="useful-links p-0">
            <li class="item"><a href="#about">Pourquoi Doctofiche ?</a></li>
            <li class="item"><a href="#services">Nos Services</a></li>
            <li class="item"><a href="#video">Bénéfices</a></li>
            <li class="item"><a href="/pages/plans#plans">Plans</a></li>
            <li class="item">Contactez-nous</li>
            <li class="item"><a href="/pages/about">Mentions Légales</a></li>
          </ul>
        </div>
        <div id="contact" class="col-s-3 custom-spaacing">
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
            <button type="button" class="btn btn-primary w-100 footer-submit shadow">Envoyer</button>
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