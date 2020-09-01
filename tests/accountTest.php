<?php
require_once "../vendor/autoload.php";

// update 
// $terryAccount = new Account;
// $terryAccount->load( ["accountId", "password", "name", "holder", "balanceHide", "balance"], "terry123");
// $oldAccountId = $terryAccount->accountId;
// $terryAccount->accountId = "terry";
// $terryAccount->name = "16888";
// $terryAccount->balanceHide = 0;
// var_dump($terryAccount->save( ["accountId","name","balanceHide"], $oldAccountId ));

/* create
$account->create([ "accountId" => "kane",
                   "name" => "9453",
                   "password" => "12345",
                   "holder" => "kane_lee",
                   "balance" => 1111 ]);*/

/* balanceOperation */
$terryAccount = new Account;
$terryAccount->load( ["accountId", "password", "name", "holder", "balanceHide", "balance"], "terry");
echo $terryAccount->balance."<br>";
echo $terryAccount->balanceOperation( 1, 1000 );


