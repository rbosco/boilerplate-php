<?php

namespace Boilerplate\library;

use Boilerplate\library\Config as Config;

class Config {

    private static $instance = null;
    private $_configArray = array();
    private $_configFolder = null;

    private function __construct() {
        
    }
    
    public function getConfigFolder() {
        return $this->_configFolder;
    }

    /**
     * 
     * @param type $configFolder
     * @throws \Exception
     * Verifica se existe a pasta config.
     */
    public function setConfigFolder($configFolder) {
        if (!$configFolder):
            throw new \Exception('Empty config folder path');
        endif;
        $_configFolder = realpath($configFolder);
        if ($_configFolder != FALSE && is_dir($_configFolder) && is_readable($_configFolder)):
            //clear old config data
            $this->_configArray = array();
            $this->_configFolder = $_configFolder . DIRECTORY_SEPARATOR;
            $ns = $this->app['namespace'];
            if(is_array($ns)):
                spl_autoload_register($ns);
            endif;
        else:
            throw new \Exception('Config directory read error:' . $configFolder);
        endif;
    }

    /**
     * 
     * @param type $path
     * @throws \Exception
     * Inclusao dos arquivos da pasta config.
     */
    public function includeConfigFile($path) {
        if (!$path):
            throw new \Exception();
        endif;
        $_file = realpath($path);
        if ($_file != FALSE && is_file($_file) && is_readable($_file)):
            $_basename = explode('.php', basename($_file))[0];
            $this->_configArray[$_basename] = require_once $_file;
        else:
            throw new \Exception('Config file read error:' . $path);
        endif;
    }
    /**
     * 
     * @param type $name
     * @return boolean
     * Pega o método passado no objeto.
     */
    public function __get($name) {
        if (!$this->_configArray[$name]):
            $this->includeConfigFile($this->_configFolder . $name . '.php');
        endif;
        if (array_key_exists($name, $this->_configArray)):
            return $this->_configArray[$name];
        endif;

        return FALSE;
    }

    /**
     * 
     * @return \Boilerplate\library
     * Singleton da classe Config
     */
    public static function getInstance() {
        if (self::$instance == null):
            self::$instance = new Config();
        endif;

        return self::$instance;
    }

}
