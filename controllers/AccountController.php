<?php
class AccountController extends Controller {
    public function __construct( $route ) {
        switch( $_SERVER["REQUEST_METHOD"] ) {
            case "GET":
                if( isset( $_SESSION["loginToken"]) ) {
                    $this->getAPI($_SESSION["loginToken"] ); 
                } else {
                    header( "HTTP/1.1 404 Not Found" );
                    exit;
                }
                break;
            case "POST":

        }
    }

    public function getAPI( $accountId ) {
        $model = $this->model("Account");
        $model->load(["accountId", "name", "holder", "balance"],$accountId);
        $data = [ "accountId" => $model->accountId,
                "name" => $model->name,
                "holder" => $model->holder,
                "balance" => $model->balance ];
        $this->view("api/JsonAPI", $data);
    }
}
