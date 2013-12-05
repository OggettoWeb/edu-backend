<?php
namespace App\Model;
use App\Model\Resource\IResourceEntity;

class Customer extends Entity
{
    public function save(IresourceEntity $resource)
    {
        $id = $resource->save($this->_data);
        $this->_data['customer_id'] = $id;
    }

    public function getId()
    {
        return $this->_getData('customer_id');
    }
}
