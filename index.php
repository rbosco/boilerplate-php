<?php
/**
 * Autor: Romulo B Bosco
 * Data criação : 28/05/2015
 * Descrição: Arquivo de inicializacao da aplicação.
 */

//Habilita a função de erros do PHP
error_reporting(E_ALL ^ E_NOTICE);

use Boilerplate\library\Application as Application;

//Autocarregamento dos namespaces
require_once ('vendor/autoload.php');

//Executa o Boilerplate
$app = Application::getInstance();
$app->run();

