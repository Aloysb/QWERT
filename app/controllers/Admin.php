<?php
if (session_status() === PHP_SESSION_NONE) {
  ini_set("session.cache_expire", 600);
  ini_set("session.gc_maxlifetime", 36000);
  ini_set("session.cookie_lifetime", 36000);
  session_start();
}

class Admin extends Controller
{
  private $adminManager;

  public function __construct()
  {
    $this->adminManager = $this->model('AdminManager');
  }

  public function index()
  {
    return $this->view('admin/list_users');
    exit;
  }

  public function list_users()
  {
    if (!isLoggedIn()) {
      redirectWithoutTag('pages/connexion');
      exit;
    } else {
      $user = $_SESSION['data_user'];
      if ($user->{'role'} == 'ROLE_ADMIN') {
        $listUsers = $this->adminManager->getListUsers();
        $data = ['list_user' => $listUsers];
        return $this->view('admin/list_users', $data);
        exit;
      } else {
        redirectWithoutTag('pages/search');
        exit;
      }
    }
    return $this->view('admin/list_users');
    exit;
  }

  public function makeEmailList($emailListArray)
  {
    $listEmail = array();
    foreach ($emailListArray as $user) {
      array_push($listEmail, $user['mail']);
    };
    return implode(', ', $listEmail);
  }

  public function send_email()
  {


    $emailListAll = $this->makeEmailList($this->adminManager->getUsersEmailList());
    $emailListNonSubscribers = $this->makeEmailList($this->adminManager->getSubscribersEmailList());
    $emailListSubscribers = $this->makeEmailList($this->adminManager->getNonSubscribersEmailList());

    $data = [
      'emailListAll' => $emailListAll,
      'emailListNonSubscribers' => $emailListNonSubscribers,
      'emailListSubscribers' => $emailListSubscribers,
    ];

    return $this->view('admin/send_email', $data);
    exit;
  }

  public function sites()
  {
    if (!isLoggedIn()) {
      redirectWithoutTag('pages/connexion');
      exit;
    } else {
      $user = $_SESSION['data_user'];
      $userId = (int)$_SESSION['data_user']->{'id'};
      if ($user->{'role'} == 'ROLE_ADMIN' or $user->{'role'} == 'ROLE_SUBSCRIBER') {
        $listSites = $this->adminManager->getListSites($userId);
        $data = ['list_sites' => $listSites, 'userId' => $userId];
        return $this->view('admin/list_sites', $data);
        exit;
      } else {
        redirectWithoutTag('pages/search');
        exit;
      }
    }
    return $this->view('admin/list_sites');
    exit;
  }

  public function ajaxUpdateSitesList()
  {
    if (!isLoggedIn() || !isset($_SERVER['HTTP_REFERER'])) {
      $_SESSION['flash']['danger'] = "Une erreur s'est produite!";
    } else {
      $user = $_SESSION['data_user'];
      // If admin, update for everyone.
      if ($user->{'role'} == 'ROLE_ADMIN') {
        $this->adminManager->updateSiteAsAdmin($_POST['id'], $_POST['name'], $_POST['value'], $_POST['userId'], 1);
        $_SESSION['flash']['success'] = "Liste des sites mise à jour!";
      } else {
        $this->adminManager->updateSites($_POST['id'], $_POST['name'], $_POST['value'], $_POST['userId']);
      }
    }
  }

  public function ajaxDeleteSitesList()
  {
    if (!isLoggedIn() || !isset($_SERVER['HTTP_REFERER'])) {
      $_SESSION['flash']['danger'] = "Une erreur s'est produite!";
    } else {
      $user = $_SESSION['data_user'];
      // If admin, delete for everyone.
      if ($user->{'role'} == 'ROLE_ADMIN') {
        $this->adminManager->deleteSiteAsAdmin($_POST['id']);
        $_SESSION['flash']['success'] = "Liste des sites mise à jour!";
      } else {
        $this->adminManager->deleteSite($_POST['id'], $_POST['userId']);
        $_SESSION['flash']['success'] = "Liste des sites mise à jour!";
      }
    }
  }

  public function removeNotifSites()
  {
    $userId = (int)$_SESSION['data_user']->{'id'};
    dd($this->adminManager->removeNotifSites($userId));
  }

  public function sendDailyEmail()
  {
    $obj = $this->adminManager->getFicheForDailyEmail();
    $emails = $this->adminManager->getUsersEmailList();
    $emailList = '';
    foreach ($emails as $email) {
      $emailList = $emailList . $email['mail'] . ';';
    }
    $fiche = '';
    foreach ($obj as $value) {
      $fiche = $fiche . "<li><h3>" . $value['title'] . "</h3></li>";
    }

    // If there is no new fiches, return nothing.
    if (empty($fiche)) {
      dd($emailList);
    }

    // $to = 'aloysberger@gmail.com';
    $to = $emailList;
    $subject = "Nouvelles fiches disponibles sur Doctofiche";

    $message = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml' xmlns:o='urn:schemas-microsoft-com:office:office' style='width:100%;font-family:lato, 'helvetica neue', helvetica, arial, sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0'>
 <head> 
  <link type='text/css' rel='stylesheet' id='dark-mode-general-link'> 
  <link type='text/css' rel='stylesheet' id='dark-mode-custom-link'> 
  <link type='text/css' rel='stylesheet' id='dark-mode-general-link'> 
  <link type='text/css' rel='stylesheet' id='dark-mode-custom-link'> 
  <link type='text/css' rel='stylesheet' id='dark-mode-general-link'> 
  <link type='text/css' rel='stylesheet' id='dark-mode-custom-link'> 
  <meta charset='UTF-8'> 
  <meta content='width=device-width, initial-scale=1' name='viewport'> 
  <meta name='x-apple-disable-message-reformatting'> 
  <meta http-equiv='X-UA-Compatible' content='IE=edge'> 
  <meta content='telephone=no' name='format-detection'> 
  <title>Doctofiche template</title> 
  <!--[if (mso 16)]>
    <style type='text/css'>
    a {text-decoration: none;}
    </style>
    <![endif]--> 
  <!--[if gte mso 9]><style>sup { font-size: 100% !important; }</style><![endif]--> 
  <!--[if gte mso 9]>
<xml>
    <o:OfficeDocumentSettings>
    <o:AllowPNG></o:AllowPNG>
    <o:PixelsPerInch>96</o:PixelsPerInch>
    </o:OfficeDocumentSettings>
</xml>
<![endif]--> 
  <!--[if !mso]><!-- --> 
  <link href='https://fonts.googleapis.com/css?family=Lato:400,400i,700,700i' rel='stylesheet'> 
  <!--<![endif]--> 
  <style type='text/css'>
#outlook a {
  padding:0;
}
.ExternalClass {
  width:100%;
}
.ExternalClass,
.ExternalClass p,
.ExternalClass span,
.ExternalClass font,
.ExternalClass td,
.ExternalClass div {
  line-height:100%;
}
.es-button {
  mso-style-priority:100!important;
  text-decoration:none!important;
}
a[x-apple-data-detectors] {
  color:inherit!important;
  text-decoration:none!important;
  font-size:inherit!important;
  font-family:inherit!important;
  font-weight:inherit!important;
  line-height:inherit!important;
}
.es-desk-hidden {
  display:none;
  float:left;
  overflow:hidden;
  width:0;
  max-height:0;
  line-height:0;
  mso-hide:all;
}
@media only screen and (max-width:600px) {p, ul li, ol li, a { font-size:16px!important; line-height:150%!important } h1 { font-size:30px!important; text-align:center; line-height:120%!important } h2 { font-size:26px!important; text-align:center; line-height:120%!important } h3 { font-size:20px!important; text-align:center; line-height:120%!important } h1 a { font-size:30px!important } h2 a { font-size:26px!important } h3 a { font-size:20px!important } .es-menu td a { font-size:16px!important } .es-header-body p, .es-header-body ul li, .es-header-body ol li, .es-header-body a { font-size:16px!important } .es-footer-body p, .es-footer-body ul li, .es-footer-body ol li, .es-footer-body a { font-size:16px!important } .es-infoblock p, .es-infoblock ul li, .es-infoblock ol li, .es-infoblock a { font-size:12px!important } *[class='gmail-fix'] { display:none!important } .es-m-txt-c, .es-m-txt-c h1, .es-m-txt-c h2, .es-m-txt-c h3 { text-align:center!important } .es-m-txt-r, .es-m-txt-r h1, .es-m-txt-r h2, .es-m-txt-r h3 { text-align:right!important } .es-m-txt-l, .es-m-txt-l h1, .es-m-txt-l h2, .es-m-txt-l h3 { text-align:left!important } .es-m-txt-r img, .es-m-txt-c img, .es-m-txt-l img { display:inline!important } .es-button-border { display:block!important } a.es-button { font-size:20px!important; display:block!important; border-width:15px 25px 15px 25px!important } .es-btn-fw { border-width:10px 0px!important; text-align:center!important } .es-adaptive table, .es-btn-fw, .es-btn-fw-brdr, .es-left, .es-right { width:100%!important } .es-content table, .es-header table, .es-footer table, .es-content, .es-footer, .es-header { width:100%!important; max-width:600px!important } .es-adapt-td { display:block!important; width:100%!important } .adapt-img { width:100%!important; height:auto!important } .es-m-p0 { padding:0px!important } .es-m-p0r { padding-right:0px!important } .es-m-p0l { padding-left:0px!important } .es-m-p0t { padding-top:0px!important } .es-m-p0b { padding-bottom:0!important } .es-m-p20b { padding-bottom:20px!important } .es-mobile-hidden, .es-hidden { display:none!important } tr.es-desk-hidden, td.es-desk-hidden, table.es-desk-hidden { width:auto!important; overflow:visible!important; float:none!important; max-height:inherit!important; line-height:inherit!important } tr.es-desk-hidden { display:table-row!important } table.es-desk-hidden { display:table!important } td.es-desk-menu-hidden { display:table-cell!important } table.es-table-not-adapt, .esd-block-html table { width:auto!important } table.es-social { display:inline-block!important } table.es-social td { display:inline-block!important } }
</style> 
 </head> 
 <body style='width:100%;font-family:lato, 'helvetica neue', helvetica, arial, sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0'> 
  <div class='es-wrapper-color' style='background-color:#F4F4F4'> 
   <!--[if gte mso 9]>
      <v:background xmlns:v='urn:schemas-microsoft-com:vml' fill='t'>
        <v:fill type='tile' color='#f4f4f4'></v:fill>
      </v:background>
    <![endif]--> 
   <table class='es-wrapper' width='100%' cellspacing='0' cellpadding='0' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;padding:0;Margin:0;width:100%;height:100%;background-repeat:repeat;background-position:center top'> 
     <tr class='gmail-fix' height='0' style='border-collapse:collapse'> 
      <td style='padding:0;Margin:0'> 
       <table cellspacing='0' cellpadding='0' border='0' align='center' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;width:600px'> 
         <tr style='border-collapse:collapse'> 
          <td cellpadding='0' cellspacing='0' border='0' style='padding:0;Margin:0;line-height:1px;min-width:600px' height='0'><img src='https://esputnik.com/repository/applications/images/blank.gif' style='display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;max-height:0px;min-height:0px;min-width:600px;width:600px' alt width='600' height='1'></td> 
         </tr> 
       </table></td> 
     </tr> 
     <tr style='border-collapse:collapse'> 
      <td valign='top' style='padding:0;Margin:0'> 
       <table class='es-header' cellspacing='0' cellpadding='0' align='center' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:#FFA73B;background-repeat:repeat;background-position:center top'> 
         <tr style='border-collapse:collapse'> 
          <td align='center' bgcolor='#0095d9' style='padding:0;Margin:0;background-color:#0095D9'> 
           <table class='es-header-body' cellspacing='0' cellpadding='0' align='center' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px'> 
             <tr style='border-collapse:collapse'> 
              <td align='left' style='Margin:0;padding-bottom:10px;padding-left:10px;padding-right:10px;padding-top:20px'> 
               <table width='100%' cellspacing='0' cellpadding='0' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'> 
                 <tr style='border-collapse:collapse'> 
                  <td valign='top' align='center' style='padding:0;Margin:0;width:580px'> 
                   <table width='100%' cellspacing='0' cellpadding='0' bgcolor='#0095d9' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#0095D9' role='presentation'> 
                     <tr style='border-collapse:collapse'> 
                      <td align='center' style='padding:0;Margin:0;font-size:0px'><img class='adapt-img' src='https://hayhvt.stripocdn.email/content/guids/CABINET_17c78bac3fac877d3325cd8d8631345c/images/29481598958489871.jpeg' alt style='display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic' width='580' height='216'></td> 
                     </tr> 
                   </table></td> 
                 </tr> 
               </table></td> 
             </tr> 
           </table></td> 
         </tr> 
       </table> 
       <table class='es-content' cellspacing='0' cellpadding='0' align='center' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%'> 
         <tr style='border-collapse:collapse'> 
          <td style='padding:0;Margin:0;background-color:#0095D9' bgcolor='#0095d9' align='center'> 
           <table class='es-content-body' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px' cellspacing='0' cellpadding='0' align='center'> 
             <tr style='border-collapse:collapse'> 
              <td align='left' style='padding:0;Margin:0'> 
               <table width='100%' cellspacing='0' cellpadding='0' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'> 
                 <tr style='border-collapse:collapse'> 
                  <td valign='top' align='center' style='padding:0;Margin:0;width:600px'> 
                   <table style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:separate;border-spacing:0px;background-color:#FFFFFF;border-radius:4px' width='100%' cellspacing='0' cellpadding='0' bgcolor='#ffffff' role='presentation'> 
                     <tr style='border-collapse:collapse'> 
                      <td align='center' style='Margin:0;padding-bottom:5px;padding-left:30px;padding-right:30px;padding-top:35px'><h1 style='Margin:0;line-height:58px;mso-line-height-rule:exactly;font-family:lato, 'helvetica neue', helvetica, arial, sans-serif;font-size:48px;font-style:normal;font-weight:normal;color:#111111'>Bonjour&nbsp;!</h1></td> 
                     </tr> 
                     <tr style='border-collapse:collapse'> 
                      <td bgcolor='#ffffff' align='center' style='Margin:0;padding-top:5px;padding-bottom:5px;padding-left:20px;padding-right:20px;font-size:0'> 
                       <table width='100%' height='100%' cellspacing='0' cellpadding='0' border='0' role='presentation' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'> 
                         <tr style='border-collapse:collapse'> 
                          <td style='padding:0;Margin:0;border-bottom:1px solid #FFFFFF;background:#FFFFFFnone repeat scroll 0% 0%;height:1px;width:100%;margin:0px'></td> 
                         </tr> 
                       </table></td> 
                     </tr> 
                   </table></td> 
                 </tr> 
               </table></td> 
             </tr> 
           </table></td> 
         </tr> 
       </table> 
       <table class='es-content' cellspacing='0' cellpadding='0' align='center' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%'> 
         <tr style='border-collapse:collapse'> 
          <td align='center' style='padding:0;Margin:0'> 
           <table class='es-content-body' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px' cellspacing='0' cellpadding='0' align='center'> 
             <tr style='border-collapse:collapse'> 
              <td align='left' style='padding:0;Margin:0'> 
               <table width='100%' cellspacing='0' cellpadding='0' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'> 
                 <tr style='border-collapse:collapse'> 
                  <td valign='top' align='center' style='padding:0;Margin:0;width:600px'> 
                   <table style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:separate;border-spacing:0px;border-radius:4px;background-color:#FFFFFF' width='100%' cellspacing='0' cellpadding='0' bgcolor='#ffffff' role='presentation'> 
                     <tr style='border-collapse:collapse'> 
                      <td class='es-m-txt-l' bgcolor='#ffffff' align='left' style='Margin:0;padding-top:20px;padding-bottom:0px;padding-left:30px;padding-right:30px'><h2 style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:lato, 'helvetica neue', helvetica, arial, sans-serif;line-height:27px;color:#666666'>Ces nouvelles fiches sont disponibles sur Doctofiche :</h2></td> 
                     </tr> 
                     <tr>
                      <td>
                      <ul>
                      " . $fiche . "
                      </ul
                      </td>
                     </tr>
                     <tr style='border-collapse:collapse'> 
                      <td align='center' style='padding:0;Margin:0;font-size:0px'><img class='adapt-img' src='https://hayhvt.stripocdn.email/content/guids/b6b79093-7176-47d8-8f1b-cce8dc912d16/images/18671598958164317.png' alt style='display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic' height='243' width='266'></td> 
                     </tr> 
                     <tr style='border-collapse:collapse'> 
                      <td class='es-m-txt-l' align='right' style='Margin:0;padding-top:20px;padding-left:30px;padding-right:30px;padding-bottom:40px'><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:20px;font-family:lato, 'helvetica neue', helvetica, arial, sans-serif;line-height:30px;color:#666666'><em>L'équipe Doctofiche.</em></p></td> 
                     </tr> 
                     <tr style='border-collapse:collapse'> 
                      <td align='center' style='Margin:0;padding-left:10px;padding-right:10px;padding-top:35px;padding-bottom:35px'><span class='es-button-border' style='border-style:solid;border-color:#0095D9;background:#0095D9;border-width:1px;display:inline-block;border-radius:5px;width:auto;box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1)'><a href='https://www.doctofiche.fr/pages/fiche' class='es-button' target='_blank' style='font-size:20px;color:#FFFFFF;border-style:solid;border-color:#0095D9;display:inline-block;background:#0095D9;border-radius:5px;font-weight:normal;font-style:normal;line-height:24px; padding: 20px 40px; width:auto;text-align:center; text-decoration: none;box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);'>Rendez-vous sur Doctofiche</a></span></td> 
                     </tr> 
                   </table></td> 
                 </tr> 
               </table></td> 
             </tr> 
           </table></td> 
         </tr> 
       </table> 
       <table class='es-content' cellspacing='0' cellpadding='0' align='center' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%'> 
         <tr style='border-collapse:collapse'> 
          <td align='center' style='padding:0;Margin:0'> 
           <table class='es-content-body' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px' cellspacing='0' cellpadding='0' align='center'> 
             <tr style='border-collapse:collapse'> 
              <td align='left' style='padding:0;Margin:0'> 
               <table width='100%' cellspacing='0' cellpadding='0' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'> 
                 <tr style='border-collapse:collapse'> 
                  <td valign='top' align='center' style='padding:0;Margin:0;width:600px'> 
                   <table width='100%' cellspacing='0' cellpadding='0' role='presentation' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'> 
                     <tr style='border-collapse:collapse'> 
                      <td align='center' style='Margin:0;padding-top:10px;padding-bottom:20px;padding-left:20px;padding-right:20px;font-size:0'> 
                       <table width='100%' height='100%' cellspacing='0' cellpadding='0' border='0' role='presentation' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'> 
                         <tr style='border-collapse:collapse'> 
                          <td style='padding:0;Margin:0;border-bottom:1px solid #F4F4F4;background:#FFFFFFnone repeat scroll 0% 0%;height:1px;width:100%;margin:0px'></td> 
                         </tr> 
                       </table></td> 
                     </tr> 
                   </table></td> 
                 </tr> 
               </table></td> 
             </tr> 
           </table></td> 
         </tr> 
       </table> 
       <table class='es-content' cellspacing='0' cellpadding='0' align='center' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%'> 
         <tr style='border-collapse:collapse'> 
          <td align='center' style='padding:0;Margin:0'> 
           <table class='es-content-body' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px' cellspacing='0' cellpadding='0' align='center'> 
             <tr style='border-collapse:collapse'> 
              <td align='left' style='padding:0;Margin:0'> 
               <table width='100%' cellspacing='0' cellpadding='0' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'> 
                 <tr style='border-collapse:collapse'> 
                  <td valign='top' align='center' style='padding:0;Margin:0;width:600px'> 
                   <table style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:separate;border-spacing:0px;background-color:#FFECD1;border-radius:4px' width='100%' cellspacing='0' cellpadding='0' bgcolor='#ffecd1' role='presentation'> 
                     <tr style='border-collapse:collapse'> 
                      <td align='center' style='padding:0;Margin:0;font-size:0px'><img class='adapt-img' src='https://hayhvt.stripocdn.email/content/guids/CABINET_17c78bac3fac877d3325cd8d8631345c/images/58591599040300533.png' alt style='display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic' width='600' height='154'></td> 
                     </tr> 
                   </table></td> 
                 </tr> 
               </table></td> 
             </tr> 
           </table></td> 
         </tr> 
       </table></td> 
     </tr> 
   </table> 
  </div>  
 </body>
</html>
            ";

    // Always set content-type when sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    // More headers
    $headers .= 'From: <doctofiche@gmail.com>' . "\r\n";
    $headers .= "BCC: " . $to . "\r\n";
    // $headers .= 'Cc: myboss@example.com' . "\r\n";

    mail('doctofiche@gmail.com', $subject, $message, $headers);
    $this->adminManager->emptyDailyEmail();
    dd('All good!');
  }

  public function ajaxAddSitesList()
  {
    $user = $_SESSION['data_user'];
    if (!isLoggedIn() || !isset($_SERVER['HTTP_REFERER'])) {
      $_SESSION['flash']['danger'] = "Une erreur s'est produite!";
    } elseif ($user->{'role'} == 'ROLE_ADMIN') {
      // If admin, add for all
      //Get all users ID.
      $usersId = $this->adminManager->getUsersId();
      //Add sites to all users except the admin caller.
      foreach ($usersId as $id) {
        $id = $id->{'id'};
        $this->adminManager->addSite($_POST['name'], $_POST['href'], $_POST['description'], $id, 1);
      }
    } else {
      $this->adminManager->addSite($_POST['name'], $_POST['href'], $_POST['description'], $_POST['userId'], 0);
      $_SESSION['flash']['success'] = "Liste des sites mise à jour!";
    }
  }

  public function sendEmail()
  {

    $to = $_POST['emailList'];

    // Always set content-type when sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    // More headers
    $headers .= 'From: <doctofiche@gmail.com>' . "\r\n";
    $headers .= "BCC: " . $to . "\r\n";
    // $headers .= 'Cc: myboss@example.com' . "\r\n";
    // $message = $_POST['email'];
    $subject = $_POST['subject'];

    $email = $_POST['email'];

    $message = "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml' xmlns:o='urn:schemas-microsoft-com:office:office' style='width:100%;font-family:lato, 'helvetica neue', helvetica, arial, sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0'>
 <head> 
  <link type='text/css' rel='stylesheet' id='dark-mode-general-link'> 
  <link type='text/css' rel='stylesheet' id='dark-mode-custom-link'> 
  <link type='text/css' rel='stylesheet' id='dark-mode-general-link'> 
  <link type='text/css' rel='stylesheet' id='dark-mode-custom-link'> 
  <link type='text/css' rel='stylesheet' id='dark-mode-general-link'> 
  <link type='text/css' rel='stylesheet' id='dark-mode-custom-link'> 
  <meta charset='UTF-8'> 
  <meta content='width=device-width, initial-scale=1' name='viewport'> 
  <meta name='x-apple-disable-message-reformatting'> 
  <meta http-equiv='X-UA-Compatible' content='IE=edge'> 
  <meta content='telephone=no' name='format-detection'> 
  <title>Doctofiche template</title> 
  <!--[if (mso 16)]>
    <style type='text/css'>
    a {text-decoration: none;}
    </style>
    <![endif]--> 
  <!--[if gte mso 9]><style>sup { font-size: 100% !important; }</style><![endif]--> 
  <!--[if gte mso 9]>
<xml>
    <o:OfficeDocumentSettings>
    <o:AllowPNG></o:AllowPNG>
    <o:PixelsPerInch>96</o:PixelsPerInch>
    </o:OfficeDocumentSettings>
</xml>
<![endif]--> 
  <!--[if !mso]><!-- --> 
  <link href='https://fonts.googleapis.com/css?family=Lato:400,400i,700,700i' rel='stylesheet'> 
  <!--<![endif]--> 
  <style type='text/css'>
#outlook a {
  padding:0;
}
.ExternalClass {
  width:100%;
}
.ExternalClass,
.ExternalClass p,
.ExternalClass span,
.ExternalClass font,
.ExternalClass td,
.ExternalClass div {
  line-height:100%;
}
.es-button {
  mso-style-priority:100!important;
  text-decoration:none!important;
}
a[x-apple-data-detectors] {
  color:inherit!important;
  text-decoration:none!important;
  font-size:inherit!important;
  font-family:inherit!important;
  font-weight:inherit!important;
  line-height:inherit!important;
}
.es-desk-hidden {
  display:none;
  float:left;
  overflow:hidden;
  width:0;
  max-height:0;
  line-height:0;
  mso-hide:all;
}
@media only screen and (max-width:600px) {p, ul li, ol li, a { font-size:16px!important; line-height:150%!important } h1 { font-size:30px!important; text-align:center; line-height:120%!important } h2 { font-size:26px!important; text-align:center; line-height:120%!important } h3 { font-size:20px!important; text-align:center; line-height:120%!important } h1 a { font-size:30px!important } h2 a { font-size:26px!important } h3 a { font-size:20px!important } .es-menu td a { font-size:16px!important } .es-header-body p, .es-header-body ul li, .es-header-body ol li, .es-header-body a { font-size:16px!important } .es-footer-body p, .es-footer-body ul li, .es-footer-body ol li, .es-footer-body a { font-size:16px!important } .es-infoblock p, .es-infoblock ul li, .es-infoblock ol li, .es-infoblock a { font-size:12px!important } *[class='gmail-fix'] { display:none!important } .es-m-txt-c, .es-m-txt-c h1, .es-m-txt-c h2, .es-m-txt-c h3 { text-align:center!important } .es-m-txt-r, .es-m-txt-r h1, .es-m-txt-r h2, .es-m-txt-r h3 { text-align:right!important } .es-m-txt-l, .es-m-txt-l h1, .es-m-txt-l h2, .es-m-txt-l h3 { text-align:left!important } .es-m-txt-r img, .es-m-txt-c img, .es-m-txt-l img { display:inline!important } .es-button-border { display:block!important } a.es-button { font-size:20px!important; display:block!important; border-width:15px 25px 15px 25px!important } .es-btn-fw { border-width:10px 0px!important; text-align:center!important } .es-adaptive table, .es-btn-fw, .es-btn-fw-brdr, .es-left, .es-right { width:100%!important } .es-content table, .es-header table, .es-footer table, .es-content, .es-footer, .es-header { width:100%!important; max-width:600px!important } .es-adapt-td { display:block!important; width:100%!important } .adapt-img { width:100%!important; height:auto!important } .es-m-p0 { padding:0px!important } .es-m-p0r { padding-right:0px!important } .es-m-p0l { padding-left:0px!important } .es-m-p0t { padding-top:0px!important } .es-m-p0b { padding-bottom:0!important } .es-m-p20b { padding-bottom:20px!important } .es-mobile-hidden, .es-hidden { display:none!important } tr.es-desk-hidden, td.es-desk-hidden, table.es-desk-hidden { width:auto!important; overflow:visible!important; float:none!important; max-height:inherit!important; line-height:inherit!important } tr.es-desk-hidden { display:table-row!important } table.es-desk-hidden { display:table!important } td.es-desk-menu-hidden { display:table-cell!important } table.es-table-not-adapt, .esd-block-html table { width:auto!important } table.es-social { display:inline-block!important } table.es-social td { display:inline-block!important } }
</style> 
 </head> 
 <body style='width:100%;font-family:lato, 'helvetica neue', helvetica, arial, sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0'> 
  <div class='es-wrapper-color' style='background-color:#F4F4F4'> 
   <!--[if gte mso 9]>
      <v:background xmlns:v='urn:schemas-microsoft-com:vml' fill='t'>
        <v:fill type='tile' color='#f4f4f4'></v:fill>
      </v:background>
    <![endif]--> 
   <table class='es-wrapper' width='100%' cellspacing='0' cellpadding='0' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;padding:0;Margin:0;width:100%;height:100%;background-repeat:repeat;background-position:center top'> 
     <tr class='gmail-fix' height='0' style='border-collapse:collapse'> 
      <td style='padding:0;Margin:0'> 
       <table cellspacing='0' cellpadding='0' border='0' align='center' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;width:600px'> 
         <tr style='border-collapse:collapse'> 
          <td cellpadding='0' cellspacing='0' border='0' style='padding:0;Margin:0;line-height:1px;min-width:600px' height='0'><img src='https://esputnik.com/repository/applications/images/blank.gif' style='display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;max-height:0px;min-height:0px;min-width:600px;width:600px' alt width='600' height='1'></td> 
         </tr> 
       </table></td> 
     </tr> 
     <tr style='border-collapse:collapse'> 
      <td valign='top' style='padding:0;Margin:0'> 
       <table class='es-header' cellspacing='0' cellpadding='0' align='center' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:#FFA73B;background-repeat:repeat;background-position:center top'> 
         <tr style='border-collapse:collapse'> 
          <td align='center' bgcolor='#0095d9' style='padding:0;Margin:0;background-color:#0095D9'> 
           <table class='es-header-body' cellspacing='0' cellpadding='0' align='center' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px'> 
             <tr style='border-collapse:collapse'> 
              <td align='left' style='Margin:0;padding-bottom:10px;padding-left:10px;padding-right:10px;padding-top:20px'> 
               <table width='100%' cellspacing='0' cellpadding='0' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'> 
                 <tr style='border-collapse:collapse'> 
                  <td valign='top' align='center' style='padding:0;Margin:0;width:580px'> 
                   <table width='100%' cellspacing='0' cellpadding='0' bgcolor='#0095d9' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#0095D9' role='presentation'> 
                     <tr style='border-collapse:collapse'> 
                      <td align='center' style='padding:0;Margin:0;font-size:0px'><img class='adapt-img' src='https://hayhvt.stripocdn.email/content/guids/CABINET_17c78bac3fac877d3325cd8d8631345c/images/29481598958489871.jpeg' alt style='display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic' width='580' height='216'></td> 
                     </tr> 
                   </table></td> 
                 </tr> 
               </table></td> 
             </tr> 
           </table></td> 
         </tr> 
       </table> 
       <table class='es-content' cellspacing='0' cellpadding='0' align='center' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%'> 
         <tr style='border-collapse:collapse'> 
          <td style='padding:0;Margin:0;background-color:#0095D9' bgcolor='#0095d9' align='center'> 
           <table class='es-content-body' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px' cellspacing='0' cellpadding='0' align='center'> 
             <tr style='border-collapse:collapse'> 
              <td align='left' style='padding:0;Margin:0'> 
               <table width='100%' cellspacing='0' cellpadding='0' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'> 
                 <tr style='border-collapse:collapse'> 
                  <td valign='top' align='center' style='padding:0;Margin:0;width:600px'> 
                   <table style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:separate;border-spacing:0px;background-color:#FFFFFF;border-radius:4px' width='100%' cellspacing='0' cellpadding='0' bgcolor='#ffffff' role='presentation'> 
                     <tr style='border-collapse:collapse'> 
                      <td align='center' style='Margin:0;padding-bottom:5px;padding-left:30px;padding-right:30px;padding-top:35px'><h1 style='Margin:0;line-height:58px;mso-line-height-rule:exactly;font-family:lato, 'helvetica neue', helvetica, arial, sans-serif;font-size:48px;font-style:normal;font-weight:normal;color:#111111'>Bonjour&nbsp;!</h1></td> 
                     </tr> 
                     <tr style='border-collapse:collapse'> 
                      <td bgcolor='#ffffff' align='center' style='Margin:0;padding-top:5px;padding-bottom:5px;padding-left:20px;padding-right:20px;font-size:0'> 
                       <table width='100%' height='100%' cellspacing='0' cellpadding='0' border='0' role='presentation' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'> 
                         <tr style='border-collapse:collapse'> 
                          <td style='padding:0;Margin:0;border-bottom:1px solid #FFFFFF;background:#FFFFFFnone repeat scroll 0% 0%;height:1px;width:100%;margin:0px'></td> 
                         </tr> 
                       </table></td> 
                     </tr> 
                   </table></td> 
                 </tr> 
               </table></td> 
             </tr> 
           </table></td> 
         </tr> 
       </table> 
       <table class='es-content' cellspacing='0' cellpadding='0' align='center' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%'> 
         <tr style='border-collapse:collapse'> 
          <td align='center' style='padding:0;Margin:0'> 
           <table class='es-content-body' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px' cellspacing='0' cellpadding='0' align='center'> 
             <tr style='border-collapse:collapse'> 
              <td align='left' style='padding:0;Margin:0'> 
               <table width='100%' cellspacing='0' cellpadding='0' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'> 
                 <tr style='border-collapse:collapse'> 
                  <td valign='top' align='center' style='padding:0;Margin:0;width:600px'> 
                   <table style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:separate;border-spacing:0px;border-radius:4px;background-color:#FFFFFF' width='100%' cellspacing='0' cellpadding='0' bgcolor='#ffffff' role='presentation'> 
                     <tr style='border-collapse:collapse'> 
                      <td class='es-m-txt-l' bgcolor='#ffffff' align='left' style='Margin:0;padding-top:20px;padding-bottom:0px;padding-left:30px;padding-right:30px'><h2 style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:18px;font-family:lato, 'helvetica neue', helvetica, arial, sans-serif;line-height:27px;color:#666666'>Un message de l'
                    équipe Doctofiche:</h2></td> 
                     </tr> 
                     <tr>
                     <td class='es-m-txt-l' bgcolor='#ffffff' align='left' style='Margin:0;padding-top:20px;padding-bottom:0px;padding-left:30px;padding-right:30px'>
                      " . $email . "
                      </td>
                     </tr>
                     <tr style='border-collapse:collapse'> 
                      <td align='center' style='padding:0;Margin:0;font-size:0px'><img class='adapt-img' src='https://hayhvt.stripocdn.email/content/guids/b6b79093-7176-47d8-8f1b-cce8dc912d16/images/18671598958164317.png' alt style='display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic' height='243' width='266'></td> 
                     </tr> 
                     <tr style='border-collapse:collapse'> 
                      <td class='es-m-txt-l' align='right' style='Margin:0;padding-top:20px;padding-left:30px;padding-right:30px;padding-bottom:40px'><p style='Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:20px;font-family:lato, 'helvetica neue', helvetica, arial, sans-serif;line-height:30px;color:#666666'><em>L'équipe Doctofiche.</em></p></td> 
                     </tr> 
                     <tr style='border-collapse:collapse'> 
                      <td align='center' style='Margin:0;padding-left:10px;padding-right:10px;padding-top:35px;padding-bottom:35px'><span class='es-button-border' style='border-style:solid;border-color:#0095D9;background:#0095D9;border-width:1px;display:inline-block;border-radius:5px;width:auto;box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1)'><a href='https://www.doctofiche.fr/pages/fiche' class='es-button' target='_blank' style='font-size:20px;color:#FFFFFF;border-style:solid;border-color:#0095D9;display:inline-block;background:#0095D9;border-radius:5px;font-weight:normal;font-style:normal;line-height:24px; padding: 20px 40px; width:auto;text-align:center; text-decoration: none;box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);'>Rendez-vous sur Doctofiche</a></span></td> 
                     </tr> 
                   </table></td> 
                 </tr> 
               </table></td> 
             </tr> 
           </table></td> 
         </tr> 
       </table> 
       <table class='es-content' cellspacing='0' cellpadding='0' align='center' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%'> 
         <tr style='border-collapse:collapse'> 
          <td align='center' style='padding:0;Margin:0'> 
           <table class='es-content-body' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px' cellspacing='0' cellpadding='0' align='center'> 
             <tr style='border-collapse:collapse'> 
              <td align='left' style='padding:0;Margin:0'> 
               <table width='100%' cellspacing='0' cellpadding='0' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'> 
                 <tr style='border-collapse:collapse'> 
                  <td valign='top' align='center' style='padding:0;Margin:0;width:600px'> 
                   <table width='100%' cellspacing='0' cellpadding='0' role='presentation' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'> 
                     <tr style='border-collapse:collapse'> 
                      <td align='center' style='Margin:0;padding-top:10px;padding-bottom:20px;padding-left:20px;padding-right:20px;font-size:0'> 
                       <table width='100%' height='100%' cellspacing='0' cellpadding='0' border='0' role='presentation' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'> 
                         <tr style='border-collapse:collapse'> 
                          <td style='padding:0;Margin:0;border-bottom:1px solid #F4F4F4;background:#FFFFFFnone repeat scroll 0% 0%;height:1px;width:100%;margin:0px'></td> 
                         </tr> 
                       </table></td> 
                     </tr> 
                   </table></td> 
                 </tr> 
               </table></td> 
             </tr> 
           </table></td> 
         </tr> 
       </table> 
       <table class='es-content' cellspacing='0' cellpadding='0' align='center' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%'> 
         <tr style='border-collapse:collapse'> 
          <td align='center' style='padding:0;Margin:0'> 
           <table class='es-content-body' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px' cellspacing='0' cellpadding='0' align='center'> 
             <tr style='border-collapse:collapse'> 
              <td align='left' style='padding:0;Margin:0'> 
               <table width='100%' cellspacing='0' cellpadding='0' style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px'> 
                 <tr style='border-collapse:collapse'> 
                  <td valign='top' align='center' style='padding:0;Margin:0;width:600px'> 
                   <table style='mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:separate;border-spacing:0px;background-color:#FFECD1;border-radius:4px' width='100%' cellspacing='0' cellpadding='0' bgcolor='#ffecd1' role='presentation'> 
                     <tr style='border-collapse:collapse'> 
                      <td align='center' style='padding:0;Margin:0;font-size:0px'><img class='adapt-img' src='https://hayhvt.stripocdn.email/content/guids/CABINET_17c78bac3fac877d3325cd8d8631345c/images/58591599040300533.png' alt style='display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic' width='600' height='154'></td> 
                     </tr> 
                   </table></td> 
                 </tr> 
               </table></td> 
             </tr> 
           </table></td> 
         </tr> 
       </table></td> 
     </tr> 
   </table> 
  </div>  
 </body>
</html>
            ";

    $success = mail('doctofiche@gmail.com', $subject, $message, $headers);

    if ($success) {
      $_SESSION['flash']['success'] = "Courriel envoyé!";
      echo json_encode('all good');
    } else {
      $_SESSION['flash']['danger'] = "Il y a eu un problème dans l'envoi du courriel!";
      echo json_encode($success);
    }
  }
}
