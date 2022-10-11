<?php
require_once 'app/controllers/products.controller.php';
require_once 'app/controllers/admin.controller.php';
require_once 'app/controllers/auth.controller.php';
require_once 'app/controllers/editsProducts.controller.php';
require_once 'app/controllers/main.controller.php';
require_once 'app/controllers/editCategories.controller.php';

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
    case 'adminPage':
        $adminController->showAdminPage();
        break;
    case 'listProducts':
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
