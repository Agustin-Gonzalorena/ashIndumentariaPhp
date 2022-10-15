<?php
require_once './libs/smarty/libs/Smarty.class.php';

class usersView{
    private $smarty;

    function __construct() {
        $this->smarty = new Smarty();
    }

    function showFormLogin($msg=null) {
        $addMsg='';
        $errorMsg='';
        switch($msg){
            case 'error':
                $errorMsg='El usuario o la contraseña no existe.';
                break;
            case 'addUser':
                $addMsg='Usuario registrado correctamente.';
                break;
            default:
                $addMsg='';
                $errorMsg='';
                break;
        }
        $this->smarty->assign('addMsg',$addMsg);
        $this->smarty->assign('error', $errorMsg);
        $this->smarty->display('loginForm.tpl');
    }

    function showSignUp($msg=null){
        $this->smarty->assign('msg',$msg);
        $this->smarty->display('signUp.tpl');
    }

    function showListUsers($users,$msg=null){
        $this->smarty->assign('error',$msg);
        $this->smarty->assign('users',$users);
        $this->smarty->display('listUsers.tpl');
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