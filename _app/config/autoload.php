<?php

// AUTO LOAD DE CLASSES ####################
function __autoload($Class) {

    $cDir = ['conn', 'helpers', 'models', 'libs'];
    $iDir = null;

    foreach ($cDir as $dirName):

        if (!$iDir && file_exists(APLICACAO . DIRECTORY_SEPARATOR . $dirName . DIRECTORY_SEPARATOR . $Class . '.php') && !is_dir(APLICACAO . DIRECTORY_SEPARATOR . $dirName . DIRECTORY_SEPARATOR . $Class . '.php')):
            require_once (APLICACAO . DIRECTORY_SEPARATOR . $dirName . DIRECTORY_SEPARATOR . $Class . '.php');
            $iDir = true;
        endif;
    endforeach;

    if (!$iDir):
        trigger_error("Não foi possível incluir {$Class}.php", E_USER_ERROR);
        die;
    endif;
}