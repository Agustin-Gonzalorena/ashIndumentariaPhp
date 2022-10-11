<?php
require_once './app/views/auth.view.php';
require_once './app/models/users.model.php';

class authController{
    private $view;
    private $model;


    public function __construct() {
        $this->model = new UserModel();
        $this->view = new AuthView();
    }

    function showFormLogin(){
        $this->checkLoggedIn();
        $this->view->showFormLogin();
    }
    
    function validateUser(){
        if(empty($_POST['userName'])){
            header("Location: " . BASE_URL . 'login');
        }
        $userName = $_POST['userName'];
        $password = $_POST['password'];

        $user = $this->model->getUserByEmail($userName);

        if ($user && password_verify($password, $user->password)) {
            session_start();
            $_SESSION['USER_ID'] = $user->id;
            $_SESSION['USER_userName'] = $user->userName;
            $_SESSION['IS_LOGGED'] = true;

            header("Location: " . BASE_URL. 'adminPage');
        } else {
           $this->view->showFormLogin("El usuario o la contraseña no existe.");
        } 
    }
    public function logout() {
        session_start();
        session_destroy();
        header("Location: " . BASE_URL);
    }


    
    private function checkLoggedIn(){
        session_start();
        if(isset($_SESSION['USER_ID'])){
            header("Location: " . BASE_URL);
            die();
        }
    }
}