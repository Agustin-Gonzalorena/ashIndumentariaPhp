<?php
include_once 'app/views/main.view.php';
include_once 'app/models/products.model.php';

class mainController{
    private $view;
    private $model;

    function __construct(){
        $this->view=new mainView();
        $this->model=new productsModel();
    }
    function showHome(){
        $products =$this->model->getAll();
        $this->view->showHome($products);
    }
    function showAbout(){
        $this->view->showAbout();
    }
    function showNotFound(){
        $this->view->showNotFound();
    }

}