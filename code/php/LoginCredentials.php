<?php
/**
 * Created by PhpStorm.
 * User: becke
 * Date: 1/30/2019
 * Time: 8:47 AM
 */

namespace code\php;

require_once $_SERVER['DOCUMENT_ROOT'] . '/code/php/Database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/code/php/Account.php';

class LoginCredentials
{

    private $username;
    private $password;
    private $accountId;
    private $email;


    /**
     * @param $accountId
     * @throws \Exception
     */
    public function generateLoginCredentials($accountId, $username, $password)
    {
        if ($this->hasLoginCredentials($accountId)) throw new \Exception('user already has login credentials');
        /* @var $db Database*/
        $db = get_db();
        $result = $db->callStoredProcedure('insert_crm_login_credentials',
            [$accountId, $username, $password],
            'iss');
    }

    /**
     * @param $username
     * @param $password
     * @throws \Exception
     */
    public function updateLoginCredentials($username, $password)
    {
        if (!$this->isLoggedIn()) {
            throw new \Exception('must be logged in to update login credentials');
        }
        /* @var $db Database*/
        $db = get_db();
        $result = $db->callStoredProcedure('update_crm_login_credentials',
            [$username, $password, $this->accountId],
            'ssi');
    }

    public function hasLoginCredentials($accountId)
    {
        /* @var $db Database*/
        $db = get_db();
        $result = $db->callStoredProcedure('find_crm_login_credentials_by',
            ['accountId',(string)$accountId],
            'ss');

        if (empty($result)) {
            return false;
        } else {
            return true;
        }
    }


    /**
     * @param $usernameOrEmail
     * @param $password
     * @return bool|Account
     * @throws \Exception
     */
    public function processLogin($usernameOrEmail, $password)
    {
        if ($this->isLoggedIn()) return true;
        if (!is_string($usernameOrEmail)) throw new \Exception('$usernameOrEmail must be a string');
        if (!is_string($password)) throw new \Exception('$password must be a string');

        /* @var $db Database*/
        $db = get_db();

        if (strpos($usernameOrEmail, '@') !== FALSE) {
            $result = $db->callStoredProcedure('find_crm_login_credentials_by',
                ['email',(string)$usernameOrEmail],
                'ss');
        } else {
            $result = $db->callStoredProcedure('find_crm_login_credentials_by',
                ['username',(string)$usernameOrEmail],
                'ss');
        }

        if (empty($result)) {
            return false;
        }

        if ($password !== $result[0]['password'])
            return false;

        $this->username = $result[0]['username'];
        $this->password = $result[0]['password'];
        $this->accountId = $result[0]['crm_account_id'];
        $this->email = $result[0]['email_address'];

        $_SESSION['loggedin_account_id'] = $this->accountId;
        $_SESSION['loggedin_email'] = $this->email;
        $_SESSION['loggedin_time'] = date('Y-m-d H:i:s');

        $account =  new Account((int)$this->accountId);
        $account->setLoginCredentials($this);
        return $account;

    }


    public function isLoggedIn()
    {
        return isset($_SESSION['loggedin_email']) && $_SESSION['loggedin_email'] === $this->email;
    }

    public function endLogin()
    {
        unset($_SESSION['loggedin_account_id']);
        unset($_SESSION['loggedin_email']);
        unset($_SESSION['loggedin_time']);
    }

}