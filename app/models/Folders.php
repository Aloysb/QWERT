<?php

    class Folders
    {
        private $db;

        public function __construct()
        {
            $this->db = new Database();
        }

        public function getFolders($userId)
        {
            $this->db->query( "SELECT m.id,m.notif,m.title,m.user_id,m.admin_medicalFolder_id,
                                  COUNT(f.medicalFolder_id) AS num_files
                                  FROM medicalFolder m 
                                  LEFT JOIN medicalFile f 
                                    ON f.medicalFolder_id = m.id 
                                    WHERE m.user_id = :user_id AND m.category = 'form'
                                  GROUP BY m.id ORDER BY m.title ASC
                                   ");
            $this->db->bind(':user_id',$userId);                   
            return $this->db->resultSetObj();
        }

        public function getFoldersByExamCategory($userId)
        {
            $this->db->query( "SELECT m.id,m.title,m.user_id,m.admin_medicalFolder_id,m.notif,
                                  COUNT(f.medicalFolder_id) AS num_files
                                  FROM medicalFolder m 
                                  LEFT JOIN medicalFile f 
                                    ON f.medicalFolder_id = m.id 
                                    WHERE m.user_id = :user_id AND m.category = 'complementary-exam'
                                  GROUP BY m.id ORDER BY m.title ASC
                                   ");
            $this->db->bind(':user_id',$userId);                   
            return $this->db->resultSetObj();
        }

        public function getFoldersByDrugCategory($userId)
        {
            $this->db->query( "SELECT m.id,m.title,m.user_id,m.admin_medicalFolder_id,m.notif,
                                  COUNT(f.medicalFolder_id) AS num_files
                                  FROM medicalFolder m 
                                  LEFT JOIN medicalFile f 
                                    ON f.medicalFolder_id = m.id 
                                    WHERE m.user_id = :user_id AND m.category = 'drug'
                                  GROUP BY m.id ORDER BY m.title ASC
                                   ");
            $this->db->bind(':user_id',$userId);                   
            return $this->db->resultSetObj();
        }

        public function getFoldersByAdviceCategory($userId)
        {
            $this->db->query( "SELECT m.id,m.title,m.user_id,m.admin_medicalFolder_id, m.notif,
                                  COUNT(f.medicalFolder_id) AS num_files
                                  FROM medicalFolder m 
                                  LEFT JOIN medicalFile f 
                                    ON f.medicalFolder_id = m.id 
                                    WHERE m.user_id = :user_id AND m.category = 'advice'
                                  GROUP BY m.id ORDER BY m.title ASC
                                   ");
            $this->db->bind(':user_id',$userId);                   
            return $this->db->resultSetObj();
        }

        public function getFiles($idFolder)
        {
            $this->db->query("SELECT *
                                   FROM medicalFile
                                   WHERE medicalFolder_id = :idFolder ORDER BY title ASC
                                   ");
            $this->db->bind(':idFolder',$idFolder);
            return $this->db->resultSetObj();
        }

        public function getFilesAndNumberByFolderId()
        {
            $this->db->query("SELECT f.id, f.title, f.description, f.medicalFolder_id                              
                                   /*COUNT(f.medicalFolder_id) AS num_files*/
                                   FROM medicalFile f
                                   RIGHT JOIN medicalFolder m
                                   ON f.medicalFolder_id = m.id 
                                   ");
            return $this->db->resultSetAssoc();
        }

        public function addAFolderByCategory($userId,$folder,$category)
        {
            $this->db->query('INSERT INTO medicalFolder (title, category, user_id) VALUES (:title, :category, :user_id)');
            $this->db->bind(':title',$folder,PDO::PARAM_STR);
            $this->db->bind(':category',$category,PDO::PARAM_STR);
            $this->db->bind(':user_id',$userId,PDO::PARAM_INT);
            $this->db->execute();
            return $this->db->lastId();
        }

        public function addAFolderByCategoryForAllUsers($idFolder,$folder,$category)
        {
            $this->db->query('INSERT INTO medicalFolder (user_id,title, category,admin_medicalFolder_id)
                              SELECT id,:title,:category,:admin_medicalFolder_id
                              FROM user 
                              WHERE id <> 5');
            $this->db->bind(':title',$folder,PDO::PARAM_STR);
            $this->db->bind(':category',$category,PDO::PARAM_STR);
            $this->db->bind(':admin_medicalFolder_id',$idFolder,PDO::PARAM_INT);
            return $this->db->execute();
        }

        public function checkFolderExistForUser($id,$userId)
        {
            $this->db->query('SELECT COUNT(*) FROM medicalFolder WHERE id = :id AND user_id = :user_id');
            $this->db->bind(':id',$id,PDO::PARAM_INT);
            $this->db->bind(':user_id',$userId,PDO::PARAM_INT);
            return $this->db->numberLine();
        }

        public function addFile($title,$description,$idFolder)
        {
            $this->db->query('INSERT INTO medicalFile (title,description,medicalFolder_id,tracker, status, notif) VALUES (:title,:description,:idFolder,:tracker, 1, 0)');
            $this->db->bind(':title',$title,PDO::PARAM_STR);
            $this->db->bind(':description',$description,PDO::PARAM_STR);
            $this->db->bind(':idFolder',$idFolder,PDO::PARAM_INT);
            $this->db->bind(':tracker',1,PDO::PARAM_INT);
            $this->db->execute();
            return (int)$this->db->lastId();
        }


        public function addFileForAllUsers($title,$description,$idFolder)
        {
            $this->db->query('INSERT INTO medicalFile (medicalFolder_id,title, description, notif )
                              SELECT id,:title,:description, 1
                              FROM medicalFolder  WHERE admin_medicalFolder_id = :medicalFolder_id OR id = :medicalFolder_id');
            $this->db->bind(':title',$title,PDO::PARAM_STR);
            $this->db->bind(':description',$description,PDO::PARAM_STR);
            $this->db->bind(':medicalFolder_id',$idFolder,PDO::PARAM_INT);
            $this->db->execute();
             return (int)$this->db->lastId();
        }

          public function getFolderAdminId($idFolder){
            $this->db->query('SELECT id FROM medicalFolder WHERE id = :medicalFolder_id');
            $this->db->bind(':medicalFolder_id',$idFolder,PDO::PARAM_INT);
            $this->db->execute();
            return $this->db->resultSetAssoc();
        }

        public function setAllNotifFoldersToFalse($userId){
            $this->db->query('UPDATE medicalFolder SET notif = 0 WHERE user_id = :userId');
            $this->db->bind(':userId', $userId, PDO::PARAM_INT);
            $this->db->execute();
        }

                public function setAllNotifFilesToFalse($userId){
            $this->db->query('UPDATE medicalFile SET notif = 0 WHERE medicalFolder_id IN (SELECT id FROM medicalFolder WHERE user_id = :userId )');
            $this->db->bind(':userId', $userId, PDO::PARAM_INT);
            $this->db->execute();
        }


        public function updateFolderNotifForAllUsers($idFolder){
            $this->db->query('UPDATE medicalFolder SET notif = 1 WHERE id = :medicalFolder_id OR admin_medicalFolder_id = :medicalFolder_id');
            $this->db->bind(':medicalFolder_id',$idFolder,PDO::PARAM_INT);
            $this->db->execute();
        }

        public function addFileImage($imageName,$idFolder)
        {
           $this->db->query('INSERT INTO medicalFile (imageName,medicalFolder_id) VALUES (:imageName,:idFolder)');
           $this->db->bind(':imageName',$imageName,PDO::PARAM_STR);
           $this->db->bind(':idFolder',$idFolder,PDO::PARAM_INT);
           $this->db->execute();
        }
        
        public function deleteImageTemp($compareArray)
        {
            $this->db->query('DELETE FROM imageTemp
                               WHERE image_filename = :image_filename');
            $this->db->bind(':image_filename', $compareArray, PDO::PARAM_STR);
            return $this->db->execute();
        }

        public function getAllContentByFolderId($id)
        {
            $this->db->query('SELECT description FROM medicalFile WHERE medicalFolder_id = :medicalFolder_id');
            $this->db->bind(':medicalFolder_id', $id, PDO::PARAM_INT);
            return $this->db->resultSetAssoc();
        }

        public function deleteAFolderByUserId($userId,$idFolder)
        {
            $this->db->query("DELETE  p,m
                              FROM  medicalFolder AS  p
                              LEFT JOIN medicalFile AS m
                              ON p.id = m.medicalFolder_id
                              WHERE m.medicalFolder_id = :medicalFolder_id  AND p.user_id = :userId");
            $this->db->bind(':userId', $userId, PDO::PARAM_INT);
            $this->db->bind(':medicalFolder_id', $idFolder, PDO::PARAM_INT);
            return $this->db->execute();
        }

        public function deleteAFolderWithoutFilesByUserId($userId,$idFolder)
        {
            $this->db->query("DELETE 
                              FROM  medicalFolder 
                              WHERE id = :id  AND user_id = :userId");
            $this->db->bind(':userId', $userId, PDO::PARAM_INT);
            $this->db->bind(':id', $idFolder, PDO::PARAM_INT);
            return $this->db->execute();
        }

        public function updateAFolderByUserId($userId,$idFolder,$valueData)
        {
            $this->db->query('UPDATE medicalFolder SET title = :title WHERE user_id = :user_id AND id =:id');
            $this->db->bind(':title', $valueData,PDO::PARAM_STR);
            $this->db->bind(':user_id', $userId,PDO::PARAM_INT);
            $this->db->bind(':id', $idFolder,PDO::PARAM_INT);       
            return $this->db->execute();
        }

        public function checkRoleOfUser($userId)
        {
            $this->db->query('SELECT role FROM user WHERE id = :id'); 
            $this->db->bind(':id', $userId,PDO::PARAM_INT);       
            return $this->db->resultSetObj();
        }

        public function moveFileByIdToFolderById($fileId, $folderId){
             $this->db->query('UPDATE medicalFile SET medicalFolder_id = :folderId WHERE id = :fileId');
             $this->db->bind(':fileId', $fileId,PDO::PARAM_INT);
            $this->db->bind(':folderId', $folderId,PDO::PARAM_INT);
            $this->db->execute();
        }

        public function removeNotificationFromFolderId($folderId){
            $this->db->query('UPDATE medicalFolder SET notif = 0 WHERE id = :id');
            $this->db->bind(':id', $folderId,PDO::PARAM_INT);
            $this->db->execute();
        }

        public function getNotifFiches($userId){
            $this->db->query('SELECT category FROM medicalFolder WHERE user_id = :id AND notif = 1 AND category = "form"');
            $this->db->bind(':id', $userId,PDO::PARAM_INT);
            return !empty($this->db->resultSetAssoc());
        }
      public function getNotifBilans($userId){
            $this->db->query('SELECT category FROM medicalFolder WHERE user_id = :id AND notif = 1 AND category = "complementary-exam"');
            $this->db->bind(':id', $userId,PDO::PARAM_INT);
            return !empty($this->db->resultSetAssoc());
        }
      public function getNotifAnnuaire($userId){
            $this->db->query('SELECT category FROM medicalFolder WHERE user_id = :id AND notif = 1 AND category = "drug"');
            $this->db->bind(':id', $userId,PDO::PARAM_INT);
            return !empty($this->db->resultSetAssoc());
        }
              public function getNotifConseil($userId){
            $this->db->query('SELECT category FROM medicalFolder WHERE user_id = :id AND notif = 1 AND category = "advice"');
            $this->db->bind(':id', $userId,PDO::PARAM_INT);
            return !empty($this->db->resultSetAssoc());
        }

        public function getNotifSites($userId){
            $this->db->query('SELECT notif FROM sites WHERE user_id = :id AND notif = 1');
            $this->db->bind(':id', $userId,PDO::PARAM_INT);
            return !empty($this->db->resultSetAssoc());
        }
        
        public function getFolderAdmin($userId)
        {
            $this->db->query('SELECT * FROM medicalFolder WHERE user_id = 5');  
            return $this->db->resultSetObj();
        }

        public function insertDataFolderCopyAdmin($userId)
        {
            $this->db->query('INSERT INTO medicalFolder (title,category,user_id,admin_medicalFolder_id, notif)
                              SELECT title, category, :user_id, id, notif
                              FROM medicalFolder WHERE user_id = 5');
            $this->db->bind(':user_id',$userId,PDO::PARAM_STR);
            $this->db->execute();
        }

        public function getIdFolderUserByUserId($userId)
        {
            $this->db->query('SELECT id FROM medicalFolder WHERE user_id = :user_id');
            $this->db->bind(':user_id', $userId,PDO::PARAM_STR);  
            return $this->db->resultSetAssoc();
        }

        public function getIdFolderAdmin()
        {
            $this->db->query('SELECT id FROM medicalFolder WHERE user_id = 5');
            return $this->db->resultSetAssoc();
        }

        public function insertDataFileCopyAdmin($idUser,$idAdmin)
        {
            $this->db->query('INSERT INTO medicalFile (title,description,medicalFolder_id,tracker)
                              SELECT f.title,description,:medicalFolder_id,tracker
                              FROM medicalFile f LEFT JOIN medicalFolder m ON f.medicalFolder_id = m.id WHERE m.id = :id');
            $this->db->bind(':medicalFolder_id',$idUser['id'],PDO::PARAM_STR);
            $this->db->bind(':id',$idAdmin['id'],PDO::PARAM_STR);
            $this->db->execute();
        }

        public function addAPostForAdmin($userId,$title,$content)
        {
            $this->db->query('INSERT INTO post (title,content,status,userId,date) VALUES (:title, :content, :status, 5, CURRENT_TIMESTAMP)');
            $this->db->bind(':title',$title,PDO::PARAM_STR);
            $this->db->bind(':content',$content,PDO::PARAM_STR);
            $this->db->bind(':status',0,PDO::PARAM_INT);
            $this->db->execute();
            return (int)$this->db->lastId();
        }

        public function addPostForAllUser($title,$content,$idPostAdmin)
        {
            $this->db->query('INSERT INTO post (title,content,status,userId,idPost, notif)
                              SELECT :title, :content, :status, id, :idPost, 1
                              FROM user WHERE id <> 5');
            $this->db->bind(':title',$title,PDO::PARAM_STR);
            $this->db->bind(':content',$content,PDO::PARAM_STR);
            $this->db->bind(':status',0,PDO::PARAM_INT);
            $this->db->bind(':idPost',$idPostAdmin,PDO::PARAM_INT);
            $this->db->execute();
        }
        

        public function getAllPostByUserId($userId)
        {
            $this->db->query('SELECT * FROM post WHERE userId = :userId ORDER BY id DESC');
            $this->db->bind(':userId', $userId, PDO::PARAM_INT);
            return $this->db->resultSetAssoc();
        }

        public function getNotifPostByUserId($userId)
        {
            $this->db->query('SELECT * FROM post WHERE notif = 1 AND userId = :userId');
            $this->db->bind(':userId', $userId, PDO::PARAM_INT);
            return $this->db->resultSetAssoc();
        }

        public function updatePostById($userId,$idPost,$title,$content)
        {
            $this->db->query('UPDATE post SET title = :title, content = :content WHERE id = :id OR idPost = :idPost');
            $this->db->bind(':title',$title,PDO::PARAM_STR);
            $this->db->bind(':content',$content,PDO::PARAM_STR);
            $this->db->bind(':id',$idPost,PDO::PARAM_INT);
            $this->db->bind(':idPost',$idPost,PDO::PARAM_INT);
            $this->db->execute();
        }
    


        public function getAllPosts()
        {
            $this->db->query('SELECT * FROM post');
            return $this->db->resultSetAssoc();
        }

        public function deleteImagePostTemp($compareArray)
        {
            $this->db->query('DELETE FROM imagePostTemp
            WHERE image_filename = :image_filename');
            $this->db->bind(':image_filename', $compareArray, PDO::PARAM_STR);
            return $this->db->execute();
        }


    }