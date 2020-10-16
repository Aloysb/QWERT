<?php

if (session_status() === PHP_SESSION_NONE) {
  ini_set("session.cache_expire", 600);
  ini_set("session.gc_maxlifetime", 36000);
  ini_set("session.cookie_lifetime", 36000);
  session_start();
}


class Pages extends Controller
{
  private $folderModel;
  private $userManagerModel;
  private $fileModel;
  private $adminManager;
  private $Notes;

  public function __construct()
  {
    $this->folderModel = $this->model('Folders');
    $this->userManagerModel = $this->model('UserManager');
    $this->fileModel = $this->model('Files');
    $this->adminManager = $this->model('AdminManager');
    $this->Notes = $this->model('Notes');
  }
  public function index()
  {

    return $this->view('pages/home');
  }

  public function plans()
  {
    return $this->view('pages/plans');
  }

  public function welcome()
  {


    if (isLoggedIn()) {

      if ($_SESSION['data_user']->{'customer_id'} == 'beta_tester') {
        // dd('here');
        redirectWithoutTag('pages/fiche');
      };
      //Update user's data
      $email = $_SESSION['data_user']->{'mail'};
      $_SESSION['data_user'] = $this->userManagerModel->getUserByEmail($email)[0];
      $session = $this->userManagerModel->sessionStripe('https://www.doctofiche.fr/pages/welcome');
      $sessionFirstYear = $this->userManagerModel->sessionStripeFirstYear('https://www.doctofiche.fr/pages/welcome');

      $data = [
        'session' => $session,
        'sessionFirstYear' => $sessionFirstYear,
      ];

      // Change when stripe is ready.
      return $this->view('pages/welcome', $data);
    } else {
      return $this->view('pages/connexion');
    }
  }


  public function connexion()
  {
    if (isLoggedIn()) {
      redirectWithoutTag('pages/fiche');
    } else {
      return $this->view('pages/connexion');
    }
  }

  public function merci()
  {
    return $this->view('pages/merci');
  }

  public function inscription()
  {
    if (isLoggedIn()) {
      redirectWithoutTag('pages/fiches');
    } else {
      $session = 'here';
      return $this->view('pages/inscription', $session);
    }
  }



  public function inscriptionPro($session = null)
  {
    if (isLoggedIn()) {
      redirectWithoutTag('pages/fiches');
    } else {
      return $this->view('pages/inscription-pro');
    }
  }

  public function confirmation()
  {
    // if (isLoggedIn() || !isset($_SERVER['HTTP_REFERER'])){
    //     redirectWithoutTag('pages/erreur');
    // } else {
    return $this->view('pages/confirmation');
    // }
  }

  public function about()
  {
    return $this->view('pages/about');
  }

  public function erreur()
  {
    return $this->view('pages/error');
  }


  public function accountingFAQ()
  {
    return $this->view('pages/accountingFAQ');
  }

  public function profil()
  {
    if (!isLoggedIn()) {
      redirectWithoutTag('pages/connexion');
    } else {
      //Update user's data

      $userId = (int)$_SESSION['data_user']->{'id'};
      $user = $this->userManagerModel->getUserById($userId);
      // $session = $this->userManagerModel->sessionStripe('https://www.doctofiche.fr/pages/plans/');
      $data = [
        'data_user' => $user,
      ];
      return $this->view('pages/profil', $data);
      exit;
    }
  }

  public function exam()
  {
    if (!isLoggedIn()) {
      redirectWithoutTag('pages/connexion');
    } else {
      //Update user's data
      $email = $_SESSION['data_user']->{'mail'};
      $_SESSION['data_user'] = $this->userManagerModel->getUserByEmail($email)[0];
      $user = $_SESSION['data_user'];
      $userId = (int)$_SESSION['data_user']->{'id'};
      $medicalFolders = $this->folderModel->getFoldersByExamCategory($userId);
      $listSites = $this->adminManager->getListSites($userId);
      $files = $this->fileModel->getAllExamsByUserId($userId);
      $notes = $this->Notes->getAllNotesByUserId($userId);
      $notificationArticle = $this->folderModel->getNotifPostByUserId($userId) ? true : false;
      $notificationFiche = $this->folderModel->getNotifFiches($userId);
      $notificationBilan = $this->folderModel->getNotifBilans($userId);
      $notificationAnnuaire = $this->folderModel->getNotifAnnuaire($userId);
      $notificationConseil = $this->folderModel->getNotifConseil($userId);
      $notificationSites = $this->folderModel->getNotifSites($userId);
      $data = [
        'user' => $user,
        'medicalFolders' => $medicalFolders,
        'files' => json_encode($files),
        'list_sites' => $listSites,
        'notes' => $notes,
        'notifFiche' => $notificationFiche,
        'notifBilan' => $notificationBilan,
        'notifAnnuaire' => $notificationAnnuaire,
        'notifConseil' => $notificationConseil,
        'notificationArticle' => $notificationArticle,
        'notificationSites' => $notificationSites,
      ];
      return $this->view('pages/exam', $data);
    }
  }

  public function drug()
  {
    if (!isLoggedIn()) {
      redirectWithoutTag('pages/connexion');
    } else {
      //Update user's data
      $email = $_SESSION['data_user']->{'mail'};
      $_SESSION['data_user'] = $this->userManagerModel->getUserByEmail($email)[0];
      $user = $_SESSION['data_user'];
      $userId = $_SESSION['data_user']->{'id'};
      $medicalFolders = $this->folderModel->getFoldersByDrugCategory($userId);
      $listSites = $this->adminManager->getListSites($userId);
      $files = $this->fileModel->getAllContactsByUserId($userId);
      $notes = $this->Notes->getAllNotesByUserId($userId);
      $notificationArticle = $this->folderModel->getNotifPostByUserId($userId) ? true : false;
      $notificationFiche = $this->folderModel->getNotifFiches($userId);
      $notificationBilan = $this->folderModel->getNotifBilans($userId);
      $notificationAnnuaire = $this->folderModel->getNotifAnnuaire($userId);
      $notificationConseil = $this->folderModel->getNotifConseil($userId);
      $notificationSites = $this->folderModel->getNotifSites($userId);
      $data = [
        'user' => $user,
        'medicalFolders' => $medicalFolders,
        'files' => json_encode($files),
        'list_sites' => $listSites,
        'notes' => $notes,
        'notifFiche' => $notificationFiche,
        'notifBilan' => $notificationBilan,
        'notifAnnuaire' => $notificationAnnuaire,
        'notifConseil' => $notificationConseil,
        'notificationArticle' => $notificationArticle,
        'notificationSites' => $notificationSites,
      ];
      return $this->view('pages/drug', $data);
    }
  }

  public function advice()
  {
    if (!isLoggedIn()) {
      redirectWithoutTag('pages/connexion');
    } else {
      //Update user's data
      $email = $_SESSION['data_user']->{'mail'};
      $_SESSION['data_user'] = $this->userManagerModel->getUserByEmail($email)[0];
      $user = $_SESSION['data_user'];
      $userId = $_SESSION['data_user']->{'id'};
      $medicalFolders = $this->folderModel->getFoldersByAdviceCategory($userId);
      $listSites = $this->adminManager->getListSites($userId);
      $notificationArticle = $this->folderModel->getNotifPostByUserId($userId) ? true : false;
      $files = $this->fileModel->getAllAdviceByUserId($userId);
      $notes = $this->Notes->getAllNotesByUserId($userId);
      $notificationFiche = $this->folderModel->getNotifFiches($userId);
      $notificationBilan = $this->folderModel->getNotifBilans($userId);
      $notificationAnnuaire = $this->folderModel->getNotifAnnuaire($userId);
      $notificationConseil = $this->folderModel->getNotifConseil($userId);
      $notificationSites = $this->folderModel->getNotifSites($userId);
      $data = [
        'user' => $user,
        'medicalFolders' => $medicalFolders,
        'files' => json_encode($files),
        'list_sites' => $listSites,
        'notes' => $notes,
        'notifFiche' => $notificationFiche,
        'notifBilan' => $notificationBilan,
        'notifAnnuaire' => $notificationAnnuaire,
        'notifConseil' => $notificationConseil,
        'notificationArticle' => $notificationArticle,
        'notificationSites' => $notificationSites,
      ];
      return $this->view('pages/advice', $data);
    }
  }

  public function accounting()
  {
    if (!isLoggedIn()) {
      redirectWithoutTag('pages/connexion');
    } else {
      $userId = (int)$_SESSION['data_user']->{'id'};
      $user = $_SESSION['data_user'];
      if ($user->{'role'} == 'ROLE_SUBSCRIBER' || $user->{'role'} == 'ROLE_ADMIN') {
        $dataAccountingById = $this->userManagerModel->getAccountingDataByUserId($userId);
        if ($dataAccountingById) {
          $data = [
            'user' => $user,
            'data_accounting' => $dataAccountingById
          ];
          return $this->view('pages/accounting', $data);
          exit;
        } else {
          return $this->view('pages/accounting');
          exit;
        }
      } else {
        $_SESSION['flash']['info'] = "Vous n'êtes pas abonnée !";
        redirectWithoutTag('pages/search');
        exit;
      }
    }
  }

  public function test()
  {
    if (!isLoggedIn()) {
      redirectWithoutTag('pages/connexion');
    } else {
      $user = $_SESSION['data_user'];
      $userId = $_SESSION['data_user']->{'id'};
      $notifications = $this->folderModel->getNotifsDashboard($userId);

      dd($notifications);
    }
  }

  public function search()
  {
    if (!isLoggedIn()) {
      redirectWithoutTag('pages/connexion');
    } else {
      //Update user's data
      $email = $_SESSION['data_user']->{'mail'};
      $_SESSION['data_user'] = $this->userManagerModel->getUserByEmail($email)[0];

      $user = $_SESSION['data_user'];
      $userId = $_SESSION['data_user']->{'id'};
      $medicalFolders = $this->folderModel->getFolders($userId);
      $listSites = $this->adminManager->getListSites($userId);
      $files = $this->fileModel->getAllFilesByUserId($userId);
      $notes = $this->Notes->getAllNotesByUserId($userId);
      $notificationArticle = $this->folderModel->getNotifPostByUserId($userId) ? true : false;
      $notificationFiche = $this->folderModel->getNotifFiches($userId);
      $notificationBilan = $this->folderModel->getNotifBilans($userId);
      $notificationAnnuaire = $this->folderModel->getNotifAnnuaire($userId);
      $notificationConseil = $this->folderModel->getNotifConseil($userId);
      $notificationSites = $this->folderModel->getNotifSites($userId);
      $data = [
        'user' => $user,
        'medicalFolders' => $medicalFolders,
        'files' => json_encode($files),
        'list_sites' => $listSites,
        'notes' => $notes,
        'notifFiche' => $notificationFiche,
        'notifBilan' => $notificationBilan,
        'notifAnnuaire' => $notificationAnnuaire,
        'notifConseil' => $notificationConseil,
        'notificationArticle' => $notificationArticle,
        'notificationSites' => $notificationSites,
      ];
      // dd($data['notificationSites']);
      return $this->view('pages/search', $data);
    }
  }

  public function renew()
  {
    if (isLoggedIn()) {
      redirectWithoutTag('pages/erreur');
    } else {
      return $this->view('pages/renew');
    }
  }

  public function createNewPassword()
  {
    if ($_SERVER['HTTP_REFERER']) {
      return $this->view('pages/create-newpassword');
    } else {
      redirecTWithoutTag('pages/erreur');
    }
  }

  public function confirmationSubscription()
  {
    // if(!empty($_SESSION['data_user'])){
    //     $user = $_SESSION['data_user'];
    //     if ($user->{'role'} == 'ROLE_USER'){
    return $this->view('pages/confirmationSubscription');
    // } else {
    // redirectWithoutTag('pages/connexion');
    // }
    // } else {
    // redirectWithoutTag('pages/connexion');
    // }
  }

  public function success()
  {
    if (!isLoggedIn()) {
      redirectWithoutTag('pages/erreur');
    } else {
      unset($_SESSION['data_user']);
      return $this->view('pages/success');
    }
  }


  public function updateProfile()
  {
    if (!empty($_POST)) {
      $name =  htmlspecialchars($_POST['name']);
      $firstName =  htmlspecialchars($_POST['firstName']);
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
        'login' => $login,
        'birth_date' => $birth_date,
        'sex' => $sex,
        'ecn_year' => $ecn_year,
        'ecn_school' => $ecn_school,
        'ecn_place' => $ecn_place,
        'status' => $status,
      ];

      $errors = [];


      if (empty($login)) {
        $errors['login'] = "votre identifiant est manquant";
      } elseif (!preg_match('/^[a-zA-Z0-9_ ]+$/', $login)) {
        $errors['login'] = "votre identifiant n' est pas valide";
      } else {
        $userLogin = $this->userManagerModel->checkLogin($login);
        if ($userLogin) {
          $errors['login'] = "Cet identifiant est déjà pris pour un autre compte";
        }
      }

      if (empty($errors) || count($errors) === 1) {
        $this->userManagerModel->updateProfileById($userId, $data);
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


  public function ajaxGetDataFolder()
  {
    if (!isLoggedIn()) {
      redirectWithoutTag('pages/erreur');
    } else {
      $folders = $this->folderModel->getFolders();
      header('Content-type: application/json');
      echo json_encode($folders);
    }
  }

  public function ajaxPostDataFile()
  {
    if (!isLoggedIn() || !isset($_SERVER['HTTP_REFERER'])) {
      redirectWithoutTag('pages/erreur');
    } else {
      $data = json_decode(file_get_contents('php://input'), true);
      $request = htmlspecialchars($data);
      $files = $this->folderModel->getFiles($request);
      echo json_encode($files);
    }
  }

  public function ajaxPostSearchFile()
  {
    if (!isLoggedIn() || !isset($_SERVER['HTTP_REFERER'])) {
      redirectWithoutTag('pages/erreur');
    } else {
      $data = json_decode(file_get_contents('php://input'), true);
      $request = htmlspecialchars($data);
      $files = $this->fileModel->getFilesById($request);
      echo json_encode($files);
    }
  }


  public function ajaxPostAFolder()
  {
    if (!isLoggedIn()) {
      redirectWithoutTag('pages/erreur');
    } else {
      $user = $_SESSION['data_user'];
      $userId = $_SESSION['data_user']->{'id'};
      if ($user->{'role'} == 'ROLE_SUBSCRIBER' || $user->{'role'} == 'ROLE_ADMIN') {

        $data = json_decode(file_get_contents('php://input'), true);
        $folder = htmlspecialchars($data);
        $endRoute = basename($_SERVER['HTTP_REFERER']);
        switch ($endRoute) {
          case 'fiche':
            $_SESSION['flash']['success'] = "Le dossier a bien été rajouté !";
            if ($user->{'role'} == 'ROLE_SUBSCRIBER') {
              $this->folderModel->addAFolderByCategory($userId, $folder, 'form');
            } elseif ($user->{'role'} == 'ROLE_ADMIN') {
              $idFolder = $this->folderModel->addAFolderByCategory($userId, $folder, 'form');
              $ret = $this->folderModel->addAFolderByCategoryForAllUsers($idFolder, $folder, 'form');
            }
            echo json_encode(true);
            exit;
            break;
          case 'exam':
            $_SESSION['flash']['success'] = "Le dossier a bien été rajouté !";
            if ($user->{'role'} == 'ROLE_SUBSCRIBER') {
              $this->folderModel->addAFolderByCategory($userId, $folder, 'complementary-exam');
            } elseif ($user->{'role'} == 'ROLE_ADMIN') {
              $idFolder = $this->folderModel->addAFolderByCategory($userId, $folder, 'complementary-exam');
              $ret = $this->folderModel->addAFolderByCategoryForAllUsers($idFolder, $folder, 'complementary-exam');
            }
            echo json_encode(true);
            exit;
            break;
          case 'annuaire':
            $_SESSION['flash']['success'] = "Le dossier a bien été rajouté !";
            if ($user->{'role'} == 'ROLE_SUBSCRIBER') {
              $this->folderModel->addAFolderByCategory($userId, $folder, 'drug');
            } elseif ($user->{'role'} == 'ROLE_ADMIN') {
              $idFolder = $this->folderModel->addAFolderByCategory($userId, $folder, 'drug');
              $ret = $this->folderModel->addAFolderByCategoryForAllUsers($idFolder, $folder, 'drug');
            }
            echo json_encode(true);
            exit;
            break;
          case 'conseils':
            $_SESSION['flash']['success'] = "Le dossier a bien été rajouté !";
            if ($user->{'role'} == 'ROLE_SUBSCRIBER') {
              $this->folderModel->addAFolderByCategory($userId, $folder, 'advice');
            } elseif ($user->{'role'} == 'ROLE_ADMIN') {
              $idFolder = $this->folderModel->addAFolderByCategory($userId, $folder, 'advice');
              $ret = $this->folderModel->addAFolderByCategoryForAllUsers($idFolder, $folder, 'advice');
            }
            echo json_encode(true);
            exit;
            break;
        }
      } else {
        $_SESSION['flash']['info'] = "Vous n'êtes pas abonnée !";
        redirectWithoutTag('pages/search');
        exit;
      }
    }
  }

  public function ajaxPostDeleteAFolder()
  {
    if (!isLoggedIn()) {
      redirectWithoutTag('pages/erreur');
    } else {
      $user = $_SESSION['data_user'];
      $data = json_decode(file_get_contents('php://input'), true);
      $idFolder = htmlspecialchars($data);
      $userId = $user->{'id'};
      if ($user->{'role'} == 'ROLE_SUBSCRIBER' || $user->{'role'} == 'ROLE_ADMIN') {
        $presentFiles = $this->fileModel->getFilesByFolderId($userId, $idFolder);
        if ($presentFiles) {
          $ret = $this->folderModel->deleteAFolderByUserId($userId, $idFolder);
        } else {
          $ret = $this->folderModel->deleteAFolderWithoutFilesByUserId($userId, $idFolder);
        }
        $allFiles = $this->fileModel->getAllFiles();

        $bigContentArray = [];
        foreach ($allFiles as $allContent) {
          $bigContentArray[] = $allContent['description'];
        }

        $bigContentArrays = implode('', $bigContentArray);

        preg_match_all('/[[:alnum:]]{1,}\.[jpegn]{3,4}/', $bigContentArrays, $matches);
        $matches = array_unique(reset($matches));

        $allFileName = $this->fileModel->getAllFilename();

        $arrayOfFilename = [];
        foreach ($allFileName as $bigArrayOfFilename) {
          $arrayOfFilename[] = $bigArrayOfFilename['image_filename'];
        }

        $compareArrays = array_diff($arrayOfFilename, $matches);

        if (!empty($compareArrays)) {
          foreach ($compareArrays as $compareArray) {
            unlink(PUBLICROOT . '/img/' . $compareArray);
          }
          foreach ($compareArrays as $compareArray) {
            $this->folderModel->deleteImageTemp($compareArray);
          }
        }
        echo json_encode($ret);
        exit;
      } else {
        $_SESSION['flash']['info'] = "Vous n'êtes pas abonnée !";
        redirectWithoutTag('pages/search');
        exit;
      }
    }
  }

  public function ajaxUpdateAFolder()
  {
    if (!isLoggedIn()) {
      redirectWithoutTag('pages/erreur');
    } else {
      $user = $_SESSION['data_user'];
      $userId = $_SESSION['data_user']->{'id'};
      if ($user->{'role'} == 'ROLE_SUBSCRIBER' || $user->{'role'} == 'ROLE_ADMIN') {
        $data = json_decode(file_get_contents('php://input'), true);
        $idFolder = htmlspecialchars($data[0]);
        $valueData = htmlspecialchars($data[1]);
        $ret = $this->folderModel->updateAFolderByUserId($userId, $idFolder, $valueData);
        echo json_encode($ret);
      } else {
        $_SESSION['flash']['info'] = "Vous n'êtes pas abonnée !";
        redirectWithoutTag('pages/search');
        exit;
      }
    }
  }

  public function ajaxAddANote()
  {
    $userId = $_SESSION['data_user']->{'id'};
    if (!isLoggedIn()) {
      redirectWithoutTag('pages/erreur');
      $_SESSION['flash']['danger'] = "Une erreur s'est produite! Merci de vous reconnecter";
    } else {
      $_SESSION['flash']['success'] = "Nouvelle note sauvegardée.";
      $this->Notes->addANote($_POST['content'], $userId);
    }
  }

  public function ajaxUpdateANote()
  {

    if (!isLoggedIn()) {
      redirectWithoutTag('pages/erreur');
      $_SESSION['flash']['danger'] = "Une erreur s'est produite! Merci de vous reconnecter";
    } else {
      $this->Notes->updateANote($_POST['id'], $_POST['content']);
      echo ($_POST['content']);
      // echo ($listUsers = $this->adminManager->getListUsers());

    }
  }

  public function ajaxDeleteANote()
  {

    if (!isLoggedIn()) {
      redirectWithoutTag('pages/erreur');
      $_SESSION['flash']['danger'] = "Une erreur s'est produite! Merci de vous reconnecter";
    } else {
      $this->Notes->deleteANote($_POST['id']);
    }
  }


  public function posts()
  {
    if (!isLoggedIn()) {
      redirectWithoutTag('pages/connexion');
    } else {
      $user = $_SESSION['data_user'];
      $userId = (int)$_SESSION['data_user']->{'id'};
      if ($user->{'role'} == 'ROLE_SUBSCRIBER' || $user->{'role'} == 'ROLE_ADMIN') {
        //5 is the admin...
        $allPosts = $this->folderModel->getAllPostByUserId($userId);
        $posts__search = $this->folderModel->getAllPostByUserId($userId);

        // Under that form to allow for mutability of the objects. Otherwise it wouldn't modify the object as per.
        foreach ($posts__search as $key => $post) {
          $posts__search[$key]['content'] = htmlspecialchars_decode(strip_tags(html_entity_decode($post['content'])));
        }
        $data = [
          'posts' => $allPosts,
          'posts__search' => json_encode($posts__search)
        ];
        return $this->view('pages/posts', $data);
        exit;
      } else {
        $_SESSION['flash']['info'] = "Vous n'êtes pas abonnée !";
        redirectWithoutTag('pages/search');
        exit;
      }
    }
  }

  public function post($id)
  {
    if (!isLoggedIn()) {
      redirectWithoutTag('pages/connexion');
      exit;
    } else {
      $user = $_SESSION['data_user'];
      $userId = (int)$_SESSION['data_user']->{'id'};
      if ($user->{'role'} == 'ROLE_ADMIN' || $user->{'role'} == 'ROLE_SUBSCRIBER') {
        $idPost = (int)$id;
        $existPost = $this->fileModel->getPostById($idPost);
        if ($existPost) {
          $post = $this->fileModel->viewPostById($idPost);
          $this->fileModel->updatePostNotif($userId, $idPost);
          $data = [
            'post' => $post
          ];
          return $this->view('pages/viewPost', $data);
          exit;
        } else {


          $_SESSION['flash']['danger'] = "Opération non autorisé!";
          redirectWithoutTag('pages/posts');
          exit;
        }
      } else {
        $_SESSION['flash']['info'] = "Vous n'êtes pas abonnée !";
        redirectWithoutTag('pages/search');
        exit;
      }
    }
  }


  public function addPost()
  {
    if (!isLoggedIn()) {
      redirectWithoutTag('pages/connexion');
      exit;
    } else {
      $user = $_SESSION['data_user'];
      $userId = $_SESSION['data_user']->{'id'};
      if ($user->{'role'} == 'ROLE_ADMIN') {

        return $this->view('pages/addPost');
      } else {
        $_SESSION['flash']['info'] = "Vous n'êtes pas autorisé à accéder à cette page !";
        redirectWithoutTag('pages/search');
        exit;
      }
    }
  }

  public function postUpdate($id)
  {
    if (!isLoggedIn()) {
      redirectWithoutTag('pages/connexion');
      exit;
    } else {
      $user = $_SESSION['data_user'];
      $userId = (int)$_SESSION['data_user']->{'id'};
      if ($user->{'role'} == 'ROLE_ADMIN') {
        $idPost = (int)$id;
        $existPost = $this->fileModel->getPostById($idPost);
        if ($existPost) {
          $post = $this->fileModel->viewPostById($idPost);
          $data = [
            'post' => $post
          ];
          return $this->view('pages/updatePost', $data);
          exit;
        } else {
          $_SESSION['flash']['info'] = "l'article n'existe pas !";
          redirectWithoutTag('pages/articles');
          exit;
        }
      } else {
        $_SESSION['flash']['info'] = "Vous n'êtes pas abonnée !";
        redirectWithoutTag('pages/search');
        exit;
      }
    }
  }
}
