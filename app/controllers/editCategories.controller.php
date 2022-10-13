<?php
require_once 'app/models/productsType.model.php';
require_once 'app/views/editCategories.view.php';
include_once 'app/models/products.model.php';

class editCategoriesController{
    private $model;
    private $productsModel;
    private $view;
    function __construct(){
        $this->productsModel=new productsModel();
        $this->model=new productsTypeModel();
        $this->view=new editCategoriesView();
    }

    function showEditCategories($msg=null){
        $this->checkLoggedIn();
        $products=$this->productsModel->getAll();
        $category=$this->model->getTypeProducts();
        $this->view->showEditCategories($category,$products,$msg);
    }

    function showEditCategory($id){
        $this->checkLoggedIn();
        $category=$this->model->getTypeProducts();
        $this->view->showEditCategory($category,$id);
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

        $type=$_POST['type'];
        $brand=$_POST['brand'];
        $this->model->addCategory($type,$brand);
        $msg='add';
        header("Location: " . BASE_URL. 'editCategories/'.$msg);
    }



    function checkLoggedIn(){
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