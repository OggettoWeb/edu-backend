<?php

class ProductCollection
{
    private $_products = array();

    private $_limit;

    private $_offset;

    public function __construct(array $products)
    {
        $this->_products = $products;
    }

    public function getProducts()
    {
        return array_slice($this->_products, $this->_offset, $this->_limit);
    }

    public function getSize()
    {
        return count($this->getProducts());
    }

    public function limit($limit)
    {
        $this->_limit = $limit;
    }

    public function offset($offset)
    {
        $this->_offset = $offset;
    }
}