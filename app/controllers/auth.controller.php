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

    function showFormLogin($msg=null){
        $this->checkLoggedIn();
        $this->view->showFormLogin($msg);
    }
    
    function validateUser(){
        if(empty($_POST['userName'])){
            header("Location: " . BASE_URL . 'login');
        }
        $userName = $_POST['userName'];
        $password = $_POST['password'];

        $user = $this->model->getUser($userName);

        if ($user && password_verify($password, $user->password)) {
            session_start();
            $_SESSION['USER_ID'] = $user->id;
            $_SESSION['USER_userName'] = $user->userName;
            $_SESSION['IS_LOGGED'] = true;
            $_SESSION['USER_NAME']  = $user->name;
            $_SESSION['USER_LASTNAME'] =$user->lastName;
            $_SESSION['ADMIN']=$user->admin;

            header("Location: " . BASE_URL);
        } else {
           $this->view->showFormLogin("error");
        } 
    }
    function logout() {
        session_start();
        session_destroy();
        header("Location: " . BASE_URL);
    }

    function showSignUp($msg=null){
        $this->checkLoggedIn();
        
        if($msg)
            $msg='El nombre de usuario ya existe.';
        $this->view->showSignUp($msg);
    }
    
    function addUser(){
        if(empty($_POST['userName'])){
            $msg='El nombre de usuario es obligatorio.';
            $this->view->showSignUp($msg);;
        }
        $name=$_POST['name'];
        $lastName=$_POST['lastName'];
        $userName=$_POST['userName'];
        $password=$_POST['password'];
        $checkPassword=$_POST['checkPassword'];
        
        
        if(empty($name)){
            $msg='El nombre es obligatorio.';
            $this->view->showSignUp($msg);
        }
        elseif(empty($lastName)){
            $msg='El apellido es obligatorio.';
            $this->view->showSignUp($msg);
        }
        elseif(empty($password)){
            $msg='La contraseña es obligatoria.';
            $this->view->showSignUp($msg);
        }
        elseif(empty($checkPassword)){
            $msg='Tiene que confirmar la contraseña.';
            $this->view->showSignUp($msg);
        }
        else{
            if($password !=$checkPassword){
                $msg='Las contraseñas no coinciden.';
                $this->view->showSignUp($msg);
            }
            else{
                $pass = password_hash($password, PASSWORD_BCRYPT);
                $this->model->addUser($name,$lastName,$userName,$pass);
                $msg='addUser';
                $this->view->showFormLogin($msg);
            }
        }
    }
    

    private function checkLoggedIn(){
        session_start();
        if(isset($_SESSION['USER_ID'])){
            header("Location: " . BASE_URL);
            die();
        }
    }
}