<?php

/*
** The My_Language_Parser version of the parser
**
*/

namespace Parser;

use Parser\Parser as Parser;
use Scanner\My_Language_Scanner as My_Language_Scanner;
use Token\EOF_Token as EOF_Token;

//require_once('Parser/Parser.php');
//require_once('Scanner/My_Language_Scanner.php');
//require_once('Token/EOF_Token.php');

class My_Language_Parser extends Parser {
	
	public $scanner;
	
	public function __construct(My_Language_Scanner $scanner) {
		
		$this->scanner = $scanner;
		
	}
	
	public function get_scanner() {}
	public function get_int_rep() {}
	public function get_symb_tab() {}
	
	public function parse() {
		
		while (!(is_a($token = $this->scanner->make_token(), 'EOF_Token'))) {
			
			//return $this->scanner->make_token();
			
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
			
		}
		
		
	}
	
}