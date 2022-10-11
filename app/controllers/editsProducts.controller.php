<?php
include_once 'app/models/products.model.php';
include_once 'app/models/productsType.model.php';
include_once 'app/views/editsProducts.view.php';

class editsProductsController{
    private $productsModel;
    private $typeModel;
    private $view;

    function __construct(){
        $this->productsModel=new productsModel();
        $this->view=new editsProductsView();
        $this->typeModel=new productsTypeModel();
    }


    function listProducts($msg=null){
        if(!$msg){
            $this->checkLoggedIn();
            }
        $products=$this->productsModel->getAll();
        $productsAndType=$this->typeModel->getProductsAndTypes($products);
        $category=$this->typeModel->getTypeProducts();
        $this->view->listProducts($productsAndType,$category);
    }

    function editProduct($id){
        
        $this->checkLoggedIn();
        
        $products=$this->productsModel->getAll();
        $productsAndType=$this->typeModel->getProductsAndTypes($products);
        $category=$this->typeModel->getTypeProducts();
        $this->view->showEditProduct($id,$productsAndType,$category,);
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
                    $this->productsModel->update($id,$name,$description,$stock,$price,$item, $_FILES['input_name']['tmp_name']);
                }
                else {
                    $item='';
                    $products=$this->productsModel->getAll();
                    foreach($products as $product){
                        if($product->id==$id)
                            $item=$product->image;
                    }
                    $this->productsModel->update($id,$name,$description,$stock,$price,$item);
                }
        header("Location: " . BASE_URL. 'editProduct/'.$id);
    }

    function addProduct(){
        $this->checkLoggedIn();

        $name = $_POST['name'];
        $description = $_POST['description'];
        $stock = $_POST['stock'];
        $price = $_POST['price'];
        $type = $_POST['type'];

        if($_FILES['input_name']['type'] == "image/jpg" || $_FILES['input_name']['type'] == "image/jpeg" 
                    || $_FILES['input_name']['type'] == "image/png" ) {
                    
                    $this->productsModel->addProduct($name,$description,$stock,$price,$type,$_FILES['input_name']['tmp_name']);
                }
                else {
                    
                    $this->productsModel->addProduct($name,$description,$stock,$price,$type);
                }
        header("Location: " . BASE_URL. 'listProducts');
    }


    function deleteProduct($id){
        $this->checkLoggedIn();
        $this->productsModel->deleteProduct($id);
        header("Location: " . BASE_URL. 'listProducts');
    }
    



    function checkLoggedIn(){
        session_start();
        if(!isset($_SESSION['USER_ID'])){
            header("Location: " . BASE_URL. 'login');
            die();
        }
    }
}