<?php
require_once "../vendor/autoload.php";

$transaction = new Transaction;

// $transaction->create([
//                 "accountId" => "terry",
//                 "aid" => 1,
//                 "value" => 1000.00,
//                 "residue" => 2000.00,
//                 "success" => 1,
//                 "date" => "2020-08-31 05:35:00" ]);

// $transaction->load(["accountId", "aid", "value"], 1);
// echo "<br>";
// echo $transaction->transId."<br>";
// echo $transaction->aid."<br>";
// echo $transaction->value."<br>";

// $transaction->value = 5000;
// $transaction->save(["value"]);

// $transaction->loadLast( ["accountId", "aid", "value", "date"]);
// echo $transaction->transId."<br>";
// echo $transaction->aid."<br>";
// echo $transaction->value."<br>";
// echo $transaction->date."<br>";

var_dump($transaction->getCountsByAccountId("kim"))."<br>";
var_dump( $transaction->getTransactionsByAccountId("kim",0, 10));