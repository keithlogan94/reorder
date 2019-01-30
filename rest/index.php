<?php
/**
 * Created by PhpStorm.
 * User: becke
 * Date: 1/30/2019
 * Time: 10:42 AM
 */


require_once $_SERVER['DOCUMENT_ROOT' ] . '/code/php/RestApi.php';

session_start();

use code\php\RestApi;

$rest = new RestApi();

if (!isset($_POST['method'])) {
    http_response_code(500);
    exit('failed to provide method in POST request');
}

if (!in_array($_POST['method'], get_class_methods('RestApi'))) {
    http_response_code(500);
    exit('method does not exist in REST api');
}

$rest->{$_POST['method']}();




