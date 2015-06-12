<?php

/**
 * Description of DefaultRouter
 *
 * @author romulobbosco
 */

namespace Boilerplate\Library\Routers;

class DefaultRouter {

    private $uri;
    private $controller;
    private $action;
    public  $params;
    private $explode;
    private $routes;
    
    public function __construct() {
        $this->getURI();
    }

    /**
     * Busca a URI
     */
    public function getURI() {
        $parseURI = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $getURI = ($parseURI == '/index') ? substr(0, strlen($parseURI) - 6) : $parseURI;
        $this->setURI($getURI);
    }

    /**
     * 
     * @param type $uri
     * Tratamento da uri
     */
    public function setURI($uri) {
        $setURI = ((empty($uri)) || ($uri == '/' )) ? 'index' : $uri;
        $this->uri = $setURI;
        echo $this->uri;
    }

}
