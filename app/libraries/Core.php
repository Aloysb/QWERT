<?php

class Core
{
  protected $currentController = 'Pages';
  protected $currentMethod = 'index';
  protected $params = [];
  public function __construct()
  {

    $url = $this->getUrl();

    if (isset($url)) {
      if (file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
        $this->currentController = ucwords($url[0]);
        unset($url[0]);
      }
    }

    require_once '../app/controllers/' . $this->currentController . '.php';

    $this->currentController = new $this->currentController;

    if (isset($url[1])) {
      if (method_exists($this->currentController, $url[1])) {

        $this->currentMethod = $url[1];
        unset($url[1]);
      } elseif (!method_exists($this->currentController, $url[1])) {
        switch ($url[1]) {
          case 'a-propos';
            $this->currentMethod = 'about';
            unset($url[1]);
            break;
          case 'nous-contacter';
            $this->currentMethod = 'contact';
            unset($url[1]);
            break;
          case 'renouvellement';
            $this->currentMethod = 'renew';
            unset($url[1]);
            break;
          case 'confirmation-abonnement';
            $this->currentMethod = 'confirmationSubscription';
            unset($url[1]);
            break;
          case 'annuaire';
            $this->currentMethod = 'drug';
            unset($url[1]);
            break;
          case 'conseils';
            $this->currentMethod = 'advice';
            unset($url[1]);
            break;
          case 'articles';
            $this->currentMethod = 'posts';
            unset($url[1]);
            break;
          case 'article';
            $this->currentMethod = 'post';
            unset($url[1]);
            break;
          case 'article-modification';
            $this->currentMethod = 'postUpdate';
            unset($url[1]);
            break;
          case 'comptabilite';
            $this->currentMethod = 'accounting';
            unset($url[1]);
            break;
          case 'fiche';
            $this->currentMethod = 'search';
            unset($url[1]);
            break;
          case 'liste-utilisateurs';
            $this->currentMethod = 'list_users';
            unset($url[1]);
            break;
          case 'envoyer-email';
            $this->currentMethod = 'send_email';
            unset($url[1]);
            break;
          case 'plans';
            $this->currentMethod = 'plans';
            unset($url[1]);
            break;
          case 'faq-comptabilite';
            $this->currentMethod = 'accountingFAQ';
            unset($url[1]);
            break;
          case 'welcome';
            $this->currentMethod = 'welcome';
            unset($url[1]);
            break;
          case 'inscription-pro';
            $this->currentMethod = 'inscriptionPro';
            unset($url[1]);
            break;
        }
      }
    }

    $this->params = $url ? array_values($url) : [];
    call_user_func_array(
      [$this->currentController, $this->currentMethod],
      $this->params
    );
  }

  public function getUrl()
  {
    if (isset($_SERVER['REQUEST_URI'])) {
      $url = ltrim($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_URI'][0]);

      $url = explode('/', $url);
      return $url;
    } else {
      return '';
    }
  }
}
