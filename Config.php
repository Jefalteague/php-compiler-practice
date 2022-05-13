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
	
	// boolean (TRUE or FALSE)
	// to turn on and off parser messaging
	'messaging' => TRUE,

	'xref' => TRUE,
	
	// general tokens
	'tokens' => [
	
		'EOF' => 'EOF', // END OF FILE
		'EOL' => 'EOL', // END OF LINE
		'ID' => 'ID',
		'INTEGER_CONST' => 'INTEGER_CONST',
		'REAL_CONST' => 'REAL_CONST',
		'ASSIGN' => ':=',
		'ERROR' => 'ERROR',

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
		'REPEAT' => 'REPEAT',
		'UNTIL' => 'UNTIL',
	
	],
	
	// single-char-tokens
	'single-char-tokens' => [
	
		'PLUS' => '+',
		'MINUS' => '-',
		'DIVISION' => '/',
		'MULTIPLICATION' => '*',
		'SEMI' => ';',
		'LPAREN' => '(',
		'RPAREN' => ')',
		'DOT' => '.',
		'COMMA' => ',',
		'EQUAL' => '=',
		'COLON' => ':',
		// more to come
	
	],
	
	// message types
	
	'message_type' => [
	
		'SOURCE_LINE',
		'SYNTAX_ERROR',
		'PARSER_SUMMARY',
		'INTERPRETER_SUMMARY',
		'COMPILER_SUMMARY',
		'MISCELLANEOUS',
		'TOKEN',
		'ASSIGN',
		'FETCH',
		'BREAKPOINT',
		'RUNTIME_ERROR',
		'CALL',
		'RETURN',

	],
	
	'pascal_error_code' => [
	
		'INVALID_CHARACTER' => 'Invalid Character',
		'INVALID_CONSTANT' => 'Invalid Constant',
		'INVALID EXPRESSION' => 'Invalid Expression',
	
	]

];