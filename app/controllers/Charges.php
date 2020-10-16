<?php
if (session_status() === PHP_SESSION_NONE) {
  ini_set("session.cache_expire", 600);
  ini_set("session.gc_maxlifetime", 36000);
  ini_set("session.cookie_lifetime", 36000);
  session_start();
}

class Charges extends Controller
{
  private $userManagerModel;

  public function __construct()
  {
    $this->userManagerModel = $this->model('UserManager');
  }

  public function cancelSubscription()
  {
    $userId = (int)$_SESSION['data_user']->{'id'};
    dd($this->userManagerModel->resetCustomerIdByUserId($userId));
    $_SESSION['flash']['info'] = "Vous n'êtes plus abonné !";
    redirectWithoutTag('pages/profil');
    exit;
  }
}
