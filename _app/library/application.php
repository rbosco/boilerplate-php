<?php

namespace Boilerplate\library;

use Boilerplate\library\Application as Application;
use Boilerplate\library\Config as Config;
use Boilerplate\library\FrontControllerAction as FrontControllerAction;

class Application {

    private static $instance = null;
    private $_config = null;
    /**
     *
     * @var \Boilerplate\library\FrontControllerAction
     */
    private $_frontControllerAction = null;

    public function __construct() {
        //Executa a classe config quando o Application é instanciado.
        $this->_config = Config::getInstance();
        //Se o configFolder não estiver pasta definida, passar a pasta padrão.
        if ($this->_config->getConfigFolder() == NULL):
            $this->setConfigFolder('_app/config');
        endif;
    }
    
    /**
     * 
     * @param type $path
     * Chama o método da classe Config, passando a pasta padrão.
     */
    public function setConfigFolder($path) {
        $this->_config->setConfigFolder($path);
    }

    /**
     * 
     * @return \Boilerplate\library\Config
     * $_config passa a chamar as propriedades do Config
     */
    public function getConfig() {
        return $this->_config;
    }

    /**
     * @return static
     * Executa a classe Config, Application e FrontControllerAction
     */
    public function run() {
        //Se o configFolder não estiver pasta definida, passar a pasta padrão.
        if ($this->_config->getConfigFolder() == NULL):
            $this->setConfigFolder('_app/config');
        endif;
        $this->_frontControllerAction = FrontControllerAction::getInstance();
        $this->_frontControllerAction->dispatch();
    }

    /**
     * @return \Boilerplate\config\Application;
     * Singleton do Boilerplate
     */
    public static function getInstance() {
        if (self::$instance == NULL):
            self::$instance = new Application();
        endif;

        return self::$instance;
    }

//    private $url;
//    private $controller;
//    private $action;
//    public  $params;
//    private $explode;
//    private $routes;
//
//    public function __construct() {
////        $this->InitRoutes();
//        $this->getUrl();
//        $this->setExplode();
//        $this->setController();
////        $this->run($this->getUrl());
//    }
//
//    public function InitRoutes(string $controller) {
//        $ar['home'] = array("route" => "/", 'controller' => $controller, 'action' => 'index');
//        $this->setRoutes($ar);
//    }
//
//    public function setRoutes(array $routes) {
//        $this->routes = $routes;
//    }
//    
//    /**
//     * Busca a url
//     */
//    public function getUrl() {
//        $parse_url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
//        $getUrl = ($parse_url == '/index') ? substr(0, strlen($parse_url) - 6) : $parse_url;
//        $this->setUrl($getUrl);
//    }
//    
//    /**
//     * 
//     * @param type $url
//     * Tratamento da url
//     */
//    public function setUrl($url) {
//        $setUrl = ((empty($url)) || ($url == '/' )) ? 'index' : $url;
//        $this->url = $setUrl;
//    }
//    
//    /**
//     * Converte a url em array 
//     */
//    public function setExplode() {
//        $this->explode = explode("/", $this->url);
//        $this->getController($this->explode);
//    }
//    
//    /**
//     * Tratamento do primeiro parâmetro controller
//     */
//    public function getController() {
//        if(count($this->explode) > 1):
//            unset($this->explode[0]);
//        endif;
//    }
//
//    public function setController() {
//        $this->controller = $this->explode;
//        $implodeController = implode("", $$this->controller);
//        echo $implodeController;die();
//        
//    }
//
//    public function run($url) {
//        array_walk($this->routes, function($route) use($url) {
//            if ($url == $route['route']):
//                echo "Encontrou";
//            endif;
//        });
//    }
}
