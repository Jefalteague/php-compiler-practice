<?php

/*
** The Char Token class
**
*/

namespace Token;

use Token\Token as Token;

require_once('Token/Token.php');

class Char_Token extends Token {

	// properties
	
	public $type = "CHAR";
	public $value;
	
	// methods
	

}