<?php
ini_set('display_errors', 1);

require_once __DIR__ . '/../src/models/Router.php';

$router = new Router($_GET['page']);


$controllerName = $router->getController();
require_once __DIR__ . "/../src/controllers/{$controllerName}.php";

$controller = new $controllerName;
$actionName = $router->getAction();

// ?page = product_list
// $controller = new ProductController;
// $actionName = listAction
//
// $controller->listAction()
$controller->$actionName();

