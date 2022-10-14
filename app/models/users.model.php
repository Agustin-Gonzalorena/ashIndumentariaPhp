<?php

class UserModel {

    private $db;

    function __construct() {
        $this->db=$this->connect();
    }
    private function connect() {
        $db = new PDO('mysql:host=localhost;'.'dbname=db_ash;charset=utf8', 'root', '');
        return $db;
    }
    function getAllUsers(){
        $query = $this->db->prepare("SELECT * FROM users");
        $query->execute();
        $users = $query->fetchAll(PDO::FETCH_OBJ);
        return $users;
    }
    function getUser($userName) {
        $query = $this->db->prepare("SELECT * FROM users WHERE userName = ?");
        $query->execute([$userName]);
        return $query->fetch(PDO::FETCH_OBJ);
    }
    function addUser($name,$lastName,$userName,$password){
        try{
            $query = $this->db->prepare("INSERT INTO users (`name`, `lastName`,`userName`,`password`, `admin`) VALUES (?, ?, ?, ?, ?)");
            $query->execute([$name,$lastName,$userName,$password,false]);
        }
        catch(PDOException){
            $msg='userDuplicate';
            header("Location: " . BASE_URL. 'signUp/'.$msg);
            exit;
        }
    }
    function updateAdmin($id,$value){
        $query=$this->db->prepare("UPDATE users SET `admin`=? WHERE id=? ");
        $query->execute([$value,$id]);
    }
    function deleteUser($id){
        $query = $this->db->prepare('DELETE FROM users WHERE id = ?');
        $query->execute([$id]);
    }
    function changePassword($password,$id){
        $query=$this->db->prepare("UPDATE users SET `password`=? WHERE id=? ");
        $query->execute([$password,$id]);
    }
}