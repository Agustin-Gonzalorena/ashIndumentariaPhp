<?php 
require_once './app/models/users.model.php';
require_once './app/views/main.view.php';

class usersController{
    private $view;
    private $model;


    public function __construct() {
        $this->model = new UserModel();
        $this->view = new mainView();
    }

    function deleteUser(){
        $this->checkUser();
        $this->checkDelete();
        $this->model->deleteUser($_SESSION['USER_ID']);
        session_destroy();
        header("Location: ".BASE_URL.'login');
    }
    function changePassword(){
        if(empty($_POST['password'])){
            header("Location: ".BASE_URL.'profile');
            die();
        }
        $this->checkLoggedIn();
        $password=$_POST['password'];
        $checkPassword=$_POST['checkPassword'];
        
        if($password !=$checkPassword){
            $msg='errorPassword';
            $this->view->showProfile($msg);
        }
        else{
            $pass = password_hash($password, PASSWORD_BCRYPT);
            $this->model->changePassword($pass,$_SESSION['USER_ID']);
            $msg="changePassword";
            $this->view->showProfile($msg);
        }
    }

    private function checkLoggedIn(){
        session_start();
        if(!isset($_SESSION['USER_ID'])){
            header("Location: ".BASE_URL.'login');
            die();
        }
    }

    private function checkDelete(){
        if($_SESSION['USER_ID']==1){
            header("Location: ".BASE_URL.'profile');
            die();
        }
    }
    private function checkUser(){
        session_start();
        if(!isset($_SESSION['USER_ID'])){
            header("Location: " . BASE_URL. 'login');
            die();
        }
        else{
            if($_SESSION['ADMIN']==0)
            header("Location: ". BASE_URL. 'nono');
    
        }
    }
}