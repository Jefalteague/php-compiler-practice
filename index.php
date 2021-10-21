<?php

require_once('.\Autoloader\Autoloader.php');

use Autoloader\Autoloader as Autoloader;


$config = require_once('Config.php');

$auto_dirs = $config['auto_dirs']['auto_dirs'];


Autoloader::init($auto_dirs);


use Factory\Parser_Factory as Parser_Factory;

use Message\Parser_Listener as Parser_Listener;


$parser_factory = new Parser_Factory();

$parser_listener = new Parser_Listener();



$parser = $parser_factory->create_parser('my_language', 'white_space_work.txt', $config);

$parser->add_listener($parser_listener);

$token = $parser->parse();
