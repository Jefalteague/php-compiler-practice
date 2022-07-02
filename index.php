<?php

// Pull in the autoloader file
require_once('.\Autoloader\Autoloader.php');

use Autoloader\Autoloader as Autoloader;
use Factory\Parser_Factory as Parser_Factory;
use Message\Parser_Listener as Parser_Listener;
use Message\Parser_Error_Listener as Parser_Error_Listener;
use Crossreferencer\Crossreferencer;

// Pull in the config file
$config = require_once('Config.php');

// Get the dirs for the autoloader from the config file
$auto_dirs = $config['auto_dirs']['auto_dirs'];

//var_dump($auto_dirs);

// Use the autoloader
$init = Autoloader::init($auto_dirs);

// Create the necessary factory objects
$parser_factory = new Parser_Factory();

// Use the factory to get started
$parser = $parser_factory->create_parser($config['language'], 'Programs/eof.txt', $config);

// Create the necessary listener for the messages
$parser_listener = new Parser_Listener();

// Create the error listener for the error messages
$error_listener = new Parser_Error_Listener();

// Register the listener for messages
$parser->add_listener($parser_listener);

// Register the error listener
// Will need to combine with general parser listener because can only send one at a time
$parser->add_listener($error_listener);

// Start the parsing process
$token = $parser->parse();

// View Crossreference if xref=TRUE
$stack = $parser->get_symbol_table_stack();

if($config['xref'] == TRUE) {

    $xref = new Crossreferencer();

    $xref->crossreference($stack);

}
