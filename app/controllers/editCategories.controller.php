<?php
require_once 'app/models/productsType.model.php';
require_once 'app/views/editCategories.view.php';

class editCategoriesController{
    private $model;
    private $view;
    function __construct(){
        $this->model=new productsTypeModel();
        $this->view=new editCategoriesView();
    }

    function showEditCategories(){
        $this->checkLoggedIn();
        $category=$this->model->getTypeProducts();
        $this->view->showEditCategories($category);
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
        header("Location: " . BASE_URL. 'editCategory/'.$id);
    }
    function deleteCategory($id){
        $this->checkLoggedIn();
        $this->model->deleteCategory($id);
        header("Location: " . BASE_URL. 'editCategories');
    }
    function addCategory(){
        $this->checkLoggedIn();

        $type=$_POST['type'];
        $brand=$_POST['brand'];
        $this->model->addCategory($type,$brand);
        header("Location: " . BASE_URL. 'editCategories');
    }



    function checkLoggedIn(){
        session_start();
        if(!isset($_SESSION['USER_ID'])){
            header("Location: " . BASE_URL. 'login');
            die();
        }
    }
}