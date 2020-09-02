<?php
class TransactionError extends Model{
    public function getDatabase() {
        return Database::getDatabase();
    }

    public function getTbName() {
        return DB::errorTbName;
    }

    public function getPidName() {
        return "errorId";
    }
}