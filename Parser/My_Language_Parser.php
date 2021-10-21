<?php

/*
** The My_Language_Parser version of the parser
**
*/

namespace Parser;

use Parser\Parser as Parser;
use Scanner\My_Language_Scanner as My_Language_Scanner;
use Token\EOF_Token as EOF_Token;
use Message\Message_Handler as Message_Handler;

class My_Language_Parser extends Parser {
	
	public $scanner;
	public $message_handler;
	
	public function __construct(My_Language_Scanner $scanner) {
		
		$this->scanner = $scanner;
		$this->message_handler = new Message_Handler();

	}
	
	public function get_scanner() {}
	public function get_int_rep() {}
	public function get_symb_tab() {}
	
	public function add_listener($listener) {
		
		$this->message_handler->add_listener($listener);
		
	}
	
	public function send_message() {
		
		$this->message_handler->send_message();
		
	}
	
	public function notify_listeners() {
		
		
		
	}
	
	public function parse() {
		//while (!feof($this->scanner->source->f_open)) {
		while (!(is_a($token = $this->scanner->make_token(), 'EOF_Token'))) {
		
			//
			
			echo "<br />Token Message: ";
			echo $token->get_message();
			echo "<br />";
			
			echo "<br /> Token Value: ";
			echo "<b>";
			echo $token->get_value();
			echo "</b>";
			echo "<br />";

			echo "<br />Token Column Number: ";
			echo $token->get_column_number();
			echo "<br />";

			echo "<br />Token Line Number: ";
			echo $token->get_line_number();
			echo "<br />";
			
			echo "<hr>";
			
		}
		
		
		

				
		
	}
	
}