<?php

namespace Boilerplate\config;

class Application {
    
    private $url;
    private $routes;

    public function __construct() {
        $this->InitRoutes();
        $this->run($this->getUrl());
    }
    
    public function InitRoutes() {
        
        $ar['home'] = array("route"=>"/", 'controller' => 'index', 'action' => 'index');
        $ar['empresa'] = array("route"=>"/empresa", 'controller' => 'index', 'action' => 'empresa');
        $this->setRoutes($ar);
    }
    
    public function setRoutes(array $routes) {
        
        $this->routes = $routes;
    }
    
    public function getUrl() {
        $this->url = parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);
        return $this->url;
    }
    
    public function run($url) {
        
        array_walk($this->routes, function($route) use($url){
            if($url == $route['route']):
                echo "Encontrou";
            endif;
        });
        
    }
    
}
