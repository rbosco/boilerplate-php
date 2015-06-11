<?php

/**
 * Autor: ROMULO B BOSCO
 * DATA CRIAÇÃO: 29/05/2015
 * DESCRIÇÃO: COMUNICA COM O CONTROLLER
 * 
 */
class View extends System {

    public function render($theme, $view , array $vars = null) {
      
        if (file_exists(PUBLICO . THEME . '/' . $theme . '/' . 'templates/' . $view . '.phtml')):
            if (is_array($vars)):
                echo $vars;
            endif;
            require_once (PUBLICO . THEME . '/' . $theme . '/' . 'templates/' . 'inc/header' . '.phtml');
            require_once (PUBLICO . THEME . '/' . $theme . '/' . 'templates/' . 'inc/sidebar' . '.phtml');
            require_once (PUBLICO . THEME . '/' . $theme . '/' . 'templates/' . $view . '.phtml');
            require_once (PUBLICO . THEME . '/' . $theme . '/' . 'templates/' . 'inc/footer' . '.phtml');
        else:
            require_once (PUBLICO . THEME . '/' . $theme . '/' . 'templates/' . 'Erro.phtml');
        endif;
    }

}
