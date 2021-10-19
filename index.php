<?php

require_once('.\Autoloader\Autoloader.php');

$config = require_once('Config.php');

$auto_dirs = $config['auto_dirs']['auto_dirs'];

autoloader::init($auto_dirs);

use Factory\Parser_Factory as Parser_Factory;

$parser_factory = new Parser_Factory();

$parser = $parser_factory->create_parser('my_language', 'jeffrey.txt', $config);

$token = $parser->parse();

