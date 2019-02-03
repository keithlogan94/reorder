<?php
/**
 * Created by PhpStorm.
 * User: becke
 * Date: 2/3/2019
 * Time: 3:36 PM
 */

namespace code\php\Classes\BusinessLayer\Upper;

use Exception;
use models\models\Base\CrmLoginCredentials;
use models\models\CrmLoginCredentialsQuery;

class ReOrderLogin
{

    private $q;
    /* @var $account Account*/
    private $account;

    public function __construct(&$account)
    {
        $this->account = $account;
        /* @var $account Account*/
        $q = \models\models\CrmLoginCredentialsQuery::create()->filterByCrmAccountId($account->getCrmAccountId())->findOne();
        if (is_null($q)) {
            throw new Exception('failed to find login by accountId');
        }
        $this->q = $q;
    }

    public function getData()
    {
        return $this->q;
    }

    private static function canCreateLogin($accountId)
    {
        $q = CrmLoginCredentialsQuery::create()->filterByCrmAccountId($accountId)->findOne();
        return is_null($q);
    }

    public static function createLogin(&$account, $username,$password)
    {
        /* @var $account Account*/
        if (!self::canCreateLogin($account->getCrmAccountId())) throw new Exception('login already exists');
        $login = new \models\models\CrmLoginCredentials();
        $login->setCrmAccountId($account->getCrmAccountId());
        $login->setUsername($username);
        $login->setPassword($password);
        $login->save();
        return new ReOrderLogin($account);
    }

    public function getAccount() : Account
    {
        return $this->account;
    }

}