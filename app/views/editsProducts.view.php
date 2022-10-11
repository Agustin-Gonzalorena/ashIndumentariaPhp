<?php
require_once './libs/smarty/libs/Smarty.class.php';


class editsProductsView{
    private $smarty;

    function __construct() {
        $this->smarty = new Smarty();
    }

    function listProducts($products,$category){
        arsort($products);
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