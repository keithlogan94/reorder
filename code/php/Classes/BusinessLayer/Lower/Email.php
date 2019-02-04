<?php
/**
 * Created by PhpStorm.
 * User: becke
 * Date: 2/3/2019
 * Time: 1:02 PM
 */

namespace code\php\Classes\BusinessLayer\Upper;

use Exception;


class Email
{

    private $q;
    private $account;

    public function __construct(&$account)
    {
        /* @var $account Account*/
        $this->account = $account;
        $q = \models\models\CrmEmailQuery::create()->filterByCrmAccountId($account->getCrmAccountId())->findOne();
        if (is_null($q)) {
            throw new Exception('failed to find email by account id');
        }
        $this->q = $q;
    }

    private static function canCreateEmail($email)
    {
        $q = \models\models\CrmEmailQuery::create()->filterByEmailAddress($email)->findOne();
        return is_null($q);
    }

    public static function createEmail(&$account,$emailAddress)
    {
        /* @var $account Account*/
        if (!self::canCreateEmail($emailAddress)) throw new Exception('email already in use');
        $email = new \models\models\CrmEmail();
        $email->setCrmAccountId($account->getCrmAccountId());
        $email->setEmailAddress($emailAddress);
        $email->save();
        return new Email($account);
    }

    public function getAccount() : Account
    {
        return $this->account;
    }

    public function getData()
    {
        return $this->q;
    }



}