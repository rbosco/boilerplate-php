<?php
/**
 * Autor: Romulo B Bosco
 * Data criação : 28/05/2015
 * Descrição: Arquivo de inicializacao da aplicação.
 */
require("_app/config/config.php");
require ("_app/config/autoload.php");
require("_app/config/paths.php");

$app = new System();
$app->run();
