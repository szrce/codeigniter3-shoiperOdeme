<?php

//new line

spl_autoload_extensions('.php'); // Only Autoload PHP Files

spl_autoload_register(function($classname) {
  //echo $classname;
    if (strpos($classname,'\\') !== false) {
        // Namespaced Classes
        $classfile = (str_replace('\\', '/', $classname));

        if ($classname[0] !== '/') {
            $classfile = APPPATH.'/libraries/' . $classfile . '.php';
        }
        require($classfile);
      }
});
