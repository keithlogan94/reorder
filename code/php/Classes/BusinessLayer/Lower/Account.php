<?php
/**
 * Created by PhpStorm.
 * User: becke
 * Date: 2/3/2019
 * Time: 12:58 PM
 */

namespace code\php\Classes\BusinessLayer\Upper;


require_once $_SERVER['DOCUMENT_ROOT'] . '/code/php/Classes/BusinessLayer/Lower/Person.php';
use code\php\Classes\BusinessLayer\Upper\Person;
require_once $_SERVER['DOCUMENT_ROOT'] . '/code/php/Classes/BusinessLayer/Lower/Email.php';
use code\php\Classes\BusinessLayer\Upper\Email;
require_once $_SERVER['DOCUMENT_ROOT'] . '/code/php/Classes/BusinessLayer/Lower/ShippingAddress.php';
use code\php\Classes\BusinessLayer\Upper\ShippingAddress;
require_once $_SERVER['DOCUMENT_ROOT'] . '/code/php/Classes/BusinessLayer/Lower/BillingAddress.php';
use code\php\Classes\BusinessLayer\Upper\BillingAddress;
require_once $_SERVER['DOCUMENT_ROOT'] . '/code/php/Classes/BusinessLayer/Lower/PrimaryAddress.php';
use code\php\Classes\BusinessLayer\Upper\PrimaryAddress;
require_once $_SERVER['DOCUMENT_ROOT'] . '/code/php/Classes/BusinessLayer/Lower/CreditCard.php';
use code\php\Classes\BusinessLayer\Upper\CreditCard;
require_once $_SERVER['DOCUMENT_ROOT'] . '/code/php/Classes/BusinessLayer/Lower/ReOrderLogin.php';
use code\php\Classes\BusinessLayer\Upper\ReOrderLogin;
require_once $_SERVER['DOCUMENT_ROOT'] . '/code/php/Classes/BusinessLayer/Lower/AmazonLogin.php';
use code\php\Classes\BusinessLayer\Upper\AmazonLogin;
require_once $_SERVER['DOCUMENT_ROOT'] . '/code/php/Classes/BusinessLayer/Lower/ZincProductSearch.php';
use code\php\Classes\BusinessLayer\Upper\ZincProductSearch;
require_once $_SERVER['DOCUMENT_ROOT'] . '/code/php/Classes/BusinessLayer/Lower/UPCItem.php';
use code\php\Classes\BusinessLayer\Upper\UPCItem;

use Exception;
use models\models\CrmEmailQuery;
use models\models\CrmLoginCredentials;

class Account
{
    private $accountId;
    private $person;
    private $email;
    private $primaryAddress;
    private $shippingAddress;
    private $billingAddress;
    private $creditCard;
    private $reorderLogin;
    private $amazonLogin;

    public function __construct($accountId)
    {
        $this->accountId = $accountId;
    }

    public static function loadByEmail($email)
    {
        $q = CrmEmailQuery::create()->filterByEmailAddress($email)->findOne();
        if (is_null($q)) {
            throw new Exception('failed to find account by email address');
        }
        return new Account($q->getCrmAccountId());
    }

    public function performProductSearch($upcItem)
    {
        if (!($upcItem instanceof UPCItem)) {
            throw new Exception('$upcItem must be instance of UPCItem');
        }
        $zincProductSearch = new \code\php\Classes\BusinessLayer\Upper\ZincProductSearch();
        $foundProducts = $zincProductSearch->search('amazon', $upcItem);
        return $foundProducts;
    }

    /**
     * @param mixed $primaryAddress
     */
    public function setPrimaryAddress($primaryAddress): void
    {
        $this->primaryAddress = $primaryAddress;
    }

    /**
     * @param mixed $shippingAddress
     */
    public function setShippingAddress($shippingAddress): void
    {
        $this->shippingAddress = $shippingAddress;
    }

    /**
     * @param mixed $billingAddress
     */
    public function setBillingAddress($billingAddress): void
    {
        $this->billingAddress = $billingAddress;
    }

    /**
     * @param mixed $person
     */
    public function setPersonObject($person): void
    {
        $this->person = $person;
    }

    /**
     * @param mixed $email
     */
    public function setEmailObject($email): void
    {
        $this->email = $email;
    }

    public static function createAccount($email, $firstName, $lastName, $phone, $username,$password)
    {
        if (self::doesAccountExist($email)) {
			set_user_error('Sorry, that email is already in use.');
            throw new Exception('email already in use');
        }

        $account = new \models\models\CrmAccount();
        $account->save();
        $newAccount = new Account($account->getCrmAccountId());
        $newAccount->setEmailObject(Email::createEmail($newAccount, $email));
        $newAccount->setPersonObject(Person::createPerson($newAccount,$firstName,$lastName,$phone));
        $newAccount->setReorderLogin(ReOrderLogin::createLogin($newAccount,$username,$password));

        return $newAccount;
    }

    public static function doesAccountExist($email)
    {
        $q = \models\models\CrmEmailQuery::create()->filterByEmailAddress($email)
            ->findOne();
        return !is_null($q);
    }

    public function getPerson()
    {
        if (is_null($this->person)) {
            $this->person = new Person($this);
        }
        return $this->person;
    }

    public function hasShippingAddress()
    {
        try {
            $shippingAddress = new ShippingAddress($this);
            $this->shippingAddress = $shippingAddress;
        } catch (Exception $e) {
            return false;
        }
        return true;
    }

    public function hasAmazonLogin()
    {
        try {
            $amazonLogin = new AmazonLogin($this);
            $this->amazonLogin = $amazonLogin;
        } catch (Exception $e) {
            return false;
        }
        return true;
    }

    public function saveAmazonLogin($username,$password)
    {
        $this->amazonLogin = AmazonLogin::createLogin($this, $username, $password);
    }

    public function getAmazonLogin()
    {
        if (is_null($this->amazonLogin)) {
            $this->amazonLogin = new AmazonLogin($this);
        }
        return $this->amazonLogin;
    }

    public function hasReOrderLogin()
    {
        try {
            $reorderLogin = new ReOrderLogin($this);
            $this->reorderLogin = $reorderLogin;
        } catch (Exception $e) {
            return false;
        }
        return true;
    }

    public function saveReorderLogin($username,$password)
    {
        $this->reorderLogin = ReOrderLogin::createLogin($this,$username,$password);
    }

    public function getReorderLogin()
    {
        if (is_null($this->reorderLogin)) {
            $this->reorderLogin = new ReOrderLogin($this);
        }
        return $this->reorderLogin;
    }

    public function setReorderLogin($login)
    {
        $this->reorderLogin = $login;
    }


    public function hasCreditCard()
    {
        try {
            $creditCard = new CreditCard($this);
            $this->creditCard = $creditCard;
        } catch (Exception $e) {
            return false;
        }
        return true;
    }

    public function saveCreditCard($nameOnCard,$number, $expM,$expY,$secCode)
    {
        $this->creditCard = CreditCard::createCreditCard($this,$nameOnCard,$number,$expM,$expY,$secCode);
    }

    public function getCreditCard()
    {
        if (is_null($this->creditCard)) {
            $this->creditCard = new CreditCard($this);
        }
        return $this->creditCard;
    }

    public function saveShippingAddress($street1,$street2,$city,$state,$zip,$country)
    {
        $this->shippingAddress = ShippingAddress::createAddress($this, $street1,$street2,$city,$state,$zip,$country);
    }


    public function saveBillingAddress($street1,$street2,$city,$state,$zip,$country)
    {
        $this->billingAddress = BillingAddress::createAddress($this, $street1,$street2,$city,$state,$zip,$country);
    }

    public function hasBillingAddress()
    {
        try {
            $billingAddress = new BillingAddress($this);
            $this->billingAddress = $billingAddress;
        } catch (Exception $e) {
            return false;
        }
        return true;
    }

    public function savePrimaryAddress($street1,$street2,$city,$state,$zip,$country)
    {
        $this->primaryAddress = PrimaryAddress::createAddress($this,$street1,$street2,$city,$state,$zip,$country);
    }

    public function hasPrimaryAddress()
    {
        try {
            $primaryAddress = new PrimaryAddress($this);
            $this->primaryAddress = $primaryAddress;
        } catch (Exception $e) {
            return false;
        }
        return true;
    }

    public function getPrimaryAddress()
    {
        if (is_null($this->primaryAddress)) {
            $this->primaryAddress = new PrimaryAddress($this);
        }
        return $this->primaryAddress;
    }

    public function getBillingAddress()
    {
        if (is_null($this->billingAddress)) {
            $this->billingAddress = new BillingAddress($this);
        }
        return $this->billingAddress;
    }

    public function getShippingAddress()
    {
        if (is_null($this->shippingAddress)) {
            $this->shippingAddress = new ShippingAddress($this);
        }
        return $this->shippingAddress;
    }

    public function getEmail()
    {
        if (is_null($this->email)) {
            $this->email = new Email($this);
        }
        return $this->email;
    }

    public function getCrmAccountId()
    {
        return $this->accountId;
    }
}