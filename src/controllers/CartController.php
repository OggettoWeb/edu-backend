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
        // no customer quotes for now :(
//        $quoteItems = $this->_di->get('QuoteItems', ['table' => 'App\Model\Resource\Table\QuoteItem']);
//        $quote = $this->_di->get('Quote', ['items' => $quoteItems, 'table' => 'App\Model\Resource\Table\Quote']);
//
        $quoteResource = $this->_di->newInstance('App\Model\Resource\DBEntity', ['table' => 'App\Model\Resource\Table\Quote']);

        $itemResource = $this->_di->newInstance('App\Model\Resource\DBEntity', ['table' => 'App\Model\Resource\Table\QuoteItem']);
        $itemsResource = $this->_di->newInstance('App\Model\Resource\DBCollection', ['table' => 'App\Model\Resource\Table\QuoteItem']);
        $itemPrototype = new \App\Model\QuoteItem([], $itemResource);

        $quoteItems = new \App\Model\QuoteItemCollection($itemsResource, $itemPrototype);
        $quote = new \App\Model\Quote([], $quoteResource, $quoteItems);

        $session = $this->_di->get('Session');
        $quote->loadBySession($session);
        return $quote;
    }
}
