<?php
require_once './libs/smarty/libs/Smarty.class.php';
class editCategoriesView{
    private $smarty;

    function __construct() {
        $this->smarty = new Smarty();
    }

    function showEditCategories($category){
        arsort($category);
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