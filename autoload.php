<?php
spl_autoload_register(function ($classname) {
    $file = __DIR__ . '\\' . $classname . '.php';
//    echo "$classname"; die();
    $file = str_replace('\\', DIRECTORY_SEPARATOR, $file);
    if (file_exists($file)) {
        include $file;
    }
});