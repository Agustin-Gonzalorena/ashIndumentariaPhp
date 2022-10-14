<?php
require_once 'app/controllers/products.controller.php';
require_once 'app/controllers/admin.controller.php';
require_once 'app/controllers/auth.controller.php';
require_once 'app/controllers/editsProducts.controller.php';
require_once 'app/controllers/main.controller.php';
require_once 'app/controllers/editCategories.controller.php';
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
$productController=new productsController();
$adminController= new adminController();
$authController = new AuthController();
$editsProductsController=new editsProductsController();
$editCategoriesController=new editCategoriesController();
$usersController=new usersController();

switch ($params[0]) {
    case 'home':
        $mainController->showHome();
        break;
    case 'about':
        $mainController->showAbout();
        break;
    case 'allProducts':
        $productController->showAllProducts();
        break;
    case 'product':
        $productController->showProduct($params[1]);
        break;
    case 't-shirts':
        $productController->showTshirts($params[1]);
        break;
    case 'sweatshirt':
        $productController->showSweatshirt($params[1]);
        break;
    case 'jackets':
        $productController->showJackets($params[1]);
        break;
    case 'login':
        $authController->showFormLogin();
        break;
    case 'validate':
        $authController->validateUser();
        break;
    case 'logout':
        $authController->logout();
        break;
    case 'signUp':
        if(!empty($params[1]))
            $authController->showSignUp($params[1]);
        else
            $authController->showSignUp();
        break;
    case 'validateSignUp':
        $authController->addUser();
        break;
    case 'profile':
        $mainController->showProfile();
        break;   
    case 'listUsers':
        $adminController->listUsers();
        break;
    case 'updateAdmin':
        $adminController->updateAdmin($params[1]);
        break;
    case 'deleteUser':
        $usersController->deleteUser();
        break; 
    case 'changePassword':
        $usersController->changePassword();
        break;             
    case 'adminPage':
        $adminController->showAdminPage();
        break;
    case 'listProducts':
        if(!empty($params[1]))
            $editsProductsController->listProducts($params[1]);
        else
            $editsProductsController->listProducts();
        break;
    case 'editProduct':
        $editsProductsController->editProduct($params[1]);
        break;
    case 'updateProduct':
        $editsProductsController->updateProduct($params[1]);
        break;
    case 'addProduct':
        $editsProductsController->addProduct();
        break;
    case 'deleteProduct':
        $editsProductsController->deleteProduct($params[1]);
        break;
    case 'editCategories':
        if(!empty($params[1]))
            $editCategoriesController->showEditCategories($params[1]);
        else
            $editCategoriesController->showEditCategories();
        break;
    case 'editCategory':
        $editCategoriesController->showEditCategory($params[1]);
        break;
    case 'updateCategory':
        $editCategoriesController->updateCategory($params[1]);
        break;
    case 'deleteCategory':
        $editCategoriesController->deleteCategory($params[1]);
        break; 
    case 'addCategory':
        $editCategoriesController->addCategory();
        break;             
    default:
        $mainController->showNotFound();
        break;
}
