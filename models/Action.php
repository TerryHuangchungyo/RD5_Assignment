<?php
class Action extends Model{
    public function getDatabase() {
        return Database::getDatabase();
    }

    public function getTbName() {
        return DB::accountTbName;
    }

    public function getPidName() {
        return "aid";
    }
}