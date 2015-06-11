<?php

/**
 * Created by PhpStorm.
 * User: romulo
 * Date: 08/06/15
 * Time: 23:55
 */

class LoginController extends  Controller{

    public function indexAction(){
        $this->view->render('default', 'login/index');
    }

} 
