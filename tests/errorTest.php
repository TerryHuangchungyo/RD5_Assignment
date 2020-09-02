<?php
require_once "../vendor/autoload.php";

$error = new TransactionError;
$error->create([
    "transId" =>1,
    "errorMsg" => "test"
]);