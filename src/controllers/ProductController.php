<?php
namespace App\Controller;

class ProductController
    extends ActionController
{
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
        $this->_di->get('Session')->generateToken();

        $product = $this->_di->get('Product');
        $product->load($_GET['id']);

        $reviews = $this->_di->get('ProductReviewCollection');
        $reviews->filterByProduct($product);

        return $this->_di->get('View', [
            'template' => 'product_view',
            'params'   => ['product' => $product, 'reviews' => $reviews]
        ]);
    }
}
