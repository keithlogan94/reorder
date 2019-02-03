<?php
/**
 * Created by PhpStorm.
 * User: becke
 * Date: 2/3/2019
 * Time: 11:44 AM
 */
// setup the autoloading
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

// setup Propel
require_once $_SERVER['DOCUMENT_ROOT'] . '/generated-conf/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/code/php/Classes/DataLayer/Upper/SysWrapper.php';
use code\php\Classes\DataLayer\Upper\SysWrapper;

class SysWrapperTests
{

    public function testValidGetConfig()
    {
        $config = SysWrapper::getConfig([
            'description' => 'ReOrder API Key'
        ]);

        if ($config['configValue'] !== 'ab4f1e8d-8de2-4bc4-9fbd-4868f61450f0') {
            throw new Exception('SysWrapperTests::testValidGetConfig() configValue is not corrent');
        }
        echo 'Config Value: '.$config['configValue'];
        if ($config['configDescription'] !== 'ReOrder API Key') {
            throw new Exception('SysWrapperTests::testValidGetConfig() configDescription is not corrent');
        }
        echo 'config desc: ' . $config['configDescription'];
        if ($config['configKey'] !== 'reorder_api_key') {
            throw new Exception('SysWrapperTests::testValidGetConfig() configKey is not corrent');
        }
        echo 'config key: ' . $config['configKey'];
    }

}