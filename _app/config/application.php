<?php

namespace Boilerplate\config;

class Application {
    
    private $url;
    private $routes;

    public function __construct() {
        $this->InitRoutes();
    }
    
    public function InitRoutes() {
        
        $ar['home'] = array("routes"=>"/", 'controller' => 'index', 'action' => 'index');
        $ar['empresa'] = array("routes"=>"/empresa", 'controller' => 'index', 'action' => 'empresa');
        $this->setRoutes($ar);
    }
    
    public function setRoutes(array $routes) {
        
        $this->routes = $routes;
    }
    
    public function getUrl() {
        $this->url = parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);
        return $this->url;
    }
    
}
