<?php

namespace App\Controller;

class CheckoutController
extends SalesController
{

    public function addressAction()
    {
        if (isset($_POST['address'])) {
            $quote = $this->_initQuote();
            $address = $quote->getAddress();
            $address->setData($_POST['address']);
            $address->save();
            $this->_redirect('shipping');
        }
    }

    public function shippingAction()
    {

    }
}
 