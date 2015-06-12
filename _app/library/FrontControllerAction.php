<?php

/**
 * Autor: Romulo B Bosco
 * Data criação : 28/05/2015
 * Descrição: Classe intermediária que irá comunicar com MODELS E VIEWS
 */

namespace Boilerplate\library;
use Boilerplate\library\FrontControllerAction as FrontControllerAction;
use Boilerplate\Library\Routers\DefaultRouter as DefaultRouter;

class FrontControllerAction{
    
    private static $_instance = null;
    
    private function __construct() {
        
    }
    
    public function dispatch() {
        $a = new DefaultRouter();
    }


    public static function getInstance() {
        if(self::$_instance == null):
            self::$_instance = new FrontControllerAction();
        endif;
        
        return self::$_instance;
    }
}

