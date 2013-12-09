<?php
namespace App\Controller;

use App\Model\Resource\DBCollection;
use App\Model\Resource\DBEntity;
use App\Model\ProductCollection;
use App\Model\Product;
use App\Model\Resource\Paginator as PaginatorAdapter;
use App\Model\Resource\Table\Product as ProductTable;
use Zend\Paginator\Paginator as ZendPaginator;

class ProductController
{
    public function listAction()
    {
        $connection = new \PDO('mysql:host=localhost;dbname=student', 'root', '123123');
        $resource = new DBCollection($connection, new ProductTable);

        $paginatorAdapter = new PaginatorAdapter($resource);
        $paginator = new ZendPaginator($paginatorAdapter);
        $paginator
            ->setItemCountPerPage(2)
            ->setCurrentPageNumber(isset($_GET['p']) ? $_GET['p'] : 1);
        $pages = $paginator->getPages();

        $products = new ProductCollection($resource);
        $view = 'product_list';
        require_once __DIR__ . '/../views/layout/base.phtml';
    }

    public function viewAction()
    {
        $product = new Product([]);

        $connection = new \PDO('mysql:host=localhost;dbname=student', 'root', '123123');
        $resource = new DBEntity($connection, new ProductTable);
        $product->load($resource, $_GET['id']);

        $view = 'product_view';
        require_once __DIR__ . '/../views/layout/base.phtml';
    }
}
