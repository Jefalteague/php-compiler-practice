<?php

return [
	
	'language' => 'My_Language',
	
	'parser' => 'My_Language_Parser',
	
	'scanner' => 'My_Language_Scanner',
	
	// register dirs for the autoloader
	'auto_dirs' => [
		
		'auto_dirs' => [
	
			__DIR__,
			
		],
	],
	
	// boolean (TRUE of FALSE)
	// to turn on and off messaging output from each step
	'messaging' => TRUE,
	
	// general tokens
	'tokens' => [
	
		'EOF' => 'EOF', // END OF FILE
		'EOL' => 'EOL', // END OF LINE
		'ID' => 'ID',
		'INTEGER_CONST' => 'INTEGER_CONST',
		'REAL_CONST' => 'REAL_CONST',
		'ASSIGN' => ':=',

	],
	
	// reserved word tokens
	'reserved-word-tokens' => [
	
		'BEGIN' => 'BEGIN',
		'PROCEDURE' => 'PROCEDURE',
		'BLOCK' => 'BLOCK',
		'INTEGER' => 'INTEGER',
		'PROGRAM' => 'PROGRAM',
		'REAL' => 'REAL',
		'INTEGER_DIV' => 'DIV',
		'VAR' => 'VAR',
		'END' => 'END',
	
	],
	
	// single-hcar-tokens
	'single-char-tokens' => [
	
		'PLUS' => '+',
		'MINUS' => '-',
		'DIVISION' => '/',
		'MULTIPLICATION' => '*',
		'SEMI' => ';',
		'COLON' => ':',
		'LPAREN' => '(',
		'RPAREN' => ')',
		'DOT' => '.',
		'COMMA' => ','
	
	]

];