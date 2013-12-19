<?php
namespace App\Model;
class Entity
{
    protected $_data = array();
    protected $_resource;

    public function __construct(array $data = [], Resource\IResourceEntity $resource = null)
    {
        $this->_data = $data;
        $this->_resource = $resource;
    }

    protected function _getData($key)
    {
        return isset($this->_data[$key]) ? $this->_data[$key] : null;
    }

    public function setData($data)
    {
        $this->_data = $data;
    }

    public function load($id)
    {
        $this->_data = $this->_resource->find($id);
    }

    public function save()
    {
        $id = $this->_resource->save($this->_data);
        $this->_data[$this->_resource->getPrimaryKeyField()] = $id;
    }

    public function getId()
    {
        return $this->_getData($this->_resource->getPrimaryKeyField());
    }
}
