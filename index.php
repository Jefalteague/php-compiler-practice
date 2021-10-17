<?php

/*
** The index to test the folder/namespace changes
**
*/

include('Factory/Parser_Factory.php');

$config = include('Config.php');

use Factory\Parser_Factory as Parser_Factory;

$parser_factory = new Parser_Factory();

$parser = $parser_factory->create_parser('my_language', 'jeffrey.txt', $config);

$token = $parser->make_token();

echo "<br />Token Message:";
echo $token->get_message();
echo "<br />";

echo "<br /> Token Value:";
echo $token->get_value();
echo "<br />";

echo "<br />Token Column Number:";
echo $token->get_column_number();
echo "<br />";

echo "<br />Token Line Number:";
echo $token->get_line_number();
echo "<br />";

$token = $parser->make_token();

echo "<br />Token Message:";
echo $token->get_message();
echo "<br />";

echo "<br /> Token Value:";
echo $token->get_value();
echo "<br />";

echo "<br />Token Column Number:";
echo $token->get_column_number();
echo "<br />";

echo "<br />Token Line Number:";
echo $token->get_line_number();
echo "<br />";

$token = $parser->make_token();

echo "<br />Token Message:";
echo $token->get_message();
echo "<br />";

echo "<br /> Token Value:";
echo $token->get_value();
echo "<br />";

echo "<br />Token Column Number:";
echo $token->get_column_number();
echo "<br />";

echo "<br />Token Line Number:";
echo $token->get_line_number();
echo "<br />";

$token = $parser->make_token();

echo "<br />Token Message:";
echo $token->get_message();
echo "<br />";

echo "<br /> Token Value:";
echo $token->get_value();
echo "<br />";

echo "<br />Token Column Number:";
echo $token->get_column_number();
echo "<br />";

echo "<br />Token Line Number:";
echo $token->get_line_number();
echo "<br />";

$token = $parser->make_token();

echo "<br />Token Message:";
echo $token->get_message();
echo "<br />";

echo "<br /> Token Value:";
echo $token->get_value();
echo "<br />";

echo "<br />Token Column Number:";
echo $token->get_column_number();
echo "<br />";

echo "<br />Token Line Number:";
echo $token->get_line_number();
echo "<br />";

$token = $parser->make_token();

echo "<br />Token Message:";
echo $token->get_message();
echo "<br />";

echo "<br /> Token Value:";
echo $token->get_value();
echo "<br />";

echo "<br />Token Column Number:";
echo $token->get_column_number();
echo "<br />";

echo "<br />Token Line Number:";
echo $token->get_line_number();
echo "<br />";

$token = $parser->make_token();

echo "<br />Token Message:";
echo $token->get_message();
echo "<br />";

echo "<br /> Token Value:";
echo $token->get_value();
echo "<br />";

echo "<br />Token Column Number:";
echo $token->get_column_number();
echo "<br />";

echo "<br />Token Line Number:";
echo $token->get_line_number();
echo "<br />";

$token = $parser->make_token();

echo "<br />Token Message:";
echo $token->get_message();
echo "<br />";

echo "<br /> Token Value:";
echo $token->get_value();
echo "<br />";

echo "<br />Token Column Number:";
echo $token->get_column_number();
echo "<br />";

echo "<br />Token Line Number:";
echo $token->get_line_number();
echo "<br />";

