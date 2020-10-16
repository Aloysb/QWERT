<?php require APPROOT . '/views/inc/header.php'; ?>

<body>
  <!-- Legacy CSS -->
  <link rel="stylesheet" href="/css/fiches.css">
  <!-- Start of navigation bar -->
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
            <a <?php
                if (($_SESSION['data_user']->{'role'} == 'ROLE_SUBSCRIBER') || ($_SESSION['data_user']->{'role'} == 'ROLE_ADMIN')) { ?>href="/pages/articles" <?php } else {
                                                                                                                                                              echo 'data-toggle="modal" data-target="#exampleUnsubscribing"';
                                                                                                                                                            } ?>> <?php if ($data['notificationArticle']) : ?><span class='notif'></span><?php endif; ?> Articles </a>
            <a <?php
                if (($_SESSION['data_user']->{'role'} == 'ROLE_SUBSCRIBER') || ($_SESSION['data_user']->{'role'} == 'ROLE_ADMIN')) { ?>href="/pages/comptabilite" <?php } else {
                                                                                                                                                                  echo 'data-toggle="modal" data-target="#exampleUnsubscribing"';
                                                                                                                                                                } ?>> Comptabilité </a>
            <?php if (($_SESSION['data_user']->{'role'} != 'ROLE_USER')) {
              echo '<div class="pro">Pro</div>';
            } ?>
          </div>
        </div>
      </div>
      <?php if ($_SESSION['data_user']->{'role'} == 'ROLE_ADMIN') : ?>
        <div class="f">
          <a href="/admin/list_users">
            <button class="btn btn-sm btn-outline-primary">
              Liste utilisateurs
            </button>
          </a>
          <a href="/admin/send_email">
            <button class="mt-1 btn-sm  btn btn-outline-primary">
              Envoyer un email
            </button>
          </a>
        </div>
      <?php endif; ?>
      <ul class="menu">
        <li>
          <img class="profile_img" src="<?= '/img/' . $_SESSION['data_user']->{'avatar'} ?>" height="50px" width="50px" style="border-radius:50%" />
        </li>
        <li>
          <a>
            <div id='user__toggle' class="user">
              <p class="user__user">Bonjour
                <?php echo $_SESSION['data_user']->{'firstname'}; ?> <i id="user__chevron" class="fa fa-chevron-down"></i>
                <p</div> <div id="user__submenu" class="user__submenu hidden">
                  <div class="user__submenuProfile">
                    <img class="profile_img" src="<?= '/img/' . $_SESSION['data_user']->{'avatar'} ?>" height="50px" width="50px" style="border-radius:50%" />
                    <p class="user__name">
                      <?php echo $_SESSION['data_user']->{'firstname'}; ?>
                    </p>
                  </div>
                  <a class="user__link" href="/pages/profil"><img src='/assets/icon_proto/Icon - User Profile.svg' height='30px' />Profil</a>
                  <!-- <a class="user__link"><img src='/assets/icon_proto/Icon - Setting.svg' height='30px' />Parametres</a> -->
                  <a class="user__link" href="/users/logout"><img src='/assets/icon_proto/Icon - Logout.svg' height='30px' />Se déconnecter</a>
            </div>
          </a>
        </li>
        <li>
          <a class="logout" href="<?= '/users/logout' ?>" id="button-deconnexion"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="25px" viewBox="0 0 512 512">
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
  <!-- End of navivation bar -->
  <main class="dashboard">
    <div class="content d-flex justify-content-center">
      <div class="container-fluid container-search first">
        <div class="row category__row">
          <div class="col-xs-12 col-sm-6 col-lg-4 offset-sm-0 category_col">
            <div class="category">
              <a class="category__link category__link" href="/pages/fiche"><?php if ($data['notifFiche']) : ?><span class='notif'></span><?php endif; ?>Fiches</a>
              <a class="category__link" href="/pages/exam"><?php if ($data['notifBilan']) : ?><span class='notif'></span><?php endif; ?>Bilans</a>
              <a class="category__link category__link--active" href="/pages/annuaire"><?php if ($data['notifAnnuaire']) : ?><span class='notif'></span><?php endif; ?>Annuaire</a>
              <a class="category__link" href="/pages/conseils"><?php if ($data['notifConseil']) : ?><span class='notif'></span><?php endif; ?>Conseils</a>
            </div>
          </div>
          <div class="col-sm-6 col-lg-4 offset-0 offset-lg-4 sites-notes__col pt-2">
            <div class="sites-notes">
              <button class="sites-notes__link" data-toggle="modal" onClick="removeNotifSites()" data-target=<?php
                                                                                                              if (($_SESSION['data_user']->{'role'} != 'ROLE_SUBSCRIBER') && ($_SESSION['data_user']->{'role'} != 'ROLE_ADMIN')) {
                                                                                                                echo '#exampleUnsubscribing';
                                                                                                              } else {
                                                                                                                echo '#sites-modal';
                                                                                                              }; ?>><?php if ($data['notificationSites'] > 0) : ?><span class='notif'></span><?php endif; ?>Sites</button>
              <button class="sites-notes__link" href="" <?php
                                                        if (($_SESSION['data_user']->{'role'} != 'ROLE_SUBSCRIBER') && ($_SESSION['data_user']->{'role'} != 'ROLE_ADMIN')) {
                                                          echo 'data-toggle="modal" data-target="#exampleUnsubscribing"';
                                                        } else {
                                                          echo "onClick = 'showNotes()'";
                                                        }; ?>>Notes</button>
            </div>
            <?php if (($_SESSION['data_user']->{'role'} != 'ROLE_USER')) {
              echo '<div class="pro">Pro</div>';
            } ?>
          </div>
        </div>
        <div class="row">
        </div>
        <?php ?>
        <div class="row d-flex">
          <!-- Folders research content -->
          <div class="col-sm-12 col-md-12 col-lg-4  text-center mt-2 mx-auto">
            <nav class="navbar-dark bg-white" id="navbar-folder">
              <h1 class="navbar-brand" id="titleFolder">Dossiers Médicaux</h1>
              <div class="actions">
                <a href="" class="navbar-brand" <?php if (($_SESSION['data_user']->{'role'} == 'ROLE_SUBSCRIBER') || ($_SESSION['data_user']->{'role'} == 'ROLE_ADMIN')) {
                                                  echo 'id="addTitleFolder"';
                                                } else {
                                                  echo 'data-toggle="modal" data-target="#exampleUnsubscribing"';
                                                } ?>><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="20" viewBox="0 0 512 512">
                    <defs>
                      <clipPath id="clip-Icon_-_Add">
                        <rect width="512" height="512" />
                      </clipPath>
                    </defs>
                    <g id="Icon_-_Add" data-name="Icon - Add" clip-path="url(#clip-Icon_-_Add)">
                      <path id="plus-circle-regular" d="M396.479,247.7v33.062a12.435,12.435,0,0,1-12.4,12.4H293.16V384.08a12.435,12.435,0,0,1-12.4,12.4H247.7a12.435,12.435,0,0,1-12.4-12.4V293.16H144.381a12.435,12.435,0,0,1-12.4-12.4V247.7a12.435,12.435,0,0,1,12.4-12.4H235.3V144.381a12.435,12.435,0,0,1,12.4-12.4h33.062a12.435,12.435,0,0,1,12.4,12.4V235.3H384.08A12.435,12.435,0,0,1,396.479,247.7Zm123.982,16.531c0,141.547-114.684,256.231-256.231,256.231S8,405.777,8,264.231,122.684,8,264.231,8,520.461,122.684,520.461,264.231Zm-49.593,0c0-114.167-92.47-206.638-206.638-206.638S57.593,150.063,57.593,264.231s92.47,206.638,206.638,206.638S470.868,378.4,470.868,264.231Z" transform="translate(-8.417 -8.461)" fill="#858585" />
                    </g>
                  </svg>
                </a>
                <a href="" class="navbar-brand" <?php if (($_SESSION['data_user']->{'role'} == 'ROLE_SUBSCRIBER') || ($_SESSION['data_user']->{'role'} == 'ROLE_ADMIN')) {
                                                  echo 'id="editTitleFolder"';
                                                } else {
                                                  echo 'data-toggle="modal" data-target="#exampleUnsubscribing"';
                                                } ?>><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="20" viewBox="0 0 512 512">
                    <defs>
                      <clipPath id="clip-Icon_-_Edit">
                        <rect width="512" height="512" />
                      </clipPath>
                    </defs>
                    <g id="Icon_-_Edit" data-name="Icon - Edit" clip-path="url(#clip-Icon_-_Edit)">
                      <path id="edit-regular" d="M356.918,305.985l28.39-28.39a7.132,7.132,0,0,1,12.155,5.057v129a42.6,42.6,0,0,1-42.585,42.585H42.585A42.6,42.6,0,0,1,0,411.65V99.357A42.6,42.6,0,0,1,42.585,56.772H285.233a7.143,7.143,0,0,1,5.057,12.155L261.9,97.317a7.033,7.033,0,0,1-5.057,2.041H42.585V411.65H354.878v-100.7A6.978,6.978,0,0,1,356.918,305.985ZM495.853,126.949,262.876,359.926l-80.2,8.872a36.652,36.652,0,0,1-40.456-40.456l8.872-80.2L384.066,15.163a51.78,51.78,0,0,1,73.371,0l38.327,38.327a51.967,51.967,0,0,1,.089,73.46ZM408.2,154.363l-51.546-51.546L191.811,267.747l-6.477,57.934,57.934-6.477Zm57.49-70.709L427.362,45.327a9.264,9.264,0,0,0-13.13,0L386.817,72.741l51.546,51.546,27.414-27.414A9.453,9.453,0,0,0,465.688,83.654Z" transform="translate(0 29.15)" fill="#858585" />
                    </g>
                  </svg>
                </a>
                <a href="" class="navbar-brand" <?php if (($_SESSION['data_user']->{'role'} == 'ROLE_SUBSCRIBER') || ($_SESSION['data_user']->{'role'} == 'ROLE_ADMIN')) {
                                                  echo 'id="deleteFolder"';
                                                } else {
                                                  echo 'data-toggle="modal" data-target="#exampleUnsubscribing"';
                                                } ?>><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="20" viewBox="0 0 512 512">
                    <defs>
                      <clipPath id="clip-Icon_-_Delete">
                        <rect width="512" height="512" />
                      </clipPath>
                    </defs>
                    <g id="Icon_-_Delete" data-name="Icon - Delete" clip-path="url(#clip-Icon_-_Delete)">
                      <path id="trash-regular" d="M431.611,79.928H349.285L315.316,23.279A47.957,47.957,0,0,0,274.153,0H173.444a47.957,47.957,0,0,0-41.163,23.279L98.311,79.928H15.986A15.986,15.986,0,0,0,0,95.913V111.9a15.986,15.986,0,0,0,15.986,15.986H31.971L53.152,466.579a47.957,47.957,0,0,0,47.857,44.959H346.587a47.955,47.955,0,0,0,47.856-44.953l21.181-338.7h15.986A15.986,15.986,0,0,0,447.6,111.9V95.913A15.986,15.986,0,0,0,431.611,79.928ZM173.444,47.957H274.153l19.183,31.971H154.261ZM346.587,463.582H101.019l-20.981-335.7H367.578Z" transform="translate(32.292 0.462)" fill="#858585" />
                    </g>
                  </svg>
                </a>
              </div>
            </nav>
            <div id="editAndAddTemplate">
              <nav class="navbar bg-white">
                <input type="search" class="form-control mr-sm-2 " name="medicalFolder" id="searchMedicalFolder" placeholder="Recherche rapide" autocomplete="off" autofocus>
                <div class="clearable">

                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                  </svg>
                </div>
                <span class="invalid-feedback">Vous devez cliquez sur un dossier pour le modifier ou le supprimer!</span>
              </nav>
              <div class="scroller" id="resultMedicalFolder">
                <div class="list-group" id="folders">
                  <?php foreach ($data['medicalFolders'] as $folder) : ?>
                    <a id="folder-<?php echo $folder->{'id'}; ?>" class="folder list-group-item d-flex justify-content-start align-items-center btn btn-light"><img src="/assets/icon_proto/Icon - File-Folder.svg" height="20px" />
                      <?php echo $folder->{'title'}; ?><span class="badge <?= ($folder->{'admin_medicalFolder_id'} === null) ? 'badge-danger' : 'badge-primary'; ?> badge-pill">
                        <?php echo $folder->{'num_files'}; ?></span></a>
                  <?php endforeach; ?>
                </div>
              </div>
            </div>
          </div>
          <!-- ARTICLE LIST-->
          <div class="col-sm-12 col-md-12 col-lg-7 text-center mt-2 mx-auto articles-list">
            <nav class="navbar">
              <h1 class="navbar-brand" id="newNameFolder">Fiches</h1>
              <a class="navbar-brand" <?= (($_SESSION['data_user']->{'role'} == 'ROLE_SUBSCRIBER') || (($_SESSION['data_user']->{'role'} == 'ROLE_ADMIN'))) ? 'id="addFileByFolder"' : 'id="modal_unsubscribing" data-toggle="modal" data-target="#exampleUnsubscribing"'; ?>><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="20" viewBox="0 0 512 512">
                  <defs>
                    <clipPath id="clip-Icon_-_Add">
                      <rect width="512" height="512" />
                    </clipPath>
                  </defs>
                  <g id="Icon_-_Add" data-name="Icon - Add" clip-path="url(#clip-Icon_-_Add)">
                    <path id="plus-circle-regular" d="M396.479,247.7v33.062a12.435,12.435,0,0,1-12.4,12.4H293.16V384.08a12.435,12.435,0,0,1-12.4,12.4H247.7a12.435,12.435,0,0,1-12.4-12.4V293.16H144.381a12.435,12.435,0,0,1-12.4-12.4V247.7a12.435,12.435,0,0,1,12.4-12.4H235.3V144.381a12.435,12.435,0,0,1,12.4-12.4h33.062a12.435,12.435,0,0,1,12.4,12.4V235.3H384.08A12.435,12.435,0,0,1,396.479,247.7Zm123.982,16.531c0,141.547-114.684,256.231-256.231,256.231S8,405.777,8,264.231,122.684,8,264.231,8,520.461,122.684,520.461,264.231Zm-49.593,0c0-114.167-92.47-206.638-206.638-206.638S57.593,150.063,57.593,264.231s92.47,206.638,206.638,206.638S470.868,378.4,470.868,264.231Z" transform="translate(-8.417 -8.461)" fill="#858585" />
                  </g>
                </svg>
              </a></a>
            </nav>
            <nav class="searchMedicalFileNav navbar navbar-light">
              <input class="form-control mr-sm-2" type="search" name="medicalFile" id="searchMedicalFile" placeholder="Recherche rapide" autocomplete="off">
              <div class="clearable">

                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                  <line x1="18" y1="6" x2="6" y2="18"></line>
                  <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
              </div>
            </nav>
            <div class="scroller" id="resultMedicalFile">
              <div class="file list-group" id="files"></div>
            </div>
          </div>
          <!-- END OF ARTICLES LIST -->
        </div>
      </div>
      <div class="container container-addFile second">
        <div class="row">
          <div class="col-lg-12 mt-2">
            <nav class="d-flex">
              <a id="return-create-file" class="navbar-brand"><i class="fa fa-chevron-left"></i> Retour</a>
              <h1 class="navbar-brand ">Créer une nouvelle fiche</h1>
            </nav>
          </div>
        </div>
        <form class="editorForm" enctype="multipart/form-data">
          <div class="md-form input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text md-addon" id="inputGroupMaterial-sizing-default">Titre</span>
            </div>
            <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroupMaterial-sizing-default" id="myTitle" autocomplete="off">
          </div>
          <div class="form-group">
            <textarea class="form-control" id="addEditor"></textarea>
          </div>
        </form>
      </div>
      <!-- THIRD SHOW FILE -->
      <div class="container container-showFile third">
        <nav class="">
          <div class="third__return">
            <a id="return-files-show" class="navbar-brand"><i class="fa fa-chevron-left"></i><span> Retour</span></a>
          </div>
          <h1 class="" id="title-show"></h1>
          <div class='third__actions'>
            <input id="hidden-file-show" type="hidden">
            <a <?php if (($data['user']->{'role'} == 'ROLE_SUBSCRIBER') || ($data['user']->{'role'} == 'ROLE_ADMIN')) {
                  echo '';
                } else {
                  echo "data-toggle='modal' data-target='#exampleUnsubscribing'";
                } ?> class="navbar-brand third__edit">
              <i class="fa fa-edit" <?php if (($data['user']->{'role'} == 'ROLE_SUBSCRIBER') || ($data['user']->{'role'} == 'ROLE_ADMIN')) {
                                      echo "id='show-update'";
                                    } else {
                                      echo "";
                                    } ?>>
              </i>
            </a>
            <a class="navbar-brand docto-single-delete"><span></span><i class="fa fa-trash" id="show-delete"></i></a>
          </div>
        </nav>
        <hr />
        <div class="docto-editor-content" id="description-show">
        </div>
      </div>
      <!-- END OF THIRD SHOW FILE -->
      <div class="container container-editFile four">
        <div class="row">
          <div class="col-lg-12 mt-2">
            <nav class="navbar-dark d-flex justify-content-start">
              <a id="return-files-edit" class="navbar-brand"><i class="fa fa-chevron-left"></i> Retour</a>
            </nav>
          </div>
        </div>
        <form class="mt-2 editorForm" method="post" enctype="multipart/form-data">
          <input name="folderId" type="hidden">
          <div class="md-form input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text md-addon" id="inputGroupMaterial-sizing-default">Titre</span>
            </div>
            <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroupMaterial-sizing-default" id="title-edit" name="myTitle" autocomplete="off">
            <input id="hidden-file-edit" type="hidden">
            <input id="hidden-folder-edit" type="hidden">
          </div>
          <div class="form-group">
            <textarea class="form-control" id="editEditor" rows="7" name="myDescription" id="description-edit"></textarea>
          </div>
        </form>
      </div>
    </div>
  </main>
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-danger " id="exampleModalLabel">ATTENTION Message important</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-danger">
          En supprimant un dossier vous supprimerez toutes les fiches associées ET elles seront définitivement perdues !
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">je conserve mon dossier et mes fiches</button>
          <a href="" class="btn btn-danger" id="deleteAFolder">Supprimez tout</a>
        </div>
      </div>
    </div>
  </div>
  <!-- Note side bar -->
  <div id="notes">
    <div class="container">
      <p class="retour" onClick="hideNotes()">Retour aux fiches <i id="hide__notes" class="fa fa-chevron-right"></i></p>
      <div class="actions">
        <input id="notes-search" class="search" type="search" placeholder="Recherche rapide">
        <button class='btn btn-success' onclick="addNote()">
          +
        </button>
      </div>
      <div id="accordion-notes">
        <h3 class="pt-2">Notes:</h3>
        <?php $notes = $data['notes']; ?>
        <?php foreach ($notes as $note) : ?>
          <div class="card" onClick='resizeTextAreas(this)'>
            <div class="card-header" id="headingOne">
              <h5 class="title mb-0">
                <div class="note__summary" data-toggle="collapse" data-target="#collapse<?= $note['id']; ?>" aria-expanded="true" aria-controls="collapseOne">
                  <p class="note__sentence--<?= $note['id'] ?> ml-2">
                    <?php
                    $line = $note['content'];
                    if (preg_match('/^.{1,40}\b/s', $note['content'], $match)) {
                      $line = $match[0];
                      if ($line != $note['content']) {
                        $line = $line . '...';
                      }
                    }
                    echo ($line);
                    ?>
                  </p>
                </div>
              </h5>
              <div class='actions'>
                <a onClick="deleteNote(<?= $note['id'] ?>)"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="20" viewBox="0 0 512 512">
                    <defs>
                      <clipPath id="clip-Icon_-_Delete">
                        <rect width="512" height="512" />
                      </clipPath>
                    </defs>
                    <g id="Icon_-_Delete" data-name="Icon - Delete" clip-path="url(#clip-Icon_-_Delete)">
                      <path id="trash-regular" d="M431.611,79.928H349.285L315.316,23.279A47.957,47.957,0,0,0,274.153,0H173.444a47.957,47.957,0,0,0-41.163,23.279L98.311,79.928H15.986A15.986,15.986,0,0,0,0,95.913V111.9a15.986,15.986,0,0,0,15.986,15.986H31.971L53.152,466.579a47.957,47.957,0,0,0,47.857,44.959H346.587a47.955,47.955,0,0,0,47.856-44.953l21.181-338.7h15.986A15.986,15.986,0,0,0,447.6,111.9V95.913A15.986,15.986,0,0,0,431.611,79.928ZM173.444,47.957H274.153l19.183,31.971H154.261ZM346.587,463.582H101.019l-20.981-335.7H367.578Z" transform="translate(32.292 0.462)" fill="crimson" />
                    </g>
                  </svg>
                </a>
              </div>
            </div>
            <div id="collapse<?= $note['id']; ?>" class="notes-input collapse" aria-labelledby="headingOne" data-parent="#accordion">
              <div class="card-body">
                <textarea name="text" oninput="this.style.height = ''; this.style.height = this.scrollHeight +'px'" id="note__<?= $note['id'] ?>"><?= trim($note['content']); ?></textarea>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="example" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-danger " id="exampleModalLabel">ATTENTION Message important</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-danger">
          Vous allez modifier un dossier, Etes-vous sûre ?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">je ne modifie pas mon dossier</button>
          <a href="" class="btn btn-danger" id="updateFolder">Modifier</a>
        </div>
      </div>
    </div>
  </div>
  <!-- SITES MODAL -->
  <div class="modal" tabindex="-1" role="dialog" id="sites-modal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <input type="search" placeholder="Recherche rapide" id="sites-research" />
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <?php if (($_SESSION['data_user']->{'role'} == 'ROLE_ADMIN' or $_SESSION['data_user']->{'role'} == 'ROLE_SUBSCRIBER')) {
          echo '<a class="btn btn-primary m-4" href="/admin/sites">Gérer la liste de site</a>';
        } ?>
        <div class="modal-body">
          <ul id="sites--list">
            <?php $listSites = $data['list_sites']; ?>
            <?php foreach ($listSites as $site) : ?>
              <li>
                <div>
                  <a href="<?= $site['href']; ?>" target="_blank" style="position: relative">
                    <?php if ($site['notif'] == 1) : ?><span class="notif" style="  background-color: red;
  position: absolute;
  left: -10px;
  top: -5px;
  border-radius: 50%;
  background: red;
  height: 10px;
  width: 10px;
  box-shadow: 0px 0px 4px 2px rgba(255, 0, 0, 0.3);"></span><?php endif; ?>
                    <?= $site['name']; ?>

                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-external-link" style="margin-bottom:5px">
                      <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                      <polyline points="15 3 21 3 21 9"></polyline>
                      <line x1="10" y1="14" x2="21" y2="3"></line>
                    </svg>
                  </a>
                  <p>
                    <?= $site['description']; ?>
                  </p>
                </div>
              </li>
              <hr />
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!--                               <div class="modal-footer">
                                <button type="button" class="btn btn-primary">Save changes</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              </div> -->
  </div>
  <!-- END OF SITE MODAL -->
  <?php require APPROOT . '/views/inc/modal_unscribing.php'; ?>
  <?php require APPROOT . '/views/inc/footer.php'; ?>
  <script type="text/javascript" src='https://cdnjs.cloudflare.com/ajax/libs/mark.js/8.11.1/mark.min.js'></script>
  <script type="text/javascript">
    const subscribed = ('<?php echo ($_SESSION['data_user']->{'role'}); ?>' != "ROLE_USER") ? true : false;
  </script>
  <script type="text/javascript" src='/js/main3.js'></script>
  <script type="text/javascript" src='/js/custom1.js'></script>
  <script>
    let files = <?php echo ($data['files']) ?>;
  </script>
  <script type="text/javascript" src='/js/search.js'></script>
  </script>
  <!-- Site research -->
  <script>
    let sitesSearch = document.getElementById('sites-research');
    sitesSearch.addEventListener('keyup', () => {
      let sites = [...document.getElementById('sites--list').querySelectorAll('li')];
      sites.map(site => site.classList.remove('hidden'))
      let filteredSites = sites.filter(site => !site.querySelector('a').innerText.toLowerCase().includes(sitesSearch.value.toLowerCase())).map(site => site.classList.add('hidden'))
      console.log(sitesSearch.value);
      console.log(sites);
    })
  </script>
  <!-- Notes -->
  <script>
    $(function() {

      $(".notes-input").find("textarea").blur(function() {
        let value = $(this).val();
        let id = $(this).prop('id').replace('note__', '');


        $.ajax({
          url: `ajaxUpdateANote`,
          method: "POST",
          data: {
            id: id,
            content: value
          },
        }).done(function(res) {
          let title = $(`.note__sentence--${id}`).html(value.substring(0, 40) + ' [...]')
        })
      });
    });

    const deleteNote = (noteId) => {
      $.ajax({
        url: `ajaxDeleteANote`,
        method: "POST",
        data: {
          id: noteId
        }
      }).done(function(res) {
        $(`.note__sentence--${noteId}`).parent().parent().parent().parent().addClass('deleted');
      })
    }

    const searchNotes = document.getElementById('notes-search');
    const notes = [...document.getElementById('accordion-notes').querySelectorAll('.card')];

    searchNotes.addEventListener('keyup', () => {
      let searchValue = slugify(searchNotes.value);

      if (!searchValue) {
        notes.map(note => note.classList.remove('hidden'))
      } else {
        notes.map(note => note.classList.add('hidden'));
        notes.filter(note => slugify(note.querySelector('textarea').value).includes(searchValue)).map(note => note.classList.remove('hidden'));
      }
    })

    const showNotes = () => {
      document.getElementById('notes').style.display = 'block';
      document.getElementById('notes').style.animation = 'scrollInLeft 1.5s ease-in-out forwards';
    }

    const hideNotes = () => {
      document.getElementById('notes').style.animation = 'scrollOutRight 1.5s ease-in-out forwards';
      setTimeout(function() {
        document.getElementById('notes').style.display = "none"
      }, 1500);
    }

    const addNote = () => {
      let newNoteInnerHtml = `
 <div class="card" id="newNote">
          <div class="card-header" id="headingOne">
            <h5 class="title mb-0">
              <div class="note__summary" data-toggle="collapse" data-target="#collapse0" aria-expanded="true" aria-controls="collapseOne">
                <p class="note__sentence--0 ml-2" >
                    Nouvelle note!
              </div>
          </h5>
              <div class='actions'>
                <a onClick="saveNote(this)">
<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="green" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-save"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path><polyline points="17 21 17 13 7 13 7 21"></polyline><polyline points="7 3 7 8 15 8"></polyline></svg>
                </a>
          </div>
        </div>
        <div id="collapse0" class="notes-input collapse show" aria-labelledby="headingOne" data-parent="#accordion" >
          <div class="card-body">
            <textarea name="text"  oninput="this.style.height = ''; this.style.height = this.scrollHeight +'px'" id="note__0">Note ici!</textarea>
          </div>
        </div>
      </div>
    `

      let newNote = document.createElement('div')
      newNote.innerHTML = newNoteInnerHtml;
      document.getElementById('accordion-notes').insertBefore(newNote, document.getElementById('accordion-notes').firstChild.nextSibling.nextSibling)
      document.getElementById('accordion-notes').querySelector('textarea').focus();


    }
  </script>
  <script type="text/javascript">
    $(function() {
      if (sessionStorage.getItem('newFolder') == null) return;
      if (!sessionStorage.getItem('newFolder') == null) {
        document.getElementById('searchMedicalFolder').value = sessionStorage.getItem('newFolder');
        let value = slugify(sessionStorage.getItem('newFolder'));
        let children = document.getElementById('folders').querySelectorAll('a');
        children.forEach(el => {
          if (!slugify(el.innerText).includes(value)) el.classList.add('hidden')
        })
        sessionStorage.setItem('newFolder', null);
      }
    })
  </script>
  <script type="text/javascript" src="/js/notes.js"></script>
  <script>
    document.querySelectorAll('.clearable').forEach(el => el.addEventListener('click', function() {
      let input = this.parentNode.querySelector('input');
      //Clear the active folder bar.
      if (document.querySelector('.list-group').querySelector('.active')) {
        document.querySelector('.list-group').querySelector('.active').classList.remove('active');
      }
      input.value = "";
      let keyupEvent = new Event('keyup');
      input.dispatchEvent(keyupEvent);
    }));
  </script>
  <script>
    [...document.getElementById('folders').querySelectorAll('.notif')].map(el => el.parentNode).reverse().map(el => document.getElementById('folders').prepend(el))
  </script>
  <script>
    const duplicateFile = (e) => {
      let file = e.target.parentElement.parentElement.parentElement.id.match(/\d+/)[0];
      $.ajax({
        url: `${urlroot}single/copyFileByFileId`,
        method: "POST",
        data: {
          id: file
        },
        success: function(data) {
          window.location.reload();
        }
      })
    };
  </script>

  <script>
    let foldersList = [...document.querySelectorAll('.folder')];
    foldersList.map(folder => {
      let opt = document.createElement("OPTION");
      opt.appendChild(document.createTextNode(folder.textContent.replace(/(\d+)(?!.*\1)/, '')));
      opt.value = folder.id.match(/\d+/)[0];
      document.querySelector('#select_folder').appendChild(opt);
    })

    const setCurrentFileTo = (e) => {
      let fileId = e.target.parentElement.parentElement.parentElement.id.match(/\d+/)[0];
      let currentFile = document.getElementById('currentFileForm');
      currentFile.value = fileId;
    }
  </script>
  <script type="text/javascript" src="/js/sitesNotif.js"></script>