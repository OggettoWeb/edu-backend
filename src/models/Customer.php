<?php
namespace App\Model;
use App\Model\Resource\IResourceEntity;

class Customer extends Entity
{
    public function getId()
    {
        return $this->_getData('customer_id');
    }

    public function save()
    {
        $id = $this->_resource->save($this->_data);
        $this->_data['customer_id'] = $id;
    }
}
