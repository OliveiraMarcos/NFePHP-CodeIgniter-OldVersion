<?php

spl_autoload_extensions('.php'); // Only Autoload PHP Files

spl_autoload_register(function($classname) {
    
    if (strpos($classname, '\\') !== false) {
        // Namespaced Classes
        $classfile = (str_replace('\\', '/', $classname));
        if ($classname[0] !== '/') {
            $classfile = APPPATH . 'libraries/' . $classfile . '.php';
        }
        require($classfile);
    } else if (strpos($classname, 'interface') !== false) {
        // Interfaces
        strtolower($classname);
        require('application/interfaces/' . $classname . '.php');
    }
});
?>

