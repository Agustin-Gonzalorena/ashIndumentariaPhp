<?php
include_once 'app/views/main.view.php';
include_once 'app/models/products.model.php';

class mainController{
    private $view;
    private $productsModel;

    function __construct(){
        $this->view=new mainView();
        $this->productsModel=new productsModel();
    }
    
    function showHome(){
        $products =$this->productsModel->getAll();
        $this->view->showHome($products);
    }

    function showAbout(){
        $this->view->showAbout();
    }

    function showNotFound(){
        $this->view->showNotFound();
    }

    function showAdminPage(){
        $this->checkLoggedIn();
        $this->view->showAdminPage();
    }
    
    //Chequeo de permisos
    
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