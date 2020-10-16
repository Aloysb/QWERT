<?php
if (session_status() === PHP_SESSION_NONE) {
  ini_set("session.cache_expire", 600);
  ini_set("session.gc_maxlifetime", 36000);
  ini_set("session.cookie_lifetime", 36000);
  session_start();
}

class Single extends Controller
{
  private $fileModel;
  private $folderModel;

  public function __construct()
  {
    $this->fileModel = $this->model('Files');
    $this->folderModel = $this->model('Folders');
    $this->adminManager = $this->model('AdminManager');
  }

  public function index($id = null)
  {
    $id = htmlspecialchars((int)$id);
    $file = $this->fileModel->getSingleFile($id);
    if (!empty($file)) {
      $data = [
        'file' => $file
      ];
      return $this->view('files/single', $data);
    } else {
      redirectToHome();
    }
  }

  public function add($id = null)
  {
    if (!isLoggedIn()) {
      redirectWithoutTag('pages/connexion');
      exit;
    } else {
      echo ('hello world');
      $userId = $_SESSION['data_user']->{'id'};
      $id = (int)htmlspecialchars($id);
      $numberFolder = (int)$this->folderModel->checkFolderExistForUser($id, $userId);

      if ($numberFolder > 0) {
        $data = [
          'id' => $id
        ];
        return $this->view('files/add', $data);
      } else {
        $_SESSION['flash']['danger'] = 'vous ne pouvez pas ajouter un fichier sur un dossier
                    ne vous appartenant pas !';
        redirectWithoutTag('pages/fiche');
        exit;
      }
    }
  }

  public function edit($id = null)
  {
    if (!isLoggedIn()) {
      redirectWithoutTag('pages/connexion');
      exit;
    } else {
      $id = htmlspecialchars((int)$id);
      $file = $this->fileModel->getSingleFile($id);
      if (!empty($file)) {
        $data = [
          'file' => $file
        ];
        return $this->view('files/edit', $data);
      } else {
        redirectWithoutTag('pages/fiche');
        exit;
      }
    }
  }

  public function ajaxPostDelete()
  {
    if (!isLoggedIn()) {
      redirectWithoutTag('pages/connexion');
      exit;
    } else {
      $user = $_SESSION['data_user'];
      $data = json_decode(file_get_contents('php://input', true));
      $idFile = (int)htmlspecialchars($data[0]);
      $idFolder = (int)htmlspecialchars($data[1]);
      $numberFile = $this->fileModel->exist($idFile);
      $userId = $user->{'id'};
      $FolderExist = $this->folderModel->checkFolderExistForUser($idFolder, $userId);

      if ($numberFile > 0 && $FolderExist > 0) {
        if ($user->{'role'} == 'ROLE_ADMIN' || $user->{'role'} == 'ROLE_SUBSCRIBER') {

          $this->fileModel->deleteFileById($idFile);

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

          $categoryArray = $this->fileModel->getCategoryOfFolderByIdFile($idFile);

          $categoryObject = reset($categoryArray);
          $category = $categoryObject->{'category'};
        }
        $this->fileModel->deleteFileById($idFile);
        switch ($category) {
          case 'form':
            $_SESSION['flash']['success'] = "La fiche a bien été supprimé !";
            echo json_encode(true);
            exit;
            break;
          case 'complementary-exam':
            $_SESSION['flash']['success'] = "La fiche a bien été supprimé !";
            echo json_encode(true);
            exit;
            break;
          case 'drug':
            $_SESSION['flash']['success'] = "La fiche a bien été supprimé !";
            echo json_encode(true);
            exit;
            break;
        }
      } else {
        $_SESSION['flash']['danger'] = "Aucun fichier n'existe ! ";
        echo json_encode(false);
        exit;
      }
    }
  }

  public function ajaxPostGetInfoFile()
  {
    if (!isLoggedIn()) {
      redirectWithoutTag('pages/erreur');
      exit;
    } else {
      $data = file_get_contents('php://input', true);
      $arrayData = explode('_', $data);
      $idFile = (int)(htmlspecialchars($arrayData[1]));
      $ret = $this->fileModel->getSingleFile($idFile);
      $this->fileModel->updateFileNotif($idFile);
      if ($ret) {
        // dd($ret);
        echo json_encode($ret);
        exit;
      } else {
      }
    }
  }

  public function copyFileByFileId()
  {
    $id = $_POST['id'];
    $title = 'Copie de ' . $this->fileModel->getSingleFile($id)[0]->{'title'};
    $this->fileModel->copyFile($id, $title);
    $_SESSION['flash']['success'] = 'Fiche copiée';
  }

  public function ajaxEditFileByFolderId()
  {
    if (!isLoggedIn()) {
      redirectWithoutTag('pages/connexion');
      exit;
    } else {
      $user = $_SESSION['data_user'];
      if ($user->{'role'} == 'ROLE_SUBSCRIBER' || $user->{'role'} == 'ROLE_ADMIN') {
        $data = json_decode(file_get_contents('php://input', true));
        $title = htmlspecialchars($data[0]);
        $content = htmlspecialchars($data[1]);
        $fileId = (int)htmlspecialchars($data[2]);
        $folderId = (int)htmlspecialchars($data[3]);
        $userId = $_SESSION['data_user']->{'id'};
        $FolderExist = $this->folderModel->checkFolderExistForUser($folderId, $userId);
        $fileExist = $this->fileModel->exist($fileId);

        if (!empty($title) && !empty($content) && $FolderExist > 0 && $fileExist > 0) {
          if ($user->{'role'} == 'ROLE_ADMIN') {
            $this->fileModel->updateFile($fileId, $title, $content);
          }
          if ($user->{'role'} == 'ROLE_SUBSCRIBER') {

            $this->fileModel->updateFile($fileId, $title, $content);
            // $allFiles = $this->fileModel->getAllFiles();

            // $bigContentArray = [];
            // foreach($allFiles as $allContent){
            //         $bigContentArray[] = $allContent['description'];      
            // }


            // $bigContentArrays = implode('',$bigContentArray);

            // preg_match_all('/[[:alnum:]]{1,}\.[jpegn]{3,4}/',$bigContentArrays,$matches);
            // $matches = array_unique(reset($matches));

            // $allFileName = $this->fileModel->getAllFilename();

            // $arrayOfFilename = [];
            // foreach($allFileName as $bigArrayOfFilename){
            //     $arrayOfFilename[] = $bigArrayOfFilename['image_filename'];
            // }

            // $compareArrays = array_diff($arrayOfFilename,$matches);
            // dd('here');

            // if(!empty($compareArrays)){
            //     foreach($compareArrays as $compareArray){
            //         unlink(PUBLICROOT.'/img/'.$compareArray);
            //     }
            //     foreach($compareArrays as $compareArray){
            //         $this->folderModel->deleteImageTemp($compareArray);
            //     }
            // }
          }


          $categoryArray = $this->fileModel->getCategoryOfFolderByIdFile($fileId);
          $categoryObject = reset($categoryArray);
          $category = $categoryObject->{'category'};

          switch ($category) {
            case 'form':
              $_SESSION['flash']['success'] = "La fiche a bien été mise à jour !";
              echo json_encode(true);
              exit;
              break;
            case 'complementary-exam':
              $_SESSION['flash']['success'] = "La fiche a bien été mise à jour !";
              echo json_encode(true);
              exit;
              break;
            case 'drug':
              $_SESSION['flash']['success'] = "La fiche a bien été mise à jour !";
              echo json_encode(true);
              exit;
              break;
            case 'advice':
              $_SESSION['flash']['success'] = "La fiche a bien été mise à jour !";
              echo json_encode(true);
              exit;
              break;
          }
        } else {
          $_SESSION['flash']['danger'] = 'il manque un titre et/ou une description à votre fichier !';
          echo json_encode(false);
          exit;
        }
      } else {
        $_SESSION['flash']['info'] = "Vous n'êtes pas abonnée !";
        echo json_encode(false);
        exit;
      }
    }
  }


  public function ajaxAddFileByFolderId()
  {
    if (!isLoggedIn()) {
      redirectWithoutTag('pages/connexion');
      exit;
    } else {

      $data = json_decode(file_get_contents('php://input', true));
      $title = htmlspecialchars($data[0]);
      $content = htmlspecialchars($data[1]);
      $idFolder = (int)htmlspecialchars($data[2]);

      $user = $_SESSION['data_user'];
      $userId = $user->{'id'};
      $numberFolder = $this->folderModel->checkFolderExistForUser($idFolder, $userId);

      if (!empty($title) && !empty($content) && $numberFolder > 0) {
        if ($user->{'role'} == 'ROLE_ADMIN') {
          $idFile = $this->folderModel->addFileForAllUsers($title, $content, $idFolder);
          $idFolderAdmin = $this->folderModel->getFolderAdminId($idFolder)[0]['id'];
          $this->folderModel->updateFolderNotifForAllUsers($idFolderAdmin);

          // Save the title of the post in a DB.
          $this->adminManager->addFicheToDailyEmail($title);
        } else if ($user->{'role'} == 'ROLE_SUBSCRIBER') {
          $idFile = $this->folderModel->addFile($title, $content, $idFolder);
        }

        // $allFiles = $this->fileModel->getAllFiles();

        // $bigContentArray = [];
        // foreach($allFiles as $allContent){
        //         $bigContentArray[] = $allContent['description'];      
        // }

        // $bigContentArrays = implode('',$bigContentArray);

        // preg_match_all('/[[:alnum:]]{1,}\.[jpegn]{3,4}/',$bigContentArrays,$matches);
        // $matches = array_unique(reset($matches));

        // $allFileName = $this->fileModel->getAllFilename();

        // $arrayOfFilename = [];
        // foreach($allFileName as $bigArrayOfFilename){
        //     $arrayOfFilename[] = $bigArrayOfFilename['image_filename'];
        // }

        // $compareArrays = array_diff($arrayOfFilename,$matches);

        // if(!empty($compareArrays)){
        //     foreach($compareArrays as $compareArray){
        //         unlink(PUBLICROOT.'/img/'.$compareArray);
        //     }
        //     foreach($compareArrays as $compareArray){
        //         $this->folderModel->deleteImageTemp($compareArray);
        //     }
        // }

        $categoryArray = $this->fileModel->getCategoryOfFolderByIdFile($idFile);
        $categoryObject = reset($categoryArray);
        $category = $categoryObject->{'category'};

        switch ($category) {
          case 'form':
            $_SESSION['flash']['success'] = "La fiche a bien été rajouté !";
            echo json_encode(true);
            exit;
            break;
          case 'complementary-exam':
            $_SESSION['flash']['success'] = "La fiche a bien été rajouté !";
            echo json_encode(true);
            exit;
            break;
          case 'drug':
            $_SESSION['flash']['success'] = "La fiche a bien été rajouté !";
            echo json_encode(true);
            exit;
            break;
          case 'advice':
            $_SESSION['flash']['success'] = "La fiche a bien été rajouté !";
            echo json_encode(true);
            exit;
            break;
        }
      } else {
        $_SESSION['flash']['danger'] = 'il manque un titre et/ou une description à votre fichier !';
        echo json_encode(false);
        exit;
      }
    }
  }

  public function removeNotifFromFolder()
  {
    $data = json_decode(file_get_contents('php://input'), true);
    $request = htmlspecialchars($data);
    $this->folderModel->removeNotificationFromFolderId($request);
  }

  public function moveFileToFolderById()
  {
    $fileId = $_POST['currentFile'];
    $folderId = $_POST['folderId'];
    $this->folderModel->moveFileByIdToFolderById($fileId, $folderId);
    $_SESSION['flash']['success'] = 'Fiche déplacée!';
    redirectWithoutTag('pages/fiche');
  }

  public function ajaxGetInfoFile()
  {

    if (!isLoggedIn()) {
      redirectToHome();
      exit;
    } else {
      $ret = $this->fileModel->getSingleFile();
      echo json_encode($ret);
    }
  }

  public function ajaxGetTrackFile()
  {
    if (!isLoggedIn()) {
      redirectToHome();
      exit;
    } else {
      $ret = $this->fileModel->getFileByTracker();
      echo json_encode($ret);
      exit;
    }
  }

  public function ajaxPostResetTracker()
  {
    if (!isLoggedIn()) {
      redirectToHome();
      exit;
    } else {
      $ret = $this->fileModel->resetTrackerFile();
      echo json_encode($ret);
    }
  }

  public function postAcceptor()
  {
    if (!isLoggedIn()) {
      redirectToHome();
      exit;
    } else {
      $userId = $_SESSION['data_user']->{'id'};
      if (!empty($_FILES['file'])) {
        if ($_FILES['file']['error'] == 0) {
          if ($_FILES['file']['size'] <= 1000000) {
            $fileInformation = pathinfo($_FILES['file']['name']);
            $fileExtension = $fileInformation['extension'];
            $authorizedExtension = ['jpg', 'jpeg', 'png'];
            $ipath = uniqid(bin2hex(random_bytes(5))) . '.' . $fileExtension;

            if (in_array($fileExtension, $authorizedExtension, true)) {
              move_uploaded_file($_FILES['file']['tmp_name'], 'img/' . $ipath);
              $this->fileModel->storageImageTempByUserId($ipath, $userId);
              echo json_encode(['location' => URLROOT . '/img/' . $ipath]);
            } else {
              echo json_encode(null);
            }
          } else {
            echo json_encode(null);
          }
        } else {
          echo json_encode(null);
        }
      }
    }
  }

  public function addPostAcceptor()
  {
    if (!isLoggedIn()) {
      redirectToHome();
      exit;
    } else {
      $userId = $_SESSION['data_user']->{'id'};
      if (!empty($_FILES['file'])) {
        if ($_FILES['file']['error'] == 0) {
          if ($_FILES['file']['size'] <= 1000000) {
            $fileInformation = pathinfo($_FILES['file']['name']);
            $fileExtension = $fileInformation['extension'];
            $authorizedExtension = ['jpg', 'jpeg', 'png'];
            $ipath = uniqid(bin2hex(random_bytes(5))) . '.' . $fileExtension;

            if (in_array($fileExtension, $authorizedExtension, true)) {
              move_uploaded_file($_FILES['file']['tmp_name'], 'imgPost/' . $ipath);
              $this->fileModel->storageImagePostTempByUserId($ipath, $userId);
              echo json_encode(['location' => URLROOT . '/imgPost/' . $ipath]);
            } else {
              echo json_encode(null);
            }
          } else {
            echo json_encode(null);
          }
        } else {
          echo json_encode(null);
        }
      }
    }
  }

  public function ajaxAddPostByAdmin()
  {
    if (!isLoggedIn()) {
      redirectWithoutTag('pages/connexion');
      exit;
    } else {
      $data = json_decode(file_get_contents('php://input', true));

      $title = htmlspecialchars($data[0]);
      $content = htmlspecialchars($data[1]);
      $user = $_SESSION['data_user'];
      $userId = $user->{'id'};

      if (!empty($title) && !empty($content)) {

        if ($user->{'role'} == 'ROLE_ADMIN') {
          $titleEmail = 'Article: ' . $title;
          $this->adminManager->addFicheToDailyEmail($titleEmail);
          $idPostAdmin = $this->folderModel->addAPostForAdmin($userId, $title, $content);
          $this->folderModel->addPostForAllUser($title, $content, $idPostAdmin);
          $allContents = $this->folderModel->getAllPosts();

          $bigContentArray = [];
          foreach ($allContents as $allContent) {
            $bigContentArray[] = $allContent['content'];
          }

          $bigContentArrays = implode('', $bigContentArray);

          preg_match_all('/[[:alnum:]]{1,}\.[jpegn]{3,4}/', $bigContentArrays, $matches);
          $matches = array_unique(reset($matches));

          $allFileName = $this->fileModel->getAllPostsFilename();

          $arrayOfFilename = [];
          foreach ($allFileName as $bigArrayOfFilename) {
            $arrayOfFilename[] = $bigArrayOfFilename['image_filename'];
          }

          $compareArrays = array_diff($arrayOfFilename, $matches);

          if (!empty($compareArrays)) {
            foreach ($compareArrays as $compareArray) {
              unlink(PUBLICROOT . '/imgPost/' . $compareArray);
            }
            foreach ($compareArrays as $compareArray) {
              $this->folderModel->deleteImagePostTemp($compareArray);
            }
          }
        }


        $_SESSION['flash']['success'] = "L 'article a bien été rajouté !";
        echo json_encode(true);
        exit;
      } else {
        $_SESSION['flash']['danger'] = 'il manque un titre et/ou une description à votre fichier !';
        echo json_encode(false);
        exit;
      }
    }
  }


  public function ajaxUpdatePostByAdmin()
  {
    if (!isLoggedIn()) {
      redirectWithoutTag('pages/connexion');
      exit;
    } else {

      $data = json_decode(file_get_contents('php://input', true));

      $idPost = htmlspecialchars($data[0]);
      $title = htmlspecialchars($data[1]);
      $content = htmlspecialchars($data[2]);

      $user = $_SESSION['data_user'];
      $userId = $user->{'id'};

      $existPost = $this->fileModel->getPostById($idPost);
      if ($existPost) {
        if (!empty($title) && !empty($content)) {

          if ($user->{'role'} == 'ROLE_ADMIN') {
            $this->folderModel->updatePostById($userId, $idPost, $title, $content);
          }

          $allContents = $this->folderModel->getAllPosts();

          $bigContentArray = [];
          foreach ($allContents as $allContent) {
            $bigContentArray[] = $allContent['content'];
          }

          $bigContentArrays = implode('', $bigContentArray);

          preg_match_all('/[[:alnum:]]{1,}\.[jpegn]{3,4}/', $bigContentArrays, $matches);
          $matches = array_unique(reset($matches));

          $allFileName = $this->fileModel->getAllPostsFilename();

          $arrayOfFilename = [];
          foreach ($allFileName as $bigArrayOfFilename) {
            $arrayOfFilename[] = $bigArrayOfFilename['image_filename'];
          }

          $compareArrays = array_diff($arrayOfFilename, $matches);

          if (!empty($compareArrays)) {
            foreach ($compareArrays as $compareArray) {
              unlink(PUBLICROOT . '/imgPost/' . $compareArray);
            }
            foreach ($compareArrays as $compareArray) {
              $this->folderModel->deleteImagePostTemp($compareArray);
            }
          }

          $_SESSION['flash']['success'] = "L 'article a bien été modifié !";
          echo json_encode($idPost);
          exit;
        } else {
          $_SESSION['flash']['danger'] = 'il manque un titre et/ou une description à votre fichier !';
          echo json_encode(false);
          exit;
        }
      } else {
        echo json_encode(false);
        exit;
      }


      var_dump($data, $title, $content);
      die();
    }
  }


  public function ajaxDeletePost()
  {

    if (!isLoggedIn()) {
      redirectWithoutTag('pages/connexion');
      exit;
    } else {

      $user = $_SESSION['data_user'];
      $data = json_decode(file_get_contents('php://input', true));
      $idPost = (int)$data;
      $userId = $user->{'id'};
      if ($user->{'role'} === 'ROLE_ADMIN' || $user->{'role'} === 'ROLE_SUBSCRIBER') {

        $existPost = $this->fileModel->getPostById($idPost);
        if ($existPost) {

          $this->fileModel->deletePostByIdFolAllUsers($idPost);
          $allContents = $this->folderModel->getAllPosts();

          $bigContentArray = [];
          foreach ($allContents as $allContent) {
            $bigContentArray[] = $allContent['content'];
          }

          $bigContentArrays = implode('', $bigContentArray);

          preg_match_all('/[[:alnum:]]{1,}\.[jpegn]{3,4}/', $bigContentArrays, $matches);
          $matches = array_unique(reset($matches));

          $allFileName = $this->fileModel->getAllPostsFilename();

          $arrayOfFilename = [];
          foreach ($allFileName as $bigArrayOfFilename) {
            $arrayOfFilename[] = $bigArrayOfFilename['image_filename'];
          }

          $compareArrays = array_diff($arrayOfFilename, $matches);

          if (!empty($compareArrays)) {
            foreach ($compareArrays as $compareArray) {
              unlink(PUBLICROOT . '/imgPost/' . $compareArray);
            }
            foreach ($compareArrays as $compareArray) {
              $this->folderModel->deleteImagePostTemp($compareArray);
            }
          }
          echo json_encode(true);
          exit;
        } else {
          echo json_encode(false);
          exit;
        }
      } else {
        echo json_encode(false);
        exit;
      }
    }
  }

  public function ajaxDeleteMultiPost()
  {
    if (!isLoggedIn()) {
      redirectWithoutTag('pages/connexion');
      exit;
    } else {

      $user = $_SESSION['data_user'];
      $userId = $user->{'id'};
      if (!empty($_POST['id'])) {
        if ($user->{'role'} === 'ROLE_ADMIN' || $user->{'role'} === 'ROLE_SUBSCRIBER') {

          $existPost = [];
          foreach ($_POST['id'] as $idPost) {
            $existPost[] = $this->fileModel->getPostById($idPost);
          }

          if (in_array(false, $existPost)) {
            $_SESSION['flash']['danger'] = "Opération non autorisé!";
            echo json_encode(true);
            exit;
          } else {
            foreach ($_POST['id'] as $idPost) {
              $this->fileModel->deletePostById($userId, $idPost);
            }

            $allContents = $this->folderModel->getAllPosts();

            $bigContentArray = [];
            foreach ($allContents as $allContent) {
              $bigContentArray[] = $allContent['content'];
            }

            $bigContentArrays = implode('', $bigContentArray);

            preg_match_all('/[[:alnum:]]{1,}\.[jpegn]{3,4}/', $bigContentArrays, $matches);
            $matches = array_unique(reset($matches));

            $allFileName = $this->fileModel->getAllPostsFilename();

            $arrayOfFilename = [];
            foreach ($allFileName as $bigArrayOfFilename) {
              $arrayOfFilename[] = $bigArrayOfFilename['image_filename'];
            }

            $compareArrays = array_diff($arrayOfFilename, $matches);

            if (!empty($compareArrays)) {
              foreach ($compareArrays as $compareArray) {
                unlink(PUBLICROOT . '/imgPost/' . $compareArray);
              }
              foreach ($compareArrays as $compareArray) {
                $this->folderModel->deleteImagePostTemp($compareArray);
              }
            }
            echo json_encode(true);
            exit;
          }
        } else {
          echo json_encode(false);
          exit;
        }
      } else {
        echo json_encode(false);
        exit;
      }
    }
  }

  public function viewAPost()
  {
    if (!isLoggedIn()) {
      redirectWithoutTag('pages/connexion');
      exit;
    } else {

      $user = $_SESSION['data_user'];
      if ($user->{'role'} === 'ROLE_ADMIN') {
        $data = json_decode(file_get_contents('php://input', true));
        $idPost = (int)$data;
        $existPost = $this->fileModel->getPostById($idPost);
        if ($existPost) {
          $ret = $this->fileModel->viewPostById($idPost);
          echo json_encode($ret);
          exit;
        } else {
          echo json_encode(false);
          exit;
        }
      } else {
        echo json_encode(false);
        exit;
      }
    }
  }

  public function ajaxAddPostNotification()
  {

    if (!isLoggedIn()) {
      redirectWithoutTag('pages/connexion');
      exit;
    } else {
      $user = $_SESSION['data_user'];
      $userId = (int)$user->{'id'};

      if (isset($_POST["view"])) {
        $postNotSeen = $this->fileModel->getPostsNotSeen($userId);
        if ($postNotSeen) {

          $postNotSeenCount = $this->fileModel->getPostsNotSeenCount($userId);
          $data = [
            'unseen_post_notification' => $postNotSeenCount
          ];
          echo json_encode($data);
        } else {
          $data = [
            'unseen_post_notification' => 0
          ];
          echo json_encode($data);
        }
      }
    }
  }

  public function ajaxAddFileNotification()
  {

    if (!isLoggedIn()) {
      redirectWithoutTag('pages/connexion');
      exit;
    } else {
      $user = $_SESSION['data_user'];
      $userId = (int)$user->{'id'};

      if (isset($_POST["view"])) {
        $fileNotSeen = $this->fileModel->getFilesNotSeen($userId);

        if ($fileNotSeen) {
          $fileNotSeenCount = $this->fileModel->getFilesNotSeenCount($userId);
          $data = [
            'unseen_file_notification' =>  $fileNotSeenCount
          ];
          echo json_encode($data);
        } else {
          $data = [
            'unseen_file_notification' =>  0
          ];
          echo json_encode($data);
        }
      }
    }
  }

  public function ajaxAddCheckupNotification()
  {

    if (!isLoggedIn()) {
      redirectWithoutTag('pages/connexion');
      exit;
    } else {
      $user = $_SESSION['data_user'];
      $userId = (int)$user->{'id'};

      if (isset($_POST["view"])) {
        $checkupFileNotSeen = $this->fileModel->getCheckupFilesNotSeen($userId);

        if ($checkupFileNotSeen) {
          $checkupFileNotSeenCount = $this->fileModel->getCheckupFilesNotSeenCount($userId);
          $data = [
            'unseen_checkup_notification' =>  $checkupFileNotSeenCount
          ];
          echo json_encode($data);
        } else {
          echo json_encode(false);
        }
      }
    }
  }

  public function ajaxChangeColorFolderBadge()
  {

    if (!isLoggedIn()) {
      redirectWithoutTag('pages/connexion');
      exit;
    } else {
      $user = $_SESSION['data_user'];
      $userId = (int)$user->{'id'};

      if (isset($_POST["view"])) {
        $arrayNumberFolder = $_POST['view'];
        $arrayTestExistNumberFolder = [];
        foreach ($arrayNumberFolder as $numberFolder) {
          $boolTestFolderStatus = $this->fileModel->getFilesStatusByFolderId($numberFolder, $userId);

          if ($boolTestFolderStatus) {
            $arrayTestExistNumberFolder[$numberFolder] = true;
          } else {
            $arrayTestExistNumberFolder[$numberFolder] = false;
          }
        }
        echo json_encode($arrayTestExistNumberFolder);
        exit;
      }
    }
  }

  public function ajaxChangeColorFileBadge()
  {

    if (!isLoggedIn()) {
      redirectWithoutTag('pages/connexion');
      exit;
    } else {
      $user = $_SESSION['data_user'];
      $userId = (int)$user->{'id'};

      if (isset($_POST["view"])) {
        $arrayNumberFile = (int)$_POST['view'];

        $existFile = $this->fileModel->getFileByIdFile($arrayNumberFile);

        if ($existFile) {
          echo json_encode(true);
          exit;
        } else {
          echo json_encode(false);
          exit;
        }
      }
    }
  }
}
