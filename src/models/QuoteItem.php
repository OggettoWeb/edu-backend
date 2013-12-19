<?php
namespace App\Model;

class QuoteItem
    extends Entity
{
    public function getProductId()
    {
        return $this->_data['product_id'];
    }

    public function belongsToProduct(Product $product)
    {
        return $this->getProductId() == $product->getId();
    }

    public function assignToProduct(Product $product)
    {
        $this->_data['product_id'] = $product->getId();
    }

    public function getQty()
    {
        return $this->_data['qty'];
    }

    public function addQty($qty)
    {
        if (isset($this->_data['qty'])) {
            $this->_data['qty'] += $qty;
        } else {
            $this->_data['qty'] = $qty;
        }
    }

    public function assignToQuote($quote)
    {
        $this->_data['quote_id'] = $quote->getId();
    }
}