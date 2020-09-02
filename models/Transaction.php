<?php
class Transaction extends Model{
    protected function getDatabase() {
        return Database::getDatabase();
    }

    protected function getTbName() {
        return DB::transactionTbName;
    }

    protected function getPidName() {
        return "transId";
    }
}