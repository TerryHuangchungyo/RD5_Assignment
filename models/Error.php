<?php
class Error extends Model{
    public function getDatabase() {
        return Database::getDatabase();
    }

    public function getTbName() {
        return DB::accountTbName;
    }

    public function getPidName() {
        return "errorId";
    }
}