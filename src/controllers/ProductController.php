<?php
namespace App\Controller;

use App\Model\Resource\DBEntity;
use App\Model\Product;
use App\Model\Resource\Table\Product as ProductTable;

class ProductController
{
    private $_di;

    public function __construct(\Zend\Di\Di $di)
    {
        $this->_di = $di;
    }
    public function listAction()
    {
        $resource = $this->_di->get('ResourceCollection', ['table' => new \App\Model\Resource\Table\Product()]);
        $paginator = $this->_di->get('Paginator', ['collection' => $resource]);
        $paginator
            ->setItemCountPerPage(2)
            ->setCurrentPageNumber(isset($_GET['p']) ? $_GET['p'] : 1);
        $pages = $paginator->getPages();

        $products = $this->_di->get('ProductCollection', ['resource' => $resource]);

        return $this->_di->get('View', [
            'template' => 'product_list',
            'params'   => ['products' => $products, 'pages' => $pages]
        ]);

    }

    public function viewAction()
    {
        $product = new Product([], $resource);

        $connection = new \PDO('mysql:host=localhost;dbname=student', 'root', '123123');
        $resource = new DBEntity($connection, new ProductTable);
        $product->load($_GET['id']);

        $view = 'product_view';
        require_once __DIR__ . '/../views/layout/base.phtml';
    }
}
