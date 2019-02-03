<?php
/**
 * Created by PhpStorm.
 * User: becke
 * Date: 2/2/2019
 * Time: 8:52 PM
 */

class RequestPayload
{
    const REQUEST = 0;
    const POST = 1;
    const GET = 2;

    private $payloadArray;

    public function __construct($requestType)
    {
        $this->updatePayloadArray($requestType);
        $this->validateRequestPayload();
    }

    public function getPayloadIndex($index)
    {
        if (!isset($this->payloadArray[$index])) return false;
        return $this->payloadArray[$index];
    }

    public function getValidatedRequestPayload()
    {
        return $this->payloadArray;
    }

    private function validateRequestPayload()
    {
        foreach ($this->payloadArray as $requestIndex => $requestValue) {
            $requestValidationData = \models\models\RequestPayloadValidationQuery::create()->findOneByRequestIndex($requestIndex);
            if (is_null($requestValidationData)) {
                throw new Exception('validation failed for requestIndex('.$requestIndex.') request key not allowed');
            }
            switch ($requestValidationData->getValidationMethod()) {
                case 'number':
                    if (!is_numeric($requestValue)) {
                        throw new Exception('request value ('.$requestValue.') for request index('.$requestIndex.') is not valid');
                    }
                    break;
                case 'regex':
                    if (!preg_match($requestValidationData->getRegex(), $requestValue)) {
                        throw new Exception('request value ('.$requestValue.') for request index('.$requestIndex.') is not valid');
                    }
                    break;
                case 'string':
                    break;
                case 'bool':
                    if (!is_bool($requestValue)) {
                        throw new Exception('request value ('.$requestValue.') for request index('.$requestIndex.') is not valid');
                    }
                    break;
                default:
                    throw new Exception('validation method('.$requestValidationData->getValidationMethod().') not supported');
            }


        }
    }

    private function updatePayloadArray($requestType)
    {
        switch ($requestType) {
            case self::REQUEST:
                $this->payloadArray = $_REQUEST;
                break;
            case self::POST:
                $this->payloadArray = $_POST;
                break;
            case self::GET:
                $this->payloadArray = $_GET;
                break;
            default:
                throw new Exception('request type must be enum REQUEST or POST');
        }
    }


}