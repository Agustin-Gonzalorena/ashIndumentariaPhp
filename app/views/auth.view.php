<?php
require_once './libs/smarty/libs/Smarty.class.php';

class AuthView {
    private $smarty;

    public function __construct() {
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
        switch($msg){
            case 'errorUser':
                $msg='El nombre de usuario es obligatorio.';
                break;
            case 'errorPasswords':
                $msg='Las contraseñas no coinciden.';
                break;
            case 'userDuplicate':
                $msg='El nombre de usuario ya existe.';
                break;
            default:
                $msg='';
        }
        $this->smarty->assign('msg',$msg);
        $this->smarty->display('signUp.tpl');
    }
}