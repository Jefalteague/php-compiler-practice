<?php

return [
	
	'language' => 'My_Language',
	
	'parser' => 'My_Langguage_Parser',
	
	'scanner' => 'My_Language_Scanner',
	
	// registered tokens
	'tokens' => [
	
		"EOF" => "EOF", // END OF FILE
		"EOL" => "EOL", // END OF LINE
	],
	
	// register dirs for the autoloader
	'auto_dirs' => [
		
		'auto_dirs' => [
	
			__DIR__,
			
		],
	],
	
	// boolean (TRUE of FALSE)
	// to turn on and off messaging output from each step
	'messaging' => TRUE,

];