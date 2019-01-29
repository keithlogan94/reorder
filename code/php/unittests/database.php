<?php
/**
 * Created by PhpStorm.
 * User: becke
 * Date: 1/29/2019
 * Time: 10:20 AM
 */


require_once $_SERVER['DOCUMENT_ROOT'] . '/code/php/Database.php';
use code\php\Database;

session_start();
while (($key = array_search('database.php', $_SESSION['okay_unit_tests'])) !== false) {
    unset($_SESSION['okay_unit_tests'][$key]);
}

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


$rows = $db->getRows('crm_account', 'WHERE email_address = ?',
    's', ['keithloganbecker94@gmail.com']);

if (mysqli_num_rows($result) !== count($rows))
    throw new Exception('unit test failed (getRows): row count does not match other query row count');

$normalQueryRows = [];
while ($row = mysqli_fetch_row($result)) {
    $normalQueryRows[] = $row;
}

if ($rows != $normalQueryRows) {
    throw new Exception('unit test failed (getRows): rows do not match normal query rows');
}

$_SESSION['okay_unit_tests'][] = 'database.php';
echo 'All unit tests ran okay!';
header('Location: http://localhost/code/php/unittests/index.php');




