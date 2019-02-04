<?php
/**
 * Created by PhpStorm.
 * User: becke
 * Date: 2/3/2019
 * Time: 3:14 PM
 */

namespace code\php\Classes\BusinessLayer\Upper;


use models\models\FinCreditCard;
use models\models\FinCreditCardQuery;
use Exception;

class CreditCard
{
    private $q;
    /* @var $account Account*/
    private $account;

    public function __construct(&$account)
    {
        $this->account = $account;
        /* @var $account Account*/
        $q = \models\models\FinCreditCardQuery::create()->filterByCrmAccountId($account->getCrmAccountId())->findOne();
        if (is_null($q)) {
            throw new Exception('failed to find credit card by accountId');
        }
        $this->q = $q;
    }

    public function getData()
    {
        return $this->q;
    }

    private static function canCreateCreditCard($accountId)
    {
        $q = FinCreditCardQuery::create()->filterByCrmAccountId($accountId)->findOne();
        return is_null($q);
    }

    public static function createCreditCard(&$account, $nameOnCard,$number, $expM,$expY,$secCode)
    {
        /* @var $account Account*/
        if (!self::canCreateCreditCard($account->getCrmAccountId())) throw new Exception('credit card already exists');
        $card = new FinCreditCard();
        $card->setCrmAccountId($account->getCrmAccountId());
        $card->setNameOnCard($nameOnCard);
        $card->setNumber($number);
        $card->setExpirationMonth($expM);
        $card->setExpirationYear($expY);
        $card->setSecurityCode($secCode);
        $card->save();
        return new CreditCard($account);
    }

    public function getAccount() : Account
    {
        return $this->account;
    }

}