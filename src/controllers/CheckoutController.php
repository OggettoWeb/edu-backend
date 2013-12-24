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

    public function paymentAction()
    {
        if (isset($_POST['payment'])) {

        } else {
            $quote = $this->_initQuote();
            $methods = $this->_di->get('PaymentFactory')
                ->getMethods()
                ->available($quote->getAddress());
        }
    }

    public function orderAction()
    {
        $quote = $this->_initQuote();
        $quote->collectTotals();
        $quote->save();
        if ($this->_isPost()) {
            $order = $this->_di->get('Order');
            $this->_di->get('QuoteConverter')
                ->toOrder($quote, $order);
            $order->save();
            $order->sendEmail();
        } else {

        }
    }


}
 