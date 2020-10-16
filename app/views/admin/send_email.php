<?php require APPROOT . '/views/inc/header.php'; ?>

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
                                                                                                                                                          } ?>> Articles </a>
          <a <?php
              if (($_SESSION['data_user']->{'role'} == 'ROLE_SUBSCRIBER') || ($_SESSION['data_user']->{'role'} == 'ROLE_ADMIN')) { ?>href="/pages/comptabilite" <?php } else {
                                                                                                                                                                echo 'data-toggle="modal" data-target="#exampleUnsubscribing"';
                                                                                                                                                              } ?>> Comptabilité </a>
          <?php if (($_SESSION['data_user']->{'role'} != 'ROLE_SUBSCRIBER') && ($_SESSION['data_user']->{'role'} != 'ROLE_ADMIN')) {
            echo '<div class="pro">Pro</div>';
          } ?>
        </div>
      </div>
    </div>
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
                <a class="user__link"><img src='/assets/icon_proto/Icon - Logout.svg' height='30px' />Se déconnecter</a>
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
<div class="container container-addFile second">
  <div class="row">
    <div class="col-lg-12 mt-2">
      <div class="d-flex">`
        <h1 class="navbar-brand ">Envoyer un courriel</h1>
        <h1 id="error" class="navbar-brand text-danger" hidden><strong> - Vérifiez que votre email contient un sujet, un message et un destinataire valide!</strong></h1>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-6 d-flex mb-2 align-items-center">
      <label for='emailList' class='pt-2 mr-3'>A qui envoyer l'email?</label>
      <select class="p-2" id="emailList" onChange="emailListChange(this)">
        <option value='null' selected>Choisir une option</option>
        <option value="all">Tous les utilisateurs</option>
        <option value="subscribers">Abonnés</option>
        <option value="non-subscribers">Non-abonnés</option>
        <option value="custom">Manuel</option>
      </select>
    </div>
    <div class="col-6 d-flex p-2 align-items-center">
      <label id="custom_emailListLabel" for="custom_emailList" class="mr-3 pt-2" hidden>Destinataires:</label>
      <input id="custom_emailList" class="flex-grow-1 p-2" type="text" placeholder="email@exemple.com; email2@exemple.com; email3@exemple.com" hidden />
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
      <textarea class="form-control" id="editEmail"></textarea>
    </div>
  </form>
</div>

<script src="/js/email.js"></script>
<script>
  // Display the input for custom email list if selected
  const emailListChange = (obj) => {
    if (obj.value !== 'custom') {
      document.getElementById('custom_emailList').hidden = true;
      document.getElementById('custom_emailListLabel').hidden = true;
    } else {
      document.getElementById('custom_emailList').hidden = false;
      document.getElementById('custom_emailListLabel').hidden = false;
    }
  }

  const getEmailList = () => {
    switch (document.getElementById('emailList').value) {
      case 'all':
        return "<?php echo $data['emailListAll']; ?>";
        break;
      case 'subscribers':
        return "<?= $data['emailListSubscribers']; ?>";
        break;
      case 'non-subscribers':
        return "<?= $data['emailListNonSubscribers']; ?>";
        break;
      case 'custom':
        return document.getElementById('custom_emailList').value;
        break;
      default:
        return false;
    }
  }


  // tinyMCE init

  tinymce.init({
    selector: 'textarea#editEmail',
    // content_css: `${urlroot}css/main.css`,
    min_height: 400,
    menubar: false,
    branding: false,
    plugins: 'image advlist lists',
    toolbar: 'undo redo | formatselect | bold italic underline | fontsizeselect | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist | outdent indent | removeformat | image | myCustomToolbarButton| anotherCustomToolbarButton',
    relative_urls: false,
    image_dimensions: false,
    remove_script_host: false,
    // document_base_url: `${urlroot}`,
    setup: (editor) => {
      editor.ui.registry.addButton('myCustomToolbarButton', {
        text: 'ENVOYER',

        onAction: () => {

          let to = getEmailList();
          let subject = document.getElementById('myTitle').value;
          // let message = createEmailWithTemplate(tinymce.activeEditor.getContent());
          let message = tinymce.activeEditor.getContent();

          if (!to || !subject || !message) {
            document.getElementById('error').hidden = false;
            return;
          }


          //Display loading screen
          document
            .querySelector('body')
            .insertAdjacentHTML('afterBegin', loadingScreen);

          const urlroot = `${window.origin}/`;

          //Send email
          const sendEmail = async (emailList, subject, email) => {

            var data = {
              emailList: emailList,
              subject: subject,
              email: message
            };
            var fd = new FormData();
            //very simply, doesn't handle complete objects
            for (var i in data) {
              fd.append(i, data[i]);
            }

            let request = await fetch(`${urlroot}/admin/sendEmail`, {
              method: 'post',
              body: fd,
              mode: 'cors',
            })
            let response = await request.json();
            // console.log(response);
            location.reload();
          }



          sendEmail(to, subject, message);
        }
      })
      editor.ui.registry.addButton('anotherCustomToolbarButton', {
        text: 'APERÇU AVANT ENVOI',

        onAction: () => {
          let email = createEmailWithTemplate(tinymce.activeEditor.getContent());
          //Display preview modal
          let preview = window.open();
          preview.document.body.innerHTML = email;
          console.log(email);

          //Send email
        }
      })
    }
  })

  //Loading screen
  let loadingScreen = `<div class='loadingScreen' style=''><img src="/img/service.png" height="200px" width="auto"/><h1 class='loadingScreen__title'>
                    Nous envoyons votre courriel, merci de patienter.
                    </h1><div class='loadingScreen__loader'></div></div><style>

                .loadingScreen{
                    height: 100vh; 
                    width: 100vw; 
                    position: absolute; 
                    z-index: 999999; 
                    background: rgba(0,0,0,.7);
                    display: flex;
                    flex-flow: column nowrap;
                    justify-content: center;
                    align-items: center;
                }

                .loadingScreen__title{
                    color: #3498db;
                    padding: 1em;
                }

                .loadingScreen__loader{
                border: 16px solid #f3f3f3; /* Light grey */
                  border-top: 16px solid #3498db; /* Blue */
                  border-radius: 50%;
                  width: 120px;
                  height: 120px;
                  animation: spin 2s linear infinite;
                }

                @keyframes spin {
                  0% { transform: rotate(0deg); }
                  100% { transform: rotate(360deg); }
                }</style>

                `;
</script>

<style>
  input::placeholder {
    color: #4a4a4a;
    opacity: .8;
  }
</style>