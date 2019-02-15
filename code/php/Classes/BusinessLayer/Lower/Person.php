<?php
/**
 * Created by PhpStorm.
 * User: becke
 * Date: 2/3/2019
 * Time: 1:00 PM
 */

namespace code\php\Classes\BusinessLayer\Upper;

class Person
{
    private $qPerson;
    /* @var $account Account*/
    private $account;

    public function __construct(&$account)
    {
        $this->account = $account;
        /* @var $account Account*/
        $qPerson = \models\models\CrmPersonQuery::create()->filterByCrmAccountId($account->getCrmAccountId())->findOne();
        if (is_null($qPerson)) {
            throw new Exception('failed to find person by accountId');
        }
        $this->qPerson = $qPerson;
    }

    public function getData()
    {
        return $this->qPerson;
    }

    private static function canCreatePerson($accountId)
    {
        $q = \models\models\CrmPersonQuery::create()->filterByCrmAccountId($accountId)->findOne();
        return is_null($q);
    }

    public static function createPerson(&$account,$firstName,$lastName,$phone)
    {
        /* @var $account Account*/
        if (!self::canCreatePerson($account->getCrmAccountId())) throw new Exception('person record already exists');
        $person = new \models\models\CrmPerson();
        $person->setCrmAccountId($account->getCrmAccountId());
        $person->setFirstName($firstName);
        $person->setLastName($lastName);
        $person->setPhoneNumber($phone);
        $person->save();
        return new Person($account);
    }

    public function getAccount() : Account
    {
        return $this->account;
    }


}