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

    public function getCountsByAccountId( $accountId ) {
        $dblink = $this->getDatabase();
        $tbName = $this->getTbName();
        $pidName = $this->getPidName();

        $stmt = $dblink->prepare( "SELECT COUNT($pidName) as transCount  FROM $tbName WHERE accountId= ?" );
        $stmt->execute([$accountId]);
        
        return $stmt->fetch(PDO::FETCH_ASSOC)["transCount"];
    }

    public function getTransactionsByAccountId( $accountId, $offset, $limit ) {
        $dblink = $this->getDatabase();
        $tbName = $this->getTbName();
        $pidName = $this->getPidName();

        $stmt = $dblink->prepare( "SELECT * FROM $tbName WHERE accountId = ? ORDER BY date DESC limit ?, ?");
        if($stmt->execute(Array($accountId, $offset, $limit))) {
           return $stmt->fetchAll( PDO::FETCH_ASSOC ); 
        } else {
            return [];
        }
    }
}