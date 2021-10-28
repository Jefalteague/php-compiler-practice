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
	public $config;
	
	public function __construct(My_Language_Scanner $scanner, $config) {
		
		$this->scanner = $scanner;
		$this->message_handler = new Message_Handler();
		$this->config = $config;

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

	public function parse() {
			
		$token_array = array();
		
		$token = NULL;
		
		while (!(is_a($token, 'Token\EOF_Token'))) {
	
			$token = $this->scanner->make_token();

			$token_array[] = $token;
			
		}
		
		// create verbose config to turn on and off message sending
		
		if($this->config['messaging'] == TRUE) {
			
			$this->message_handler->send_message($message = 'VOICY MODE', $token_array = $token_array);
			
		} else {
			
			$this->message_handler->send_message($message = "QUIET MODE");
			
		}

	}
	
}