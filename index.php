<?php

/*
** The index to test the folder/namespace changes
**
*/

include('Factory/Scanner_Factory.php');

$config = include('Config.php');

use Factory\Scanner_Factory as Scanner_Factory;

$scanner = new Scanner_Factory();

$scanner = $scanner->create_scanner('my_language', 'bob.txt', $config);

$token = $scanner->make_token();

echo $token->get_message();