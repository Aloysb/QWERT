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
<?php $_SESSION['edit-profile'] = 0 ?>
<!--::header part start::-->

<header class="head head-profile" role="banner">

  <?php
  $data = reset($data['data_user']);
  ?>

  <nav class="navbar navbar-expand-lg" id="profile-nav">
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
    <div class="collapse navbar-collapse" id="">
      <div class="navbar-nav">
        <div class="menu menu-middle">
          <a class="user__avatar__link" data-toggle="modal" data-target="#exampleModal">
            <img class="user__avatar--large" src="<?= '/img/' . $data->{'avatar'}; ?>" height="100" width="100" />
          </a>
          <h2 class='user__name'>Bonjour <?= $data->{'firstname'}; ?></h2>
          <?php if ($_SESSION['edit-profile'] == 0) : ?>
            <div class="profile-actions">
              <div class='btn btn-outline-<?= ($data->{'ecn_year'} == NULL) ? 'danger' : 'primary'; ?>' id="edit-profile">
                <?= ($data->{'ecn_year'} == NULL) ? 'Compléter mon profil'
                  : 'Modifier'; ?></div>

            </div>
          <?php endif; ?>
        </div>
        <ul class="menu">
          <?php if ($_SESSION['data_user']->{'role'} == 'ROLE_ADMIN') : ?>
            <li class="login-btn btn">
              <a href='/admin/list_users'> <button class="btn">
                  Liste utilisateurs
                </button>
              </a>
            </li>
          <?php endif; ?>
          <li class="login-btn btn">
            <a href='/pages/connexion'>
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
<div class="container-fluid container-profil">
  <div class="blop blop__one">
    <svg viewBox="0 0 500 500" xmlns="http://www.w3.org/2000/svg" width="100%" id="blobSvg">
      <path id="blob" d="M335.5,348Q250,446,140.5,348Q31,250,140.5,142.5Q250,35,335.5,142.5Q421,250,335.5,348Z" fill="#0095d9"></path>
      <div class="blop blop__two">
        <svg viewBox="0 0 500 500" xmlns="http://www.w3.org/2000/svg" width="100%" id="blobSvg">
          <path id="blob" d="M317.5,328.5Q159,407,156.5,245.5Q154,84,315,167Q476,250,317.5,328.5Z" fill="#0095d9"></path>
        </svg>
      </div>
    </svg>
  </div>
  <div class="row row-profil">
    <div class="col-md-6 col-sm-8 col-xs-12 mx-auto col-profil">
      <table class="table">
        <tbody>
          <tr>
            <td class="thead"><span class="titlehead">Prénom</span></td>
            <td><input class="titlevalue" value="<?= $data->{'firstname'}; ?>" disabled /></td>
          </tr>
          <tr>
            <td class="thead"> <span class="titlehead">Nom</span></td>
            <td><input class="titlevalue" value="<?= $data->{'name'}; ?>" disabled />
            </td>
          </tr>
          <tr>
            <td class="thead"><span class="titlehead">Courriel</span></td>
            <td><input class="titlevalue" value="<?= $data->{'mail'}; ?>" disabled />
          </tr>
          <tr>
            <td class="thead"> <span class="titlehead">Date de naissance</span></td>
            <td><input class="titlevalue" type="date" value="<?= $data->{'birth_date'}; ?>" disabled />
            </td>
          </tr>
          <tr>
            <td class="thead"> <span class="titlehead ">Sexe</span></td>
            <td class="sex">
              <div class="form-check d-flex align-items-center">
                <input class="form-check-input mt-0 titlevalue mr-4 pr-4" type="radio" name="sex" value="F" id="sexF" disabled <?= ($data->{'sex'} == 'F') ? 'checked' : ''; ?>>
                <label class="form-check-label ml-5 pl-4" for="sexF">
                  Femme
                </label>
              </div>
    </div>
    <div class="col-sm-3">
      <div class="form-check d-flex align-items-center">
        <input class="form-check-input mt-0 titlevalue <?= (!empty($error['name'])) ? 'is-invalid' : ''; ?> " " type='radio' name='sex' value='H' id='sexeH' disabled <?= ($data->{'sex'} == 'H') ? 'checked' : ''; ?>>
        <label class=" form-check-label ml-4 <?= (!empty($error['name'])) ? 'is-invalid' : ''; ?> " " for='sexeH'>
        Homme
        </label>
      </div>
      </td>
      </tr>
      <tr>
        <td class="thead"> <span class="titlehead">Année obtention ECN</span></td>
        <td><input class="titlevalue" type="number" min="1920" max="2020" value="<?= $data->{'ecn_year'}; ?>" disabled />
        </td>
      </tr>
      <tr>
        <td class="thead"> <span class="titlehead">Département ECN</span></td>
        <td><select class="titlevalue" type="number" value="<?= $data->{'ecn_place'}; ?>" disabled>
            <?php foreach ($departements as $index => $departement) : ?>
              <option <?= ($index == $data->{'ecn_place'}) ? 'selected' : ''; ?> value=<?= $index; ?>><?= $index . ' - ' . $departement; ?></option>
            <?php endforeach; ?>
          </select>
        </td>
      </tr>

      <tr>
        <td class="thead"> <span class="titlehead">Faculté</span></td>
        <td><input class="titlevalue" value="<?= $data->{'ecn_school'}; ?>" disabled />
        </td>
      </tr>
      <tr>
        <td class="thead"> <span class="titlehead">Status</span></td>
        <td>
          <select name="status" id="status" class="custom-select titlevalue <?= (!empty($error['status'])) ? 'is-invalid' : ''; ?> " " disabled>
                      <option <?= ($data->{'status'} == 'externe') ? 'selected' : '' ?> value=" externe">Externe</option>
            <option <?= ($data->{'status'} == 'interne-non-these') ? 'selected' : '' ?> value="interne-non-these">Interne non thésé</option>
            <option <?= ($data->{'status'} == 'interne-these') ? 'selected' : '' ?> value="interne-these">Interne thésé</option>
            <option <?= ($data->{'status'} == 'medecin') ? 'selected' : '' ?> value="medecin">Médecin</option>
          </select>
        </td>
      </tr>
      <?php if ($data->{'role'} != 'ROLE_ADMIN') : ?>
        <tr>
          <td class="thead"> <span class="titlehead">Formule:</span></td>
          <td><span class="titlevalue titlevalue--subscription">
              <?php if ($data->{'subscription'} == 0) : ?>
                <span>Vous êtes actuellement membre <strong>Classique</strong> </span>
              <?php else : ?>
                <span>Vous êtes actuellement membre PRO </span>
              <?php endif; ?>
            </span>
          </td>
        </tr>
      <?php endif; ?>

      </tbody>
      </table>
      <div id='subscription-container' class="d-flex justify-content-end ">
        <?php if ($data->{'role'} !== 'ROLE_USER') : ?>
          <button data-toggle="modal" data-target="#unsubscribeModal" class="btn btn-danger text-white">Repasser en formule classique sans abonnement</button>
        <?php else : ?>
          <a href="/pages/welcome" class="card__button btn btn-primary text-white">Passer à la formule PRO</a>
        <?php endif; ?>
        <a id='confirm' class="card__button btn btn-success text-white ml-2" hidden>Enregistrer</a>
      </div>
    </div>
  </div>
</div>

<!-- unsubscribeModal -->
<div class="modal fade" id="unsubscribeModal" tabindex="-1" role="dialog" aria-labelledby="unsubscribeModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Êtes vous sûr d'annuler votre abonnement?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Vous voulez nous quitter? </p>
        <p>Êtes vous sûr de vouloir perdre tous les avantages qu'apporte Doctofiche?</p>
        <p>
          N'hésitez pas à nous contacter à <strong>doctofiche@gmail.com</strong> pour nous faire part de vos remarques.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
        <a href="/charges/cancelSubscription" type="button" class="btn btn-primary">Confirmer l'annulation de mon abonnement</a>
      </div>
    </div>
  </div>
</div>
<!-- end of unsubscribeModal -->

<!-- MODAL TO CHANGE AVATAR'S PROFILE PICTURE -->
<div class="modal fade avatarModal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="max-width: 90%!important;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Télécharge Ton avatar</h5>
        <button type="button" class="close" data-dismiss="modal" onclick="refresh" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="panel panel-default">
          <div class="panel-body">
            <div class="row">
              <div class="col-md-4 text-center">
                <div id="upload-demo" style="width:350px"></div>
              </div>
              <div class="col-md-4" style="padding-top:30px;">
                <strong>Selectionne une image:</strong>
                <br />
                <input type="file" name="image" class="btn btn-primary" id="upload">
                <br /><br>
                <br>
                <button class="btn btn-success upload-result">Modifier image de profile</button>
              </div>
              <div class="col-md-4 avatar__current" style="">
                <img id="upload-demo-i" src="<?= '/img/' . $data->{'avatar'}; ?>" />
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" id="closeUpdate" data-dismiss="modal">Annuler</button>
        </div>
      </div>
    </div>
  </div>
  <?php require APPROOT . '/views/inc/footer.php'; ?>
  <script type="text/javascript">
    const initialFirstName = "<?= $data->{'firstname'}; ?>";
    const initialName = "<?= $data->{'name'}; ?>";
    const initialEmail = "<?= $data->{'mail'}; ?>";
    const initialLogin = "<?= $data->{'login'}; ?>";
    const birthDate = "<?= $data->{'birth_date'}; ?>";
    const sex = "<?= $data->{'sex'}; ?>";
    const ecn_year = "<?= $data->{'ecn_year'}; ?>";
    const ecn_school = "<?= $data->{'ecn_school'}; ?>";
    const ecn_place = "<?= $data->{'ecn_place'}; ?>";
    const status = "<?= $data->{'status'}; ?>";
  </script>
  <script type="text/javascript" src="/js/main3.js"></script>
  <script type="text/javascript" src="/js/custom1.js"></script>
  <script type="text/javascript" src="/js/profil.js"></script>
  <script type='text/javascript' src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.css">