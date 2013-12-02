<?php
namespace Test\Model;
use \App\Model\ProductReviewCollection;
use \App\Model\Product;

class ProductReviewCollectionTest extends \PHPUnit_Framework_TestCase
{
    public function testTakesDataFromResource()
    {
        $resource = $this->getMock('\App\Model\Resource\IResourceCollection');
        $resource->expects($this->any())
            ->method('fetch')
            ->will($this->returnValue(
                [
                    ['name' => 'Vasia']
                ]
            ));

        $collection = new ProductReviewCollection($resource);

        $reviews = $collection->getReviews();
        $this->assertEquals('Vasia', $reviews[0]->getName());
    }

    public function testIsIterableWithForeachFunction()
    {
        $resource = $this->getMock('\App\Model\Resource\IResourceCollection');
        $resource->expects($this->any())
            ->method('fetch')
            ->will($this->returnValue(
                [
                    ['name' => 'Vasia'],
                    ['name' => 'Petia']
                ]
            ));

        $collection = new ProductReviewCollection($resource);
        $expected = array(0 => 'Vasia', 1 => 'Petia');
        $iterated = false;
        foreach ($collection as $_key => $_productReview) {
            $this->assertEquals($expected[$_key], $_productReview->getName());
            $iterated = true;
        }

        if (!$iterated) {
            $this->fail('Iteration did not happen');
        }
    }

    /**
     * @dataProvider getProductIds
     */
    public function testFiltersCollectionByProduct($productId)
    {
        $product = new Product(['product_id' => $productId]);
        $resource = $this->getMock('\App\Model\Resource\IResourceCollection');
        $resource->expects($this->any())
            ->method('filterBy')
            ->with($this->equalTo('product_id'), $this->equalTo($productId));

        $collection = new ProductReviewCollection($resource);

        $collection->filterByProduct($product);
    }

    public function getProductIds()
    {
        return [[1], [2]];
    }

    public function testCalculatesAverageRating()
    {
        $resource = $this->getMock('\App\Model\Resource\IResourceCollection');
        $resource->expects($this->any())
            ->method('average')
            ->with($this->equalTo('rating'));

        $collection = new ProductReviewCollection($resource);
        $collection->getAverageRating();
    }

}
