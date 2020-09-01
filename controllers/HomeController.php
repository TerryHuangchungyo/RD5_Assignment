<?php
class HomeController extends Controller {
    public function __construct( $route ) {
        switch( $route->getNextPath() ) {
            case "login":
                if( count($route->getParam()) != 0 ) {
                    header( "HTTP/1.1 404 Not Found" );
                    exit;
                }
                $this->login();
                break;
            case "signup":
                if( count($route->getParam()) != 0 ) {
                    header( "HTTP/1.1 404 Not Found" );
                    exit;
                }
                $this->signup();
                break;
            case "page":
            default:
                if( count($route->getParam()) != 0 ) {
                    header( "HTTP/1.1 404 Not Found" );
                    exit;
                }
                $this->page();
                break;
        }
    }

    public function page() {
        $data = [];
        $data["brandName"] = "發大財網路銀行";
        $data["title"] = "首頁";
        $data["script"] = "views/script/home.js";
        $this->view("home", $data);
    }

    public function login() {
        
    }

    public function signup() {
        $result = [];

        if( $_POST["signupId"] == "" ) {
            $result["signupId"] = "網銀帳號不可留空";
        } else {
            $account = $this->model("Account");
            $exists = $account->load(["accountId"], $_POST["signupId"]);
            if( $exists ) {
                $result["signupId"] = "該網銀帳號已被註冊，請更換";
            }
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
        } else if( $_POST["signupPassword"] != $_POST["signupCheckPassword"] ) {
            $result["signupCheckPassword"] = "必須與輸入的網銀密碼相同";
        }

        if( count($result) == 0 ) {
            $success = $account->create([ "accountId" => htmlspecialchars($_POST["signupId"]),
                   "name" => htmlspecialchars($_POST["signupName"]),
                   "password" => hash( "sha256",$_POST["signupPassword"]),
                   "holder" => htmlspecialchars($_POST["signupHolder"])]);
            if( $success ) {   
                $result["success"] = true;
            } else {
                $result["success"] = false;   
            }
        } else {
            $result["success"] = false;
        }
        $this->view("api/JsonAPI", $result);
    }
}