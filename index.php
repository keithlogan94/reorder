<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/code/php/Account.php';


//\code\php\Account::createAccount('Keith','Becker',NULL,
//    'keithloganbecker94@gmail.com','8082258615','4240 Swanson Way','Unit 207',
//    'Castle Rock','80109','CO','US');


$account = new \code\php\Account(1);
echo $account->getFirstName(). ' ' . $account->getLastName()  .', How are you?<BR>';
$account->setFirstName('Kyle');
$account = new \code\php\Account(1);
echo $account->getFirstName(). ' ' . $account->getLastName()  .', How are you?<BR>';


