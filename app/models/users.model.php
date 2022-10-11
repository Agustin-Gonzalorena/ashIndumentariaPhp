<?php

class UserModel {

    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;'.'dbname=db_ash;charset=utf8', 'root', '');
    }

    public function getUserByEmail($userName) {
        $query = $this->db->prepare("SELECT * FROM users WHERE userName = ?");
        $query->execute([$userName]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

}