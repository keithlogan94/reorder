<?php
/**
 * Created by PhpStorm.
 * User: becke
 * Date: 2/4/2019
 * Time: 2:47 PM
 */

namespace code\php\Classes\BusinessLayer\Upper;

require_once $_SERVER['DOCUMENT_ROOT'] . '/code/php/Classes/BusinessLayer/Lower/ZincAPIKey.php';
use code\php\Classes\BusinessLayer\Upper\ZincAPIKey;
require_once $_SERVER['DOCUMENT_ROOT'] . '/code/php/Classes/BusinessLayer/Lower/ZincProductList.php';
use code\php\Classes\BusinessLayer\Upper\ZincProductList;
require_once $_SERVER['DOCUMENT_ROOT'] . '/code/php/Classes/BusinessLayer/Lower/UPCItem.php';
use code\php\Classes\BusinessLayer\Upper\UPCItem;

use Exception;

class ZincProductSearch
{

    public function search($retailer, $upcItem)
    {
        if (!($upcItem instanceof UPCItem)) {
            throw new Exception('$upcItem must be instance of UPCItem');
        }
        $query = urlencode($upcItem->getTitle());
        $retailer = urlencode($retailer);
        $url = "https://api.zinc.io/v1/search?query=$query&page=1&retailer=$retailer";
        echo 'requesting page '.$url;

        $apiKey = new ZincAPIKey();

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_USERNAME, (string)$apiKey);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_URL, $url);

        $res = curl_exec($curl);

        if ($res === false) {
            throw new Exception('curl failed with error: ' . curl_error($curl));
        }
        
        $res = json_decode($res, true);
        if ($res['status'] === 'completed') {
            $zincProductList = \code\php\Classes\BusinessLayer\Upper\ZincProductList::loadProductListFromZincSearchResults(
                $res['results']
            );
            return $zincProductList;
        } else {
            throw new Exception('failed to get products');
        }

    }


}