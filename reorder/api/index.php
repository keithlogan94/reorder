<?php
/**
 * Created by PhpStorm.
 * User: becke
 * Date: 2/4/2019
 * Time: 12:09 PM
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/code/php/Classes/BusinessLayer/Upper/SysMethods.php';
use code\php\Classes\BusinessLayer\Upper\SysMethods;

try {
    SysMethods::handleRequest();
} catch (Exception $e) {
    http_response_code(500);
    $res = json_encode(['error'=>$e->getMessage()]);
    if (json_last_error() !== JSON_ERROR_NONE) exit('error: ' . json_last_error_msg());
    exit($res);
}
