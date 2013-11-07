<?php

class EntityCollection
    implements IteratorAggregate
{
    private $_entities = array();

    private $_limit;

    private $_offset;

    private $_sortField;


    public function __construct(array $entities)
    {
        $this->_entities = $entities;
    }

    protected function _getEntities()
    {
        $entities = array_slice($this->_entities, $this->_offset, $this->_limit);
        return $this->_sortEntities($entities);
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

    public function sort($field) {
        $this->_sortField = $field;
    }

    public function getIterator()
    {
        return new ArrayIterator($this->_getEntities());
    }

    private function _sortEntities($entities)
    {
        if (!$this->_sortField) {
            return $entities;
        }

        usort($entities, function (Entity $first, Entity $second) {
            return $first->getData($this->_sortField) > $second->getData($this->_sortField);
        });
        return $entities;
    }
}
