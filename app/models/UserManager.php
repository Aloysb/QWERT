<?php


class UserManager
{
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }



  public function checkMail($mail)
  {
    $this->db->query('SELECT id FROM user WHERE mail = :mail');
    $this->db->bind(':mail', $mail, PDO::PARAM_STR);
    return $this->db->resultBool();
  }

  public function checkLogin($login)
  {
    $this->db->query('SELECT id FROM user WHERE login = :login');
    $this->db->bind(':login', $login, PDO::PARAM_STR);
    return $this->db->resultBool();
  }

  public function create($form)
  {
    $avatar = ($form['sex'] == 'H') ? 'service.png' : 'serviceF.png';
    $this->db->query('INSERT INTO user( name,firstname,mail,login,password,confirmation_token,role,avatar,subscription,birth_date,sex,ecn_year,ecn_place,ecn_school,status)
                          VALUES( :name,:firstName,:mail,:login,:password,:confirmation_token,:role,:avatar,:subscription,:birth_date,:sex,:ecn_year,:ecn_place,:ecn_school,:status)');
    $this->db->bind(':name', $form["name"], PDO::PARAM_STR);
    $this->db->bind(':firstName', $form["firstName"], PDO::PARAM_STR);
    $this->db->bind(':mail', $form["mail"], PDO::PARAM_STR);
    $this->db->bind(':login', $form["login"], PDO::PARAM_STR);
    $this->db->bind(':password', $form["password"], PDO::PARAM_STR);
    $this->db->bind(':confirmation_token', $form["token"], PDO::PARAM_STR);
    $this->db->bind(':role', 'ROLE_USER', PDO::PARAM_STR);
    $this->db->bind(':avatar', $avatar, PDO::PARAM_STR);
    $this->db->bind(':birth_date', $form["birth_date"], PDO::PARAM_STR);
    $this->db->bind(':subscription', 0, PDO::PARAM_INT);
    $this->db->bind(':sex', $form["sex"], PDO::PARAM_STR);
    $this->db->bind(':ecn_year', $form["ecn_year"], PDO::PARAM_INT);
    $this->db->bind(':ecn_place', $form["ecn_place"], PDO::PARAM_INT);
    $this->db->bind(':ecn_school', $form["ecn_school"], PDO::PARAM_STR);
    $this->db->bind(':status', $form["status"], PDO::PARAM_STR);
    $this->db->execute();
  }

  public function createPro($form)
  {
    $avatar = ($form['sex'] == 'H') ? 'service.png' : 'serviceF.png';
    $this->db->query('INSERT INTO user( id, name,firstname,mail,login,password,confirmation_token,role,avatar,subscription,birth_date,sex,ecn_year,ecn_place,ecn_school,status)
                          VALUES( 1,:name,:firstName,:mail,:login,:password,:confirmation_token,:role,:avatar,:subscription,:birth_date,:sex,:ecn_year,:ecn_place,:ecn_school,:status)');
    $this->db->bind(':name', $form["name"], PDO::PARAM_STR);
    $this->db->bind(':firstName', $form["firstName"], PDO::PARAM_STR);
    $this->db->bind(':mail', $form["mail"], PDO::PARAM_STR);
    $this->db->bind(':login', $form["login"], PDO::PARAM_STR);
    $this->db->bind(':password', $form["password"], PDO::PARAM_STR);
    $this->db->bind(':confirmation_token', $form["token"], PDO::PARAM_STR);
    $this->db->bind(':role', 'ROLE_USER', PDO::PARAM_STR);
    $this->db->bind(':avatar', $avatar, PDO::PARAM_STR);
    $this->db->bind(':birth_date', $form["birth_date"], PDO::PARAM_STR);
    $this->db->bind(':subscription', 0, PDO::PARAM_INT);
    $this->db->bind(':sex', $form["sex"], PDO::PARAM_STR);
    $this->db->bind(':ecn_year', $form["ecn_year"], PDO::PARAM_INT);
    $this->db->bind(':ecn_place', $form["ecn_place"], PDO::PARAM_INT);
    $this->db->bind(':ecn_school', $form["ecn_school"], PDO::PARAM_STR);
    $this->db->bind(':status', $form["status"], PDO::PARAM_STR);
    $this->db->execute();
  }

  public function updateUser($id, $form)
  {
    $this->db->query('UPDATE user
                          SET birth_date = :birth_date,
                              sex = :sex,
                              ecn_year = :ecn_year,
                              ecn_place = :ecn_place,
                              ecn_school = :ecn_school,
                              status = :status
                          WHERE id = :id
                          ');
    $this->db->bind(':id', $id, PDO::PARAM_INT);
    $this->db->bind(':birth_date', $form["birth_date"], PDO::PARAM_STR);
    $this->db->bind(':sex', $form["sex"], PDO::PARAM_STR);
    $this->db->bind(':ecn_year', $form["ecn_year"], PDO::PARAM_INT);
    $this->db->bind(':ecn_place', $form["ecn_place"], PDO::PARAM_INT);
    $this->db->bind(':ecn_school', $form["ecn_school"], PDO::PARAM_STR);
    $this->db->bind(':status', $form["status"], PDO::PARAM_STR);
    $this->db->execute();
  }

  public function update($id)
  {
    $this->db->query('UPDATE user SET confirmation_token = null, confirmed_at = NOW() WHERE id = :id');
    $this->db->bind(':id', $id, PDO::PARAM_INT);
    $this->db->execute();
  }

  public function getId()
  {
    return $this->db->lastId();
  }

  public function getUserById($id)
  {
    $this->db->query('SELECT * FROM user WHERE id = :id');
    $this->db->bind(':id', $id, PDO::PARAM_INT);
    return $this->db->resultSetObj();
  }

  public function getIdByEmail($email)
  {
    $this->db->query('SELECT id FROM user WHERE mail = :mail');
    $this->db->bind(':mail', $email, PDO::PARAM_STR);
    return $this->db->single();
  }


  public function getUserByEmail($email)
  {
    $this->db->query('SELECT * FROM user WHERE mail = :mail');
    $this->db->bind(':mail', $email, PDO::PARAM_STR);
    return $this->db->resultSetObj();
  }

  public function getUserByIdAndToken($id, $token)
  {
    $this->db->query('SELECT * FROM pswdReset WHERE user_id = :id AND confirmation_token = :token ');
    $this->db->bind(':id', $id, PDO::PARAM_INT);
    $this->db->bind(':token', $token, PDO::PARAM_STR);
    return $this->db->resultSetObj();
  }


  public function createPswdReset($id, $token)
  {
    $this->db->query('INSERT INTO pswdReset(user_id, confirmation_token) VALUES (:user_id, :token)');
    $this->db->bind(':user_id', $id, PDO::PARAM_INT);
    $this->db->bind(':token', $token, PDO::PARAM_STR);
    $this->db->execute();
  }


  public function getPswdResetIdByUserId($id)
  {
    $this->db->query('SELECT id FROM pswdReset WHERE user_id = :id');
    $this->db->bind(':id', $id, PDO::PARAM_INT);
    return $this->db->single();
  }

  public function getConfirmationTokenByPswdResetId($id)
  {
    $this->db->query('SELECT confirmation_token FROM pswdReset WHERE id = :id');
    $this->db->bind(':id', $id, PDO::PARAM_INT);
    return $this->db->single();
  }

  public function updatePswdReset($id)
  {
    $this->db->query('UPDATE pswdReset SET confirmation_token = null, confirmed_at = NOW() WHERE id = :id ');
    $this->db->bind(':id', $id, PDO::PARAM_INT);
    $this->db->execute();
  }

  public function deleteRowPswdReset($id)
  {
    $this->db->query('DELETE FROM pswdReset WHERE user_id = :id ');
    $this->db->bind(':id', $id, PDO::PARAM_INT);
    $this->db->execute();
  }

  public function updatePasswordAndPswdReset($userId, $password)
  {
    $this->db->query(
      'UPDATE pswdReset p
            LEFT JOIN user u
            ON p.user_id = u.id
            SET  p.confirmation_token = null , p.confirmed_at = NOW(), u.password = :password
            WHERE p.user_id = :user_id'
    );
    $this->db->bind(':user_id', $userId, PDO::PARAM_INT);
    $this->db->bind(':password', $password, PDO::PARAM_STR);
    $this->db->execute();
  }

  public function insertAccountingData($form)
  {
    $this->db->query('INSERT INTO accounting (dateAccounting, drReplace, totalOfDay, retro,
         tRetro, comment, userId) VALUES (:dateAccounting, :drReplace, :totalOfDay, :retro, :tRetro,
         :comment, :userId)');
    $this->db->bind(':dateAccounting', $form['dateAccounting'], PDO::PARAM_STR);
    $this->db->bind(':drReplace', $form['doctorReplace'], PDO::PARAM_STR);
    $this->db->bind(':totalOfDay', $form['totalOfDay'], PDO::PARAM_INT);
    $this->db->bind(':retro', $form['retrocession'], PDO::PARAM_INT);
    $this->db->bind(':tRetro', $form['totalRetrocession'], PDO::PARAM_INT);
    $this->db->bind(':comment', $form['comments'], PDO::PARAM_STR);
    $this->db->bind(':userId', $form['userId'], PDO::PARAM_INT);
    $this->db->execute();
  }

  public function getAccountingDataByUserId($id)
  {
    $this->db->query('SELECT * FROM accounting WHERE userId = :userId');
    $this->db->bind(':userId', $id, PDO::PARAM_INT);
    return $this->db->resultSetObj();
  }

  public function getRowByIdAndUserId($rowId, $userId)
  {
    $this->db->query('SELECT * FROM accounting WHERE id = :rowId AND userId = :userId');
    $this->db->bind(':rowId', $rowId, PDO::PARAM_INT);
    $this->db->bind(':userId', $userId, PDO::PARAM_INT);
    return $this->db->resultBool();
  }

  public function deleteRowByIdAndUserId($rowId, $userId)
  {
    $this->db->query('DELETE FROM accounting WHERE id = :rowId AND userId = :userId');
    $this->db->bind(':rowId', $rowId, PDO::PARAM_INT);
    $this->db->bind(':userId', $userId, PDO::PARAM_INT);
    $this->db->execute();
  }

  public function updateRowByIdAndUserId($rowId, $userId, $form)
  {
    $this->db->query('UPDATE accounting 
                            SET dateAccounting = :dateAccounting,
                                drReplace = :drReplace,
                                totalOfDay = :totalOfDay,
                                retro = :retro,
                                tRetro = :tRetro,
                                comment = :comment
                            WHERE id = :rowId 
                            AND userId = :userId');
    $this->db->bind(':dateAccounting', $form['dateAccounting'], PDO::PARAM_STR);
    $this->db->bind(':drReplace', $form['doctorReplace'], PDO::PARAM_STR);
    $this->db->bind(':totalOfDay', $form['totalOfDay'], PDO::PARAM_INT);
    $this->db->bind(':retro', $form['retrocession'], PDO::PARAM_INT);
    $this->db->bind(':tRetro', $form['totalRetrocession'], PDO::PARAM_INT);
    $this->db->bind(':comment', $form['comments'], PDO::PARAM_STR);
    $this->db->bind(':rowId', $rowId, PDO::PARAM_INT);
    $this->db->bind(':userId', $userId, PDO::PARAM_INT);
    $this->db->execute();
  }

  public function SearchDataOfUserByMonth($userId, $month)
  {
    $this->db->query('SELECT * 
                            FROM accounting
                             WHERE userId = :userId
                              AND MONTH(dateAccounting) = :dateAccounting');
    $this->db->bind(':userId', $userId, PDO::PARAM_INT);
    $this->db->bind(':dateAccounting', $month, PDO::PARAM_STR);
    return $this->db->resultSetObj();
  }

  public function insertAvatarById($userId, $image_path)
  {
    $this->db->query('UPDATE user SET avatar = :avatar WHERE id = :id');
    $this->db->bind(':id', $userId, PDO::PARAM_INT);
    $this->db->bind(':avatar', $image_path, PDO::PARAM_STR);
    $this->db->execute();
  }

  public function updateAvatarById($userId, $image_path)
  {
    $this->db->query('UPDATE user SET avatar = :avatar WHERE id = :id');
    $this->db->bind(':id', $userId, PDO::PARAM_INT);
    $this->db->bind(':avatar', $image_path, PDO::PARAM_STR);
    $this->db->execute();
  }

  public function updateProfileById($userId, $data)
  {
    $this->db->query('UPDATE user SET name = :name, firstname = :firstName, login = :login, sex = :sex, ecn_year = :ecn_year, ecn_school = :ecn_school, ecn_place = :ecn_place, status = :status, birth_date = :birth_date WHERE id = :id');
    $this->db->bind(':id', $userId, PDO::PARAM_INT);
    $this->db->bind(':firstName', $data['firstName'], PDO::PARAM_STR);
    $this->db->bind(':name', $data['name'], PDO::PARAM_STR);
    $this->db->bind(':login', $data['login'], PDO::PARAM_STR);
    $this->db->bind(':sex', $data['sex'], PDO::PARAM_STR);
    $this->db->bind(':ecn_year', $data['ecn_year'], PDO::PARAM_INT);
    $this->db->bind(':ecn_place', $data['ecn_place'], PDO::PARAM_INT);
    $this->db->bind(':ecn_school', $data['ecn_school'], PDO::PARAM_STR);
    $this->db->bind(':status', $data['status'], PDO::PARAM_STR);
    $this->db->bind(':birth_date', $data['birth_date'], PDO::PARAM_STR);

    $this->db->execute();
  }

  public function  updateUserByNewPassword($userId, $passwordHash)
  {
    $this->db->query('UPDATE user SET password = :password WHERE id = :id');
    $this->db->bind(':id', $userId, PDO::PARAM_INT);
    $this->db->bind(':password', $passwordHash, PDO::PARAM_STR);
    $this->db->execute();
  }

  public function updateCustomerIdById($userId, $customerId)
  {
    $this->db->query('UPDATE user SET customer_id = :customerId WHERE id = :id');
    $this->db->bind(':id', $userId, PDO::PARAM_INT);
    $this->db->bind(':customerId', $customerId, PDO::PARAM_STR);
    $this->db->execute();
  }


  public function updateSubscribeByCustomerId($customerId)
  {
    $this->db->query('UPDATE user SET role = :role, subscription = 1 WHERE customer_id = :customerId');
    $this->db->bind(':customerId', $customerId, PDO::PARAM_STR);
    $this->db->bind(':role', 'ROLE_SUBSCRIBER', PDO::PARAM_STR);
    return $this->db->execute();
  }

  public function resetCustomerIdByUserId($userId)
  {
    $this->db->query('UPDATE user SET role = :role, subscription = 0, customer_id = NULL  WHERE id=:id');
    $this->db->bind(':id', $userId, PDO::PARAM_INT);
    $this->db->bind(':role', 'ROLE_USER', PDO::PARAM_STR);
    $this->db->execute();
  }

  public function resetCustomerIdById($customer_id)
  {
    $this->db->query('UPDATE user SET role = :role, subscription = 0, customer_id = NULL  WHERE customer_id=:customer_id');
    $this->db->bind(':customer_id', $customer_id, PDO::PARAM_INT);
    $this->db->bind(':role', 'ROLE_USER', PDO::PARAM_STR);
    $this->db->execute();
  }

  public function getCustomerIdById($userId)
  {
    $this->db->query('SELECT customer_id FROM user WHERE id = :id');
    $this->db->bind(':id', $userId, PDO::PARAM_INT);
    return $this->db->resultSetObj();
  }
  // STRIPE

  public function sessionStripe($currentPage)
  {

    if (!isLoggedIn()) {
      $_SESSION['flash']['success'] = "Merci de bien vouloir vous inscrire en premier lieu.";
      redirectWithoutTag('pages/inscription');
    } else {

      // Set your secret key. Remember to switch to your live secret key in production!
      // See your keys here: https://dashboard.stripe.com/account/apikeys
      


      $userId = (int)$_SESSION['data_user']->{'id'};
      $user = $this->getUserById($userId)[0];

      if (!$user->{'customer_id'}) {
        $customer = \Stripe\Customer::create([
          'email' => $user->{'mail'},
          'name' => $user->{'name'} . ' ' . $user->{'firstname'},
        ]);
        $this->updateCustomerIdById($userId, $customer->{'id'});
      } else {
        $customer = \Stripe\Customer::retrieve($user->{'customer_id'});
      }

      $session = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card'],
        'locale' => 'fr',
        'customer' => $customer,
        'line_items' => [[
          'price' => 'price_1HUwx7FkUJgkN5qoeC1d8jS6',
          'quantity' => 1,
        ]],
        'subscription_data' => [
          //OR trial_period_days = 360 if first year.
          'trial_from_plan' => true,
        ],
        'mode' => 'subscription',
        'success_url' => 'https://www.doctofiche.fr/pages/fiche',
        'cancel_url' => $currentPage,
      ]);

      $data = ['session' => json_encode($session), 'customer' => json_encode($customer)];

      return $data;
    }
  }

  public function sessionStripeFirstYear($currentPage)
  {

    if (!isLoggedIn()) {
      $_SESSION['flash']['success'] = "Merci de bien vouloir vous inscrire en premier lieu.";
      redirectWithoutTag('pages/inscription');
    } else {

      // Set your secret key. Remember to switch to your live secret key in production!
      // See your keys here: https://dashboard.stripe.com/account/apikeys
      \Stripe\Stripe::setApiKey


      $userId = (int)$_SESSION['data_user']->{'id'};
      $user = $this->getUserById($userId)[0];

      if (!$user->{'customer_id'}) {
        $customer = \Stripe\Customer::create([
          'email' => $user->{'mail'},
          'name' => $user->{'name'} . ' ' . $user->{'firstname'},
        ]);
        $this->updateCustomerIdById($userId, $customer->{'id'});
      } else {
        $customer = \Stripe\Customer::retrieve($user->{'customer_id'});
      }

      $session = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card'],
        'locale' => 'fr',
        'customer' => $customer,
        'line_items' => [[
          'price' => 'price_1HUwx7FkUJgkN5qo2NLwzwOF',
          'quantity' => 1,
        ]],
        'subscription_data' => [
          'trial_period_days' => 365
          // 'trial_from_plan' => true,
        ],
        'mode' => 'subscription',
        'success_url' => 'https://www.doctofiche.fr/pages/confirmationSubscription',
        'cancel_url' => $currentPage,
      ]);

      $data = ['session' => json_encode($session), 'customer' => json_encode($customer)];

      return $data;
    }
  }

  public function sessionStripePro($currentPage, $name, $firstName, $mail)
  {
    // Set your secret key. Remember to switch to your live secret key in production!
    // See your keys here: https://dashboard.stripe.com/account/apikeys
    // \Stripe\Stripe::setApiKey('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');
    \Stripe\Stripe::setApiKe


    $userId = 1;

    $customer = \Stripe\Customer::create([
      'email' => $mail,
      'name' => $firstName
    ]);
    $this->updateCustomerIdById($userId, $customer->{'id'});

    $session = \Stripe\Checkout\Session::create([
      'payment_method_types' => ['card'],
      'locale' => 'fr',
      'customer' => $customer,
      'line_items' => [[
        'price' => 'price_1HTRoKFkUJgkN5qopYnbtqeO',
        // 'price' => 'price_1HUwx7FkUJgkN5qoeC1d8jS6',
        'quantity' => 1,
      ]],
      'subscription_data' => [
        //OR trial_period_days = 360 if first year.
        'trial_from_plan' => true,
      ],
      'mode' => 'subscription',
      'success_url' => $currentPage,
      'cancel_url' => 'https://localhost:8888/pages/',
    ]);

    $data = ['session' => json_encode($session), 'customer' => json_encode($customer)];

    return $data;
  }
}
