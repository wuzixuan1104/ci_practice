<?php

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Exception;
use Lib\Cart;

class CartTest extends TestCase
{
    /**
     * @dataProvider provider
     */
    public function testUpdateQuantitiesAndGetTotal($quantities, $expected) {
        $cart = new Cart();
        $cart->updateQuantities($quantities);
        $this->assertEquals($expected, $cart->getTotal());
    }

    public function provider() {
        return [
            [ [ 1, 0, 0, 0, 0, 0 ], 199 ],
            [ [ 1, 0, 0, 2, 0, 0 ], 597 ],
        ];
    }

    public function testGetProducts() {
        $cart = new Cart();
        $cart->updateQuantities([ 1, 0, 0, 0, 0, 0 ]);

        $products = $cart->getProducts();
        $this->assertEquals(6, count($products));
        $this->assertEquals(0, $products[3]['quantity']);
    }

    /**
     * @expectedException Exception
     */
    public function testUpdateQuantitiesWithException() {
        $cart = new Cart();
        $quantities = [ 1, 0, 'eer', -1, 0, 0 ];
        $cart->updateQuantities($quantities); // 預期會產生一個 Exception
    }
}





