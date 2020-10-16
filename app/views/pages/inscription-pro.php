<?php require APPROOT . '/views/inc/header.php'; ?>

<?php if (isset($_SESSION['data'])) {
  $data = $_SESSION['data'];
}
if (isset($_SESSION['form'])) {
  $form = $_SESSION['form'];
};
if (isset($_SESSION['session'])) {
  $session = $_SESSION['session'];
  unset($_SESSION['session']);
};
if (isset($_SESSION['errors'])) {
  $error = $_SESSION['errors'];
}; ?>
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
      <p>Déjà inscrit ?</p>
      <a class="shadow" href="/pages/connexion">Connectez-vous!</a>
    </div>
  </div>
</nav>

<main class="main main--connexion main--inscription container" role="main">
  <div class="form px-0">
    <h3>Inscription</h3>
    <form method="POST" action="/users/registerpro" autocomplete="off">
      <div class="row">
        <div class="col-sm-6">
          <input class="form-control <?= (!empty($error['name'])) ? 'is-invalid' : ''; ?> " value="<?= isset($data['name']) ? $data['name'] : ''; ?>" type="text" name="name" id="name" placeholder="Nom" />
          <span class="invalid-feedback">
            <?= isset($error['name']) ? $error['name'] : ''; ?>
          </span>
        </div>
        <div class="col-sm-6">
          <input class="form-control <?= (!empty($error['firstName'])) ? 'is-invalid' : ''; ?>" value="<?= isset($data['firstName']) ? $data['firstName'] : ''; ?>" type="text" name="firstName" id="firstName" placeholder="Prénom" />
          <span class="invalid-feedback">
            <?= (!empty($error['firstName'])) ? $error['firstName'] : ''; ?>
          </span>
        </div>
      </div>
      <input class="form-control  <?= (!empty($error['mail'])) ? 'is-invalid' : ''; ?>" value="<?= isset($data['mail']) ? $data['mail'] : ''; ?>" type="email" name="mail" id="mail" placeholder="Email" />
      <span class="invalid-feedback">
        <?= (!empty($error['mail'])) ? $error['mail'] : '' ?>
      </span>
      <!-- <div class="form-group row d-flex align-items-center mt-3">
        <label for="birth_date" class="col-sm-6 col-form-label <?= (!empty($error['birth_date'])) ? 'is-invalid' : ''; ?> ">Date de naissance</label>

        <div class="col-sm-6">
          <input type="text" name="birth_date" class="form-control mt-0 <?= (!empty($error['birth_date'])) ? 'is-invalid' : ''; ?> " " id=" birth_date" placeholder="JJ/MM/AAAA" onfocus="(this.type='date')" />
        </div>
      </div>
      <span class="invalid-feedback">
        <?= isset($error['birth_date']) ? $error['birth_date'] : ''; ?>
      </span>
      <div class="row mt-3 d-flex justify-content-around">
        <legend class="col-form-label col-sm-6 pt-0">Sexe</legend>
        <div class="col-sm-3">
          <div class="form-check d-flex align-items-center">
            <input class="form-check-input mt-0 <?= (!empty($error['name'])) ? 'is-invalid' : ''; ?> " " type='radio' name=" sex" value="F" id="sexF" checked>
            <label class="form-check-label <?= (!empty($error['name'])) ? 'is-invalid' : ''; ?> " " for=" sexF">
              Femme
            </label>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-check d-flex align-items-center">
            <input class="form-check-input mt-0 <?= (!empty($error['name'])) ? 'is-invalid' : ''; ?> " " type='radio' name=" sex" value="H" id='sexeH'>
            <label class="form-check-label <?= (!empty($error['name'])) ? 'is-invalid' : ''; ?> " " for=" sexeH">
              Homme
            </label>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <input class="form-control <?= (!empty($error['ecn_year'])) ? 'is-invalid' : ''; ?> " " type=" number" placeholder="Année de passage ECN" name="ecn_year" id="ecn_year" min="1920" max="2022">
          <span class="invalid-feedback">
            <?= (!empty($error['ecn_year'])) ? $error['ecn_year'] : ''; ?>
          </span>
        </div>
        <div class="col-sm-6 mt-3">
          <select class="custom-select <?= (!empty($error['ecn_place'])) ? 'is-invalid' : ''; ?> " " placeholder=" Département ECN" name="ecn_place" id="ecn_place">
            <option selected value="0">Département ECN</option>
            <?php foreach ($departements as $index => $departement) : ?>
              <option value=<?= $index; ?>><?= $index . ' - ' . $departement; ?></option>
            <?php endforeach; ?>
          </select>
          <span class="invalid-feedback">
            <?= (!empty($error['ecn_place'])) ? $error['ecn_place'] : ''; ?>
          </span>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <input class="form-control <?= (!empty($error['ecn_school'])) ? 'is-invalid' : ''; ?>" value="<?= isset($data['ecn_school']) ? $data['ecn_school'] : ''; ?>" type="text" name="ecn_school" id="ecn_school" placeholder="Faculté ECN" />
          <span class="invalid-feedback">
            <?= (!empty($error['ecn_school'])) ? $error['ecn_school'] : ''; ?>
          </span>
        </div>
      </div>

      <div class="row mt-3">
        <div class="col-sm-12">
          <select name="status" id="status" class="custom-select <?= (!empty($error['status'])) ? 'is-invalid' : ''; ?> " ">
                        <option selected value='null'>Status</option>
                        <option value=" externe">Externe</option>
            <option value="interne-non-these">Interne non thésé</option>
            <option value="interne-these">Interne thésé</option>
            <option value="medecin">Médecin</option>
          </select>
        </div>
        <span class="invalid-feedback">
          <?= (!empty($error['status'])) ? $error['status'] : ''; ?>
        </span>
      </div>
      <input class="form-control" type="text" name="login" id="login" placeholder="Pseudonyme" hidden value="NULL" />
      <span class="invalid-feedback">
        <?= (!empty($error['login'])) ? $error['login'] : '' ?>
      </span> -->
      <input class="form-control <?= (!empty($error['password'])) ? 'is-invalid' : ''; ?>" type="password" name="password" id="password" autocomplete="off" placeholder="Mot de passe">
      <span class="invalid-feedback">
        <?= (!empty($error['password'])) ? $error['password'] : '' ?>
      </span>
      <small><span class="pwd_rules text-center">8 caractères min. inclus un chiffre, une majuscule et un caractère spécial(!,@,#,$,%).</span></small>
      <input class="form-control <?= (!empty($error['password_repeat'])) ? 'is-invalid' : ''; ?>" type="password" name="password_repeat" id="password-repeat" placeholder="Confirmez le mot de passe" />
      <span class="invalid-feedback">
        <?= (!empty($error['password_repeat'])) ? $error['password_repeat'] : '' ?>
      </span>
      <div class="d-flex justify-content-center mb-2"><button class="btn btn-primary btn_2 btn-lg shadow" type="submit" name="submit">S'inscrire</button></div>
      <input class='hidden' type="text" name="workplace" class="form-control" style="display: none" placeholder="workplace">
  </div>
  <input type="hidden" name="recaptcha_response_register" id="recaptchaResponseRegister">
  </form>
  </div>
</main>

<?php if (isset($session)) : ?>

  <script src="https://js.stripe.com/v3/"></script>
  <script>
    // var stripe = Stripe('pk_live_51HCWUzFkUJgkN5qoYYqvCpKirPu8yMD0gruy1PZM3xQs8SjFPdW7JduugrdUyqzQaneun6J9ko5Xy9cU2vwMHeO000c5VwCLcB');

    const stripe = Stripe('pk_test_51HCWUzFkUJgkN5qoa7sdB9iSPaALT6AC34rFWoPYNrLvXIzAjvP2wyHWA7CH9I5h9ggHyGVHAyyfuO8Z2RAUzc6r000XH0ARNG');

    let session = <?= $session['session'] ?>;

    // //3 months free.
    const CHECKOUT_SESSION_ID = session.id;

    (function() {
      stripe.redirectToCheckout({
        // // Make the id field from the Checkout Session creation API response
        // // available to this file, so you can provide it as argument here
        // // instead of the {{CHECKOUT_SESSION_ID}} placeholder.
        sessionId: CHECKOUT_SESSION_ID
      }).then(function(result) {
        // // If `redirectToCheckout` fails due to a browser or network
        // // error, display the localized error message to your customer
        // // using `result.error.message`.
        console.log(result);
      });
    })()
  </script>
<?php endif; ?>

<?php require APPROOT . '/views/inc/footer.php'; ?>



<!-- <?php if (!empty($_SESSION['errors'])) : ?>
<>
    $('#extraInfoUserModal').modal('show')
</>
<?php endif; ?> -->