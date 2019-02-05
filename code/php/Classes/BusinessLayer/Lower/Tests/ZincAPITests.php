<?php
/**
 * Created by PhpStorm.
 * User: becke
 * Date: 2/4/2019
 * Time: 2:57 PM
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/code/php/Classes/BusinessLayer/Lower/ZincProductSearch.php';
use code\php\Classes\BusinessLayer\Upper\ZincProductSearch;

class ZincAPITests
{


    function testSearchProduct()
    {
        $zSearch = new ZincProductSearch();
        $products = $zSearch->search('amazon','Smart Ones, Traditional Lasagna With Meat Sauce');

        $products = $products->getProducts();
        foreach ($products as $product) {
            /* @var $product \code\php\Classes\BusinessLayer\Upper\ZincProduct*/
            echo $product->getTitle() . ' ' . $product->getProductId();
        }

    }

}