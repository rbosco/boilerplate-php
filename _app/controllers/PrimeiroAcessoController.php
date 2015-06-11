<?php

/**
 * Created by PhpStorm.
 * User: romulo
 * Date: 08/06/15
 * Time: 23:54
 */

class PrimeiroAcessoController extends Controller{

    public function indexAction(){
        $this->view->render('default','primeiro-acesso/index');
    }

} 
