<?php
require_once './libs/smarty/libs/Smarty.class.php';


class editsProductsView{
    private $smarty;

    function __construct() {
        $this->smarty = new Smarty();
    }

    function listProducts($products,$category,$msg){
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
        $this->smarty->assign('category',$category);
        $this->smarty->assign('products',$products);
        $this->smarty->display('listProducts.tpl');
    }


    function showEditProduct($id,$products,$category){
        foreach($products as $item){
            if($item->id==$id){
                $this->smarty->assign('product', $item);
            }
        }
        $this->smarty->assign('category',$category);
        $this->smarty->display('editProduct.tpl');
    }
}