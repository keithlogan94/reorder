<?php
/**
 * Created by PhpStorm.
 * User: becke
 * Date: 2/5/2019
 * Time: 9:53 AM
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/code/php/Classes/BusinessLayer/Lower/UPCItem.php';
use code\php\Classes\BusinessLayer\Upper\UPCItem;


class UPCTests
{

    public function testGetUPCItem()
    {
        $upcItem = new UPCItem(602652184048);
        echo $upcItem->getTitle();
    }

}