<?php

class AdminManager
{
  private $db;

  public function __construct()
  {
    $this->db =  new Database();
  }

  public function getListUsers()
  {
    $this->db->query('SELECT name, firstname, mail, role FROM user ORDER BY id DESC');
    return $this->db->resultSetAssoc();
  }

  public function getListSites($userId)
  {
    $this->db->query('SELECT * FROM sites WHERE user_id = :userId ORDER BY name ASC');
    $this->db->bind(':userId', $userId, PDO::PARAM_INT);
    return $this->db->resultSetAssoc();
  }

  public function updateSites($siteId, $name, $input, $userId)
  {
    $this->db->query('UPDATE sites SET ' . $name . ' = :input WHERE id = :siteId AND user_id: :userId');
    $this->db->bind(':siteId', $siteId, PDO::PARAM_INT);
    $this->db->bind(':input', $input, PDO::PARAM_STR);
    $this->db->bind(':userId', $userId, PDO::PARAM_INT);

    return $this->db->execute();
  }

  public function updateSiteAsAdmin($siteId, $name, $input, $userId, $notif)
  {
    $this->db->query('UPDATE sites SET ' . $name . ' = :input, notif = :notif WHERE name = ( SELECT * FROM (SELECT name FROM sites WHERE id = ' . $siteId . ' AND user_id = ' . $userId . ')tblTmp)');
    $this->db->bind(':input', $input, PDO::PARAM_STR);
    $this->db->bind(':notif', $notif, PDO::PARAM_int);
    $this->db->execute();
  }


  public function addSite($name, $href, $description, $userId, $notif)
  {
    $this->db->query('INSERT INTO sites (name, href, description, user_id, notif) VALUES (:name,:href,:description, :userId, :notif)');
    $this->db->bind(':name', $name, PDO::PARAM_STR);
    $this->db->bind(':href', $href, PDO::PARAM_STR);
    $this->db->bind(':userId', $userId, PDO::PARAM_INT);
    $this->db->bind(':description', $description, PDO::PARAM_STR);
    $this->db->bind(':notif', $notif, PDO::PARAM_INT);

    return $this->db->execute();
  }

  public function addFicheToDailyEmail($title)
  {
    $this->db->query('INSERT INTO dailyEmail (title) VALUES (:title)');
    $this->db->bind(':title', $title, PDO::PARAM_STR);
    $this->db->execute();
  }

  public function emptyDailyEmail()
  {
    $this->db->query('DELETE FROM dailyEmail');
    $this->db->execute();
  }

  public function getFicheForDailyEmail()
  {
    $this->db->query("SELECT title
                                   FROM dailyEmail
                                   ");
    return $this->db->resultSetAssoc();
  }


  public function getUsersEmailList()
  {
    $this->db->query('SELECT mail FROM user');
    return $this->db->resultSetAssoc();
  }

  public function getNonSubscribersEmailList()
  {
    $this->db->query('SELECT mail FROM user WHERE NOT role = "ROLE_SUBSCRIBER"');
    return $this->db->resultSetAssoc();
  }


  public function getSubscribersEmailList()
  {
    $this->db->query('SELECT mail FROM user WHERE NOT role = "ROLE_USER"');
    return $this->db->resultSetAssoc();
  }

  public function getUsersId()
  {
    $this->db->query('SELECT id FROM user');
    return $this->db->resultSetObj();
  }

  public function removeNotifSites($userId)
  {

    $this->db->query('UPDATE sites SET notif = 0 WHERE notif = 1 and user_id = :userId');
    $this->db->bind(':userId', $userId, PDO::PARAM_INT);
    return $this->db->execute();
  }

  public function deleteSite($siteId, $userId)
  {
    $this->db->query('DELETE FROM sites WHERE id = :siteId AND user_id = :userId');
    $this->db->bind(':siteId', $siteId, PDO::PARAM_INT);
    $this->db->bind(':userId', $userId, PDO::PARAM_INT);

    return $this->db->execute();
  }

  public function deleteSiteAsAdmin($siteId)
  {
    $this->db->query('DELETE FROM 
                              sites 
                          WHERE 
                            name = ( 
                            SELECT * FROM (
                                 SELECT name FROM sites WHERE id = :siteId
                            )tblTmp)
                          ');
    $this->db->bind(':siteId', $siteId, PDO::PARAM_INT);
    return $this->db->execute();
  }

  public function copyAdminSitesData($newUserId)
  {
    $this->db->query('
               INSERT INTO sites (user_id, name, href, description, notif)
                SELECT
                  :newUserId, name, href, description, :notif
                FROM
                  sites
                WHERE
                  user_id = 5
            ');
    $this->db->bind(':newUserId', $newUserId, PDO::PARAM_INT);
    $this->db->bind(':notif', 0, PDO::PARAM_INT);
    $this->db->execute();
  }

  public function copyAdminArticlesData($newUserId)
  {
    $this->db->query('
               INSERT INTO post (userId, title, content, status, notif, date)
                SELECT
                  :newUserId, title, content, 0, :notif, date
                FROM
                  post
                WHERE
                  userId = 5
            ');
    $this->db->bind(':newUserId', $newUserId, PDO::PARAM_INT);
    $this->db->bind(':notif', 0, PDO::PARAM_INT);
    $this->db->execute();
  }
}
