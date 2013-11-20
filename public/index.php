<?php
ini_set('display_errors', 1);

require_once __DIR__ . '/../src/models/Router.php';
require_once __DIR__ . '/../src/models/RouterException.php';

try {
    $defaultPath = 'product_list';

    $routePath = isset($_GET['page']) ? $_GET['page'] : $defaultPath ;

    $router = new Router($routePath);
    $controllerName = $router->getController();
    $actionName = $router->getAction();


    $controllerFilePath = __DIR__ . "/../src/controllers/{$controllerName}.php";

    if (!file_exists($controllerFilePath)) {
        throw new RouterException('Controller file not found');
    }

    require_once $controllerFilePath;

    if (!class_exists($controllerName) || !method_exists($controllerName, $actionName)) {
        throw new RouterException('Class or method are not exist');
    }

} catch (RouterException $e) {
    $controllerName = 'ErrorController';
    $actionName = 'notFoundAction';
}

require_once __DIR__ . "/../src/controllers/{$controllerName}.php";

$controller = new $controllerName;
$controller->$actionName();




