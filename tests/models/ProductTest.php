<?php
namespace Test\Model;
use \App\Model\Product;

class ProductTest extends \PHPUnit_Framework_TestCase
{
    public function testReturnsSkuWhichHasBeenInitialized()
    {
        $product = new Product(['sku' => '12345']);
        $this->assertEquals('12345', $product->getSku());

        $product = new Product(['sku' => '567890']);
        $this->assertEquals('567890', $product->getSku());
    }

    public function testReturnsNameWhichHasBeenInitialized()
    {
        $product = new Product(['name' => 'Nokio']);
        $this->assertEquals('Nokio', $product->getName());

        $product = new Product(['name' => 'Motorobla']);
        $this->assertEquals('Motorobla', $product->getName());
    }

    public function testReturnsImageWhichHasBeenInitialized()
    {
        $product = new Product(['image' => 'http://url.ru/img.jpg']);
        $this->assertEquals('http://url.ru/img.jpg', $product->getImage());

        $product = new Product(['image' => 'http://url.ru/img2.jpg']);
        $this->assertEquals('http://url.ru/img2.jpg', $product->getImage());
    }

    public function testReturnsPriceWhichHasBeenInitialized()
    {
        $product = new Product(['price' => 123.5]);
        $this->assertEquals(123.5, $product->getPrice());

        $product = new Product(['price' => 42]);
        $this->assertEquals(42, $product->getPrice());
    }

    public function testReturnsSpecialPriceWhichHasBeenInitialized()
    {
        $product = new Product(['special_price' => 123.5]);
        $this->assertEquals(123.5, $product->getSpecialPrice());

        $product = new Product(['special_price' => 42]);
        $this->assertEquals(42, $product->getSpecialPrice());
    }

    public function testSpecialPriceIsAppliedWhenValueIsSet()
    {
        $product = new Product(['special_price' => 123.5]);
        $this->assertTrue($product->isSpecialPriceApplied());

        $product = new Product([]);
        $this->assertFalse($product->isSpecialPriceApplied());
    }

    public function testCastsSpecialPriceToFloatWhenChecksForApplied()
    {
        $product = new Product(['special_price' => '0.00']);
        $this->assertFalse($product->isSpecialPriceApplied());
    }

    public function testReturnsIdWhichHasBeenInitialized()
    {
        $product = new Product(['product_id' => 1]);
        $this->assertEquals(1, $product->getId());

        $product = new Product(['product_id' => 2]);
        $this->assertEquals(2, $product->getId());
    }

    public function testLoadsDataFromResource()
    {
        $resource = $this->getMock('\App\Model\Resource\IResourceEntity');
        $resource->expects($this->any())
            ->method('find')
            ->with($this->equalTo(42))
            ->will($this->returnValue(['name' => 'foo']));

        $product = new Product([], $resource);
        $product->load(42);

        $this->assertEquals('foo', $product->getName());
    }
}
