<?php
/**
 * Created by PhpStorm.
 * User: becke
 * Date: 1/30/2019
 * Time: 10:25 AM
 */

namespace code\php;

require_once $_SERVER['DOCUMENT_ROOT'] . '/code/php/LoginCredentials.php';


class RestApi
{

    public function processCreateAccount()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $fname = $_POST['fname'];
        $mname = $_POST['mname'];
        $lname = $_POST['lname'];
        $accountType = $_POST['account_type'];
        $phone = $_POST['phone'];
        $street1 = $_POST['street1'];
        $street2 = $_POST['street2'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $country = $_POST['country'];
        $zip = $_POST['zip'];

        try {
            $asm = new AccountSignupManager();
            if (!$asm->canCreateAccount($email)) {
                $out = [
                    'status' => 'failed',
                    'message' => 'Can not create an account with that email. Account already exists.'
                ];
                echo json_encode($out);
                exit;
            }
            $account = $asm->requestCreateAccount($accountType, $fname, $lname, $mname, $email, $phone, $street1, $street2,
                $city, $zip, $state, $country);
            if (!$account) {
                $out = [
                    'status' => 'failed',
                    'message' => 'Failed creating account with unknown reason.'
                ];
                echo json_encode($out);
                exit;
            }
            $loginCred = new LoginCredentials();
            $loginCred->generateLoginCredentials($account->getCrmAccountId(), $username, $password);
            $out = [
                'status' => 'success',
                'message' => 'Successfully created an account.',
                'accountId' => $account->getCrmAccountId(),
            ];
            echo json_encode($out);
            exit;
        } catch (\Exception $e) {
            $out = [
                'status' => 'failed',
                'message' => 'Failed creating account with unknown reason.'
            ];
            echo json_encode($out);
            exit;
        }
    }

}