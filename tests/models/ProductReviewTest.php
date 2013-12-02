<?php
namespace Test\Model;
use \App\Model\ProductReview;
use \App\Model\Product;

class ProductReviewTest extends \PHPUnit_Framework_TestCase
{
    public function testReturnsNameWhichHasBeenInitialized()
    {
        $review = new ProductReview(['name' => 'Sasha']);
        $this->assertEquals('Sasha', $review->getName());

        $review = new ProductReview(['name' => 'Masha']);
        $this->assertEquals('Masha', $review->getName());
    }

    public function testReturnsEmailWhichHasBeenInitialized()
    {
        $review = new ProductReview(['email' => 'foo@mail.ru']);
        $this->assertEquals('foo@mail.ru', $review->getEmail());

        $review = new ProductReview(['email' => 'bar@mail.ru']);
        $this->assertEquals('bar@mail.ru', $review->getEmail());
    }

    public function testReturnsTextWhichHasBeenInitialized()
    {
        $review = new ProductReview(['text' => 'foo']);
        $this->assertEquals('foo', $review->getText());

        $review = new ProductReview(['text' => 'bar']);
        $this->assertEquals('bar', $review->getText());
    }

    public function testReturnsRatingWhichHasBeenInitialized()
    {
        $review = new ProductReview(['rating' => 1]);
        $this->assertEquals(1, $review->getRating());

        $review = new ProductReview(['rating' => 2]);
        $this->assertEquals(2, $review->getRating());
    }

    public function testChecksThatBelongsToProductByLink()
    {
        $productFoo = new Product(['sku' => 'foo']);
        $productBar = new Product(['sku' => 'bar']);

        $review = new ProductReview(['product' => $productFoo]);
        $this->assertTrue($review->belongsToProduct($productFoo));
        $this->assertFalse($review->belongsToProduct($productBar));
    }


    public function testLoadsDataFromResource()
    {
        $resource = $this->getMock('\App\Model\Resource\IResourceEntity');
        $resource->expects($this->any())
            ->method('find')
            ->with($this->equalTo(42))
            ->will($this->returnValue(['name' => 'Vasia']));

        $productReview = new ProductReview([]);
        $productReview->load($resource, 42);

        $this->assertEquals('Vasia', $productReview->getName());
    }
}
