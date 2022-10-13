<?php
require_once './libs/smarty/libs/Smarty.class.php';


class productsView{
    private $smarty;

    function __construct() {
        $this->smarty = new Smarty();
    }

    function showAllProducts($products,$category){
        session_start();
        $this->categories($category);
        $this->smarty->assign('products', $products);
        $this->smarty->assign('category', $category);
        $this->smarty->display('products.tpl');
    }
    function showProduct($params,$products){
        session_start();
        foreach($products as $item){
            if($item->id==$params){
                $this->smarty->assign('product', $item);
            }
        }
        
        
        $this->smarty->display('oneProduct.tpl');
    }

    function categories($category){
        
        $remeras=array();
        foreach($category as $item){
            if($item->type=='remeras')
                array_push($remeras, $item);          
        }
        $buzos=array();
        foreach($category as $item){
            if($item->type=='buzos')
                array_push($buzos, $item);          
        }
        $camperas=array();
        foreach($category as $item){
            if($item->type=='camperas')
                array_push($camperas, $item);          
        }
        $this->smarty->assign('remeras',$remeras);
        $this->smarty->assign('buzos',$buzos);
        $this->smarty->assign('camperas',$camperas);
    }

    function showProductFilter($params,$products,$category,$type){
        session_start();
        $array=array();
        if($params=='all'){
            foreach($products as $item)
                if($item->type==$type)
                    array_push($array,$item);
        }else{
            foreach($products as $item){
                if($item->brand==$params and $item->type==$type)
                    array_push($array,$item);
            }
        }
        $this->categories($category);
        $this->smarty->assign('products', $array);
        $this->smarty->display('products.tpl');
    }
}