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

    public function loadLast( $columns ) {
        $dblink = $this->getDatabase();
        $tbName = $this->getTbName();
        $pidName = $this->getPidName();

        $result = $dblink->query("SELECT MAX($pidName) as lastId FROM $tbName;", PDO::FETCH_ASSOC);
        $data = $result->fetch();
        $lastId = $data["lastId"];

        $this->load( $columns, $lastId );
    }
}