<?php
namespace App\Model\Resource\Table;
class QuoteItem implements ITable
{
    public function getName()
    {
        return 'quote_items';
    }

    public function getPrimaryKey()
    {
        return 'item_id';
    }
}
  