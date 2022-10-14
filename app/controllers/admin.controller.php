<?php
include_once 'app/views/admin.view.php';
include_once 'app/models/users.model.php';

class adminController{
    private $view;
    private $model;

    function __construct(){
        $this->view=new adminView();
        $this->model=new UserModel();
    }

    function showAdminPage(){

        $this->checkLoggedIn();
        $this->view->showAdminPage();
    }
    function listUsers($msg=null){
        if(!$msg)
            $this->checkLoggedIn();
        $users=$this->model->getAllUsers();
        $this->view->showListUsers($users,$msg);
    }
    function updateAdmin($id){
        $this->checkLoggedIn();

        $users=$this->model->getAllUsers();
        foreach($users as $u){
            if($u->id==$id)
                $user=$u;
        }
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
    
    private function checkLoggedIn(){
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