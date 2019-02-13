<?php
/**
 * Created by PhpStorm.
 * User: becke
 * Date: 2/3/2019
 * Time: 9:24 AM
 */

namespace code\php\Classes\DataLayer\Upper;

use models\models\SysConfigQuery;
use Exception;

abstract class SysWrapper
{

    public static function query($params)
    {

    }

    public static function getConfig($params)
    {
        if (!isset($params['key']) && !isset($params['description'])) {
            throw new Exception('SysWrapper::getConfig() key or description must be set in params');
        }
        $configValue = null;
        $key = '';
        $desc = '';
        switch (true) {
            case isset($params['key']):
                $q = SysConfigQuery::create()->findOneByConfigKey($params['key']);
                if (is_null($q)) {
                    throw new Exception('SysWrapper::getConfig() config value failed to be found by key');
                } else {
                    $desc = $q->getDescription();
                    $key = $q->getConfigKey();
                    $configValue = $q->getValue();
                }
                break;
            case isset($params['description']):
                $q = SysConfigQuery::create()->findOneByDescription($params['description']);
                if (is_null($q)) {
                    throw new Exception('SysWrapper::getConfig() config value failed to be found by description');
                } else {
                    $desc = $q->getDescription();
                    $key = $q->getConfigKey();
                    $configValue = $q->getValue();
                }
                break;
        }
        return [
            'configKey' => $key,
            'configDescription' => $desc,
            'configValue' => $configValue,
        ];
    }

}