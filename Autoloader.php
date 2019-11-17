<?php

spl_autoload_register(function($class) {
   
    //get the difference in folders
    $lastDirectories = substr(getcwd(), strlen(__DIR__));
    
    //echo "getcwd = : " . getcwd() . " <br>";
    //echo "__DIR__ = : " . __DIR__ . " <br>";
    //echo "lastDirectories = : " . $lastDirectories . " <br>";
    
    //count the number of slashes
    $numberOfLastDirectories = substr_count($lastDirectories, '/');
    
    //echo "number of driectories different = : " . $numberOfLastDirectories . " <br>";
    
    //look up locations for class in this app
    $directories = ['businessService', 'businessService/model', 'dataService', 'presentation', 'presentation/handlers', 'presentation/views', 'presentation/views/login', 'utility'];
    
    //look up each directory for the class we need
    foreach($directories as $dir) {
        $curDirectory = $dir;
        for($x = 0;$x < $numberOfLastDirectories;$x++) {
            $curDirectory = "../" . $curDirectory;
        }
        $classfile = $curDirectory . '/' . $class . '.php';
        
        if(is_readable($classfile)) {
            if(require $dir . '/' . $class . ".php") {
                break;
            }
        }
    }
    
});