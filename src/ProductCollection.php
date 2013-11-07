<?php
require_once __DIR__ . '/EntityCollection.php';

class ProductCollection extends EntityCollection
{
    public function getProducts()
    {
        return $this->_getEntities();
    }
}