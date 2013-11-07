<?php
require_once __DIR__ . '/EntityCollection.php';

class ProductReviewCollection extends EntityCollection
{
    public function getReviews()
    {
        return $this->_getEntities();
    }

    public function getAverageRating()
    {
        $ratings = array_map(function (ProductReview $review) {
            return $review->getRating();
        }, $this->getReviews());

        return array_sum($ratings) / count($ratings);
    }
}