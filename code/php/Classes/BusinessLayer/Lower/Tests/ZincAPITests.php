<?php
/**
 * Created by PhpStorm.
 * User: becke
 * Date: 2/4/2019
 * Time: 2:57 PM
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/code/php/Classes/BusinessLayer/Lower/ZincProductSearch.php';
use code\php\Classes\BusinessLayer\Upper\ZincProductSearch;
require_once $_SERVER['DOCUMENT_ROOT'] . '/code/php/Classes/BusinessLayer/Lower/ZincOrder.php';
use code\php\Classes\BusinessLayer\Upper\ZincOrder;

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

    function testPurchaseProductFromSearch()
    {
        $email = 'keith'.rand(1,100000).'@test.com';
        $account = \code\php\Classes\BusinessLayer\Upper\Account::createAccount($email,'Keith','Becker','Logan','8082258615','male');
        $account->saveCreditCard('Keith Becker','4111111111111111','12','2025','123');

        $account->saveShippingAddress('4240 Swanson Way','Unit 207','Castle Rock','CO','80109','US');
        $account->saveBillingAddress('4240 Swanson Way','Unit 207','Castle Rock','CO','80109','US');
        $account->saveAmazonLogin('alsdkfj@test.com','asldkfj');

        $zSearch = new ZincProductSearch();
        $products = $zSearch->search('amazon','Smart Ones, Traditional Lasagna With Meat Sauce');
        $zincOrder = new ZincOrder($account);
        $zincOrder->buy('free',$products,'Thank you for using ReOrder!',0,'amazon');

    }

}