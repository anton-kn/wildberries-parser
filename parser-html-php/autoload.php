<?php
spl_autoload_register(function($class) {
    $file = str_replace('\\', DIRECTORY_SEPARATOR, $class).'.php';
    // throw new Exception(__DIR__ . '/src/' . $file);
    require __DIR__ . '/src/' . $file;
});
