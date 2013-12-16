<?php
namespace App\Controller;

class ProductReviewController
    extends ActionController
{
    public function addAction()
    {
        $data = $_POST;
        unset($data['review_id']);

        $review = $this->_di->get('ProductReview', ['data' => $data]);
        $review->save();

        $this->_redirect('product_view', ['id' => $data['product_id']]);
    }
}
