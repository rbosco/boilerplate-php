<?php

/**
 * Autor: Romulo B Bosco
 * Data criação : 28/05/2015
 * Descrição : Configurações dos diretórios
 */
define('BASEURL', 'http://arquiteturaphp.com.br:3000');
define('THEME', '/themes');
define('NOMETHEME','/default');
define('APLICACAO','_app');
define('PUBLICO', '_public');
define('CONTROLLERS', APLICACAO . '/controllers/');
define('MODELS', APLICACAO . '/controllers/');
define('VIEWS', PUBLICO . THEME . NOMETHEME . '/templates');
define('INCLUDE_PATH', PUBLICO . THEME . NOMETHEME);

require("_app/config/menu.php");


