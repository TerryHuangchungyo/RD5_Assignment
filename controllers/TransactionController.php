<?php
class TransactionController extends Controller {
    public function __construct( $route ) {
        switch( $_SERVER["REQUEST_METHOD"] ) {
            case "GET":
                if( isset( $_SESSION["loginToken"] ) && isset( $_SESSION["validated"] ) ) {
                    $this->getAPI($_SESSION["loginToken"] ); 
                } else {
                    header( "HTTP/1.1 404 Not Found" );
                    exit;
                }
                break;
        }
    }

    public function getAPI( $accountId ) {
        $transaction = $this->model("Transaction");
        if( (isset($_GET["offsets"]) && isset($_GET["limits"]))) {
            $data = $transaction->getTransactionsByAccountId($_SESSION["loginToken"], $_GET["offsets"], $_GET["limits"]);
            $this->view("api/JsonArrAPI", $data);
        } else {
            $data = $transaction->getCountsByAccountId($_SESSION["loginToken"]);
            $this->view("api/JsonAPI", $data);
        }
    }
}
