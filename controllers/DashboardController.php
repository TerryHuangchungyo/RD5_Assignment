<?php
class DashboardController extends Controller {
    public function __construct( $route ) {
        switch( $route->getNextPath() ) {
            case "logout":
                unset($_SESSION["loginToken"]);
                break;
            case null:
                if( !isset($_SESSION["loginToken"])) {
                    header( "Location: home" );
                    exit;
                }
                $this->page();
                break;
            default:
                header( "Location: home" );
                break;
        }
    }

    public function page() {
        $data = [];
        $data["brandName"] = "發大財網路銀行";
        $data["title"] = "網路ATM";
        $data["css"] = "css/custom.css";
        $this->view("dashboard", $data);
    }
}