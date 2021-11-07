<?php

/*
** The My_Language_Parser version of the parser
**
*/

namespace Parser;

use Error\My_Language_Error_Handler as My_Language_Error_Handler;
use Parser\Parser as Parser;
use Scanner\My_Language_Scanner as My_Language_Scanner;
// remove when solution found
// COMMENT OUT TO TEST...
//use Token\EOF_Token as EOF_Token;
use Token\EOL_Token as EOL_Token;
// add new tokens...
// UNCOMMENT OUT TO TEST...
 use Token\EOF_Token2 as EOF_Token2;
// use Token\EOL_Token2 as EOL_Token2;
use Message\Message_Handler as Message_Handler;
use Message\Message_Listener as Message_Listener;
use Message\Message as Message;
use Error\Custom_Exception as Custom_Exception;

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
	
	public function add_listener(Message_Listener $listener) {
		
		$this->message_handler->add_listener($listener);
		
	}
	
	
	// DESCRIPTION OF MOD: get rid of $token_array
	
	// COMMENT OUT TO TEST...
	//public function send_message($message, $token_array) {
		
		//$this->message_handler->send_message($message, $token_array);
		
	//}
	
	// UNCOMMENT OUT TO TEST...
	public function send_message($message) {
		
		$this->message_handler->send_message($message);
		
	}

	public function parse() {
			
		$token_array = array();
		
		// get rid of if the below works
		
		// COMMENT OUT TO TEST...
		$token = NULL;
		
		// DESCRIPTION OF MOD: simplify and change to EOF_Token2
		
		// UNCOMMENT OUT TO TEST...
		// while (!(is_a($token = $this->scanner->make_token(), 'Token\EOF_Token2'))) {$token_array[] = $token;}
		
		// COMMENT OUT TO TEST...
		while (!(is_a($token, 'Token\EOF_Token2'))) {
	
			$token = $this->scanner->make_token();
			
			// DESCRIPTION OF MOD: create $data to add as argument to Message __construct
			// $data will contain the token's data to be delivered to the listener
			// the listener will loop through and echo out all the data.
			
			// UNCOMMENT OUT TO TEST...
			array_push($token_array, ['text' => $token->get_text(), 'type' => $token->get_type(), 'value' => $token->get_value(), 
			'line_number' => $token->get_line_number(), 'column_number' => $token->get_column_number()]);
			
			// COMMENT OUT TO TEST...
			//$token_array[] = $token;
			
			if($token->get_type() == 'ERROR') {
				
				try {
					
					if($token != NULL) {
						
						$type = $token->type;
						$file = $token->source->file;
						$value = $token->value;
						$line_number = $token->line_number;
						$column_number = $token->column_number;
						
						throw new Custom_Exception($type, $file, $value, $line_number, $column_number);
					
					}
				
				}
				
				catch (Custom_Exception $e) {
				
					echo $e->errorMessage();
					
					die;
				
				}
				
			}
			
		}
		
		// create verbose config to turn on and off message sending
		
		if($this->config['messaging'] == TRUE) {
			
			// when php enums are available Nov 25th, switch to that approach, rather than the config associative array
			
			// need to figure out the error stuff...
			
			
			
			// DESCRIPTION OF MOD: change 'PARSER_SUMMARY' to 'TOKEN'
			// PARSER_SUMMARY will be reserved for parser stats, rather than token stats
			
			// UNCOMMENT OUT TO TEST...
			if(in_array('TOKEN', $this->config['message_type'])) {$type = 'TOKEN';}
			
			// COMMENT OUT TO TEST...
			//if(in_array('PARSER_SUMMARY', $this->config['message_type'])) {
				
			//	$type = 'PARSER_SUMMARY';
				
			//}
			
			// DESCRIPTION OF MOD: add $data to message as parameter
			// update all necessary Message and Listener system components
			
			// UNCOMMENT OUT TO TEST...
			$message = New Message($type, $token_array);
			
			// COMMENT OUT TO TEST...
			//$message = new Message($type);
			
			// DESCRIPTION OF MOD: change $token_array argument to $data argument
			// see above for description
			
			// UNCOMMENT OUT TO TEST...
			$this->send_message($message);
			
			// COMMENT OUT TO TEST...
			// $this->send_message($message, $token_array);
			
		}

	}
	
public function program() {}
	
}