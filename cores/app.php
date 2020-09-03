<?php
class APP {
    public function __construct() {
        $route = new Route();
        
        switch( $route->getNextPath() ) {
            case "transaction":
                $controller = new TransactionController($route);
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