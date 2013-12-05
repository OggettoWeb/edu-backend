<?php
namespace App\Controller;

use App\Model\Resource\DBCollection;
use App\Model\Resource\DBEntity;
use App\Model\Customer;
use App\Model\Resource\Table\Customer as CustomerTable;

class CustomerController
{

    public function loginAction()
    {
        $view = 'customer_login';
        require_once __DIR__ . '/../views/layout/base.phtml';
    }

    public function registerAction()
    {
        if (isset($_POST['customer'])) {
            $this->_registerCustomer();
        } else {
            $view = 'customer_register';
            require_once __DIR__ . '/../views/layout/base.phtml';
        }
    }

    private function _registerCustomer()
    {
        $connection = new \PDO('mysql:host=localhost;dbname=student', 'root', '123123');
        $resource = new DBEntity($connection, new CustomerTable);
        $customer = new Customer($_POST['customer']);
        $customer->save($resource);
    }
}
