<?php
if (session_status() === PHP_SESSION_NONE) {
  ini_set("session.cache_expire", 600);
  ini_set("session.gc_maxlifetime", 36000);
  ini_set("session.cookie_lifetime", 36000);
  session_start();
}


class Users extends Controller
{
  private $userManagerModel;
  private $folderModel;

  public function __construct()
  {
    $this->userManagerModel = $this->model('UserManager');
    $this->folderModel = $this->model('Folders');
    $this->adminManager = $this->model('AdminManager');
  }

  public function index()
  {
    redirectWithoutTag('pages/erreur');
    exit;
  }

  public function updateUserSession()
  {
    $email = $_SESSION['data_user']->{'mail'};
    $_SESSION['data_user'] = $this->userManagerModel->getUserByEmail($email);
    exit;
  }

  public function test()
  {
    redirectWithoutTag('pages/erreur');
    exit;
  }
  public function updateuser()
  {
    if (!$_SERVER['HTTP_REFERER']) {
      redirectWithoutTag('pages/erreur');
    } else {
      $email = $_SESSION['data_user']->{'mail'};
      $_SESSION['data_user'] = $this->userManagerModel->getUserByEmail($email)[0];

      $ecn_year = htmlspecialchars($_POST['ecn_year']);
      $ecn_place = htmlspecialchars($_POST['ecn_place']);
      $ecn_school = htmlspecialchars($_POST['ecn_school']);
      $birth_date = htmlspecialchars($_POST['birth_date']);
      $sex = htmlspecialchars($_POST['sex']);
      $status = htmlspecialchars($_POST['status']);

      $form = [
        'ecn_year' => $ecn_year,
        'ecn_place' => $ecn_place,
        'ecn_school' => $ecn_school,
        'birth_date' => $birth_date,
        'sex' => $sex,
        'status' => $status,
      ];

      $errors = [];

      if (empty($ecn_year)) {

        $errors['ecn_year'] = "Année de passsage ECN manquante.";
      }

      if (empty($birth_date)) {
        $errors['birth_date'] = "Votre année de naissance est manquante.";
      }

      if ($ecn_place == 0) {
        $errors['ecn_place'] = "Votre départment ECN est manquant.";
      }

      if (empty($ecn_school)) {
        $errors['ecn_school'] = "Votre faculté est manquante.";
      }

      if (empty($birth_date)) {
        $errors['birth_date'] = "Votre date de naissance est invalide.";
      }

      if (empty($birth_date)) {
        $errors['birth_date'] = "Votre date de naissance est invalide.";
      }

      if ($status == 'null') {
        $errors['status'] = "Votre status est invalide.";
      }

      if (empty($errors)) {
        $this->userManagerModel->updateUser($_SESSION['data_user']->{'id'}, $form);
        $_SESSION['flash']['success'] = "Vous pouvez maintenant vous abonner ci-dessous!";
        redirectWithoutTag('pages/welcome');
        exit;
      } else {

        $_SESSION['errors'] = $errors;
        $_SESSION['flash']['danger'] = "Merci de renseigner ces informations supplémentaires pour vous abonner.";
        redirectWithoutTag('pages/welcome');
        exit;
      }
    }
  }

  public function register()
  {
    if (!$_SERVER['HTTP_REFERER']) {
      redirectWithoutTag('pages/erreur');
    } else {
      if (!empty($_POST)) {

        $name = htmlspecialchars($_POST['name']);
        $firstName = htmlspecialchars($_POST['firstName']);
        $mail = htmlspecialchars($_POST['mail']);
        $login = htmlspecialchars($_POST['login']);
        $password = htmlspecialchars($_POST['password']);
        $passwordRepeat = htmlspecialchars($_POST['password_repeat']);
        $token = bin2hex(random_bytes(30));
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        $workplace = htmlspecialchars($_POST['workplace']);


        $data = [
          'name' => $name,
          'firstName' => $firstName,
          'login' => $login,
          'mail' => $mail
        ];

        $form = [
          'name' => $name,
          'firstName' => $firstName,
          'password' => $passwordHash,
          'login' => $login,
          'mail' => $mail,
          'passwordRepeat' => $passwordRepeat,
          'token' => $token,
          // 'ecn_year' => $ecn_year,
          // 'ecn_place' => $ecn_place,
          // 'ecn_school' => $ecn_school,
          // 'birth_date' => $birth_date,
          // 'sex' => $sex,
          // 'status' => $status,
        ];

        $errors = [];

        if (empty($name)) {
          $errors['name'] = "Votre nom est manquant.";
        }
        if (!preg_match("/^[a-zA-Z0-9áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ._\s-]+$/", $name)) {
          $errors['name'] = "Votre nom n'est pas valide.";
        }
        if (empty($firstName)) {
          $errors['firstName'] = "Votre prénom est manquant.";
        }
        if (!preg_match('/^[a-zA-Z0-9áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ._\s-]+$/', $firstName)) {
          $errors['firstName'] = "Votre prénom n'est pas valide.";
        }
        if (empty($mail)) {
          $errors['mail'] = "Votre email est manquant";
        } elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
          $errors['mail'] = "Votre email n' est pas valide";
        } else {
          $userMail = $this->userManagerModel->checkMail($mail);
          if ($userMail) {
            $errors['mail'] = "Ce mail est déjà pris.";
          }
        }
        // if (empty($login)) {
        //     $errors['login'] = "Votre identifiant est manquant";
        // } elseif (!preg_match('/^[a-zA-Z0-9áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ._\s-]+$/', $login)) {
        //     $errors['login'] = "Votre identifiant n' est pas valide";
        // // } else {
        // //     $userLogin = $this->userManagerModel->checkLogin($login);
        // //     if ($userLogin) {
        // //         $errors['login'] = "Cette identifiant est déjà pris pour un autre compte.";
        // //     }
        // }

        // if (empty($ecn_year)) {
        //   $errors['ecn_year'] = "Année de passsage ECN manquante.";
        // }

        // if (empty($birth_date)) {
        //   $errors['birth_date'] = "Votre année de naissance est manquante.";
        // }

        // if ($ecn_place == 0) {
        //   $errors['ecn_place'] = "Votre départment ECN est manquant.";
        // }

        // if (empty($ecn_school)) {
        //   $errors['ecn_school'] = "Votre faculté est manquante.";
        // }

        // if (empty($birth_date)) {
        //   $errors['birth_date'] = "Votre date de naissance est invalide.";
        // }

        // if (empty($birth_date)) {
        //   $errors['birth_date'] = "Votre date de naissance est invalide.";
        // }

        // if ($status == 'null') {
        //   $errors['status'] = "Votre status est invalide.";
        // }

        if (empty($password)) {
          $errors['password'] = "Mot de passe manquant";
        } elseif (strlen($password) < 8) {
          $errors['password'] = "Le mot de passe doit contenir au moins 8 caractères";
        } elseif (!preg_match('@[A-Z]@', $password)) {
          $errors['password'] = 'Le mot de passe ne contient pas de majuscules';
        } elseif (!preg_match('@[a-z]@', $password)) {
          $errors['password'] = 'Le mot de passe ne contient pas de minuscules';
        } elseif (!preg_match('@[0-9]@', $password)) {
          $errors['password'] = 'Le mot de passe ne contient pas de chiffres';
        } elseif (!preg_match('@[\W]@', $password)) {
          $errors['password'] = 'Le mot de passe ne contient pas de caractères spéciaux ,!@#$%';
        }

        if (empty($passwordRepeat)) {
          $errors['password_repeat'] = "Mot de passe répété manquant";
        }

        if ($password != $passwordRepeat) {
          $errors['password_repeat'] = "Les mots de passes ne correspondent pas";
        }

        if (!empty($workplace)) {
          redirectToHome();
        } else {
          if (isset($_POST['recaptcha_response_register'])) {
            if (empty($errors)) {

              $recaptchaUrl = 'https://www.google.com/recaptcha/api/siteverify';
              $recaptchaSecret = SITE_SECRET_KEY;
              $recaptchaResponse = htmlspecialchars($_POST['recaptcha_response_register']);

              $recaptcha = file_get_contents($recaptchaUrl . '?secret=' . $recaptchaSecret . '&response=' . $recaptchaResponse);
              $recaptcha = json_decode($recaptcha);

              // if (($recaptcha->{'score'} >= 0.3) && $recaptcha->{'action'} === 'register')
              // {
              $this->userManagerModel->create($form);
              $userId = (int)$this->userManagerModel->getId();

              //Copy the fiches into the newly registered user.
              //Get all folders from of ADMIN (id = 5).
              $adminFolder = $this->folderModel->getFolderAdmin($userId);

              //Copy all the folders of the admin into the new user.
              $this->folderModel->insertDataFolderCopyAdmin($userId);

              // Get the id of the create folder.
              $arrayIdFolderCreated = $this->folderModel->getIdFolderUserByUserId($userId);

              // Get the id of the folder of the admin (id = 5).
              $arrayIdFolderAdmin = $this->folderModel->getIdFolderAdmin();

              // For each file in the folder admin, copy it into the newly created user
              for ($i = 0; $i < count($arrayIdFolderAdmin); $i++) {
                $this->folderModel->insertDataFileCopyAdmin($arrayIdFolderCreated[$i], $arrayIdFolderAdmin[$i]);
              }

              //Add articles to new users.
              $this->adminManager->copyAdminArticlesData($userId);


              //Add site to new users.
              $this->adminManager->copyAdminSitesData($userId);

              // Set all notifications to 0
              $this->folderModel->setAllNotifFoldersToFalse($userId);
              $this->folderModel->setAllNotifFilesToFalse($userId);


              //Create the default avatar for the new user.
              // copy(URLROOT.'/img/service.png', URLROOT.'/img/'.$userId.'.png');

              $headers[] = 'MIME-Version: 1.0';
              $headers[] = 'Content-type: text/html; charset=UTF8';
              $headers[] = 'From: Doctofiche <doctofiche@gmail.com>';
              $message = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml' xmlns:o='urn:schemas-microsoft-com:office:office' style='width:100%;font-family:lato, 'helvetica neue', helvetica, arial, sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0'><head><link type='text/css' rel='stylesheet' id='dark-mode-general-link'><link type='text/css' rel='stylesheet' id='dark-mode-custom-link'><link type='text/css' rel='stylesheet' id='dark-mode-general-link'><link type='text/css' rel='stylesheet' id='dark-mode-custom-link'><meta charset='UTF-8'><meta content='width=device-width, initial-scale=1' name='viewport'><meta name='x-apple-disable-message-reformatting'><meta http-equiv='X-UA-Compatible' content='IE=edge'><meta content='telephone=no' name='format-detection'><title>Doctofiche email bienvenue</title>
 <!--[if (mso 16)]><style type='text/css'>     a {text-decoration: none;}     </style><![endif]--> <!--[if gte mso 9]><style>sup { font-size: 100% !important; }</style><![endif]--> <!--[if gte mso 9]><xml> <o:OfficeDocumentSettings> <o:AllowPNG></o:AllowPNG> <o:PixelsPerInch>96</o:PixelsPerInch> </o:OfficeDocumentSettings> </xml><![endif]--> <!--[if !mso]><!-- --><link href='https://fonts.googleapis.com/css?family=Lato:400,400i,700,700i' rel='stylesheet'> <!--<![endif]--><style type='text/css'>
@media only screen and (max-width:600px) {p, ul li, ol li, a { font-size:16px!important; line-height:150%!important } h1 { font-size:30px!important; text-align:center; line-height:120%!important } h2 { font-size:26px!important; text-align:center; line-height:120%!important } h3 { font-size:20px!important; text-align:center; line-height:120%!important } h1 a { font-size:30px!important } h2 a { font-size:26px!important } h3 a { font-size:20px!important } .es-menu td a { font-size:16px!important } .es-header-body p, .es-header-body ul li, .es-header-body ol li, .es-header-body a { font-size:16px!important } .es-footer-body p, .es-footer-body ul li, .es-footer-body ol li, .es-footer-body a { font-size:16px!important } .es-infoblock p, .es-infoblock ul li, .es-infoblock ol li, .es-infoblock a { font-size:12px!important } *[class='gmail-fix'] { display:none!important } .es-m-txt-c, .es-m-txt-c h1, .es-m-txt-c h2, .es-m-txt-c h3 { 
text-align:center!important } .es-m-txt-r, .es-m-txt-r h1, .es-m-txt-r h2, .es-m-txt-r h3 { text-align:right!important } .es-m-txt-l, .es-m-txt-l h1, .es-m-txt-l h2, .es-m-txt-l h3 { text-align:left!important } .es-m-txt-r img, .es-m-txt-c img, .es-m-txt-l img { display:inline!important } .es-button-border { display:block!important } a.es-button { font-size:20px!important; display:block!important; border-width:15px 25px 15px 25px!important } .es-btn-fw { border-width:10px 0px!important; text-align:center!important } .es-adaptive table, .es-btn-fw, .es-btn-fw-brdr, .es-left, .es-right { width:100%!important } .es-content table, .es-header table, .es-footer table, .es-content, .es-footer, .es-header { width:100%!important; max-width:600px!important } .es-adapt-td { display:block!important; width:100%!important } .adapt-img { width:100%!important; height:auto!important } .es-m-p0 { padding:0px!important } .es-m-p0r { 
padding-right:0px!important } .es-m-p0l { padding-left:0px!important } .es-m-p0t { padding-top:0px!important } .es-m-p0b { padding-bottom:0!important } .es-m-p20b { padding-bottom:20px!important } .es-mobile-hidden, .es-hidden { display:none!important } tr.es-desk-hidden, td.es-desk-hidden, table.es-desk-hidden { width:auto!important; overflow:visible!important; float:none!important; max-height:inherit!important; line-height:inherit!important } tr.es-desk-hidden { display:table-row!important } table.es-desk-hidden { display:table!important } td.es-desk-menu-hidden { display:table-cell!important } table.es-table-not-adapt, .esd-block-html table { width:auto!important } table.es-social { display:inline-block!important } table.es-social td { display:inline-block!important } }#outlook a { padding:0;}.ExternalClass { width:100%;}.ExternalClass,.ExternalClass p,.ExternalClass span,.ExternalClass font,.ExternalClass td,.ExternalClass div 
{   line-height:100%;}.es-button {  mso-style-priority:100!important;   text-decoration:none!important;}a[x-apple-data-detectors] { color:inherit!important;    text-decoration:none!important; font-size:inherit!important;    font-family:inherit!important;  font-weight:inherit!important;  line-height:inherit!important;}.es-desk-hidden {    display:none;   float:left; overflow:hidden;    width:0;    max-height:0;   line-height:0;  mso-hide:all;}</style></head><body style='width:100%;font-family:lato, 'helvetica neue', helvetica, arial, sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0'><div class='es-wrapper-color' style='background-color:#F4F4F4'> <!--[if gte mso 9]><v:background xmlns:v='urn:schemas-microsoft-com:vml' fill='t'> <v:fill type='tile' color='#f4f4f4'></v:fill> </v:background><![endif]-->
<table class='es-wrapper' width='100%' cellspacing='0' cellpadding='0' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;padding:0;Margin:0;width:100%;height:100%;background-repeat:repeat;background-position:center top'><tr class='gmail-fix' height='0' style='border-collapse:collapse'><td style='padding:0;Margin:0'><table cellspacing='0' cellpadding='0' border='0' align='center' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;width:600px'><tr style='border-collapse:collapse'><td cellpadding='0' cellspacing='0' border='0' style='padding:0;Margin:0;line-height:1px;min-width:600px' height='0'><img src='https://esputnik.com/repository/applications/images/blank.gif' style='display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;max-height:0px;min-height:0px;min-width:600px;width:600px' alt width='600' height='1'></td></tr>
</table></td></tr><tr style='border-collapse:collapse'><td valign='top' style='padding:0;Margin:0'><table class='es-header' cellspacing='0' cellpadding='0' align='center' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:#FFA73B;background-repeat:repeat;background-position:center top'><tr style='border-collapse:collapse'><td align='center' bgcolor='#0095d9' style='padding:0;Margin:0;background-color:#0095D9'><table class='es-header-body' cellspacing='0' cellpadding='0' align='center' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px'><tr style='border-collapse:collapse'><td align='left' style='Margin:0;padding-bottom:10px;padding-left:10px;padding-right:10px;padding-top:20px'>
<table width='100%' cellspacing='0' cellpadding='0' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'><tr style='border-collapse:collapse'><td valign='top' align='center' style='padding:0;Margin:0;width:580px'><table width='100%' cellspacing='0' cellpadding='0' bgcolor='#0095d9' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#0095D9' role='presentation'><tr style='border-collapse:collapse'><td align='center' style='padding:0;Margin:0;font-size:0px'><img class='adapt-img' src='https://hayhvt.stripocdn.email/content/guids/CABINET_38e78def40daef7c908dc9f183c3c2c2/images/29481598958489871.jpeg' alt style='display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic' width='580' height='216'></td></tr></table></td></tr></table></td></tr></table></td></tr></table>
<table class='es-content' cellspacing='0' cellpadding='0' align='center' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%'><tr style='border-collapse:collapse'><td style='padding:0;Margin:0;background-color:#0095D9' bgcolor='#0095d9' align='center'><table class='es-content-body' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px' cellspacing='0' cellpadding='0' align='center'><tr style='border-collapse:collapse'><td align='left' style='padding:0;Margin:0'><table width='100%' cellspacing='0' cellpadding='0' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'><tr style='border-collapse:collapse'><td valign='top' align='center' style='padding:0;Margin:0;width:600px'>
<table style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:separate;border-spacing:0px;background-color:#FFFFFF;border-radius:4px' width='100%' cellspacing='0' cellpadding='0' bgcolor='#ffffff' role='presentation'><tr style='border-collapse:collapse'><td align='center' style='Margin:0;padding-bottom:5px;padding-left:30px;padding-right:30px;padding-top:35px'><h1 style='Margin:0;line-height:58px;mso-line-height-rule:exactly;font-family:lato, 'helvetica neue', helvetica, arial, sans-serif;font-size:48px;font-style:normal;font-weight:normal;color:#111111'>Salut&nbsp; " . $firstName . " !</h1></td></tr><tr style='border-collapse:collapse'><td bgcolor='#ffffff' align='center' style='Margin:0;padding-top:5px;padding-bottom:5px;padding-left:20px;padding-right:20px;font-size:0'>
<table width='100%' height='100%' cellspacing='0' cellpadding='0' border='0' role='presentation' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'><tr style='border-collapse:collapse'><td style='padding:0;Margin:0;border-bottom:1px solid #FFFFFF;background:#FFFFFFnone repeat scroll 0% 0%;height:1px;width:100%;margin:0px'></td></tr></table></td></tr></table></td></tr></table></td></tr></table></td></tr></table><table class='es-content' cellspacing='0' cellpadding='0' align='center' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%'><tr style='border-collapse:collapse'><td align='center' style='padding:0;Margin:0'>
<table class='es-content-body' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px' cellspacing='0' cellpadding='0' align='center'><tr style='border-collapse:collapse'><td align='left' style='padding:0;Margin:0'><table width='100%' cellspacing='0' cellpadding='0' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'><tr style='border-collapse:collapse'><td valign='top' align='center' style='padding:0;Margin:0;width:600px'><table style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:separate;border-spacing:0px;border-radius:4px;background-color:#FFFFFF' width='100%' cellspacing='0' cellpadding='0' bgcolor='#ffffff' role='presentation'><tr style='border-collapse:collapse'>
<td class='es-m-txt-l' bgcolor='#ffffff' align='left' style='Margin:0;padding-top:20px;padding-bottom:20px;padding-left:30px;padding-right:30px'><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:lato, 'helvetica neue', helvetica, arial, sans-serif;line-height:27px;color:#666666'>Bienvenue, tu fais maintenant parti de la communauté Doctofiche, tu verras, tu ne le regretteras pas&nbsp;!&nbsp;</p><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:lato, 'helvetica neue', helvetica, arial, sans-serif;line-height:27px;color:#666666'><br></p><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:lato, 'helvetica neue', helvetica, arial, sans-serif;line-height:27px;color:#666666'>
Tu trouveras en bas de cet e-mail le lien te permettant d’accéder à ton compte.&nbsp;</p></td></tr><tr style='border-collapse:collapse'><td align='center' style='padding:0;Margin:0;font-size:0px'><img class='adapt-img' src='https://hayhvt.stripocdn.email/content/guids/b6b79093-7176-47d8-8f1b-cce8dc912d16/images/18671598958164317.png' alt style='display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic' height='243' width='266'></td></tr><tr style='border-collapse:collapse'><td class='es-m-txt-l' bgcolor='#ffffff' align='left' style='Margin:0;padding-top:20px;padding-bottom:20px;padding-left:40px;padding-right:40px'><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:lato, 'helvetica neue', helvetica, arial, sans-serif;line-height:27px;color:#666666'><br><em><u style='opacity: .8'>Message d’accueil du fondateur , Alexandre:&nbsp;</u></em></p>
<p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:lato, 'helvetica neue', helvetica, arial, sans-serif;line-height:27px;color:#666666'><br></p><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:lato, 'helvetica neue', helvetica, arial, sans-serif;line-height:27px;color:#666666'><em>Ici, je te présente un système génial pour retenir, consigner et classer tout ce que tu apprendras&nbsp;! Créer par des internes pour des internes&nbsp;!&nbsp;</em></p><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:lato, 'helvetica neue', helvetica, arial, sans-serif;line-height:27px;color:#666666'><br></p>
<p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:lato, 'helvetica neue', helvetica, arial, sans-serif;line-height:27px;color:#666666'><em>La gestion de l’information des connaissances, en médecine, personne n’en parle.&nbsp;</em></p><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:lato, 'helvetica neue', helvetica, arial, sans-serif;line-height:27px;color:#666666'><br></p><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:lato, 'helvetica neue', helvetica, arial, sans-serif;line-height:27px;color:#666666'><em>C’est pourtant l’une des choses les plus importantes pour tout médecin, et encore plus quand tu te lances dans les remplas, en stage niveau 1 ou SASPAS.&nbsp;</em></p>
<p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:lato, 'helvetica neue', helvetica, arial, sans-serif;line-height:27px;color:#666666'><em>&nbsp;</em></p><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:lato, 'helvetica neue', helvetica, arial, sans-serif;line-height:27px;color:#666666'><em>Parce que tu vois…&nbsp;</em></p><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:lato, 'helvetica neue', helvetica, arial, sans-serif;line-height:27px;color:#666666'><br></p><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:lato, 'helvetica neue', helvetica, arial, sans-serif;line-height:27px;color:#666666'><em><b>
Ton cerveau ne peut pas être à 100% tous les jours.&nbsp;</b></em></p><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:lato, 'helvetica neue', helvetica, arial, sans-serif;line-height:27px;color:#666666'><br></p><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:lato, 'helvetica neue', helvetica, arial, sans-serif;line-height:27px;color:#666666'><em>Surtout que tu verras tu seras envahi pour une multitude d’informations, de newsletters, de formations, d’articles médicaux, de nouvelles recommandations etc.&nbsp;&nbsp;</em></p><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:lato, 'helvetica neue', helvetica, arial, sans-serif;line-height:27px;color:#666666'><br></p>
<p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:lato, 'helvetica neue', helvetica, arial, sans-serif;line-height:27px;color:#666666'><em><b>Si tu mises sur ta capacité de mémorisation, au début ça va aller mais au fil des consultations, tout va se compliquer&nbsp;!</b>&nbsp;</em></p><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:lato, 'helvetica neue', helvetica, arial, sans-serif;line-height:27px;color:#666666'><br></p><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:lato, 'helvetica neue', helvetica, arial, sans-serif;line-height:27px;color:#666666'><em>
Tu risques de t’épuiser, de mal gérer ton stress, de ne plus être capable d’emmagasiner quoique ce soit, de ne plus être un médecin à jour des nouvelles recommandations, ou pire… de faire un burn out&nbsp;!&nbsp;&nbsp;</em></p><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:lato, 'helvetica neue', helvetica, arial, sans-serif;line-height:27px;color:#666666'><br></p><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:lato, 'helvetica neue', helvetica, arial, sans-serif;line-height:27px;color:#666666'><em>Avec Doctofiche, tu apprends à créer ta propre base de données, personnelle fiable et sécurisée. Ceci dans le but de retrouver les informations dont tu as besoin au moment où tu en as besoin, en moins de 3 clics.&nbsp;</em></p>
<p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:lato, 'helvetica neue', helvetica, arial, sans-serif;line-height:27px;color:#666666'><br></p><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:lato, 'helvetica neue', helvetica, arial, sans-serif;line-height:27px;color:#666666'><br></p><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:lato, 'helvetica neue', helvetica, arial, sans-serif;line-height:27px;color:#666666'><em><em>Tu vas aussi, dès aujourd’hui commencer à créer ton réseau médical. Ça peut te paraître un peu tôt pour toi, mais c’est important de pouvoir adresser son patient à un confrère fiable et de confiance rapidement.&nbsp;</em></em></p>
<p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:lato, 'helvetica neue', helvetica, arial, sans-serif;line-height:27px;color:#666666'><br></p><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:lato, 'helvetica neue', helvetica, arial, sans-serif;line-height:27px;color:#666666'><em><em><b>Si tu commences à créer ce contenu petit à petit dès aujourd’hui, cette base de données pourrait devenir le logiciel qui t’accompagnera durant toute ta vie professionnelle.</b>&nbsp;</em></em></p><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:lato, 'helvetica neue', helvetica, arial, sans-serif;line-height:27px;color:#666666'><br></p>
<p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:lato, 'helvetica neue', helvetica, arial, sans-serif;line-height:27px;color:#666666'><em><em>En gros, tout ce dont tu as besoin pour te décharger l’esprit et être opérationnelle face à tes patients.&nbsp;</em></em></p><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:lato, 'helvetica neue', helvetica, arial, sans-serif;line-height:27px;color:#666666'><br></p><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:lato, 'helvetica neue', helvetica, arial, sans-serif;line-height:27px;color:#666666'><em><em><b>Tu garderais l’accès à cette base à vie, et chaque année, elle continuerait de croître et à prendre de la valeur.</b>&nbsp;</em></em></p>
<p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:lato, 'helvetica neue', helvetica, arial, sans-serif;line-height:27px;color:#666666'><em><em><b>Je crois sincèrement que cette méthode de prise de notes (qui est beaucoup plus que ça, tu l’as compris) peut radicalement changer ta façon de consulter.</b>&nbsp;</em></em></p><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:lato, 'helvetica neue', helvetica, arial, sans-serif;line-height:27px;color:#666666'><br></p><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:lato, 'helvetica neue', helvetica, arial, sans-serif;line-height:27px;color:#666666'><em><em>
Je te conseille de remplir tes propres fiches au fur et à mesure des situations complexes que tu rencontreras en consultation.&nbsp;</em></em></p><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:lato, 'helvetica neue', helvetica, arial, sans-serif;line-height:27px;color:#666666'><br></p><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:lato, 'helvetica neue', helvetica, arial, sans-serif;line-height:27px;color:#666666'><em><em><b>Une fois que l’habitude sera prise, tu verras : tu te demanderas comment tu faisais avant…</b>&nbsp;</em></em></p><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:lato, 'helvetica neue', helvetica, arial, sans-serif;line-height:27px;color:#666666'><br></p>
<p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:lato, 'helvetica neue', helvetica, arial, sans-serif;line-height:27px;color:#666666'><em><em>Bonne chance pour la création de ton nouveau binôme de travail&nbsp;!&nbsp;</em></em></p><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:lato, 'helvetica neue', helvetica, arial, sans-serif;line-height:27px;color:#666666'><br></p></td></tr><tr style='border-collapse:collapse'><td class='es-m-txt-l' align='left' style='padding:0;Margin:0;padding-top:20px;padding-left:30px;padding-right:30px'><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:lato, 'helvetica neue', helvetica, arial, sans-serif;line-height:27px;color:#666666'><strong>
Si vous avez des questions, répondez simplement à cet email — nous sommes heureux de vous écouter!</strong></p></td></tr><tr style='border-collapse:collapse'><td class='es-m-txt-l' align='right' style='Margin:0;padding-top:20px;padding-left:30px;padding-right:30px;padding-bottom:40px'><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:20px;font-family:lato, 'helvetica neue', helvetica, arial, sans-serif;line-height:30px;color:#666666'><em>L'équipe Doctofiche.</em></p></td></tr><tr style='border-collapse:collapse'><td align='center' style='Margin:0;padding-left:10px;padding-right:10px;padding-top:35px;padding-bottom:35px'><span class='es-button-border' style='border-style:solid;border-color:#0095D9;background:#0095D9;border-width:1px;display:inline-block;border-radius:5px;width:auto;box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1)'>
<a href=" . URLROOT . '/users/confirm/?id=' . $userId . '&token=' . $token . " class='es-button' target='_blank' style='font-size:20px;color:#FFFFFF;border-style:solid;border-color:#0095D9;display:inline-block;background:#0095D9;border-radius:5px;font-weight:normal;font-style:normal;line-height:24px; padding: 20px 40px; width:auto;text-align:center; text-decoration: none;box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);'>Valider mon email</a></span></td></tr></table></td></tr></table></td></tr></table></td></tr></table><table class='es-content' cellspacing='0' cellpadding='0' align='center' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%'><tr style='border-collapse:collapse'><td align='center' style='padding:0;Margin:0'>
<table class='es-content-body' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px' cellspacing='0' cellpadding='0' align='center'><tr style='border-collapse:collapse'><td align='left' style='padding:0;Margin:0'><table width='100%' cellspacing='0' cellpadding='0' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'><tr style='border-collapse:collapse'><td valign='top' align='center' style='padding:0;Margin:0;width:600px'><table width='100%' cellspacing='0' cellpadding='0' role='presentation' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'><tr style='border-collapse:collapse'><td align='center' style='Margin:0;padding-top:10px;padding-bottom:20px;padding-left:20px;padding-right:20px;font-size:0'>
<table width='100%' height='100%' cellspacing='0' cellpadding='0' border='0' role='presentation' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'><tr style='border-collapse:collapse'><td style='padding:0;Margin:0;border-bottom:1px solid #F4F4F4;background:#FFFFFFnone repeat scroll 0% 0%;height:1px;width:100%;margin:0px'></td></tr></table></td></tr></table></td></tr></table></td></tr></table></td></tr></table><table class='es-content' cellspacing='0' cellpadding='0' align='center' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%'><tr style='border-collapse:collapse'><td align='center' style='padding:0;Margin:0'>
<table class='es-content-body' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px' cellspacing='0' cellpadding='0' align='center'><tr style='border-collapse:collapse'><td align='left' style='padding:0;Margin:0'><table width='100%' cellspacing='0' cellpadding='0' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'><tr style='border-collapse:collapse'><td valign='top' align='center' style='padding:0;Margin:0;width:600px'><table style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:separate;border-spacing:0px;background-color:#FFECD1;border-radius:4px' width='100%' cellspacing='0' cellpadding='0' bgcolor='#ffecd1' role='presentation'><tr style='border-collapse:collapse'><td align='center' style='padding:0;Margin:0;font-size:0px'>
<img class='adapt-img' src='https://hayhvt.stripocdn.email/content/guids/CABINET_38e78def40daef7c908dc9f183c3c2c2/images/58591599040300533.png' alt style='display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic' width='600' height='154'></td></tr></table></td></tr></table></td></tr></table></td></tr></table></td></tr></table></div></body>
</html>
";
              $subject = '=?UTF-8?B?' . base64_encode('Confirmation de votre compte sur Doctofiche') . '?=';
              mail(
                $mail,
                $subject,
                $message,
                implode("\r\n", $headers)
              );
              $_SESSION['flash']['success'] = "Un email de confirmation a été envoyé sur votre boîte e-mail!";
              $_SESSION['email'] = $email;
              redirectWithoutTag('pages/confirmation');
              exit;
              // } else {
              //     $_SESSION['flash']['danger'] = "Action invalide";
              //     redirectToHome();
              //     exit;
              // }
            } else {
              $_SESSION['errors'] = $errors;
              $_SESSION['data'] = $data;
              redirectWithoutTag('pages/inscription');
              exit;
            }
          }
        }
      }
    }
  }

  public function registerPro()
  {
    if (!$_SERVER['HTTP_REFERER']) {
      redirectWithoutTag('pages/erreur');
    } else {
      if (!empty($_POST)) {

        $name = htmlspecialchars($_POST['name']);
        $firstName = htmlspecialchars($_POST['firstName']);
        $mail = htmlspecialchars($_POST['mail']);
        $login = htmlspecialchars($_POST['login']);
        $password = htmlspecialchars($_POST['password']);
        $passwordRepeat = htmlspecialchars($_POST['password_repeat']);
        $token = bin2hex(random_bytes(30));
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        $workplace = htmlspecialchars($_POST['workplace']);


        $data = [
          'name' => $name,
          'firstName' => $firstName,
          'login' => $login,
          'mail' => $mail
        ];

        $form = [
          'name' => $name,
          'firstName' => $firstName,
          'password' => $passwordHash,
          'login' => $login,
          'mail' => $mail,
          'passwordRepeat' => $passwordRepeat,
          'token' => $token,
        ];

        $errors = [];

        if (empty($name)) {
          $errors['name'] = "Votre nom est manquant.";
        }
        if (!preg_match("/^[a-zA-Z0-9áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ._\s-]+$/", $name)) {
          $errors['name'] = "Votre nom n'est pas valide.";
        }
        if (empty($firstName)) {
          $errors['firstName'] = "Votre prénom est manquant.";
        }
        if (!preg_match('/^[a-zA-Z0-9áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ._\s-]+$/', $firstName)) {
          $errors['firstName'] = "Votre prénom n'est pas valide.";
        }
        if (empty($mail)) {
          $errors['mail'] = "Votre email est manquant";
        } elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
          $errors['mail'] = "Votre email n' est pas valide";
        } else {
          $userMail = $this->userManagerModel->checkMail($mail);
          if ($userMail) {
            $errors['mail'] = "Ce mail est déjà pris.";
          }
        }
        if (empty($password)) {
          $errors['password'] = "Mot de passe manquant";
        } elseif (strlen($password) < 8) {
          $errors['password'] = "Le mot de passe doit contenir au moins 8 caractères";
        } elseif (!preg_match('@[A-Z]@', $password)) {
          $errors['password'] = 'Le mot de passe ne contient pas de majuscules';
        } elseif (!preg_match('@[a-z]@', $password)) {
          $errors['password'] = 'Le mot de passe ne contient pas de minuscules';
        } elseif (!preg_match('@[0-9]@', $password)) {
          $errors['password'] = 'Le mot de passe ne contient pas de chiffres';
        } elseif (!preg_match('@[\W]@', $password)) {
          $errors['password'] = 'Le mot de passe ne contient pas de caractères spéciaux ,!@#$%';
        }

        if (empty($passwordRepeat)) {
          $errors['password_repeat'] = "Mot de passe répété manquant";
        }

        if ($password != $passwordRepeat) {
          $errors['password_repeat'] = "Les mots de passes ne correspondent pas";
        }

        if (!empty($workplace)) {
          redirectToHome();
        } else {
          if (isset($_POST['recaptcha_response_register'])) {
            if (empty($errors)) {

              $recaptchaUrl = 'https://www.google.com/recaptcha/api/siteverify';
              $recaptchaSecret = SITE_SECRET_KEY;
              $recaptchaResponse = htmlspecialchars($_POST['recaptcha_response_register']);

              $recaptcha = file_get_contents($recaptchaUrl . '?secret=' . $recaptchaSecret . '&response=' . $recaptchaResponse);
              $recaptcha = json_decode($recaptcha);

              // if (($recaptcha->{'score'} >= 0.3) && $recaptcha->{'action'} === 'register')
              // {
              $this->userManagerModel->createPro($form);
              $userId = 1;

              //Copy the fiches into the newly registered user.
              //Get all folders from of ADMIN (id = 5).
              $adminFolder = $this->folderModel->getFolderAdmin($userId);

              //Copy all the folders of the admin into the new user.
              $this->folderModel->insertDataFolderCopyAdmin($userId);

              // Get the id of the create folder.
              $arrayIdFolderCreated = $this->folderModel->getIdFolderUserByUserId($userId);

              // Get the id of the folder of the admin (id = 5).
              $arrayIdFolderAdmin = $this->folderModel->getIdFolderAdmin();

              // For each file in the folder admin, copy it into the newly created user
              for ($i = 0; $i < count($arrayIdFolderAdmin); $i++) {
                $this->folderModel->insertDataFileCopyAdmin($arrayIdFolderCreated[$i], $arrayIdFolderAdmin[$i]);
              }

              //Add articles to new users.
              $this->adminManager->copyAdminArticlesData($userId);


              //Add site to new users.
              $this->adminManager->copyAdminSitesData($userId);

              // Set all notifications to 0
              $this->folderModel->setAllNotifFoldersToFalse($userId);
              $this->folderModel->setAllNotifFilesToFalse($userId);

              $email = $mail;
              $session = $this->userManagerModel->sessionStripePro('https://localhost:8888/pages/inscription-pro', $name, $firstName, $mail);
              $_SESSION['session'] = $session;
              redirectWithoutTag(('pages/inscription-pro'));
              exit;
            } else {
              $_SESSION['errors'] = $errors;
              $_SESSION['data'] = $data;
              redirectWithoutTag(('pages/inscription-pro'));
              exit;
            }
          }
        }
      }
    }
  }

  public function connexion()
  {
    // if (!$_SERVER['HTTP_REFERER']){ 
    // redirectWithoutTag('pages/erreur');
    // } else {
    if (!empty($_POST)) {
      $email = htmlspecialchars($_POST['email']);
      $password = htmlspecialchars($_POST['password']);
      $user = $this->userManagerModel->getUserByEmail($email);
      $user = reset($user);
      if ($user) {
        $confirmationToken = $user->{'confirmation_token'};
        $customer_id = $user->{'customer_id'};
        if ($confirmationToken == NULL) {
          if (password_verify($password, $user->{'password'})) {
            session_unset();
            session_destroy();
            ini_set("session.cache_expire", 600);
            ini_set("session.gc_maxlifetime", 36000);
            ini_set("session.cookie_lifetime", 36000);
            session_start();
            $_SESSION['data_user'] = $user;
            $_SESSION['flash']['success'] = "Vous êtes maintenant connecté";
            $_SESSION['inactivity_time'] = time() + (36000);
            if ($customer_id == NULL) {
              redirectWIthoutTag('pages/welcome');
            } else {
              redirectWIthoutTag('pages/fiche');
              exit;
            }
          } else {
            $_SESSION['flash']['danger'] = "Mot de passe ou identifiant incorrect";
            redirectWithoutTag('pages/connexion');
            exit;
          }
        } else {
          $_SESSION['flash']['danger'] = "Vous devez d'abord validé votre e-mail";
          redirectWithoutTag('pages/connexion');
          exit;
        }
      } else {
        $_SESSION['flash']['danger'] = "Adresse email inconnue.Veuillez vérifier l'adresse email.";
        redirectWithoutTag('pages/connexion');
        exit;
      }
    } else {
      $_SESSION['flash']['info'] = 'Les champs de connexion sont vides';
      redirect('pages/connexion');
      exit;
    }
    // }

  }

  public function confirm()
  {
    $userId = (int)$_GET['id'];
    $token = $_GET['token'];
    $user = $this->userManagerModel->getUserById($userId);
    $user = reset($user);
    if (!empty($user)) {

      if ($user->{'confirmation_token'} == $token) {
        $this->userManagerModel->update($userId);
        $_SESSION['data_user'] = $user;
        $_SESSION['flash']['success'] = "Votre compte a bien été validé";
        redirectWithoutTag('pages/welcome');
        // redirectWithoutTag('pages/fiche');
        exit;
      } else {
        $_SESSION['flash']['danger'] = "Opération non autorisé";
        redirectWithoutTag('pages/connexion');
        exit;
      }
    } else {
      $_SESSION['flash']['danger'] = "Opération non autorisé";
      redirectWithoutTag('pages/connexion');
      exit;
    }
  }

  public function contactForm()
  {
    if (!empty($_POST)) {
      $name = htmlspecialchars($_POST['name']);
      $email = htmlspecialchars($_POST['email']);
      $message = htmlspecialchars($_POST['message']);
      $firstName = htmlspecialchars($_POST['firstname']);

      $data = [
        'name' => $name,
        'email' => $email,
        'message' => $message
      ];

      $errors = [];

      if (empty($name)) {
        $errors['name'] = "votre nom est manquant";
      }
      if (!preg_match("/^[a-zA-Z0-9_ ]+$/", $name)) {
        $errors['name'] = "Votre nom n'est pas valide";
      }
      if (empty($email)) {
        $errors['email'] = "votre email est manquant";
      } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "votre email n' est pas valide";
      }
      if (empty($message)) {
        $errors['message'] = "votre message est manquant";
      }

      if (!empty($firstName)) {
        redirectToHome();
      } else {
        if (isset($_POST['recaptcha_response'])) {
          if (empty($errors)) {

            $recaptchaUrl = 'https://www.google.com/recaptcha/api/siteverify';
            $recaptchaSecret = SITE_SECRET_KEY;
            $recaptchaResponse = htmlspecialchars($_POST['recaptcha_response']);

            $recaptcha = file_get_contents($recaptchaUrl . '?secret=' . $recaptchaSecret . '&response=' . $recaptchaResponse);
            $recaptcha = json_decode($recaptcha);

            if (($recaptcha->{'score'} >= 0.3) && $recaptcha->{'action'} === 'contact') {
              $headers[] = 'MIME-Version: 1.0';
              $headers[] = 'Content-type: text/html; charset=UTF8';
              $headers[] = 'From: Doctofiche <doctofiche@gmail.com>';
              $subject = '=?UTF-8?B?' . base64_encode('Formulaire de contact Doctofiche') . '?=';
              mail(
                MAIL,
                $subject,
                $message,
                implode("\r\n", $headers)
              );
              $_SESSION['flash']['success'] = "Votre e-mail a bien été envoyé";
              redirectToHome();
              exit;
            } else {
              $_SESSION['flash']['danger'] = "Action invalide";
              redirectToHome();
              exit;
            }
          } else {
            $_SESSION['errors'] = $errors;
            $_SESSION['data'] = $data;
            redirectWithoutTag('#contact');
            exit;
          }
        } else {
          $_SESSION['flash']['danger'] = "Action invalide";
          redirectToHome();
          exit;
        }
      }
    }
  }

  public function renewPassword()
  {

    if (!empty($_POST)) {
      $email = htmlspecialchars($_POST['mail']);
      $errors = [];
      if (empty($email)) {
        $errors['email'] = 'Aucun e-mail renseigné!';
      } else {
        if (empty($errors)) {
          $userMail = $this->userManagerModel->checkMail($email);
          if (!$userMail) {
            $errors['email'] = "Nous n'avons pas pu trouver ce compte avec cette e-mail, veuillez réessayez";
            $_SESSION['errors'] = $errors;
            redirect('pages/home    ');
            exit;
          } else {
            $userId = $this->userManagerModel->getIdByEmail($email);
            $userId = (int)reset($userId);
            $token = bin2hex(random_bytes(30));
            $this->userManagerModel->deleteRowPswdReset($userId);
            $this->userManagerModel->createPswdReset($userId, $token);
            $message = 'pour réinitialiser votre mot de passe, veuillez cliquer sur 
                        ce lien<br/><a href="' . URLROOT . '/users/verification/?id=' . $userId . '&token=' . $token . '" >cliquez ici</a>';
            $headers[] = 'MIME-Version: 1.0';
            $headers[] = 'Content-type: text/html; charset=UTF8';
            $headers[] = 'From: Doctofiche <doctofiche@gmail.com>';
            $subject = '=?UTF-8?B?' . base64_encode('Réinitialisation du mot de passe') . '?=';
            mail(
              MAIL,
              $subject,
              $message,
              implode("\r\n", $headers)
            );
            $_SESSION['flash']['success'] = "Vérifie ta boîte e-mail!";
            redirect('pages/home');
            exit;
          }
        } else {

          $_SESSION['errors'] = $errors;
          redirect('pages/home');
          exit;
        }
      }
    }
  }

  public function verification()
  {
    $userId = (int)htmlspecialchars($_GET['id']);
    $token = htmlspecialchars($_GET['token']);
    $user = $this->userManagerModel->getUserByIdAndToken($userId, $token);

    if (empty($user)) {
      $_SESSION['flash']['danger'] = "Opération non autorisé";
      redirect('/pages/renew');
      exit;
    } else {
      $_SESSION['userRenewPass'] = $user;
      $_SESSION['flash']['success'] = "Veuillez réinitialiser votre mot de passe!";
      redirect('pages/createNewPassword', $urlTags);
      exit;
    }
  }
  public function confirmResetPassword()
  {

    if (!empty($_POST)) {

      $password = htmlspecialchars($_POST['password']);
      $passwordRepeat = htmlspecialchars($_POST['password_repeat']);

      $errors = [];
      if (empty($password)) {
        $errors['password'] = "mot de passe manquant";
      } elseif (strlen($password) < 8) {
        $errors['password'] = "Le mot de passe doit contenir au moins 8 caractères";
      } elseif (!preg_match('@[A-Z]@', $password)) {
        $errors['password'] = 'Le mot de passe ne contient pas de majuscules';
      } elseif (!preg_match('@[a-z]@', $password)) {
        $errors['password'] = 'Le mot de passe ne contient pas de minuscules';
      } elseif (!preg_match('@[0-9]@', $password)) {
        $errors['password'] = 'Le mot de passe ne contient pas de chiffres';
      } elseif (!preg_match('@[\W]@', $password)) {
        $errors['password'] = 'Le mot de passe ne contient pas de caractères spéciaux ,!@#$%';
      }

      if (empty($passwordRepeat)) {
        $errors['password_repeat'] = "mot de passe répété manquant";
      }

      if ($password !== $passwordRepeat) {
        $errors['password_repeat'] = "Les mots de passes ne correspondent pas";
      }

      if (empty($errors)) {
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        $pswdReset = reset($_SESSION['userRenewPass']);
        $userId = (int)$pswdReset->user_id;
        $this->userManagerModel->updatePasswordAndPswdReset($userId, $passwordHash);
        redirect('pages/connexion');
        exit;
      } else {
        $_SESSION['errors'] = $errors;
        redirect('pages/createNewPassword');
        exit;
      }
    }
  }

  public function logout()
  {
    if (session_status() === PHP_SESSION_NONE) {
      ini_set("session.cache_expire", 600);
      ini_set("session.gc_maxlifetime", 36000);
      ini_set("session.cookie_lifetime", 36000);
      session_start();
    }
    unset($_SESSION['data_user']);
    $_SESSION['flash']['success'] = 'Vous êtes maintenant déconnecté';
    redirectToHome();
    exit;
  }

  public function addAccounting()
  {
    if (!empty($_POST)) {

      $userId = (int)$_SESSION['data_user']->{'id'};
      $dateAccounting = htmlspecialchars($_POST['dateAccounting']);
      $doctorReplace = htmlspecialchars($_POST['drReplace']);
      $totalOfDay = htmlspecialchars($_POST['totalOfDay']);
      $totalOfDay = floatval(str_replace(',', '.', $totalOfDay));
      $retrocession = (int)htmlspecialchars($_POST['retro']);
      $totalRetrocesion = htmlspecialchars($_POST['tRetro']);
      $comments = htmlspecialchars($_POST['cmt']);

      $form = [
        'userId' => $userId,
        'dateAccounting' => $dateAccounting,
        'doctorReplace' => $doctorReplace,
        'totalOfDay' => $totalOfDay,
        'retrocession' => $retrocession,
        'totalRetrocession' => $totalRetrocesion,
        'comments' => $comments
      ];

      if (empty($errors)) {
        $this->userManagerModel->insertAccountingData($form);
        $dataAccountingById = $this->userManagerModel->getAccountingDataByUserId($userId);
        if ($dataAccountingById) {
          $_SESSION['data_accounting'] = $dataAccountingById;
          redirectWithoutTag('pages/comptabilite');
          exit;
        } else {
          redirectWithoutTag('pages/comptabilite');
          exit;
        }
      } else {

        $_SESSION['flash']['danger'] = 'nom du docteur ou nombre totale de jour manquant';
        redirect('pages/comptabilite');
        exit;
      }
    }
  }

  public function deleteRowAccounting()
  {
    if (!empty($_POST)) {
      $userId = (int)$_SESSION['data_user']->{'id'};
      $rowId = (int)htmlspecialchars($_POST['delete']);

      $getRowByIdAndUserId = $this->userManagerModel->getRowByIdAndUserId($rowId, $userId);

      if ($getRowByIdAndUserId) {
        $this->userManagerModel->deleteRowByIdAndUserId($rowId, $userId);
        $_SESSION['flash']['success'] = 'Ligne comptable supprimé avec succès !';
        redirectWithoutTag('pages/comptabilite');
        exit;
      } else {
        $_SESSION['flash']['danger'] = 'Opération non autorisé !';
        redirectWithoutTag('pages/comptabilite');
        exit;
      }
    }
  }

  public function updateRowAccounting()
  {
    if (!empty($_POST)) {
      $userId = (int)$_SESSION['data_user']->{'id'};
      $rowId = (int)htmlspecialchars($_POST['rowId']);

      $dateAccounting = htmlspecialchars($_POST['dateAccounting']);
      $doctorReplace = htmlspecialchars($_POST['drReplace']);
      $totalOfDay = (int)htmlspecialchars($_POST['totalOfDay']);
      $retrocession = (int)htmlspecialchars($_POST['retro']);
      $totalRetrocesion = (int)htmlspecialchars($_POST['tRetro']);
      $comments = htmlspecialchars($_POST['cmt']);

      $form = [
        'dateAccounting' => $dateAccounting,
        'doctorReplace' => $doctorReplace,
        'totalOfDay' => $totalOfDay,
        'retrocession' => $retrocession,
        'totalRetrocession' => $totalRetrocesion,
        'comments' => $comments
      ];

      $getRowByIdAndUserId = $this->userManagerModel->getRowByIdAndUserId($rowId, $userId);

      if ($getRowByIdAndUserId) {
        $this->userManagerModel->updateRowByIdAndUserId($rowId, $userId, $form);
        $_SESSION['flash']['success'] = 'Ligne comptable mise à jour avec succès !';
        redirectWithoutTag('pages/comptabilite');
        exit;
      } else {
        $_SESSION['flash']['danger'] = 'Opération non autorisé !';
        redirectWithoutTag('pages/comptabilite');
        exit;
      }
    }
  }


  public function selectedMonth()
  {
    if (!empty($_POST)) {
      $userId = (int)$_SESSION['data_user']->{'id'};
      $month = (int)htmlspecialchars($_POST['month']);
      $ret = $this->userManagerModel->SearchDataOfUserByMonth($userId, $month);
      if ($ret) {
        $data = [
          'data_accounting' => $ret
        ];
        return $this->view('pages/accounting', $data);
        exit;
      } else {
        return $this->view('pages/accounting');
        exit;
      }
    }
  }


  public function ajaxUpdateAvatar()
  {
    if (isset($_POST['image'])) {

      $image = $_POST['image'];
      $userId = $_SESSION['data_user']->{'id'};
      list($type, $image) = explode(';', $image);
      list(, $image) = explode(',', $image);

      $image = base64_decode($image);
      $image_path = PUBLICROOT . '/img/' . $userId . '.png';
      $image_name = $userId . '.png';

      if (file_exists($image_path)) {
        unlink($image_path);
      }
      file_put_contents($image_path, $image);

      $this->userManagerModel->updateAvatarById($userId, $image_name);
      echo $image_path;
    }
  }

  public function updateProfile()
  {
    if (!empty($_POST)) {
      $name =  htmlspecialchars($_POST['name']);
      $firstName =  htmlspecialchars($_POST['firstName']);
      $email = htmlspecialchars($_POST['email']);
      $login = htmlspecialchars($_POST['login']);
      $sex = htmlspecialchars($_POST['sex']);
      $birth_date = htmlspecialchars($_POST['birth_date']);
      $ecn_year = htmlspecialchars($_POST['ecn_year']);
      $ecn_school = htmlspecialchars($_POST['ecn_school']);
      $ecn_place = htmlspecialchars($_POST['ecn_place']);
      $status = htmlspecialchars($_POST['status']);
      $userId = $_SESSION['data_user']->{'id'};

      $data = [
        'name' => $name,
        'firstName' => $firstName,
        'email' => $email,
        'login' => $login,
        'birth_date' => $birth_date,
        'sex' => $sex,
        'ecn_year' => $ecn_year,
        'ecn_school' => $ecn_school,
        'ecn_place' => $ecn_place,
        'status' => $status,
      ];

      $errors = [];

      if (empty($email)) {
        $errors['email'] = "votre email est manquant";
      } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "votre email n' est pas valide";
      } else {
        $userMail = $this->userManagerModel->checkMail($email);
        if ($userMail) {
          $errors['email'] = "Ce email est déjà pris";
        }
      }
      if (empty($login)) {
        $errors['login'] = "votre identifiant est manquant";
      } elseif (!preg_match('/^[a-zA-Z0-9_ ]+$/', $login)) {
        $errors['login'] = "votre identifiant n' est pas valide";
      } else {
        $userLogin = $this->userManagerModel->checkLogin($login);
        if ($userLogin) {
          $errors['login'] = "Cette identifiant est déjà pris pour un autre compte";
        }
      }

      if (empty($errors) || count($errors) === 1) {
        dd($this->userManagerModel->updateProfileById($userId, $data));
        // redirectWithoutTag('pages/profil');
        $_SESSION['flash']['success'] = 'Profile mis à jour!';
        exit;
      } else {
        $_SESSION['errors'] = $errors;
        // redirect('pages/profil', $userId);
        exit;
      }
    }
  }


  public function ajaxPostRenewPassword()
  {
    $oldPassword = htmlspecialchars($_POST['oldPassword']);
    $newPassword = htmlspecialchars($_POST['newPassword']);
    if (!empty($oldPassword) && !empty($newPassword)) {
      $userId = $_SESSION['data_user']->{'id'};
      $userData = $this->userManagerModel->getUserById($userId);
      $user = reset($userData);

      if (password_verify($oldPassword, $user->{'password'})) {
        if ((strlen($newPassword) < 8) || !preg_match('@[A-Z]@', $newPassword) ||  !preg_match('@[a-z]@', $newPassword)
          || !preg_match('@[0-9]@', $newPassword) || !preg_match('@[\W]@', $newPassword)
        ) {
          $_SESSION['flash']['danger'] = 'Mot de passe faible(8 caractères minimum, (aA5!@#$%))';
          exit;
        } else {
          $passwordHash = password_hash($newPassword, PASSWORD_BCRYPT);
          $this->userManagerModel->updateUserByNewPassword($userId, $passwordHash);
          $_SESSION['flash']['success'] = 'Le mot de passe a été modifié avec succès!';
          exit;
        }
      } else {
        $_SESSION['flash']['danger'] = 'Mot de passe ne correspond à celui dont nous disposons!';
        exit;
      }

      $oldPassword = htmlspecialchars($_POST['oldPassword']);
    } else {
      $_SESSION['flash']['danger'] = 'Aucune donnée envoyés !';
      exit;
    }
  }
}
