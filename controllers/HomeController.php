<?php
class HomeController extends Controller {
    public function __construct( $route ) {
        if( isset($_SESSION["loginToken"])) {
            header( "Location: /RD5_Assignment/dashboard" );
            exit;
        }

        switch( $route->getNextPath() ) {
            case "login":
                if( $route->hasNextPath() ) {
                    header( "HTTP/1.1 404 Not Found" );
                    exit;
                }
                $this->login();
                break;
            case "signup":
                if( $route->hasNextPath()) {
                    header( "HTTP/1.1 404 Not Found" );
                    exit;
                }
                $this->signup();
                break;
            case null:
                header("X-Frame-Options: SAMEORIGIN");
                $this->page();
                break;
            default:
                header( "HTTP/1.1 404 Not Found" );
                exit;
                break;
        }
    }

    public function page() {
        $data = [];
        $data["brandName"] = "發大財網路銀行";
        $data["title"] = "首頁";
        $data["script"] = ["views/script/home.js"];
        $data["css"] = ["views/css/custom.css"];
        $this->view("home", $data);
    }

    public function login() {
        $result = [];
        if( isset($_POST["accountId"]) ) {
            if( $_POST["accountId"] == "" ) {
                $result["accountId"] = "網銀帳號不可留空";
            }
        } else {
            header( "HTTP/1.1 404 Not Found" );
            exit;
        }

        if( $_POST["accountPassword"] == "") {
            $result["accountPassword"] = "網銀密碼不可留空";
        }

        if( count( $result )== 0 ) {
            $account = $this->model("Account");
            $exists = $account->load(["accountId","password"], htmlspecialchars($_POST["accountId"]));
            if( $exists && hash( "sha256",$_POST["accountPassword"]) == $account->password ) {
                $_SESSION["loginToken"] = $account->accountId;
                $result["success"] = true;
            } else {
                $result["accountConclude"] = "網銀帳號或密碼有誤";
                $result["success"] = false;
            }
        } else {
            $result["success"] = false;
        }
        $this->view("api/JsonAPI", $result);
    }

    public function signup() {
        $result = [];
        if( isset($_POST["signupId"]) ) {
            if( $_POST["signupId"] == "" ) {
                $result["signupId"] = "網銀帳號不可留空";
            } else {
                $account = $this->model("Account");
                $exists = $account->load(["accountId"], $_POST["signupId"]);
                if( $exists ) {
                    $result["signupId"] = "該網銀帳號已被註冊，請更換";
                }
            }
        } else {
            header( "HTTP/1.1 404 Not Found" );
            exit;
        }

        if( $_POST["signupName"] == "") {
            $result["signupName"] = "網銀帳戶名稱不可留空";
        }

        if( $_POST["signupHolder"] == "") {
            $result["signupHolder"] = "網銀帳戶擁有人姓名不可留空";
        }

       
        if( $_POST["signupPassword"] == "") {
            $result["signupPassword"] = "網銀密碼不可留空";
        }

        if( $_POST["signupCheckPassword"] == "") {
            $result["signupCheckPassword"] = "網銀確認密碼不可留空";
        } else if( $_POST["signupPassword"] !== $_POST["signupCheckPassword"] ) {
            $result["signupCheckPassword"] = "必須與輸入的網銀密碼相同";
        }


        if( count($result) == 0 ) {
            $result["success"] = false;
            $success = $account->create([ "accountId" => htmlspecialchars($_POST["signupId"]),
                   "name" => htmlspecialchars($_POST["signupName"]),
                   "password" => hash( "sha256",$_POST["signupPassword"]),
                   "holder" => htmlspecialchars($_POST["signupHolder"])]);
            if( $success ) {   
                $result["success"] = true;
            } 
        } else {
            $result["success"] = false;
        }

        $this->view("api/JsonAPI", $result);
    }
}