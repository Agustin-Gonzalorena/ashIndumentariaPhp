<?php 
require_once './app/models/users.model.php';
require_once './app/views/users.view.php';

class usersController{
    private $view;
    private $model;

    public function __construct() {
        $this->model = new userModel();
        $this->view = new usersView();
    }

    function showFormLogin($msg=null){
        $this->checkLoggedOut();
        $this->view->showFormLogin($msg);
    }
    
    function validateUser(){
        $this->checkLoggedOut();
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
        $this->checkLoggedIn();
        session_start();
        session_destroy();
        header("Location: " . BASE_URL);
    }

    function listUsers($msg=null){
        if(!$msg)
            $this->checkUser();
        $users=$this->model->getAllUsers();
        $this->view->showListUsers($users,$msg);
    }

    function showProfile(){
        $this->checkLoggedIn();
        $this->view->showProfile();
    }

    function showSignUp($msg=null){
        $this->checkLoggedOut();
        if($msg)
            $msg='El nombre de usuario ya existe.';
        $this->view->showSignUp($msg);
    }
    
    function addUser(){
        $this->checkLoggedOut();
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

    function updateAdmin($id){
        $this->checkUser();
        $user=$this->model->getUserByID($id);
        if($_SESSION['USER_ID']==$user->id){
            $this->listUsers('No se pueden revocar los permisos al usuario actual.');
        }
        elseif($id==1){
            $this->listUsers('No se pueden revocar los permisos al ADMIN.');
        }
        else{
            if($user->admin==1){
                $this->model->updateAdmin($id,0);
            }
            elseif($user->admin==0){
                $this->model->updateAdmin($id,1);
            }
            header("Location: ". BASE_URL. 'listUsers');
        }
    }

    function deleteUser(){
        $this->checkUser();
        $this->checkDelete();
        $this->model->deleteUser($_SESSION['USER_ID']);
        session_destroy();
        header("Location: ".BASE_URL.'login');
    }

    function changePassword(){
        $this->checkLoggedIn();
        if(empty($_POST['password'])){
            header("Location: ".BASE_URL.'profile');
            die();
        }
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

    //Chequeo de permisos
    
    private function checkLoggedIn(){
        session_start();
        if(!isset($_SESSION['USER_ID'])){
            header("Location: ".BASE_URL.'login');
            die();
        }
    }
    private function checkLoggedOut(){
        session_start();
        if(isset($_SESSION['USER_ID'])){
            header("Location: " . BASE_URL);
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