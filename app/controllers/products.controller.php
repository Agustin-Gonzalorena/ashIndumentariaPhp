<?php
include_once 'app/models/products.model.php';
include_once 'app/models/productsType.model.php';
include_once 'app/views/products.view.php';


class productsController{
    private $productsModel;
    private $typeModel;
    private $view;

    function __construct(){
        $this->productsModel=new productsModel();
        $this->view=new productsView();
        $this->typeModel=new productsTypeModel();
    }

    function showAllProducts(){
        
        $category=$this->typeModel->getTypeProducts();
        $products=$this->productsModel->getAll();
        $this->view->showAllProducts($products,$category);
    }

    function showProduct($params){
        $products=$this->productsModel->getAll();
        $productsAndType=$this->typeModel->getProductsAndTypes($products);
        $this->view->showProduct($params,$productsAndType);
    }

    function showTshirts($params){
        
        $products=$this->productsModel->getAll();
        $productsAndType=$this->typeModel->getProductsAndTypes($products);
        $category=$this->typeModel->getTypeProducts();
        $this->view->showProductFilter($params,$productsAndType,$category,'remeras');
    }

    function showSweatshirt($params){
        
        $products=$this->productsModel->getAll();
        $productsAndType=$this->typeModel->getProductsAndTypes($products);
        $category=$this->typeModel->getTypeProducts();
        $this->view->showProductFilter($params,$productsAndType,$category,'buzos');
    }

    function showJackets($params){
        
        $products=$this->productsModel->getAll();
        $productsAndType=$this->typeModel->getProductsAndTypes($products);
        $category=$this->typeModel->getTypeProducts();
        $this->view->showProductFilter($params,$productsAndType,$category,'camperas');   
    }

    


    
}   