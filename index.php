<?php



// setup the autoloading
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

// setup Propel
require_once $_SERVER['DOCUMENT_ROOT'] . '/generated-conf/config.php';


$q = \models\models\CrmPersonQuery::create()->find();

foreach ($q as $person) {
    /* @var $person \models\models\CrmPerson*/
    $emailQ = \models\models\CrmEmailQuery::create()->findOneByCrmAccountId($person->getCrmAccountId());
    if (!is_null($emailQ))
        echo $emailQ->getEmailAddress() . '<BR>';
}







