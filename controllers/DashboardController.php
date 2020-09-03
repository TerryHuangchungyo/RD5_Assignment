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
            case "action":
                if( !isset($_SESSION["loginToken"]) || $route->hasNextPath() ) {
                    header( "HTTP/1.1 404 Not Found" );
                    exit;
                }
                $this->action();
                break;
            case "setting":
                if( !isset($_SESSION["loginToken"]) || $route->hasNextPath() || !isset($_SESSION["validated"]) ) {
                    header( "HTTP/1.1 404 Not Found" );
                    exit;
                }
                $this->setting();
                break;
            case null:
                if( !isset($_SESSION["loginToken"])) {
                    header( "Location: ./home" );
                    exit;
                }
                header("X-Frame-Options: SAMEORIGIN");
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
        if( isset($_SESSION["validated"]) ) {
            unset($_SESSION["validated"]);
        }
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
                $data = [ "action" => "withdraw", 
                        "actionName" => "提款",
                        "script" => ["views/script/action.js"] ];
                $this->view("panel/actionForm", $data);
                break;
            case "deposit":
                $data = ["action" => "deposit", 
                        "actionName" => "存款",
                        "script" => ["views/script/action.js"] ];
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
            default:
                header( "HTTP/1.1 404 Not Found" );
                exit;
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
                    $result["script"] = ["views/script/continue.js"];
                    $this->view("panel/changeResult", $result);
                } else {
                    $result["what"] = "帳戶密碼";
                    $result["where"] = "changePassword";
                    $result["success"] = "失敗";
                    $result["msg"] = ["系統發生錯誤"];
                    $result["script"] = ["views/script/continue.js"];
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
                    $_SESSION["validated"] = true;
                    switch( $_POST["panel"] ) {
                        case "setting":
                            $model = $this->model("Account");
                            $model->load(["name", "holder", "balanceHide"],$_SESSION["loginToken"]);
                            $data = [ "accountName" => $model->name,
                                    "accountHolder" => $model->holder,
                                    "balanceHide" => $model->balanceHide ];
                            $data["script"] = ["views/script/settingForm.js"];
                            $this->view("panel/settingForm", $data);
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

    public function action() {
        $result = [];
        if( $_POST["value"] == "") {
            $result["valueInvalid"] = "is-invalid";
            $result["valueFeedback"] = "此欄位不可留空";
        } else {
            $pattern = '/^\d{1,18}(\.\d{1,3})?$/';
            if( !preg_match( $pattern, $_POST["value"]) ) {
                $result["valueInvalid"] = "is-invalid";
                $result["valueFeedback"] = "必須是整數或浮點數，容許小數點後3位";
            }
        }

        if( $_POST["actionPassword"] == "") {
            $result["actionPassword"] = "is-invalid";
            $result["actionPasswordFeedback"] = "此欄位不可留空";
        }

        if( $_POST["actionCheckPassword"] == "") {
            $result["actionCheckPassword"] = "is-invalid";
            $result["actionCheckPasswordFeedback"] = "此欄位不可留空";
        } else if( $_POST["actionPassword"] !== $_POST["actionCheckPassword"] ) {
            $result["actionCheckPassword"] = "is-invalid";
            $result["actionCheckPasswordFeedback"] = "必須上欄網銀密碼相同";
        }

        if( count($result) == 0 ) {
            $result["value"] = $_POST["value"];
            $result["action"] = $_POST["action"];

            $account = $this->model("Account");
            $success = $account->load(["password"], $_SESSION["loginToken"]);
            if( $success ) {
                if( hash( "sha256",$_POST["actionPassword"]) == $account->password ) {  
                    $transaction = $this->model("Transaction");
                    $error = $this->model("TransactionError");

                    $account->load(["balance","name"], $_SESSION["loginToken"]);
                    
                    if( $_POST["action"] == "deposit" ) {
                        $actionCode = 1;
                    } else {
                        $actionCode = 2;
                    }
                    $value = (float)$_POST["value"];
                    $currentTime = date("Y-m-d H:i:s", mktime(gmdate("H")+8, gmdate("i"), gmdate("s"), gmdate("m"), gmdate("d"), gmdate("Y")) );

                    $success = $account->balanceOperation( $actionCode, $value);
                    $transaction->create([
                                        "accountId" => $account->accountId,
                                        "aid" => $actionCode,
                                        "value" => $value,
                                        "residue" => $account->balance,
                                        "success" => ( $success == "success") ? 1:0,
                                        "date" => $currentTime ] );
                    $transaction->loadLast(["value","residue","success","date"]);
                    if( $success != "success" ) {
                        $error->create([
                            "transId" => $transaction->transId,
                            "errorMsg" => $success
                        ]);
                    }

                    $detail = [];
                    $detail["action"] = $_POST["action"];
                    $detail["actionName"] = ($_POST["action"]=="withdraw")?"提款":"存款";
                    $detail["accountName"] = $account->name;
                    $detail["transId"] = sprintf("%10d", $transaction->transId );
                    $detail["date"] = $transaction->date;
                    $detail["value"] = $transaction->value;
                    $detail["residue"] = $transaction->residue;
                    $detail["status"] = ($transaction->success)?"成功":"失敗";
                    $detail["success"] = $transaction->success;
                    $detail["errorMsg"] = $success;
                    $detail["script"] = ["views/script/continue.js"];
                    $this->view("panel/transactionDetail", $detail );
                } else {
                    
                    if( $_POST["action"] == "withdraw" ) {
                        $result["actionName"] = "提款";
                    } else {
                        $result["actionName"] = "存款";
                    }

                    $result["actionCheckPassword"] = "is-invalid";
                    $result["actionCheckPasswordFeedback"] = "輸入密碼錯誤";
                    $result["script"] = ["views/script/action.js"];
                    $this->view("panel/actionForm", $result);
                }
            } else {

                if( $_POST["action"] == "withdraw" ) {
                    $result["actionName"] = "提款";
                } else {
                    $result["actionName"] = "存款";
                }

                $result["actionCheckPassword"] = "is-invalid";
                $result["actionCheckPasswordFeedback"] = "系統發生錯誤";
                $result["script"] = ["views/script/action.js"];
                $this->view("panel/actionForm", $result);
            }
        } else {
            $result["value"] = $_POST["value"];
            $result["action"] = $_POST["action"];

            if( $_POST["action"] == "withdraw" ) {
                $result["actionName"] = "提款";
            } else {
                $result["actionName"] = "存款";
            }

            $result["script"] = ["views/script/action.js"];
            $this->view("panel/actionForm", $result);   
        }
    }

    public function setting() {
        $result = [];


        if( $_POST["accountName"] == "") {
            $result["accountNameInvalid"] = "is-invalid";
            $result["accountNameFeedback"] = "此欄位不可留空";
        }

        if( $_POST["accountHolder"] == "") {
            $result["accountHolderInvalid"] = "is-invalid";
            $result["accountHolderFeedback"] = "此欄位不可留空";
        }

        if( count($result) == 0 ) { 
            $account = $this->model("Account");
            $account->load(["name", "holder", "balanceHide"], $_SESSION["loginToken"]);
            $account->name = $_POST["accountName"];
            $account->holder = $_POST["accountHolder"];
            $account->balanceHide = $_POST["balanceHide"];

            $success = $account->save(["name", "holder", "balanceHide"], $_SESSION["loginToken"]);
            if( $success ) {
                $result["what"] = "帳戶設定";
                $result["where"] = "setting";
                $result["success"] = "成功";
                $result["script"] = ["views/script/continue.js"];
                $this->view("panel/changeResult", $result);
            } else {
                $result["what"] = "帳戶設定";
                $result["where"] = "setting";
                $result["success"] = "失敗";
                $result["msg"] = ["系統發生錯誤"];
                $result["script"] = ["views/script/continue.js"];
                $this->view("panel/changeResult", $result);
            }
        } else {
            $result["accountName"] = $_POST["accountName"];
            $result["accountHolder"] = $_POST["accountHolder"];
            $result["balanceHide"] = $_POST["balanceHide"];
            $result["script"] = ["views/script/settingForm.js"];
            $this->view("panel/settingForm", $result);
        }
    }
}
