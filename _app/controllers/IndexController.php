<?php
/**
 * Autor : Romulo B Bosco
 * Data criação: 28/05/2015
 * Descriação: Controlador da página inicial
 */
class IndexController extends Controller{
    
    public function indexAction() {
        
        $this->view->render('default','index/index');
    }
}

