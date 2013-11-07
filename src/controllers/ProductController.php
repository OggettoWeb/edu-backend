<?php
require_once __DIR__ . '/../models/ProductCollection.php';
require_once __DIR__ . '/../models/Product.php';

class ProductController
{
    public function listAction()
    {
        $products = new ProductCollection([
            new Product([
                'image'         => 'http://active-buy.com/foto/thumb-kopiya-nokia-6900-tv-2sim-fm-12-1mpx-kamera-mobilnye-telefony-597.jpg',
                'name'          => 'Nokla',
                'sku'           => '1233212312312312',
                'price'         => 100,
                'special_price' => 99.99,
            ]),
            new Product([
                'image'         => 'http://active-buy.com/foto/thumb-kopiya-nokia-6900-tv-2sim-fm-12-1mpx-kamera-mobilnye-telefony-597.jpg',
                'name'          => 'Nokla',
                'sku'           => '1233212312312312',
                'price'         => 100,
                'special_price' => 99.99,
            ]),
            new Product([
                'image'         => 'http://active-buy.com/foto/thumb-kopiya-nokia-6900-tv-2sim-fm-12-1mpx-kamera-mobilnye-telefony-597.jpg',
                'name'          => 'Nokla',
                'sku'           => '1233212312312312',
                'price'         => 100,
                'special_price' => 99.99,
            ]),
        ]);

        require_once __DIR__ . '/../views/product_list.phtml';
    }

    public function viewAction()
    {
        $product = new Product([
            'image'         => 'http://active-buy.com/foto/thumb-kopiya-nokia-6900-tv-2sim-fm-12-1mpx-kamera-mobilnye-telefony-597.jpg',
            'name'          => 'Nokla',
            'sku'           => '1233212312312312',
            'price'         => 100,
            'special_price' => 99.99,
        ]);

        require_once __DIR__ . '/../views/product_view.phtml';
    }
}
