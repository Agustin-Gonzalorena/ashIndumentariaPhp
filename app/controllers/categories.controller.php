<?php
require_once 'app/models/categories.model.php';
require_once 'app/views/categories.view.php';
include_once 'app/models/products.model.php';

class categoriesController{
    private $model;
    private $productsModel;
    private $view;

    function __construct(){
        $this->productsModel=new productsModel();
        $this->model=new categoriesModel();
        $this->view=new categoriesView();
    }

    function showEditCategories($msg=null){
        $this->checkLoggedIn();
        $products=$this->productsModel->getAll();
        $categories=$this->model->getAll();
        $this->view->showEditCategories($categories,$products,$msg);
    }

    function showEditCategory($id){
        $this->checkLoggedIn();
        $category=$this->model->getCategory($id);
        $this->view->showEditCategory($category);
    }

    function updateCategory($id){
        $this->checkLoggedIn();
        $type=$_POST['type'];
        $brand=$_POST['brand'];
        $this->model->updateCategory($id,$type,$brand);
        $msg='update';
        header("Location: " . BASE_URL. 'editCategories/'.$msg);
    }

    function deleteCategory($id){
        $this->checkLoggedIn();
        $this->model->deleteCategory($id);
        $msg='delete';
        header("Location: " . BASE_URL. 'editCategories/'.$msg);
    }

    function addCategory(){
        $this->checkLoggedIn();
        if(empty($_POST['type'])){
            header("Location: ".BASE_URL.'editCategories');
        }
        $type=$_POST['type'];
        $brand=$_POST['brand'];
        $this->model->addCategory($type,$brand);
        $msg='add';
        header("Location: " . BASE_URL. 'editCategories/'.$msg);
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