<?php

class EntityCollection
    implements IteratorAggregate
{
    private $_entities = array();

    private $_limit;

    private $_offset;

    public function __construct(array $entities)
    {
        $this->_entities = $entities;
    }

    protected function _getEntities()
    {
        return array_slice($this->_entities, $this->_offset, $this->_limit);
    }

    public function getSize()
    {
        return count($this->_getEntities());
    }

    public function limit($limit)
    {
        $this->_limit = $limit;
    }

    public function offset($offset)
    {
        $this->_offset = $offset;
    }

    public function getIterator()
    {
        return new ArrayIterator($this->_getEntities());
    }
}
