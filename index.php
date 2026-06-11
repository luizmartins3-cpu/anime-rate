<?php

/**
 * Ponto de entrada da aplicação
 */

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/autoload.php';

// O roteador decide qual controller executar
require_once __DIR__ . '/app/router/router.php';
