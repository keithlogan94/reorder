<?php
/**
 * Created by PhpStorm.
 * User: becke
 * Date: 2/2/2019
 * Time: 8:13 PM
 */

class Account
{

    public function requestCreateAccount($dataPayload)
    {
        /* @var $dataPayload RequestPayload*/
        if (!$dataPayload->getPayloadIndex('email')) {
            throw new Exception('datapayload must contain email index');
        }
        if (!$this->canCreateAccountWithEmail($dataPayload->getPayloadIndex('email'))) {
            return false;
        }
    }

    private function canCreateAccountWithEmail($email)
    {
        return \models\models\CrmEmailQuery::create()->findByEmailAddress($email)->isEmpty();
    }

}