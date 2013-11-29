<?php
require_once __DIR__ . '/Resource/IResourceCollection.php';
require_once __DIR__ . '/ProductReview.php';

class ProductReviewCollection
    implements IteratorAggregate
{
    private $_resource;

    public function __construct(IResourceCollection $resource)
    {
        $this->_resource = $resource;
    }

    public function getReviews()
    {
        return array_map(
            function ($data) {
                return new ProductReview($data);
            },
            $this->_resource->fetch()
        );
    }

    public function getIterator()
    {
        return new ArrayIterator($this->getReviews());
    }

    public function filterByProduct(Product $product)
    {
        $this->_resource->filterBy('product_id', $product->getId());
    }

    public function getAverageRating()
    {
        return $this->_resource->average('rating');
    }
}