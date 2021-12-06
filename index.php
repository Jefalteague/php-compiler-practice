<?php

//phpinfo();
//die;

// Pull in the autoloader file
require_once('.\Autoloader\Autoloader.php');

// Pull in the config file
$config = require_once('Config.php');

// Use the autoloader namespace
use Autoloader\Autoloader as Autoloader;

// Use the parser factory namespace
use Factory\Parser_Factory as Parser_Factory;

// Use the parser listener namespace
use Message\Parser_Listener as Parser_Listener;

// Get the dirs for the autoloader from the config file
$auto_dirs = $config['auto_dirs']['auto_dirs'];

// Use the autoloader
$init = Autoloader::init($auto_dirs);

// Create the necessary factory objects
$parser_factory = new Parser_Factory();

// Create the necessary listener for the messages
$parser_listener = new Parser_Listener();

// Use the factory to get started
$parser = $parser_factory->create_parser($config['language'], 'stroffset_problem.txt', $config);

// Register the listener for messages
$parser->add_listener($parser_listener);

// Start the parsing process
$token = $parser->parse();
