<?php
require_once "cores/controller.php";

class HomeController extends Controller {
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
        
    }
}