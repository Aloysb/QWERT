<?php

    class Files
    {
        private $db;

        public function __construct()
        {
            $this->db = new Database();
        }

        public function getSingleFile($id)
        {
            $this->db->query('SELECT mfi.id, mfi.title, mfi.description,mfi.medicalFolder_id, mfo.user_id FROM medicalFile AS mfi
                                       LEFT JOIN medicalFolder AS mfo
                                       ON mfo.id = mfi.medicalFolder_id
                                       WHERE mfi.id = :id');
            $this->db->bind(':id',$id);
            return $this->db->resultSetObj();
        }

        public function getFilesById($id){
            $this->db->query("SELECT *
                                FROM medicalFile
                                WHERE id IN :idFiles ORDER BY title ASC
             ");
            $this->db->bind(':idFiles',$idFolder);
            return $this->db->resultSetObj();
        }

        public function getFileByTracker(){
            $this->db->query('SELECT medicalFolder_id FROM medicalFile
                                       WHERE tracker = 1');
            return $this->db->resultSetObj();
        }

        public function resetTrackerFile(){
            $this->db->query('UPDATE medicalFile SET tracker = :tracker');
            $this->db->bind(':tracker',0,PDO::PARAM_INT);
            $this->db->execute();
        }

        public function exist($id)
        {
            $this->db->query('SELECT COUNT(*) FROM medicalFile WHERE id = :id');
            $this->db->bind(':id',$id,PDO::PARAM_INT);
            return (int)$this->db->numberLine();
        }

        public function updateFile($id,$title,$description)
        {
            $this->db->query('UPDATE medicalFile SET title = :title , description = :description, tracker = :tracker WHERE id = :id');
            $this->db->bind(':id',$id,PDO::PARAM_INT);
            $this->db->bind(':title',$title,PDO::PARAM_STR);
            $this->db->bind(':description',$description,PDO::PARAM_STR);
            $this->db->bind(':tracker',1,PDO::PARAM_INT);
            $this->db->execute();
        }

        public function updateFileForAllUsers($id,$title,$description)
        {
            $this->db->query('UPDATE medicalFile SET title = :title , description = :description, tracker = :tracker WHERE title = :title AND tracker = 0');
            $this->db->bind(':id',$id,PDO::PARAM_INT);
            $this->db->bind(':title',$title,PDO::PARAM_STR);
            $this->db->bind(':description',$description,PDO::PARAM_STR);
            $this->db->bind(':tracker',1,PDO::PARAM_INT);
            $this->db->execute();
        }


        public function copyFile($id, $title)
        {
           $this->db->query('INSERT INTO medicalFile (title, description, medicalFolder_id, tracker, status, notif) SELECT (:title),( description), (medicalFolder_id), (tracker), (status), (notif) FROM medicalFile WHERE id=:id');
           $this->db->bind(':id',$id,PDO::PARAM_INT);
           $this->db->bind(':title',$title,PDO::PARAM_STR);
          $this->db->execute();
        }

        public function updateFileImage($imageName,$id)
        {
            $this->db->query('UPDATE medicalFile SET imageName = :imageName WHERE id = :id');
            $this->db->bind(':id',$id,PDO::PARAM_INT);
            $this->db->bind(':imageName',$imageName,PDO::PARAM_STR);
            $this->db->execute();
        }

        public function deleteFileById($id)
        {
            $this->db->query('DELETE FROM medicalFile WHERE id = :id');
            $this->db->bind(':id',$id,PDO::PARAM_INT);
            $this->db->execute();
        }

        public function storageImageTempByUserId($imageName,$userId)
        {
            $this->db->query('INSERT INTO imageTemp (image_filename, user_id ) VALUES(:image_filename, :user_id)');
            $this->db->bind(':user_id', $userId, PDO::PARAM_INT);
            $this->db->bind(':image_filename', $imageName, PDO::PARAM_STR);
            $this->db->execute();
        }

        public function getAllImageFilenameById($userId)
        {
            $this->db->query('SELECT image_filename FROM imageTemp WHERE user_id = :user_id');
            $this->db->bind(':user_id', $userId, PDO::PARAM_INT);
            return $this->db->resultSetAssoc();
        }

        public function deleteArrayFilename($strCompare)
        {
            $this->db->query("DELETE FROM imageTemp  WHERE image_filename IN ('".$strCompare."')");
            $this->db->execute();
        }

        public function getAllContentById($id)
        {
            $this->db->query('SELECT description FROM medicalFile WHERE id = :id');
            $this->db->bind(':id', $id, PDO::PARAM_INT);
            return $this->db->resultSetAssoc();
        }

        public function getCategoryOfFolderByIdFile($idFile)
        {
            $this->db->query('SELECT mfi.id, mfi.title, mfi.description,mfi.medicalFolder_id, mfo.user_id,mfo.category FROM medicalFile AS mfi
            LEFT JOIN medicalFolder AS mfo
            ON mfo.id = mfi.medicalFolder_id
            WHERE mfi.id = :id');
            $this->db->bind(':id',$idFile,PDO::PARAM_INT);
            return $this->db->resultSetObj();
        }

        public function getAllFiles()
        {
            $this->db->query("SELECT description FROM medicalFile WHERE description REGEXP '[[:alnum:]]{1,}\.[jpegn]{3,4}'");
            return $this->db->resultSetAssoc();
        }

        public function getAllFilesByUserId($userId)
        {
            $this->db->query('SELECT mfi.title, mfi.description, mfi.medicalFolder_id, mfi.id, mfo.category FROM medicalFile AS mfi
                                       LEFT JOIN medicalFolder AS mfo
                                       ON mfi.medicalFolder_id = mfo.id
                                       WHERE user_id = :id AND  mfo.category = "form" ');
            $this->db->bind(':id', $userId, PDO::PARAM_INT);
            return $this->db->resultSetObj();
        }


        public function getAllContactsByUserId($userId)
        {
            $this->db->query('SELECT mfi.title, mfi.description, mfi.id, mfo.category FROM medicalFile AS mfi
                                       LEFT JOIN medicalFolder AS mfo
                                       ON mfi.medicalFolder_id = mfo.id
                                       WHERE user_id = :id AND  mfo.category = "drug"  ');
            $this->db->bind(':id', $userId, PDO::PARAM_INT);
            return $this->db->resultSetObj();
        }

                public function getAllAdviceByUserId($userId)
        {
            $this->db->query('SELECT mfi.title, mfi.description, mfi.id, mfo.category FROM medicalFile AS mfi
                                       LEFT JOIN medicalFolder AS mfo
                                       ON mfi.medicalFolder_id = mfo.id
                                       WHERE user_id = :id AND  mfo.category = "advice"  ');
            $this->db->bind(':id', $userId, PDO::PARAM_INT);
            return $this->db->resultSetObj();
        }


                public function getAllExamsByUserId($userId)
        {
            $this->db->query('SELECT mfi.title, mfi.description, mfi.id, mfo.category FROM medicalFile AS mfi
                                       LEFT JOIN medicalFolder AS mfo
                                       ON mfi.medicalFolder_id = mfo.id
                                       WHERE user_id = :id AND  mfo.category = "complementary-exam"  ');
            $this->db->bind(':id', $userId, PDO::PARAM_INT);
            return $this->db->resultSetObj();
        }

        public function getAllFilename()
        {
            $this->db->query("SELECT image_filename FROM imageTemp");
            return $this->db->resultSetAssoc();
        }
	
        public function getFilesByFolderId($userId,$idFolder)
        {
            $this->db->query('SELECT m.* FROM medicalFolder p
                              RIGHT JOIN medicalFile m
                              ON m.medicalFolder_id = p.id
                               WHERE medicalFolder_id = :medicalFolder_id AND p.user_id = :user_id');
            $this->db->bind(':medicalFolder_id', $idFolder, PDO::PARAM_INT);
            $this->db->bind(':user_id', $userId, PDO::PARAM_INT);
            return $this->db->resultBool();
        }
       
        public function storageImagePostTempByUserId($imageName,$userId)
        {
            $this->db->query('INSERT INTO imagePostTemp (image_filename, user_id ) VALUES(:image_filename, :user_id)');
            $this->db->bind(':user_id', $userId, PDO::PARAM_INT);
            $this->db->bind(':image_filename', $imageName, PDO::PARAM_STR);
            $this->db->execute();
        }
        
        public function getAllPostsFilename()
        {
            $this->db->query('SELECT image_filename FROM imagePostTemp');
            return $this->db->resultSetAssoc();
        }

        public function deleteArrayPostFilename($strCompare)
        {
            $this->db->query("DELETE FROM imagePostTemp  WHERE image_filename IN ('".$strCompare."')");
            $this->db->execute();
        }
        
        public function getPostById($idPost)
        {
            $this->db->query('SELECT * FROM post WHERE id = :id');
            $this->db->bind(':id', $idPost, PDO::PARAM_INT);
            return $this->db->resultBool();
        }

        public function deletePostById($userId,$idPost)
        {   
            $this->db->query("DELETE FROM post WHERE id = :id AND userId = :userId");
            $this->db->bind(':id', $idPost, PDO::PARAM_INT);
            $this->db->bind(':userId', $userId, PDO::PARAM_INT);
            $this->db->execute();
        }

        public function deletePostByIdFolAllUsers($idPost){
            $this->db->query("DELETE FROM post WHERE idPost = :id OR id = :id");
            $this->db->bind(':id', $idPost, PDO::PARAM_INT);
            $this->db->execute();
        }

        public function updatePostFile($title,$content)
        {
            $this->db->query('UPDATE post SET title = :title , content = :content');
            $this->db->bind(':id',$id,PDO::PARAM_INT);
            $this->db->bind(':title',$title,PDO::PARAM_STR);
            $this->db->bind(':description',$description,PDO::PARAM_STR);
            $this->db->bind(':tracker',1,PDO::PARAM_INT);
            $this->db->execute();
        }

        public function viewPostById($idPost)
        {
            $this->db->query('SELECT * FROM post WHERE id = :id');
            $this->db->bind(':id', $idPost, PDO::PARAM_INT);
            return $this->db->resultSetObj();
        }

        public function getPostContentById($idPost)
        {
            $this->db->query('SELECT content FROM post WHERE id = :id');
            $this->db->bind(':id', $idPost, PDO::PARAM_INT);
            return $this->db->resultSetObj();
        }

        public function deletePostTempByIdentifier($match)
        {   
            $this->db->query("DELETE FROM imagePostTemp WHERE image_filename = :image_filename");
            $this->db->bind(':image_filename', $match, PDO::PARAM_STR);
            $this->db->execute();

        }

       public function getPostsNotSeen($userId)
       {
            $this->db->query("SELECT * FROM post WHERE status = 0 AND userId = :userId");
            $this->db->bind(':userId', $userId, PDO::PARAM_INT);
            return $this->db->resultBool();
       }

       public function getPostsNotSeenCount($userId)
       {
            $this->db->query("SELECT COUNT(*) FROM post WHERE status = 0  AND userId = :userId");
            $this->db->bind(':userId', $userId, PDO::PARAM_INT);
            return (int)$this->db->numberLine();
       }

       public function updatePostNotif($userId,$idPost)
       {
            $this->db->query("UPDATE post SET status = 1, notif = 0 WHERE userId = :userId AND id = :idPost");
            $this->db->bind(':idPost', $idPost, PDO::PARAM_INT);
            $this->db->bind(':userId', $userId, PDO::PARAM_INT);
            $this->db->execute();
       }

        public function getFilesNotSeen($userId)
       {
        $this->db->query("SELECT medicalFile.* FROM medicalFile
                          LEFT JOIN medicalFolder
                          ON medicalFile.medicalFolder_id = medicalFolder.id
                          WHERE medicalFile.status = 0 AND user_id = :user_id AND medicalFolder.category = 'form'");
        $this->db->bind(':user_id', $userId, PDO::PARAM_INT);
        return $this->db->resultSetAssoc();
       }
       
       public function getFilesNotSeenCount($userId)
       {
        $this->db->query("SELECT COUNT(*) FROM medicalFile
                          LEFT JOIN medicalFolder
                          ON medicalFile.medicalFolder_id = medicalFolder.id
                          WHERE medicalFile.status = 0 AND user_id = :user_id AND medicalFolder.category = 'form'");
        $this->db->bind(':user_id', $userId, PDO::PARAM_INT);
        return (int)$this->db->numberLine();
       }
       
       public function getFilesStatusByFolderId($numberFolder,$userId)
       {
        $this->db->query('SELECT * FROM medicalFile m
                            LEFT JOIN medicalFolder p
                            ON m.medicalFolder_id = p.id
                            WHERE m.status = 0 AND m.medicalFolder_id = :medicalFolder_id AND p.user_id = :user_id ');
        $this->db->bind(':medicalFolder_id', $numberFolder, PDO::PARAM_INT);
        $this->db->bind(':user_id', $userId, PDO::PARAM_INT);
        return $this->db->resultBool();
       }
 
       public function updateFileNotif($idFile)
       {
            $this->db->query("UPDATE medicalFile SET status = 1 WHERE status = 0 AND id = :idFile");
            $this->db->bind(':idFile', $idFile, PDO::PARAM_INT);
            $this->db->execute();
       }
       
 
       public function getCheckupFilesNotSeen($userId)
       {
            $this->db->query("SELECT medicalFile.* FROM medicalFile
                                LEFT JOIN medicalFolder
                                ON medicalFile.medicalFolder_id = medicalFolder.id
                                WHERE medicalFile.status = 0 AND user_id = :user_id AND medicalFolder.category = 'complementary-exam'");
            $this->db->bind(':user_id', $userId, PDO::PARAM_INT);
            return $this->db->resultSetAssoc();
       }

        public function getCheckupFilesNotSeenCount($userId)
        {
         $this->db->query("SELECT COUNT(*) FROM medicalFile
                           LEFT JOIN medicalFolder
                           ON medicalFile.medicalFolder_id = medicalFolder.id
                           WHERE medicalFile.status = 0 AND user_id = :user_id AND medicalFolder.category = 'complementary-exam'");
         $this->db->bind(':user_id', $userId, PDO::PARAM_INT);
         return (int)$this->db->numberLine();
        }
       
       public function getFileByIdFile($idFile)
       {
        $this->db->query("SELECT * FROM medicalFile WHERE id = :id"); 
        $this->db->bind(':id', $idFile, PDO::PARAM_INT);
        return $this->db->resultBool();
       }
      
    }