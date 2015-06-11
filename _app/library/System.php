<?php

/*
 * Autor : Romulo B Bosco
 * Data criação : 28/05/2015
 * Descrição : Configurações do sistema
 */

class System {

    private $url;
    private $explode;
    private $ind;
    private $value;
    public $controllers;
    public $action;
    public $params;

    public function __construct() {
        $this->setUrl();
        $this->setExplode();
        $this->setController();
        $this->setAction();
        $this->setParams();
    }

    private function setUrl() {
        $getUrl = strip_tags(trim(filter_input(INPUT_GET, 'url', FILTER_DEFAULT)));
        $setUrl = (empty($getUrl) ? 'index' : $getUrl);
        $this->url = $setUrl;
    }

    private function setExplode() {
        $this->explode = explode('/', $this->url);
    }

    private function setController() {
        $controllerString = $this->explode[0];
        $controllerArr = explode("-", $controllerString);
        if (count($controllerArr) > 1):
            $controllerImplodeComEspaco = implode(" ", $controllerArr);
            $controllerUC = ucwords(strtolower($controllerImplodeComEspaco));
            $controllerFinal = str_replace(" ", "", $controllerUC) . 'Controller';
            $this->controllers = $controllerFinal;
        else:
            $controllerString = $this->explode[0];
            $controllerUC = ucfirst($controllerString);
            $controllerFinal = $controllerUC . 'Controller';
            $this->controllers = $controllerFinal;
        endif;
    }

    private function setAction() {
        $ac = (!isset($this->explode[1]) || $this->explode[1] == "" || $this->explode[1] == 'index' ? "indexAction" : $this->explode[1]);
        if ($ac == 'indexAction' || $ac == 'index'):
            $this->action = $ac;
        else:
            $ac = $this->explode[1];
            $actionArr = explode("-", $ac);
            for ($i = 0; $i < count($actionArr); $i++):
                $actionArrFinal[] = ucfirst($actionArr[$i]);
            endfor;
            $actionImplode = implode("", $actionArrFinal);
            $actionTratada = lcfirst($actionImplode) . 'Action';
            $this->action = $actionTratada;
        endif;
    }

    private function setParams() {

        unset($this->explode[0], $this->explode[1]);

        if (end($this->explode) == null):
            array_pop($this->explode);
        endif;

        $i = 0;
        if (!empty($this->explode)):
            foreach ($this->explode as $val):
                if ($i % 2 == 0):
                    $ind[] = $val;
                else:
                    $value[] = $val;
                endif;
                $i++;
            endforeach;
        else:
            $ind = array();
            $value = array();
        endif;

        if (count($ind) == count($value) && !empty($ind) && !empty($value)):
            $this->params = array_combine($ind, $value);
        else:
            $this->params = array();
        endif;
    }

    public function getParams($name = null) {
        if ($name != null):
            return $this->params[$name];
        else:
            return $this->params;
        endif;
    }

    public function run() {
        $controller_path = CONTROLLERS . $this->controllers . '.php';
        if (!file_exists($controller_path)):
            throw new Exception("Houve um erro. O controller não existe.");
        else:
            require_once $controller_path;
            $app = new $this->controllers();
            if (!method_exists($app, $this->action)):
                throw new Exception('Houve um erro. Esta action não existe');
            endif;
            $action = $this->action;
            $app->$action();
        endif;
    }

}
