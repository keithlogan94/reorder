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
	$errorMessages = [];
	do {
		$errorMessages[] = $e->getMessage();
	} while (($e = $e->getPrevious()) instanceof Exception);
    $res = json_encode(['errors'=>$errorMessages]);
    if (json_last_error() !== JSON_ERROR_NONE) exit('error: ' . json_last_error_msg());
    exit($res);
}
