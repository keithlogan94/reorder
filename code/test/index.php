<?php
/**
 * Created by PhpStorm.
 * User: becke
 * Date: 2/2/2019
 * Time: 12:58 PM
 */


require_once $_SERVER['DOCUMENT_ROOT'] . '/code/php/unittests/all_unit_tests.php';


$class = new \unittests\UnitTests();
$methods = get_class_methods($class);

foreach ($methods as $method) {
    $class->{$method}();
}