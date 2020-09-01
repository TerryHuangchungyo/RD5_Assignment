<?php
class APP {
    public function __construct() {
        $route = new Route();
        
        switch( $route->getNextPath() ) {
            case "account":
                $controller = new AccountController($route);
                break;
            case "dashboard":
                $controller = new DashboardController($route);
                break;
            case "home":    
            default:
                $controller = new HomeController($route);
                break;
        }
    }
}