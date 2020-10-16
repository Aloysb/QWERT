<?php
if (session_status() === PHP_SESSION_NONE) {
  ini_set("session.cache_expire", 600);
  ini_set("session.gc_maxlifetime", 36000);
  ini_set("session.cookie_lifetime", 36000);
  session_start();
}
$now = time();

if (isset($_SESSION['inactivity_time']) && $now > $_SESSION['inactivity_time']) {

  session_unset();
  session_destroy();
  session_start();
  $_SESSION['flash']['success'] = 'Vous avez été déconnecté automatiquement par sécurité  , vous devez vous reconnecter';
  redirectWithoutTag('pages/connexion');
  exit;
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-175307919-1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'UA-175307919-1');
  </script>

  <!-- Remove print footnotes and header -->
  <style type="text/css" media="print">
    @page {
      size: auto;
      /* auto is the initial value */
      margin: 0mm;
      /* this affects the margin in the printer settings */
    }

    html {
      background-color: #FFFFFF;
      margin: 0px;
      /* this affects the margin on the html before sending to printer */
    }

    body {
      border: solid 1px blue;
      margin: 10mm 15mm 10mm 15mm;
      /* margin you want for the content */
    }
  </style>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Expires" content="0">
  <meta name="referrer" content="always">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

  <!-- CROPPIE -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.js"></script>

  <link rel="stylesheet" href="../css/bootstrap/bootstrap-grid.css">
  <link rel="stylesheet" href="../css/bootstrap/bootstrap-reboot.css">
  <link rel="stylesheet" href="../css/bootstrap/bootstrap.css">
  <link rel="stylesheet" href="/css/layout.css">
  <link rel="icon" href="<?= URLROOT . '/img/favicon.ico'; ?>" />
  <title><?= SITENAME; ?></title>

  <!-- JQUERY -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

  <!-- DATATABLE -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.21/datatables.min.css" />

  <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.21/datatables.min.js"></script>

  <!-- POPPER -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

  <!-- BOOTSTRAP -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  <!-- FONTAWESOME -->
  <script type="text/javascript" src="https://kit.fontawesome.com/e542916da2.js" crossorigin="anonymous"></script>

  <!-- TINY ME -->
  <script src="https://cdn.tiny.cloud/1/r0old19rk3g1635j6dzpokfqtup6we3e22jl1si496t54wpm/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

  <!-- FLICKITY -->
  <script type="text/javascript" src="/js/flickity.js" crossorigin="anonymous"></script>

  <!-- Hotjar Tracking Code for www.doctofiche.fr -->
  <script>
    (function(h, o, t, j, a, r) {
      h.hj = h.hj || function() {
        (h.hj.q = h.hj.q || []).push(arguments)
      };
      h._hjSettings = {
        hjid: 1940449,
        hjsv: 6
      };
      a = o.getElementsByTagName('head')[0];
      r = o.createElement('script');
      r.async = 1;
      r.src = t + h._hjSettings.hjid + j + h._hjSettings.hjsv;
      a.appendChild(r);
    })(window, document, 'https://static.hotjar.com/c/hotjar-', '.js?sv=');
  </script>
</head>

<body>

  <?php if (array_key_exists('flash', $_SESSION)) : ?>
    <?php foreach ($_SESSION['flash'] as $type => $message) : ?>
      <div class="alert alert-<?= $type; ?> alert-dismissible text-center">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong><?= $message; ?></strong>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>
  <!-- Header part end-->