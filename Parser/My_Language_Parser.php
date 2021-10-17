<?php

/*
** The My_Language_Parser version of the parser
**
*/

namespace Parser;

use Parser\Parser as Parser;
use Scanner\My_Language_Scanner as My_Language_Scanner;


require_once('Parser/Parser.php');
require_once('Scanner/My_Language_Scanner.php');

class My_Language_Parser extends Parser {
	
	public $scanner;
	
	public function __construct(My_Language_Scanner $scanner) {
		
		$this->scanner = $scanner;
		
	}
	
	public function get_scanner() {}
	public function get_int_rep() {}
	public function get_symb_tab() {}
	
	public function make_token() {
		
		return $this->scanner->make_token();
		
	}
	
}