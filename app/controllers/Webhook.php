<?php
if (session_status() === PHP_SESSION_NONE) {
  ini_set("session.cache_expire", 600);
  ini_set("session.gc_maxlifetime", 36000);
  ini_set("session.cookie_lifetime", 36000);
  session_start();
}
class Webhook extends Controller
{
  private $userManagerModel;

  public function __construct()
  {
    $this->userManagerModel = $this->model('UserManager');
  }

  public function index()
  {
    redirectWithoutTag('pages/erreur');
    exit;
  }

  public function treatment()
  {

    \Stripe\Stripe::setApiKey('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');
    // \Stripe\Stripe::setApiKey('sk_test_51HCWUzFkUJgkN5qoCMndxWlNEZqNH2J7YYBkDqeL75OF6oLFM27GxcbL6EpXp0deNAqTNJkUNwTrAyU3y39cB19v005rCzYMqr');

    $endpoint_secret = 'whsec_9BIslTtsA0cQneuwtKD0J3oL3X9lSncL';
    // $endpoint_secret = 'whsec_G1ppmMZh3XBeSCaauz9gV5wM08C3qrAW';

    $payload = @file_get_contents('php://input');
    $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
    $event = null;

    try {
      $event = \Stripe\Webhook::constructEvent(
        $payload,
        $sig_header,
        $endpoint_secret
      );
    } catch (\UnexpectedValueException $e) {

      http_response_code(400);
      exit();
    } catch (\Stripe\Error\SignatureVerificationException $e) {

      http_response_code(400);
      exit();
    }


    switch ($event->type) {
      case 'checkout.session.completed':
        $customerId = $event->{'data'}->{'object'}->{'customer'};
        $this->userManagerModel->updateSubscribeByCustomerId($customerId);
        $_SESSION['flash']['success'] = "Bienvenu! Pour arrêter votre abonnement, rendez-vous sur la page profil.";
        break;
        //subscription is about to end
        // case 'customer.subscription.trial_will_end=now':             
        //     $session = $event->data->object;	
        //     $userId = $session->{'client_reference_id'};         
        //     $customerId = $session->{'customer'};
        //     $this->userManagerModel->resetCustomerIdById($userId);
        //     break;
        //subscription is unpaid or canceled
      case 'customer.subscription.updated':
        $status = $event->{'data'}->{'object'}->{'status'};
        if ($status == 'canceled' || $status == 'unpaid') {
          $session = $event->{'data'}->{'object'};
          $customerId = $session->{'customer'};
          $this->userManagerModel->resetCustomerIdById($customerId);
          $_SESSION['flash']['info'] = "Vous n'êtes plus abonné! S'il s'agit d'une erreur, n'hésitez pas à nous contacter.";
          break;
        }
      default:
        http_response_code(200);
        exit();
    }

    http_response_code(200);
  }
}
