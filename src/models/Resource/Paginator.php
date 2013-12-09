<?php
namespace App\Model\Resource;

use Zend\Paginator\Adapter\AdapterInterface;

class Paginator
    implements AdapterInterface
{
    private $_collection;

    public function __construct(IResourceCollection $collection)
    {
        $this->_collection = $collection;
    }

    public function getItems($offset, $itemCountPerPage)
    {
        $this->_collection->limit($itemCountPerPage, $offset);
        return $this->_collection->fetch();
    }

    public function count()
    {
        return $this->_collection->count();
    }
}