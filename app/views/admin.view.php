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
    function showListUsers($users,$msg=null){
        $this->smarty->assign('error',$msg);
        $this->smarty->assign('users',$users);
        $this->smarty->display('listUsers.tpl');
    }
}
