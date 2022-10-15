<?php
require_once './libs/smarty/libs/Smarty.class.php';

class productsView{
    private $smarty;

    function __construct() {
        $this->smarty = new Smarty();
    }

    function showAllProducts($products,$categories){
        session_start();
        $this->categories($categories);
        $this->smarty->assign('products', $products);
        $this->smarty->display('products.tpl');
    }

    function showProduct($id,$products){
        session_start();
        foreach($products as $product){
            if($product->id==$id){
                $this->smarty->assign('product', $product);
            }
        }
        $this->smarty->display('oneProduct.tpl');
    }

    function categories($categories){
        $remeras=array();
        $buzos=array();
        $camperas=array();
        foreach($categories as $category){
            if($category->type=='remeras')
                array_push($remeras, $category);
            elseif($category->type=='buzos')
                array_push($buzos, $category);
            elseif($category->type=='camperas')
                array_push($camperas, $category);             
        }
        $this->smarty->assign('remeras',$remeras);
        $this->smarty->assign('buzos',$buzos);
        $this->smarty->assign('camperas',$camperas);
    }

    function showProductFilter($params,$products,$categories,$type){
        session_start();
        $arrayProducts=array();
        if($params=='all'){
            foreach($products as $product)
                if($product->type==$type)
                    array_push($arrayProducts,$product);
        }else{
            foreach($products as $product){
                if($product->brand==$params and $product->type==$type)
                    array_push($arrayProducts,$product);
            }
        }
        $this->categories($categories);
        $this->smarty->assign('products', $arrayProducts);
        $this->smarty->display('products.tpl');
    }
    
    function listProducts($products,$categories,$msg){
        arsort($products);
        $successMsg='';
        switch($msg){
            case 'add':
                $successMsg='Producto AGREGADO correctamente.';
                break;
            case 'delete':
                $successMsg='Producto ELIMINADO correctamente.';
                break;
            case 'update':
                $successMsg='Producto MODIFICADO correctamente.';
                break;
            default:
                $successMsg='';
                break;
        }
        $this->smarty->assign('successMsg',$successMsg);
        $this->smarty->assign('categories',$categories);
        $this->smarty->assign('products',$products);
        $this->smarty->display('listProducts.tpl');
    }

    function showEditProduct($id,$products,$categories){
        foreach($products as $product){
            if($product->id==$id)
                $this->smarty->assign('product', $product);
        }
        $this->smarty->assign('categories',$categories);
        $this->smarty->display('editProduct.tpl');
    }
}