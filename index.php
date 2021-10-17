<?php

/*
** The index to test the folder/namespace changes
**
*/

include('Factory/Parser_Factory.php');

$config = include('Config.php');

use Factory\Parser_Factory as Parser_Factory;

$parser_factory = new Parser_Factory();

$parser = $parser_factory->create_parser('my_language', 'bob.txt', $config);

$token = $parser->parse();

