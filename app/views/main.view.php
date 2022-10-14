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
    function showProfile($msg=null){
        $error=null;
        $change=null;
        if($msg=="errorPassword"){
            $error="Las contraseñas no coinciden.";
        }
        elseif($msg=="changePassword"){
            $change="Se cambio su contraseña con exito.";
        }
        $this->smarty->assign('change',$change);
        $this->smarty->assign('error',$error);
        $this->smarty->display('profilePage.tpl');
    }
}
