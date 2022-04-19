<?php

namespace App\Service;

class ProductHandler
{
    private $products = [];

    /**
     * ProductHandler constructor.
     * @param array $products data of products
     */
    public function __construct(array $products)
    {
        $this->products = $products;
    }

    /**
     * Get total price from all products
     * @return float|int
     */
    public function getTotalPrice()
    {
        $totalPrice = 0;
        $prices = array_column($this->products, 'price');
        if ($prices)
        {
            $totalPrice = array_sum($prices);
        }

        return $totalPrice;
    }

    /**
     * Get products which type is 'Dessert' and DESC by prices
     * @return array
     */
    public function getDessertProducts()
    {
        $desserts = [];
        $prices = [];
        $search = 'dessert';
        foreach($this->products as $product)
        {
            if ($product['type'] && $search = strtolower($product['type']))
            {
                $desserts[] = $product;
                $prices[] = $product['price']?$product['price']:0;
            }
        }
        array_multisort($prices, SORT_DESC, $desserts);

        return $desserts;
    }

    /**
     * Convert the create time of product to unix timestamp
     * @return array
     */
    public function convertCreateTimestamp()
    {
        $converted = [];
        foreach($this->products as $product)
        {
            if ($product['create_at'])
            {
                $product['create_at'] = strtotime($product['create_at']);
            }
            $converted[] = $product;
        }

        return $converted;
    }
}