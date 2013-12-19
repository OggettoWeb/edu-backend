<?php
namespace App\Model;

class QuoteItemCollection
    implements \IteratorAggregate
{
    private $_resource;
    private $_prototype;

    public function __construct(Resource\IResourceCollection $resource, QuoteItem $itemPrototype)
    {
        $this->_resource = $resource;
        $this->_prototype = $itemPrototype;
    }

    public function filterByQuote(Quote $quote)
    {
        $this->_prototype->assignToQuote($quote);
        $this->_resource->filterBy('quote_id', $quote->getId());
    }

    public function getItems()
    {
        return array_map(
            function ($data) {
                $item = clone $this->_prototype;
                $item->setData($data);
                return $item;
            },
            $this->_resource->fetch()
        );
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->getItems());
    }

    public function forProduct(Product $product)
    {
        if ($item = $this->_findByProduct($product)) {
            return $item;
        }

        $newItem = clone $this->_prototype;
        $newItem->assignToProduct($product);
        $newItem->save();
        return $newItem;
    }

    private function _findByProduct(Product $product)
    {
        foreach ($this->getItems() as $_item) {
            if ($_item->belongsToProduct($product)) {
                return $_item;
            }
        }
    }
}