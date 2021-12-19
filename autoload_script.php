<?php

$config = [
    
    'auto_dirs' => [
		
        'auto_dirs' => [

            __DIR__,
        
        ],

    ],

];

$autoloader_directories = $config['auto_dirs']['auto_dirs'];

require_once('.\Autoloader\autoloader.php');

use Autoloader\Autoloader as Autoloader;

Autoloader::init($autoloader_directories);