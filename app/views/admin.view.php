<?php
require_once './libs/smarty/libs/Smarty.class.php';


class adminView{
    private $smarty;

    function __construct() {
        $this->smarty = new Smarty();
    }
    
    function showAdminPage(){
        $this->smarty->display('adminPage.tpl');
    }
}
