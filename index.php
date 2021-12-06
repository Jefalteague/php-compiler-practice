<?php

//phpinfo();
//die;

require_once('.\Autoloader\Autoloader.php');

$config = require_once('Config.php');


use Autoloader\Autoloader as Autoloader;

use Factory\Parser_Factory as Parser_Factory;

use Message\Parser_Listener as Parser_Listener;


$auto_dirs = $config['auto_dirs']['auto_dirs'];

$init = Autoloader::init($auto_dirs);

$parser_factory = new Parser_Factory();

$parser_listener = new Parser_Listener();

$parser = $parser_factory->create_parser($config['language'], 'stroffset_problem.txt', $config);

$parser->add_listener($parser_listener);

$token = $parser->parse();
