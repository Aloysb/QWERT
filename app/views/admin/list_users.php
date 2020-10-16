<?php require APPROOT.'/views/inc/header.php';?>

<?php $listUser = $data['list_user']; ?>

  <nav class="navbar navbar-expand-lg" id="dashboard-nav">
    <a class="navbar-brand" href="/">
      <img src="/assets/images_proto/logo.jpeg" alt="Logo" class="logo-img" />
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHome" aria-controls="navbarN    avAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu">
        <line x1="3" y1="12" x2="21" y2="12"></line>
        <line x1="3" y1="6" x2="21" y2="6"></line>
        <line x1="3" y1="18" x2="21" y2="18"></line>
      </svg></button>
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarHome">
      <div class="navbar-nav">
        <div class='menu-compta-articles'>
          <div class='compta-articles'>
             <a 
            <?php 
                if(($_SESSION['data_user']->{'role'} == 'ROLE_SUBSCRIBER') || ($_SESSION['data_user']->{'role'} == 'ROLE_ADMIN'))
                  { ?>href = "/pages/articles" <?php } else { echo 'data-toggle="modal" data-target="#exampleUnsubscribing"';} ?>
              > Articles </a>
            <a 
                <?php 
                if(($_SESSION['data_user']->{'role'} == 'ROLE_SUBSCRIBER') || ($_SESSION['data_user']->{'role'} == 'ROLE_ADMIN'))
                  { ?>href = "/pages/comptabilite" <?php } else { echo 'data-toggle="modal" data-target="#exampleUnsubscribing"';} ?>
            > Comptabilité </a>
            <?php if(($_SESSION['data_user']->{'role'} != 'ROLE_SUBSCRIBER') && ($_SESSION['data_user']->{'role'} != 'ROLE_ADMIN')){ echo '<div class="pro">Pro</div>'; } ?>
          </div>
        </div>
      </div>
      <ul class="menu">
        <li>
          <img class="profile_img" src="<?='/img/'.$_SESSION['data_user']->{'avatar'} ?>" height="50px" width="50px" style="border-radius:50%" />
        </li>
        <li>
          <a>
            <div id='user__toggle' class="user">
              <p class="user__user">Bonjour
                <?php echo $_SESSION['data_user'] -> {'firstname'}; ?> <i id="user__chevron" class="fa fa-chevron-down"></i>
                <p</div> <div id="user__submenu" class="user__submenu hidden">
                  <div class="user__submenuProfile">
                    <img class="profile_img" src="<?='/img/'.$_SESSION['data_user']->{'avatar'} ?>" height="50px" width="50px" style="border-radius:50%" />
                    <p class="user__name">
                      <?php echo $_SESSION['data_user'] -> {'firstname'}; ?>
                    </p>
                  </div>
                  <a class="user__link" href="/pages/profil"><img src='/assets/icon_proto/Icon - User Profile.svg' height='30px' />Profil</a>
                  <!-- <a class="user__link"><img src='/assets/icon_proto/Icon - Setting.svg' height='30px' />Parametres</a> -->
                  <a class="user__link"><img src='/assets/icon_proto/Icon - Logout.svg' height='30px' />Se déconnecter</a>
            </div>
          </a>
        </li>
        <li>
          <a class="logout" href="<?='/users/logout' ?>" id="button-deconnexion"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="25px" viewBox="0 0 512 512">
              <defs>
                <clipPath id="clip-Icon_-_Logout">
                  <rect width="512" height="512" />
                </clipPath>
              </defs>
              <g id="Icon_-_Logout" data-name="Icon - Logout" clip-path="url(#clip-Icon_-_Logout)">
                <path id="sign-out-alt-regular" d="M269.163,111.5v51.062h-95a47.512,47.512,0,0,0-47.5,47.5v87.676a47.512,47.512,0,0,0,47.5,47.5h95V396.3c0,42.156,51.161,63.53,81.046,33.546l142.5-142.4a47.6,47.6,0,0,0,0-67.192l-142.5-142.5C320.423,48.166,269.163,69.244,269.163,111.5Zm190,142.5-142.5,142.5v-98.66h-142.5V210.159h142.5V111.5ZM95,64h83.124A11.91,11.91,0,0,1,190,75.874v23.75A11.91,11.91,0,0,1,178.123,111.5H95A47.512,47.512,0,0,0,47.5,159V349A47.512,47.512,0,0,0,95,396.5h83.124A11.91,11.91,0,0,1,190,408.37v23.75a11.91,11.91,0,0,1-11.875,11.875H95A95.023,95.023,0,0,1,0,349V159A95.023,95.023,0,0,1,95,64Z" transform="translate(1.692 508.793) rotate(-90)" fill="#0095d9" />
              </g>
            </svg>
          </a>
        </li>
      </ul>
    </div>
    </div>
  </nav>

<div class="content d-flex justify-content-center">
  <div class="container-fluid container-admin-list-users text-center">
    <h2>Liste des inscrits</h2>
    <div class='row d-flex justify-content-center'>
                <?php $listEmail = array() ?>
        <?php foreach($listUser as $user): ?>
        <?php array_push($listEmail, $user['mail']) ?>
            <?php endforeach; ?>
            <?php $listEmail = implode(', ', $listEmail) ?>
        <p class="btn btn-primary" id ="list_email" onClick="copyEmail('<?php echo($listEmail) ?>')">
            Copier la liste email
        </p>
    </div>
    <div class="post-table">
      <table class="table" id="datatable-list-user" style="width: 100%">
         <thead style="background: #0095d9; color: white; font-weight: bold">
          <tr>
            <td>Nom</td>
            <td>Prénom</td>
            <td>Courriel</td>
            <td>Status</td>
          </tr>
        </thead>
        <tbody>
          <?php foreach($listUser as $user): ?>
          <tr class="new-user">
            <td>
              <?= $user['name']; ?>
            </td>
            <td>
              <?= $user['firstname']; ?>
            </td>
            <td>
              <?= $user['mail']; ?>
            </td>
            <td>
              <?php if($user['role'] == 'ROLE_SUBSCRIBER'): ?>
              <span class="badge badge-pill badge-info">Abonné</span>
              <?php elseif($user['role'] == 'ROLE_ADMIN'): ?>
              <span class="badge badge-pill badge-danger">Admin</span>
              <?php else: ?>
              <span class="badge badge-pill badge-secondary">Inscrit</span>
              <?php endif; ?>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<?php require APPROOT.'/views/inc/footer.php'; ?>

<script>
    function copyEmail(str) {


  /* Get the text field */

  const el = document.createElement('textarea');
  el.value = str;
  document.body.appendChild(el);
  el.select();
  document.execCommand('copy');
  document.body.removeChild(el);
          /* Copy the text inside the text field */
          document.execCommand("copy");

          /* Alert the copied text */
  alert("Liste de courriels copiée !");
}
</script>
