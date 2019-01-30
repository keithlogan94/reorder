<?php
/**
 * Created by PhpStorm.
 * User: becke
 * Date: 1/30/2019
 * Time: 8:47 AM
 */

namespace code\php;

use mysql_xdevapi\Exception;

require_once $_SERVER['DOCUMENT_ROOT'] . '/code/php/Database.php';

class LoginCredentials
{

    private $username;
    private $password;
    private $accountId;
    private $email;

    /**
     * LoginCredentials constructor.
     * @param $accountId
     * @throws \Exception
     */
    public function __construct($accountId)
    {
        if (!is_numeric($accountId)) throw new \Exception('$accountId must be numeric');
        /* @var $db Database*/
        $db = get_db();
        $result = $db->callStoredProcedure('find_crm_login_credentials_by',
            ['accountId',(string)$accountId],
            'ss');

        if (empty($result)) {
            throw new \Exception('no login credentials found for account id: ' . $accountId);
        }

        $this->username = $result[0]['username'];
        $this->password = $result[0]['password'];
        $this->accountId = $result[0]['crm_account_id'];
        $this->email = $result[0]['email_address'];

        if ($this->accountId != $accountId) throw new \Exception('accountId and login ' .
            'credential account id do not match');


    }

    /**
     * @param $usernameOrEmail
     * @param $password
     * @return bool
     * @throws \Exception
     */
    public function isValidLoginCredentials($usernameOrEmail, $password)
    {
        if (!is_string($usernameOrEmail) || !is_string($password))
            throw new \Exception('$usernameOrEmail and $password must be strings');
        if (($this->password === $password) &&
            ($usernameOrEmail === $this->username || $usernameOrEmail === $this->email))
            return true;
        else return false;
    }

}