<?php
namespace App\Model;


class Quote
    extends Entity
{
    private $_items;

    public function __construct(
        array $data = [],
        Resource\IResourceEntity $resource = null,
        QuoteItemCollection $items = null
    ) {
        $this->_items = $items;
        parent::__construct($data, $resource);
    }

    public function loadBySession(Session $session)
    {
        if ($quoteId = $session->getQuoteId()) {
            $this->load($session->getQuoteId());
        } else {
            $this->save();
            $session->setQuoteId($this->getId());
        }
    }

    public function getItems()
    {
        $this->_items->filterByQuote($this);
        return $this->_items;
    }
}