<?php
namespace App\Model;
class Router
{
    private $_controller;
    private $_action;

    public function __construct($route)
    {
        $parsedRoute = explode('_', $route);
        if (sizeof($parsedRoute) != 2) {
            throw new RouterException('Invalid route path');
        }
        list($this->_controller, $this->_action) = $parsedRoute;
    }

    public function getController()
    {
        return '\\App\\Controller\\' . ucfirst($this->_controller) . 'Controller';
    }

    public function getAction()
    {
        return lcfirst($this->_action) . 'Action';
    }
}
