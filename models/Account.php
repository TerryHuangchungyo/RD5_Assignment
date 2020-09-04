<?php
class Account {
    private $isLoad;

    public function __set( $name, $value ) {
        $this->$name = $value;
    }

    public function __get( $name ) {
        return $this->$name;
    }
    
    public function create( $options ) {
        $dblink = Database::getDatabase();
        $tbName = DB::accountTbName;
        $colstr = implode( ",", array_keys($options) );
        $prestr = "INSERT INTO $tbName ( $colstr ) VALUES(";

        foreach( array_keys($options) as $key ) {
            $prestr .= ":$key,";
        }
        $prestr = rtrim( $prestr, ",");
        $prestr .= ");";
        $stmt = $dblink->prepare($prestr);
        if( $stmt->execute($options) ) {
            $this->isLoad = true;
        } else {
            $this->isLoad = false;
        }
        return $this->isLoad;
    }

    public function load( $columns, $accountId) {
        $dblink = Database::getDatabase();
        $tbName = DB::accountTbName;

        $colstr = implode( ",", $columns );
        $prestr = "SELECT $colstr FROM $tbName WHERE accountId = :accountId LOCK IN SHARE MODE;";

        $stmt = $dblink->prepare( $prestr );
        $stmt->bindParam( ":accountId", $accountId );

        $dblink->beginTransaction();
        $dblink->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            $result = $stmt->execute();
            $data = $stmt->fetch( PDO::FETCH_ASSOC );
            if( $data ) {
                foreach( $data as $key => $value ) {
                    $this->$key = $value;
                }
                $this->accountId = $accountId;
                $this->isLoad = true;
            } else {
                $this->isLoad = false;
            }
            $dblink->commit();
        } catch( Exception $e ) {
            $this->isLoad = false;
            $dblink->rollBack();
        }
        return $this->isLoad;
    }

    public function save( $columns = [], $accountId ) {
        if( $this->isLoad && $columns ) {
            $dblink = Database::getDatabase();
            $tbName = DB::accountTbName;

            $colstr = implode( ",", $columns );
            $selectPrestr = "SELECT $colstr FROM $tbName WHERE accountId = :accountId FOR UPDATE;";

            $updatePrestr = "UPDATE $tbName SET ";
            $params = [];
            foreach( $columns as $column ) {
                $params[] = $this->$column;
                $updatePrestr .= "$column = ?,";
            }
            $params[] = $accountId;
            $updatePrestr = rtrim( $updatePrestr, ",");
            $updatePrestr .= " WHERE accountId = ?";


            $dblink->beginTransaction();
            $dblink->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            try {
                $stmt =$dblink->prepare( $selectPrestr );
                $stmt->bindParam( ":accountId", $accountId );
                $stmt->execute();
                $stmt = $dblink->prepare( $updatePrestr );
                $stmt->execute($params);
                $dblink->commit();
                return true;
            } catch( Exception $e ) {
                echo $e->getMessage();
                $dblink->rollback();
                return false;
            }
        }
    }

    public function balanceOperation( $opcode, $value ) {
        if( $this->isLoad ) {
            $dblink = Database::getDatabase();
            $dblink->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $tbName = DB::accountTbName;
            $accountId = $this->accountId;
            $pastBalance = $this->balance;

            try{
                $dblink->beginTransaction();
                $result = $dblink->query( "SELECT balance FROM $tbName where accountId = '$accountId' FOR UPDATE");
                $balance = ($result->fetch(PDO::FETCH_ASSOC))["balance"];

                switch( $opcode ) {
                    case 1:
                        $balance += $value;
                        break;
                    case 2:
                        if( round($value,3) <= round($balance,3) ) {
                            $balance = round($balance,3) - round($value,3);
                        } else {
                            throw new Exception("餘額不足");
                        }
                        break;
                    default:
                        break;
                }

                $stmt = $dblink->prepare( "UPDATE $tbName SET balance = :balance WHERE accountId = :accountId");
                $stmt->bindParam( ":balance", $balance );
                $stmt->bindParam( ":accountId", $accountId );
                $stmt->execute();
                $this->balance = $balance;
                $dblink->commit();
                return "success";
            } catch ( Exception $e ) {
                $this->balance =$pastBalance;
                $dblink->rollBack();
                return $e->getMessage();
            }
        }  
    }
}