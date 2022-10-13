<?php
require_once './libs/smarty/libs/Smarty.class.php';
class editCategoriesView{
    private $smarty;

    function __construct() {
        $this->smarty = new Smarty();
    }

    function showEditCategories($category,$products,$msg){
        arsort($category);
        $successMsg='';
        $errorMsg='';
        switch($msg){
            case 'add':
                $successMsg='Categoria AGREGADA correctamente.';
                break;
            case 'delete':
                $successMsg='Categoria ELIMINADA correctamente.';
                break;
            case 'update':
                $successMsg='Categoria MODIFICADA correctamente.';
                break;
            case 'error':
                $errorMsg='Actualmente existen productos con esta categoria.';
                break;
            default:
                $successMsg='';
                $errorMsg='';
                break;
        }
        $this->smarty->assign('errorMsg',$errorMsg);
        $this->smarty->assign('successMsg',$successMsg);
        $this->smarty->assign('products',$products);
        $this->smarty->assign('category',$category);
        $this->smarty->display('editCategories.tpl');
    }
    
    function showEditCategory($category,$id){
        foreach($category as $item)
            if($item->id==$id)
                $this->smarty->assign('category',$item);
        $this->smarty->display('editCategory.tpl');
    }
    
}