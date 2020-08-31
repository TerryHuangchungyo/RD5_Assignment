<?php
class APP {
    public function __construct() {
        if( !isset($_GET["url"])) {
            $_GET["url"] = "home/page";
        }

        $url = explode("/",rtrim( $_GET["url"], "/"));

        if( !isset($url[0])) {
            header( "HTTP/1.1 404 Not Found" );
            exit;
        }

        $controllerName = "{$url[0]}Controller";
        require_once "controllers/$controllerName.php";
        $controller = new $controllerName;
        $method = $url[1];
        unset($url[0]);
        unset($url[1]);
        $param = $url ? array_values($url) : Array();
        if( method_exists( $controller, $method ) ) {
            call_user_func_array( array( $controller, $method ), $param );
        } else {
            header( "HTTP/1.1 404 Not Found" );
        }
    }
}