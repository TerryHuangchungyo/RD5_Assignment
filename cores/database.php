<?php
class Database {
    private static $dblink = null;

    public static function getDatabase() {
        if( self::$dblink == null ) {
            try {
                $dbStr = "mysql:host=".DB::dbhost.";dbname=".DB::dbname.";dbport=".DB::dbport.";";
                self::$dblink = new PDO( $dbStr, DB::dbuser, DB::dbpass);
                self::$dblink->query("SET NAMES utf8");
            } catch( PDOException $e ) {
                print "Error!: " . $e->getMessage() . "<br/>";
                self::$dblink = null;
            }
        }

        return self::$dblink;
    }

    public static function destroyDatabase() {
        self::$dblink = null;
    }
}