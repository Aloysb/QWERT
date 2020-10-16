<?php require APPROOT . '/views/inc/header.php' ?>
<?php require APPROOT . '/views/inc/navbar_home.php' ?>
<main>
  <section id="plans" class="plans">
    <h1 class='plans__title'>Choisis la formule <br> qui te convient</h1>
    <!-- <h2 class="plans__subtitle lead mb-2">Tu viens d'avoir ton <span class="color">ECN?</span> On t'offre <span class="color">1 an gratuit!</span>  -->
    <h2 class="plans__subtitle lead mb-2">On t'offre <span class="color">3 mois</span> pour essayer notre plateforme <span class="color">sans engagement</span>.</h2>
    <div class="plans__cards">
      <div class="card" style="color: #0095d9;">
        <div style="height: 1.2rem"></div>
        <h2 class="card__title" style="color: #0095d9;">Classique</h2>
        <hr />
        <div style="height: 1.9rem"></div>
        <h3 class="card__price" style="color: #5a5a5a;">0 €<small style="color: #5a5a5a;">/Mois</small></h3>
        <div style="height: 1.9rem"></div>
        <hr />
        <ul class='card__list'>
          <li><img style="height: 1rem; width: auto; opacity: 1" src='/assets/icon_proto/Icon - Check.svg' />&nbsp;&nbsp;Accès illimité aux fiches</li>
          <li><img style="height: 1rem; width: auto; opacity: 1" src='/assets/icon_proto/Icon - Cross.svg' />&nbsp;&nbsp;Possibilité de les compléter et/ou les modifier</li>
          <li><img style="height: 1rem; width: auto; opacity: 1" src='/assets/icon_proto/Icon - Cross.svg' />&nbsp;&nbsp;Créer et classer ses propres fiches</li>
          <li><img style="height: 1rem; width: auto; opacity: 1" src='/assets/icon_proto/Icon - Cross.svg' />&nbsp;&nbsp;Logiciel de comptabilité en ligne de ses remplas</li>
          <li><img style="height: 1rem; width: auto; opacity: 1" src='/assets/icon_proto/Icon - Cross.svg' />&nbsp;&nbsp;Aide administrative + contact expert comptable</li>
          <li><img style="height: 1rem; width: auto; opacity: 1" src='/assets/icon_proto/Icon - Cross.svg' />&nbsp;&nbsp;Notification des nouvelles recommandations</li>
        </ul>
        <hr />
        <div class='d-flex align-items-center'>
          <a class="card__button btn btn-success shadow" href='/pages/inscription' style="height: 2.3em;">S'inscrire gratuitement</a>
        </div>
      </div>
      <div class="card">
        <div style="height: 1rem"></div>
        <h2 class="card__title" style="color: #0095d9;">Pro</h2>

        <hr />
        <h3 class="card__price" style="color: #5a5a5a;; opacity: ; font-size: 1rem">Testez le 3 mois gratuitement </h3>
        <h3><small style="color: #5a5a5a;opacity:.9;font-weight: 400; font-size: .8rem;">puis</small></h3>
        <h3 class="card__price" style="color: #5a5a5a">19 €<small> /Mois et <span style="color: #0095d9">sans engagement</span></small></h3>
        <!-- <h3><small style="color: #5a5a5a; opacity:.0; font-size:.8rem">(Tout ça pour moins qu'une consultation par mois!)</small></h3> -->
        <hr />
        <ul class='card__list'>
          <li><img style="height: 1rem; width: auto; opacity: 1" src='/assets/icon_proto/Icon - Check.svg' />&nbsp;&nbsp;Accès illimité aux fiches</li>
          <li><img style="height: 1rem; width: auto; opacity: 1" src='/assets/icon_proto/Icon - Check.svg' />&nbsp;&nbsp;Possibilité de les compléter et/ou les modifier</li>
          <li><img style="height: 1rem; width: auto; opacity: 1" src='/assets/icon_proto/Icon - Check.svg' />&nbsp;&nbsp;Créer et classer ses propres fiches</li>
          <li><img style="height: 1rem; width: auto; opacity: 1" src='/assets/icon_proto/Icon - Check.svg' />&nbsp;&nbsp;Logiciel de comptabilité en ligne de ses remplas</li>
          <li><img style="height: 1rem; width: auto; opacity: 1" src='/assets/icon_proto/Icon - Check.svg' />&nbsp;&nbsp;Aide administrative + contact expert comptable</li>
          <li><img style="height: 1rem; width: auto; opacity: 1" src='/assets/icon_proto/Icon - Check.svg' />&nbsp;&nbsp;Notification des nouvelles recommandations</li>
        </ul>
        <hr />
        <div>
          <a href="/pages/inscription-pro" class="card__button btn btn-success shadow" style="height: 2.3em;">Formule PRO</a>
        </div>
      </div>
    </div>
    <div id="video" class="video-section mt-5">
      <h1>Comment fonctionne Doctofiche?</h1>
      <video class='video' width="auto" height="auto" controls poster="/assets/video/poster_tuto.png">
        <source src="/assets/video/tuto.mp4" type="video/mp4">
        Your browser does not support the video tag.
      </video>
    </div>
    <img src="/assets/blops/Doctofiche Blobs_Grey blob behind docteur.png" alt="" class="blop_one">
    <img class='blop_two' src="/assets/blops/Doctofiche Blobs_Right side blue blob.png" />
    <img class='blop_three' src="/assets/blops/Doctofiche Blobs_Main transparent blob.png">
    <img src="assets/blops/Doctofiche Blobs_Grey blob behind docteur.png" alt="" class="blop_one">
  </section>

  <section class="gratitude">
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
  </section>
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

<script src="https://js.stripe.com/v3/"></script>
<script>
  var stripe = Stripe('pk_live_51HCWUzFkUJgkN5qoYYqvCpKirPu8yMD0gruy1PZM3xQs8SjFPdW7JduugrdUyqzQaneun6J9ko5Xy9cU2vwMHeO000c5VwCLcB');
  var checkoutButton = document.getElementById('subscription-btn');
  let session = <?= $data['session'] ?>;
  const CHECKOUT_SESSION_ID = session.id;

  console.log(CHECKOUT_SESSION_ID);

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
</script>