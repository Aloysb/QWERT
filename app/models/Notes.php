<?php

class Notes
{
    private $db;

    public function __construct()
    {
        $this->db =  new Database();
    }

    public function getAllNotesByUserId($user_id){
        $this->db->query('SELECT * FROM notes WHERE user_id = :user_id');
        $this->db->bind(':user_id', $user_id,PDO::PARAM_INT);
        return $this->db->resultSetAssoc();
    }

        public function addANote($content, $userId)
    {
        $this->db->query('INSERT INTO notes(content, user_id) VALUES (:content, :userId)');
        $this->db->bind(':content', $content,PDO::PARAM_STR);
        $this->db->bind(':userId', $userId,PDO::PARAM_INT);
        return $this->db->execute();
    }

    public function updateANote($id, $content)
    {
        $this->db->query('UPDATE notes SET content = :content WHERE id = :id');
        $this->db->bind(':content', $content,PDO::PARAM_STR);
        $this->db->bind(':id', $id,PDO::PARAM_INT);
        return $this->db->execute();
    }

    public function deleteANote($id)
    {
        $this->db->query('DELETE FROM notes WHERE id = :id');
        $this->db->bind(':id', $id,PDO::PARAM_INT);
        return $this->db->execute();
    }

}