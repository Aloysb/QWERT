<?php // Tableau des départements français ! 

$departements = array();

$departements['01'] = 'Ain';
$departements['02'] = 'Aisne';
$departements['03'] = 'Allier';
$departements['04'] = 'Alpes de Haute Provence';
$departements['05'] = 'Hautes Alpes';
$departements['06'] = 'Alpes Maritimes';
$departements['07'] = 'Ardèche';
$departements['08'] = 'Ardennes';
$departements['09'] = 'Ariège';
$departements['10'] = 'Aube';
$departements['11'] = 'Aude';
$departements['12'] = 'Aveyron';
$departements['13'] = 'Bouches du Rhône';
$departements['14'] = 'Calvados';
$departements['15'] = 'Cantal';
$departements['16'] = 'Charente';
$departements['17'] = 'Charente Maritime';
$departements['18'] = 'Cher';
$departements['19'] = 'Corrèze';
$departements['2A'] = 'Corse du Sud';
$departements['2B'] = 'Haute Corse';
$departements['21'] = 'Côte d\'Or';
$departements['22'] = 'Côtes d\'Armor';
$departements['23'] = 'Creuse';
$departements['24'] = 'Dordogne';
$departements['25'] = 'Doubs';
$departements['26'] = 'Drôme';
$departements['27'] = 'Eure';
$departements['28'] = 'Eure et Loir';
$departements['29'] = 'Finistère';
$departements['30'] = 'Gard';
$departements['31'] = 'Haute Garonne';
$departements['32'] = 'Gers';
$departements['33'] = 'Gironde';
$departements['34'] = 'Hérault';
$departements['35'] = 'Ille et Vilaine';
$departements['36'] = 'Indre';
$departements['37'] = 'Indre et Loire';
$departements['38'] = 'Isère';
$departements['39'] = 'Jura';
$departements['40'] = 'Landes';
$departements['41'] = 'Loir et Cher';
$departements['42'] = 'Loire';
$departements['43'] = 'Haute Loire';
$departements['44'] = 'Loire Atlantique';
$departements['45'] = 'Loiret';
$departements['46'] = 'Lot';
$departements['47'] = 'Lot et Garonne';
$departements['48'] = 'Lozère';
$departements['49'] = 'Maine et Loire';
$departements['50'] = 'Manche';
$departements['51'] = 'Marne';
$departements['52'] = 'Haute Marne';
$departements['53'] = 'Mayenne';
$departements['54'] = 'Meurthe et Moselle';
$departements['55'] = 'Meuse';
$departements['56'] = 'Morbihan';
$departements['57'] = 'Moselle';
$departements['58'] = 'Nièvre';
$departements['59'] = 'Nord';
$departements['60'] = 'Oise';
$departements['61'] = 'Orne';
$departements['62'] = 'Pas de Calais';
$departements['63'] = 'Puy de Dôme';
$departements['64'] = 'Pyrénées Atlantiques';
$departements['65'] = 'Hautes Pyrénées';
$departements['66'] = 'Pyrénées Orientales';
$departements['67'] = 'Bas Rhin';
$departements['68'] = 'Haut Rhin';
$departements['69'] = 'Rhône-Alpes';
$departements['70'] = 'Haute Saône';
$departements['71'] = 'Saône et Loire';
$departements['72'] = 'Sarthe';
$departements['73'] = 'Savoie';
$departements['74'] = 'Haute Savoie';
$departements['75'] = 'Paris';
$departements['76'] = 'Seine Maritime';
$departements['77'] = 'Seine et Marne';
$departements['78'] = 'Yvelines';
$departements['79'] = 'Deux Sèvres';
$departements['80'] = 'Somme';
$departements['81'] = 'Tarn';
$departements['82'] = 'Tarn et Garonne';
$departements['83'] = 'Var';
$departements['84'] = 'Vaucluse';
$departements['85'] = 'Vendée';
$departements['86'] = 'Vienne';
$departements['87'] = 'Haute Vienne';
$departements['88'] = 'Vosges';
$departements['89'] = 'Yonne';
$departements['90'] = 'Territoire de Belfort';
$departements['91'] = 'Essonne';
$departements['92'] = 'Hauts de Seine';
$departements['93'] = 'Seine St Denis';
$departements['94'] = 'Val de Marne';
$departements['95'] = 'Val d\'Oise';
$departements['97'] = 'DOM';
$departements['971'] = 'Guadeloupe';
$departements['972'] = 'Martinique';
$departements['973'] = 'Guyane';
$departements['974'] = 'Réunion';
$departements['975'] = 'Saint Pierre et Miquelon';
$departements['976'] = 'Mayotte';

?>

<?php require APPROOT . '/views/inc/header.php'; ?>
<?php if (isset($_SESSION['data'])) {
  $data = $_SESSION['data'];
}
if (isset($_SESSION['errors'])) {
  $error = $_SESSION['errors'];
}
?>
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
    <form method="POST" action="/users/register" autocomplete="off">
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


<!-- <footer class="container footer-bottom-connexion" role="contentinfo">
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
</footer> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<?php require APPROOT . '/views/inc/footer.php'; ?>