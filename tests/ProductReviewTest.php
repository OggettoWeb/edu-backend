<?php
require_once __DIR__ . '/../src/ProductReview.php';
require_once __DIR__ . '/../src/Product.php';

class ProductReviewReviewTest extends PHPUnit_Framework_TestCase
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
}
