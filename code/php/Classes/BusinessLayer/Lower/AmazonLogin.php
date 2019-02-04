<?php
/**
 * Created by PhpStorm.
 * User: becke
 * Date: 2/3/2019
 * Time: 6:45 PM
 */

namespace code\php\Classes\BusinessLayer\Upper;

use Exception;
use models\models\SecRetailerLogin;
use models\models\SecRetailerLoginQuery;

class AmazonLogin
{
    private $q;
    /* @var $account Account*/
    private $account;

    public function __construct(&$account)
    {
        $this->account = $account;
        /* @var $account Account*/
        $q = SecRetailerLoginQuery::create()->filterByCrmAccountId($account->getCrmAccountId())
            ->filterByRetailer('amazon')
            ->findOne();
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
        $q = SecRetailerLoginQuery::create()->filterByCrmAccountId($accountId)
            ->filterByRetailer('amazon')
            ->findOne();
        return is_null($q);
    }

    public static function createLogin(&$account, $username,$password)
    {
        /* @var $account Account*/
        if (!self::canCreateLogin($account->getCrmAccountId())) throw new Exception('amazon login already exists');
        $login = new SecRetailerLogin();
        $login->setCrmAccountId($account->getCrmAccountId());
        $login->setLoginEmail($username);
        $login->setLoginPassword($password);
        $login->setRetailer('amazon');
        $login->save();
        return new AmazonLogin($account);
    }

    public function getAccount() : Account
    {
        return $this->account;
    }
}