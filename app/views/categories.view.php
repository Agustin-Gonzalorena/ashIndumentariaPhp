<?php
require_once './libs/smarty/libs/Smarty.class.php';

class categoriesView{
    private $smarty;

    function __construct() {
        $this->smarty = new Smarty();
    }

    function showEditCategories($categories,$products,$msg){
        arsort($categories);
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
        $this->smarty->assign('categories',$categories);
        $this->smarty->display('editCategories.tpl');
    }
    
    function showEditCategory($category){
        $this->smarty->assign('category',$category);
        $this->smarty->display('editCategory.tpl');
    }
}