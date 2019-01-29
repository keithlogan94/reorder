<?php
/**
 * Created by PhpStorm.
 * User: becke
 * Date: 1/29/2019
 * Time: 10:20 AM
 */


require_once $_SERVER['DOCUMENT_ROOT'] . '/code/php/Database.php';
use code\php\Database;

/* @var $db Database*/
$db = \code\php\get_db();

$result = $db->query('SELECT * FROM crm_account WHERE email_address = \'keithloganbecker94@gmail.com\';');
if (mysqli_num_rows($result) === 0) {
    throw new Exception('failed to find account keithloganbecker94@gmail.com: please fix that to run unit tests.');
}

$row = $db->getSingleRow('crm_account','email_address','keithloganbecker94@gmail.com','s');
if (empty($row)) {
    throw new Exception('unit test failed (getSingleRow): failed to get account row');
}
var_dump($row);


echo 'All unit tests ran okay!';




