<?php
require_once __DIR__ . '/../src/ProductReview.php';
require_once __DIR__ . '/../src/ProductReviewCollection.php';

class ProductReviewCollectionTest extends PHPUnit_Framework_TestCase
{
    public function testReturnsReviewsWhichHaveBeenInitialized()
    {
        $reviews = [new ProductReview(['text' => 'fuu']), new ProductReview(['text' => 'bar'])];
        $collection = new ProductReviewCollection($reviews);
        $this->assertEquals($reviews, $collection->getReviews());
    }

    public function testCalculatesCollectionSizeAsProductReviewsCount()
    {
        $reviews = new ProductReviewCollection([new ProductReview([]), new ProductReview([])]);
        $this->assertEquals(2, $reviews->getSize());

        $reviews = new ProductReviewCollection([new ProductReview([])]);
        $this->assertEquals(1, $reviews->getSize());
    }

    public function testAppliesLimitToProductReviewCollectionSize()
    {
        $reviews = new ProductReviewCollection(
            [
                new ProductReview(['text' => 'fuu']),
                new ProductReview(['text' => 'bar']),
                new ProductReview(['text' => 'baz'])
            ]
        );
        $reviews->limit(1);
        $this->assertEquals(1, $reviews->getSize());

        $reviews->limit(2);
        $this->assertEquals(2, $reviews->getSize());

        $reviews->limit(4);
        $this->assertEquals(3, $reviews->getSize());
    }

    public function testAppliesLimitToCollectionProductReviews()
    {
        $reviews = new ProductReviewCollection(
            [
                new ProductReview(['text' => 'fuu']),
                new ProductReview(['text' => 'bar']),
                new ProductReview(['text' => 'baz'])
            ]
        );
        $reviews->limit(1);
        $this->assertEquals([new ProductReview(['text' => 'fuu'])], $reviews->getReviews());

        $reviews->limit(2);
        $this->assertEquals(
            [new ProductReview(['text' => 'fuu']), new ProductReview(['text' => 'bar'])],
            $reviews->getReviews()
        );
    }

    public function testAppliesOffsetToCollectionProductReviews()
    {
        $reviews = new ProductReviewCollection(
            [
                new ProductReview(['text' => 'fuu']),
                new ProductReview(['text' => 'bar']),
                new ProductReview(['text' => 'baz'])
            ]
        );
        $reviews->offset(1);
        $this->assertEquals(
            [
                new ProductReview(['text' => 'bar']),
                new ProductReview(['text' => 'baz'])
            ],  $reviews->getReviews())
        ;

        $reviews->offset(2);
        $this->assertEquals([new ProductReview(['text' => 'baz'])], $reviews->getReviews());
    }

    public function testReturnsAllProductReviewsForZeroOffset()
    {
        $reviews = new ProductReviewCollection(
            [
                new ProductReview(['text' => 'fuu']),
                new ProductReview(['text' => 'bar']),
                new ProductReview(['text' => 'baz'])
            ]
        );
        $reviews->offset(0);
        $this->assertEquals(
            [
                new ProductReview(['text' => 'fuu']),
                new ProductReview(['text' => 'bar']),
                new ProductReview(['text' => 'baz'])
            ],
            $reviews->getReviews()
        );
    }

    public function testAppliesOffsetForProductReviewCollectionSize()
    {
        $collection = new ProductReviewCollection(
            [
                new ProductReview(['text' => 1]),
                new ProductReview(['text' => 2]),
                new ProductReview(['text' => 3])
            ]
        );
        $collection->offset(1);

        $this->assertEquals(2, $collection->getSize());
    }
    
    public function testCalculatesAverageRatingOfReviews()
    {
        $collection = new ProductReviewCollection(
            [
                new ProductReview(['rating' => 1]),
                new ProductReview(['rating' => 2]),
                new ProductReview(['rating' => 3])
            ]
        );

        $this->assertEquals((1 + 2 + 3) / 3, $collection->getAverageRating());
    }
}
