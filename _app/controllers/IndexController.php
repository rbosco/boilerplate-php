<?php
/**
 * Autor : Romulo B Bosco
 * Data criação: 28/05/2015
 * Descriação: Controlador da página inicial
 */
namespace Boilerplate\controllers;

use Boilerplate\config\Application as Application;

class IndexController extends Application{
    
    public function indexAction() {
        echo "HOME";
//        $this->view->render('default','index/index');
    }
    
    public function empresaAction(){
        echo "empresa";
    }
}

