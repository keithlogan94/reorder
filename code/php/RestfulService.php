<?php
/**
 * Created by PhpStorm.
 * User: becke
 * Date: 2/2/2019
 * Time: 7:47 PM
 */

require_once 'RestfulServiceMethodHandler.php';
require_once 'RequestPayload.php';

class RestfulService
{

    private $requestPayload;

    public function __construct()
    {
        $this->validateRequest();
        $this->determineRequestedService();
    }

    private function determineRequestedService()
    {
        switch ($_POST['method']) {
            case 'createAccount':

                break;
        }
    }

    protected function validateRequest()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') $this->applicationError('request method must be POST');
        $requestPayload = null;
        try {
            $requestPayload = new RequestPayload(RequestPayload::POST);
            $this->requestPayload = $requestPayload->getValidatedRequestPayload();
        } catch (\Exception $e) {
            $this->userError($e->getMessage());
        }
        if (!isset($this->requestPayload['method'])) $this->applicationError('method must be sent in the request');
    }

    protected function userError($message)
    {
        $this->sendBadResponse($message);
    }

    protected function applicationError($message)
    {
        http_response_code(500);
        $this->sendBadResponse($message);
    }

    protected function sendBadResponse($message)
    {
        return $this->buildResponseMessage('error',$message);
    }

    protected function sendSuccessResponse($message)
    {
        return $this->buildResponseMessage('success',$message);
    }

    private function buildResponseMessage($status, $message)
    {
        return json_encode(array(
            'status' => $status,
            'message' => $message
        ));
    }


}