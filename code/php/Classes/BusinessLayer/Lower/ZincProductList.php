<?php
/**
 * Created by PhpStorm.
 * User: becke
 * Date: 2/4/2019
 * Time: 3:54 PM
 */

namespace code\php\Classes\BusinessLayer\Upper;

require_once $_SERVER['DOCUMENT_ROOT'] . '/code/php/Classes/BusinessLayer/Lower/ZincProduct.php';
use code\php\Classes\BusinessLayer\Upper\ZincProduct;

use Exception;

class ZincProductList
{

    private $products = [];

    public static function loadProductListFromZincSearchResults($resultsArray)
    {
        if (!is_array($resultsArray)) {
            throw new Exception('$resultsArray must be an array');
        }
        $zProductList = new ZincProductList();
        foreach ($resultsArray as $arr) {
            $zProductList->addProduct(
                \code\php\Classes\BusinessLayer\Upper\ZincProduct::loadFromZincProductSearch($arr)
            );
        }

        return $zProductList;
    }

    public function addProduct($product)
    {
        if (!($product instanceof ZincProduct))
            throw new Exception('$product must be instance of ZincProduct');
        $this->products[] = $product;
    }

    public function getProducts()
    {
        return $this->products;
    }

    public function removeAllProductsFromListExceptWithProductId($productId)
    {
        for ($i = 0; $i < count($this->products); ++$i) {
            if ($this->products[$i]->getProductId() != $productId) {
                array_splice($this->products, $i, 1);
                $i = 0;
            }
        }
    }

    public function removeAllProductsFromListExceptWithProductIdsInArray($productIds)
    {
        if (!is_array($productIds)) {
            throw new Exception('$productIds should be an array');
        }
        for ($i = 0; $i < count($this->products); ++$i) {
            if (!in_array($this->products[$i]->getProductId(), $productIds)) {
                array_splice($this->products, $i, 1);
                $i = 0;
            }
        }
    }


}