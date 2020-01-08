<?php
namespace Lib;
use Lib\CartException;

class Cart {
    public $price = 199;
    public $qtys = [];

    public function __construct() {

    }

    public function getTotal() {
        return array_sum(array_map(function($qty) {
            return $qty * $this->price;
        }, $this->qtys));
    }

    public function getProducts() {
        return $this->qtys;
    }

    public function updateQuantities($qtys) {
        foreach ($qtys as $qty) {
            if (!is_numeric($qty) || intval($qty) < 0)
                throw new \Exception("數量不正確！", 1);
        }
        $this->qtys = $qtys;
        return $this;
    }
}


