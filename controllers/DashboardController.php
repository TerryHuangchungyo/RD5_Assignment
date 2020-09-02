<?php
class DashboardController extends Controller {
    public function __construct( $route ) {
        switch( $route->getNextPath() ) {
            case "logout":
                if( isset($_SESSION["loginToken"]))
                    unset($_SESSION["loginToken"]);
                header( "Location: /RD5_Assignment/home" );
                break;
            case "info":
                if( !isset($_SESSION["loginToken"]) ) {
                    header( "HTTP/1.1 404 Not Found" );
                    exit;
                }
                $this->info();
                break;
            case "panel":
                if( !isset($_SESSION["loginToken"]) && count($route->getParam()) != 1 ) {
                    header( "HTTP/1.1 404 Not Found" );
                    exit;
                }
                $this->panel( $route->getParam()[0] );
                break;
            case "deposit":
                break;
            case "withdraw":
                break;
            case "validate":
                $this->validate();
                break;
            case "changePassword":
                if( !isset($_SESSION["loginToken"]) || $route->hasNextPath() ) {
                    header( "HTTP/1.1 404 Not Found" );
                    exit;
                }
                //echo $_SESSION["loginToken"];
                $this->changePassword();
                break;
            case null:
                if( !isset($_SESSION["loginToken"])) {
                    header( "Location: ./home" );
                    exit;
                }
                $this->page();
                break;
            default:
                header( "Location: ./home" );
                break;
        }
    }

    public function page() {
        $data = [];
        $data["brandName"] = "發大財網路銀行";
        $data["title"] = "網路ATM";
        $data["css"] = ["views/css/custom.css"];
        $data["script"] = ["views/script/dashboard.js"];
        $data["navs"] = [ "accountInfo" => "帳戶資訊",
                        "deposit" => "存款",
                        "withdraw" => "提款",
                        "transaction" => "查詢明細",
                        "setting" => "帳戶設定",
                        "changePassword" => "更改密碼" ];
        $this->view("dashboard", $data);
    }

    public function panel( $panelName ) {
        switch( $panelName ) {
            case "info":
                $model = $this->model("Account");
                $model->load(["name", "holder", "balance"],$_SESSION["loginToken"]);
                $data = [ "accountName" => $model->name,
                        "accountHolder" => $model->holder,
                        "accountBalance" => $model->balance ];
                $this->view("panel/accountInfo", $data);
                break;
            case "withdraw":
                $data = [ "actionName" => "提款" ];
                $this->view("panel/actionForm", $data);
                break;
            case "deposit":
                $data = [ "actionName" => "存款" ];
                $this->view("panel/actionForm", $data);
                break;
            case "validate":
                $data[ "script" ] = ["views/script/validate.js"];
                $this->view("panel/validateForm", $data);
                break;
            case "transaction":
                if( isset($_SESSION["validated"]) ) {
                    $this->view("panel/transactionTable", Array());
                    unset($_SESSION["validated"]);
                } else {
                    header( "HTTP/1.1 404 Not Found" );
                    exit;
                }
                break;
            case "changePassword":
                $data = [];
                $data["script"] = ["views/script/changePassword.js"];
                $this->view("panel/changePasswordForm", $data);
                break;
        }
    }

    public function changePassword() {
        $result = [];
        /*if( !isset($_POST["changePassword"]) ||
            !isset($_POST["changeCheckPassword"]) ||
            !isset($_POST["password"]) ||
            !isset($_POST["checkPassword"]) 
          ) {
            header( "HTTP/1.1 404 Not Found" );
            exit;
        }*/

        if( $_POST["changePassword"] == "") {
            $result["changePassword"] = "is-invalid";
            $result["changePasswordFeedback"] = "此欄位不可留空";
        }

        if( $_POST["changeCheckPassword"] == "") {
            $result["changeCheckPassword"] = "is-invalid";
            $result["changeCheckPasswordFeedback"] = "此欄位不可留空";
        } else if( $_POST["changePassword"] !== $_POST["changeCheckPassword"] ) {
            $result["changeCheckPassword"] = "is-invalid";
            $result["changeCheckPasswordFeedback"] = "必須與欲更改的網銀密碼相同";
        }

        if( $_POST["password"] == "") {
            $result["password"] = "is-invalid";
            $result["passwordFeedback"] = "此欄位不可留空";
        }

        if( $_POST["checkPassword"] == "") {
            $result["checkPassword"] = "is-invalid";
            $result["checkPasswordFeedback"] = "此欄位不可留空";
        } else if( $_POST["password"] !== $_POST["checkPassword"] ) {
            $result["checkPassword"] = "is-invalid";
            $result["checkPasswordFeedback"] = "必須與原本的網銀密碼相同";
        }


        if( count($result) == 0 ) {
            $account = $this->model("Account");
            $account->load(["password"], $_SESSION["loginToken"]);
            if( hash( "sha256",$_POST["password"]) == $account->password ) {   
                $account->password = hash( "sha256",$_POST["changePassword"]);
                $success = $account->save(["password"], $_SESSION["loginToken"]);
                if( $success ) {
                    $result["what"] = "帳戶密碼";
                    $result["where"] = "changePassword";
                    $result["success"] = "成功";
                    $result["script"] = ["views/script/changeResult.js"];
                    $this->view("panel/changeResult", $result);
                } else {
                    $result["what"] = "帳戶密碼";
                    $result["where"] = "changePassword";
                    $result["success"] = "失敗";
                    $result["msg"] = ["系統發生錯誤"];
                    $result["script"] = ["views/script/changeResult.js"];
                    $this->view("panel/changeResult", $result);
                }
            } else {
                $result["checkPassword"] = "is-invalid";
                $result["checkPasswordFeedback"] = "輸入密碼錯誤";
                $result["script"] = ["views/script/changePassword.js"];
                $this->view("panel/changePasswordForm", $result);
            }
        } else {
            $result["script"] = ["views/script/changePassword.js"];
            $this->view("panel/changePasswordForm", $result);   
        }
    }

    public function validate() {
        $result = [];

        if( $_POST["validatePassword"] == "") {
            $result["validatePassword"] = "is-invalid";
            $result["validatePasswordFeedback"] = "此欄位不可留空";
        }

        if( $_POST["validateCheckPassword"] == "") {
            $result["validateCheckPassword"] = "is-invalid";
            $result["validateCheckPasswordFeedback"] = "此欄位不可留空";
        } else if( $_POST["validatePassword"] !== $_POST["validateCheckPassword"] ) {
            $result["validateCheckPassword"] = "is-invalid";
            $result["validateCheckPasswordFeedback"] = "必須上欄網銀密碼相同";
        }

        if( count($result) == 0 ) {
            $account = $this->model("Account");
            $success = $account->load(["password"], $_SESSION["loginToken"]);
            if( $success ) {
                if( hash( "sha256",$_POST["validateCheckPassword"]) == $account->password ) {   
                
                    switch( $_POST["panel"] ) {
                        case "setting":
                            $this->view("panel/settingForm", Array());
                            break;
                        case "transaction":
                            $this->view("panel/transactionTable", Array());
                            break;
                    }
                } else {
                    $result["validateCheckPassword"] = "is-invalid";
                    $result["validateCheckPasswordFeedback"] = "輸入密碼錯誤";
                    $result["script"] = ["views/script/validate.js"];
                    $this->view("panel/validateForm", $result);
                }
            } else {
                $result["validateCheckPassword"] = "is-invalid";
                $result["validateCheckPasswordFeedback"] = "系統發生錯誤";
                $result["script"] = ["views/script/validate.js"];
                $this->view("panel/validateForm", $result);
            }
        } else {
            $result["script"] = ["views/script/validate.js"];
            $this->view("panel/validateForm", $result);   
        }
    }
}
