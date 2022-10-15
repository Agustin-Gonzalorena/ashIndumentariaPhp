<?php
require_once './libs/smarty/libs/Smarty.class.php';

class mainView{
    private $smarty;

    function __construct() {
        $this->smarty = new Smarty();
    }

    function showHome($products){
        session_start();
        $array=array();
        foreach($products as $item){
            if($item->stock==1)
                array_push($array,$item);
        }
        $this->smarty->assign('products', $array);
        $this->smarty->display('home.tpl');
    }

    function showAbout(){
        session_start();
        $this->smarty->display('about.tpl');
    }

    function showNotFound(){
        session_start();
        $this->smarty->display('notFound.tpl');
    }

    function showAdminPage(){
        $this->smarty->display('adminPage.tpl');
    }
}
