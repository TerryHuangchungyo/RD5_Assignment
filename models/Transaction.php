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
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getTransactionsByAccountId( $accountId, $offsets, $limits ) {
        $dblink = $this->getDatabase();
        $tbName = $this->getTbName();
        $pidName = $this->getPidName();

        $stmt = $dblink->prepare( "SELECT t.transId, a.name, aid, value, residue, success, date, e.errorMsg 
                                FROM transactions t LEFT JOIN  errors e ON t.transId = e.transId 
                                JOIN accounts a ON a.accountId = t.accountId 
                                WHERE t.accountId = :accountId ORDER BY date DESC limit :offsets, :limits");
        $stmt->bindParam( ":accountId", $accountId );
        $stmt->bindParam( ":offsets", $offsets, PDO::PARAM_INT);
        $stmt->bindParam( ":limits", $limits, PDO::PARAM_INT);
        if($stmt->execute()) {
           return $stmt->fetchAll( PDO::FETCH_ASSOC ); 
        } else {
            return [];
        }
    }
}