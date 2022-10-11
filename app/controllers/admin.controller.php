<?php
include_once 'app/views/admin.view.php';

class adminController{
    private $view;

    function __construct(){
        $this->view=new adminView();
    }

    function showAdminPage(){

        $this->checkLoggedIn();
        $this->view->showAdminPage();
    }

    function checkLoggedIn(){
        session_start();
        if(!isset($_SESSION['USER_ID'])){
            header("Location: " . BASE_URL. 'login');
            die();
        }
    }
}