<?php
require_once __DIR__ . '/../src/models/Router.php';

class RouterTest extends PHPUnit_Framework_TestCase
{
    public function testReturnsControllerNameMatchedByRoute()
    {
        $router = new Router('foo_bar');
        $this->assertEquals(
            'FooController', $router->getController()
        );

        $router = new Router('product_bar');
        $this->assertEquals(
            'ProductController', $router->getController()
        );
    }

    public function testReturnsActionNameMatchedByRoute()
    {
        $router = new Router('foo_bar');
        $this->assertEquals('barAction',$router->getAction());

        $router = new Router('product_list');
        $this->assertEquals('listAction',$router->getAction());
    }

    public function testTransformsFirstCharacterOfControllerNameToUppercase()
    {
        $router = new Router('foo_bar');
        $this->assertEquals(
            'FooController', $router->getController()
        );
    }

    public function testTransformsFirstCharacterOfActionToLowercase()
    {
        $router = new Router('foo_Bar');
        $this->assertEquals('barAction',$router->getAction());
    }

    /**
     *
     * @expectedException RouterException
     * @expectedExceptionMessage Invalid route path
     */
    public function testThrowsExceptionIfRouteIsInvalid()
    {
        $router = new Router('foo');
    }
}
