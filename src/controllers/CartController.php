<?php
namespace App\Controller;

class CartController
    extends ActionController
{
    public function addProductAction()
    {
        $quoteItem = $this->_initQuoteItem();
        $quoteItem->addQty(1);
        $quoteItem->save();

        $this->_redirect('cart_list');
    }

    public function listAction()
    {
        $quote = $this->_initQuote();
        $items = $quote->getItems();
        $items->assignProducts($this->_di->get('Product'));

        return $this->_di->get('View', [
            'template' => 'cart_list',
            'params'   => ['items' => $items]
        ]);
    }

    private function _initQuoteItem()
    {
        $quote = $this->_initQuote();

        $product = $this->_di->get('Product');
        $product->load($_POST['product_id']);

        $item = $quote->getItems()->forProduct($product);
        return $item;
    }

    private function _initQuote()
    {
        $quote = $this->_di->get('Quote');
        $session = $this->_di->get('Session');

        $quote->loadBySession($session);
        return $quote;
    }
}
