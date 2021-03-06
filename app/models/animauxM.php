<?php
class animauxM
{
    private $db;
    private $nomAnimal;
    private $type;
    private $age;
    private $pays;
    private $status;
    private $regimeAlimentaire;
    private $image;
   // private $reclamation;

    public function __construct()
    {
        $this->db = new Database;
    }
    public function getnomAnimal(){
        echo $this->nomAnimal;
    }

    public function getType(){
        echo $this->type;
    }

    public function getage(){
        echo $this->age;
    }

    public function getpays(){
        echo $this->pays;
    }

    public function getstatus(){
        echo $this->status;
    }

    public function getRegimeAlimentaire(){
        echo $this->regimeAlimentaire;
    }

    public function getImage(){
        echo $this->image;
    }

    public function afficherAnimaux(){
        $this->db->query('SELECT * FROM animaux ');
        return $this->db->resultSet();
    }


    
    public function findUserByIDUpdate($id)
    {
        //Prepared statement
        $this->db->query('SELECT * FROM animaux WHERE id != :id');

        $this->db->bind(':id', $id);
        $this->db->execute();
    }
    
    public function findEmailByID()
    {
        //Prepared statement
        $this->db->query('SELECT email FROM `users` WHERE id = :id;');
        $this->db->bind(':id',$_SESSION['id'] );

        return $this->db->resultSet();
       
    }

    public function addReclamation($data)
    {
        $this->db->query('INSERT INTO reclamation (reclamation,idUser) VALUES(:reclamation,:idUser)');

        //Bind values
        $this->db->bind(':reclamation', $data['reclamation']);
        $this->db->bind(':idUser', $_SESSION['id']);
        //Execute function
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function addCommentM($data)
    {
        $this->db->query('INSERT INTO comments (userName,comment,animalID) VALUES(:userName,:comment,:animalID)');

        //Bind values
        $this->db->bind(':comment', $data['comment']);
        $this->db->bind(':userName', $data['userName']);
        $this->db->bind(':animalID', $data['animalID']);
        //Execute function
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getNbrComments($animalID)
    {
        $this->db->query('SELECT COUNT(*) FROM `comments` where animalID=:animalID');
        $this->db->bind(':animalID', $animalID);
        return $this->db->resultSet();
    }
      
    public function afficherComment($animalID){
        $this->db->query('SELECT id_comment,comment,`comments`.userName,animalID,users.image FROM `comments`,users WHERE comments.userName=users.username AND animalID=:animalID ');
        $this->db->bind(':animalID', $animalID);
        return $this->db->resultSet();
    }

    public function getUserByID(){
        $this->db->query('SELECT username  FROM users where id=:id ');
        $this->db->bind(':id', $_SESSION['id']);
        return $this->db->resultSet();
    }

    public function getImageUserByID(){
        $this->db->query('SELECT image  FROM users where id=:id ');
        $this->db->bind(':id', $_SESSION['id']);
        return $this->db->resultSet();
    }

}
