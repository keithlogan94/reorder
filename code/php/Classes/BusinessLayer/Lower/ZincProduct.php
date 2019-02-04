<?php
/**
 * Created by PhpStorm.
 * User: becke
 * Date: 2/4/2019
 * Time: 9:22 AM
 */

namespace code\php\Classes\BusinessLayer\Upper;

use Exception;

class ZincProduct
{

    private $productId;
    private $quantity;


    public function getOrderArray()
    {
        if (is_null($this->productId) || is_null($this->quantity))
            throw new Exception('zinc product is not completely set');
        return array(
            'product_id' => $this->productId,
            'quantity' => $this->quantity
        );
    }


}