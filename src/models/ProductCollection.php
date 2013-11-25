<?php
require_once __DIR__ . '/Resource/IResourceCollection.php';
require_once __DIR__ . '/EntityCollection.php';
require_once __DIR__ . '/Entity.php';

class ProductCollection
    implements IteratorAggregate
{
    private $_resource;

    public function __construct(IResourceCollection $resource)
    {
        $this->_resource = $resource;
    }

    public function getProducts()
    {
        return array_map(
            function ($data) {
                return new Product($data);
            },
            $this->_resource->fetch()
        );
    }

    public function getIterator()
    {
        return new ArrayIterator($this->getProducts());
    }
}