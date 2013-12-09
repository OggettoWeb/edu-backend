<?php
class CartController
{

    public function addAction()
    {
        $quoteItem = $this->_initQuoteItem();
        $quoteItem->addQty($_POST['qty']);
        $quoteItem->save(new QuoteItemResource);
    }

    public function updateAction()
    {
        $quoteItem = $this->_initQuoteItem();
        $quoteItem->updateQty($_POST['qty']);
        $quoteItem->save(new QuoteItemResource);
    }

    public function deleteAction()
    {
        $quoteItem = $this->_initQuoteItem();
        $quoteItem->delete(new QuoteItemResource);
    }

    public function listAction()
    {
        $quote = $this->_initQuote();
        $quoteItems = new QuoteItemCollection(new QICollectionResource);
        $quoteItems->filterByQuote($quote);
        $quoteItems->assignProducts(new Product(), new ProductResource);

        /*
        // quote item collection:
        foreach ($this as $_item) {
            $product = clone $prototype; // Product
            $product->load($_item->getProductId());
            $_item->assignProduct($product); // call getProduct in template
        }
        */
    }

    private function _initQuoteItem()
    {
        $quote = $this->_initQuote();

        $product = new Product();
        $product->load($_POST['product_id'], new ProductResource);

        $quoteItem = $quote->getItemForProduct($product, new QuoteItemResource);
        return $quoteItem;
    }

    private function _initQuote()
    {
        $quote = new Quote();
        $session = new Session; // get session
        if ($session->isLoggedIn()) {
            $quote->loadByCustomer($session->getCustomer());
            return $quote;
        } else {
            $quote->loadBySession($session);
            return $quote;
        }
    }

}
