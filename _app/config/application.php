<?php

namespace Boilerplate\config;

class Application {
    
    private $request_uri;
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
        $this->request_uri = $_SERVER['REQUEST_URI'];
        return parse_url($this->request_uri, PHP_URL_PATH);
    }
    
}
