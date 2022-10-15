<?php
require_once 'app/controllers/main.controller.php';
require_once 'app/controllers/products.controller.php';
require_once 'app/controllers/categories.controller.php';
require_once 'app/controllers/users.controller.php';

define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');


if (!empty($_GET['action'])){
    $action = $_GET['action'];
}
else {
    $action = 'home';
}
$params = explode('/', $action);

$mainController=new mainController();
$productsController=new productsController();
$categoriesController=new categoriesController();
$usersController=new usersController();

switch ($params[0]) {
    case 'home':
        $mainController->showHome();
        break;
    case 'about':
        $mainController->showAbout();
        break;
    case 'allProducts':
        $productsController->showAllProducts();
        break;
    case 'product':
        $productsController->showProduct($params[1]);
        break;
    case 't-shirts':
        $productsController->showTshirts($params[1]);
        break;
    case 'sweatshirt':
        $productsController->showSweatshirt($params[1]);
        break;
    case 'jackets':
        $productsController->showJackets($params[1]);
        break;
    case 'login':
        $usersController->showFormLogin();
        break;
    case 'validate':
        $usersController->validateUser();
        break;
    case 'logout':
        $usersController->logout();
        break;
    case 'signUp':
        if(!empty($params[1]))
            $usersController->showSignUp($params[1]);
        else
            $usersController->showSignUp();
        break;
    case 'validateSignUp':
        $usersController->addUser();
        break;
    case 'profile':
        $usersController->showProfile();
        break;   
    case 'listUsers':
        $usersController->listUsers();
        break;
    case 'updateAdmin':
        $usersController->updateAdmin($params[1]);
        break;
    case 'deleteUser':
        $usersController->deleteUser();
        break; 
    case 'changePassword':
        $usersController->changePassword();
        break;             
    case 'adminPage':
        $mainController->showAdminPage();
        break;
    case 'listProducts':
        if(!empty($params[1]))
            $productsController->listProducts($params[1]);
        else
            $productsController->listProducts();
        break;
    case 'editProduct':
        $productsController->editProduct($params[1]);
        break;
    case 'updateProduct':
        $productsController->updateProduct($params[1]);
        break;
    case 'addProduct':
        $productsController->addProduct();
        break;
    case 'deleteProduct':
        $productsController->deleteProduct($params[1]);
        break;
    case 'editCategories':
        if(!empty($params[1]))
            $categoriesController->showEditCategories($params[1]);
        else
            $categoriesController->showEditCategories();
        break;
    case 'editCategory':
        $categoriesController->showEditCategory($params[1]);
        break;
    case 'updateCategory':
        $categoriesController->updateCategory($params[1]);
        break;
    case 'deleteCategory':
        $categoriesController->deleteCategory($params[1]);
        break; 
    case 'addCategory':
        $categoriesController->addCategory();
        break;             
    default:
        $mainController->showNotFound();
        break;
}
