<?php

/*
** The EOF token class to return to the parser
**
*/

namespace Token;

use Token\Token as Token;

require_once('Token/Token.php');

class EOF_Token extends Token{
	
	// properties
		
	public $type = "EOF";
		
	// methods
	
}