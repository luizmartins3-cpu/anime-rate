<?php

spl_autoload_register(function ($class) {
    // Remove o namespace para buscar o arquivo físico
    $parts = explode('\\', $class);
    $className = end($parts);
    
    // Mapeamento de pastas conforme a nova estrutura
    $directories = [
        'app/controller/',
        'app/model/',
        'app/middleware/',
        'app/services/',
        'app/migration/',
        'app/router/',
        'app/interface/',
        'app/repository/',
        'app/'
    ];

    foreach ($directories as $directory) {
        $file = __DIR__ . '/' . $directory . $className . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});
