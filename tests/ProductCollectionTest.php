<?php
require_once __DIR__ . '/../src/models/Product.php';
require_once __DIR__ . '/../src/models/ProductCollection.php';

class ProductCollectionTest extends PHPUnit_Framework_TestCase
{
    public function testReturnsProductsWhichHaveBeenInitialized()
    {
        $products = [new Product(['sku' => 'fuu']), new Product(['sku' => 'bar'])];
        $collection = new ProductCollection($products);
        $this->assertEquals($products, $collection->getProducts());
    }

    public function testCalculatesCollectionSizeAsProductsCount()
    {
        $products = new ProductCollection([new Product([]), new Product([])]);
        $this->assertEquals(2, $products->getSize());

        $products = new ProductCollection([new Product([])]);
        $this->assertEquals(1, $products->getSize());
    }

    public function testAppliesLimitToProductCollectionSize()
    {
        $products = new ProductCollection(
            [new Product(['sku' => 'fuu']), new Product(['sku' => 'bar']), new Product(['sku' => 'baz'])]
        );
        $products->limit(1);
        $this->assertEquals(1, $products->getSize());

        $products->limit(2);
        $this->assertEquals(2, $products->getSize());

        $products->limit(4);
        $this->assertEquals(3, $products->getSize());
    }

    public function testAppliesLimitToCollectionProducts()
    {
        $products = new ProductCollection(
            [new Product(['sku' => 'fuu']), new Product(['sku' => 'bar']), new Product(['sku' => 'baz'])]
        );
        $products->limit(1);
        $this->assertEquals([new Product(['sku' => 'fuu'])], $products->getProducts());

        $products->limit(2);
        $this->assertEquals([new Product(['sku' => 'fuu']), new Product(['sku' => 'bar'])], $products->getProducts());
    }

    public function testAppliesOffsetToCollectionProducts()
    {
        $products = new ProductCollection(
            [new Product(['sku' => 'fuu']), new Product(['sku' => 'bar']), new Product(['sku' => 'baz'])]
        );
        $products->offset(1);
        $this->assertEquals([new Product(['sku' => 'bar']), new Product(['sku' => 'baz'])], $products->getProducts());

        $products->offset(2);
        $this->assertEquals([new Product(['sku' => 'baz'])], $products->getProducts());
    }

    public function testReturnsAllProductsForZeroOffset()
    {
        $products = new ProductCollection(
            [new Product(['sku' => 'fuu']), new Product(['sku' => 'bar']), new Product(['sku' => 'baz'])]
        );
        $products->offset(0);
        $this->assertEquals(
            [new Product(['sku' => 'fuu']), new Product(['sku' => 'bar']), new Product(['sku' => 'baz'])],
            $products->getProducts()
        );
    }

    public function testAppliesOffsetForProductCollectionSize()
    {
        $collection = new ProductCollection(
            [new Product(['sku' => 1]), new Product(['sku' => 2]), new Product(['sku' => 3])]
        );
        $collection->offset(1);

        $this->assertEquals(2, $collection->getSize());
    }

    public function testIsIterableWithForeachFunction()
    {
        $collection = new ProductCollection(
            [new Product(['sku' => 'foo']), new Product(['sku' => 'bar'])]
        );
        $expected = array(0 => 'foo', 1 => 'bar');
        $iterated = false;
        foreach ($collection as $_key => $_product) {
            $this->assertEquals($expected[$_key], $_product->getSku());
            $iterated = true;
        }

        if (!$iterated) {
            $this->fail('Iteration did not happen');
        }
    }

    public function testSortsProductsByField()
    {
        $collection = new ProductCollection(
            [
                new Product(['sku' => 'C']),
                new Product(['sku' => 'A']),
                new Product(['sku' => 'B'])
            ]
        );

        $collection->sort('sku');
        $this->assertEquals(
            [
                new Product(['sku' => 'A']),
                new Product(['sku' => 'B']),
                new Product(['sku' => 'C'])
            ],
            $collection->getProducts()
        );
    }
}
