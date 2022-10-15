<?php
include_once 'app/models/products.model.php';
include_once 'app/models/categories.model.php';
include_once 'app/views/products.view.php';

class productsController{
    private $model;
    private $categoriesModel;
    private $view;

    function __construct(){
        $this->model=new productsModel();
        $this->view=new productsView();
        $this->categoriesModel=new categoriesModel();
    }

    function showAllProducts(){
        $categories=$this->categoriesModel->getAll();
        $products=$this->model->getAll();
        $this->view->showAllProducts($products,$categories);
    }

    function showProduct($id){
        $products=$this->model->getAll();
        $productsAndCategories=$this->categoriesModel->getProductsAndCategories($products);
        $this->view->showProduct($id,$productsAndCategories);
    }

    function showTshirts($params){
        $products=$this->model->getAll();
        $productsAndCategories=$this->categoriesModel->getProductsAndCategories($products);
        $categories=$this->categoriesModel->getAll();
        $this->view->showProductFilter($params,$productsAndCategories,$categories,'remeras');
    }

    function showSweatshirt($params){
        $products=$this->model->getAll();
        $productsAndCategories=$this->categoriesModel->getProductsAndCategories($products);
        $categories=$this->categoriesModel->getAll();
        $this->view->showProductFilter($params,$productsAndCategories,$categories,'buzos');
    }

    function showJackets($params){
        $products=$this->model->getAll();
        $productsAndCategories=$this->categoriesModel->getProductsAndCategories($products);
        $categories=$this->categoriesModel->getAll();
        $this->view->showProductFilter($params,$productsAndCategories,$categories,'camperas');   
    }

    function listProducts($msg=null){
        $this->checkLoggedIn(); 
        $products=$this->model->getAll();
        $productsAndCategories=$this->categoriesModel->getProductsAndCategories($products);
        $categories=$this->categoriesModel->getAll();
        $this->view->listProducts($productsAndCategories,$categories,$msg);
    }

    function editProduct($id){
        $this->checkLoggedIn();
        $products=$this->model->getAll();
        $productsAndCategories=$this->categoriesModel->getProductsAndCategories($products);
        $categories=$this->categoriesModel->getAll();
        $this->view->showEditProduct($id,$productsAndCategories,$categories);
    }

    function updateProduct($id){
        $this->checkLoggedIn();
        $name = $_POST['name'];
        $description = $_POST['description'];
        $stock = $_POST['stock'];
        $price = $_POST['price'];
        $type = $_POST['type'];

        if($_FILES['input_name']['type'] == "image/jpg" || $_FILES['input_name']['type'] == "image/jpeg" 
        || $_FILES['input_name']['type'] == "image/png" ) {

            $item='';
            $this->model->updateProduct($id,$name,$description,$stock,$price,$type,$item, $_FILES['input_name']['tmp_name']);
        }
        else {
            $item='';
            $products=$this->model->getAll();
            foreach($products as $product){
                if($product->id==$id)
                    $item=$product->image;
            }
            $this->model->updateProduct($id,$name,$description,$stock,$price,$type,$item);
        }
        $msg="update";
        header("Location: " . BASE_URL. 'listProducts/'.$msg);
    }

    function addProduct(){
        $this->checkLoggedIn();
        if(empty($_POST['name'])){
            header("Location: ".BASE_URL.'listProducts');
        }
        $name = $_POST['name'];
        $description = $_POST['description'];
        $stock = $_POST['stock'];
        $price = $_POST['price'];
        $type = $_POST['type'];

        if($_FILES['input_name']['type'] == "image/jpg" || $_FILES['input_name']['type'] == "image/jpeg" 
        || $_FILES['input_name']['type'] == "image/png" ) {

            $this->model->addProduct($name,$description,$stock,$price,$type,$_FILES['input_name']['tmp_name']);
        }
        else {
            $this->model->addProduct($name,$description,$stock,$price,$type);
        }
        $msg="add";
        header("Location: " . BASE_URL. 'listProducts/'.$msg);
    }

    function deleteProduct($id){
        $this->checkLoggedIn();
        $this->model->deleteProduct($id);
        $msg="delete";
        header("Location: " . BASE_URL. 'listProducts/'.$msg);
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