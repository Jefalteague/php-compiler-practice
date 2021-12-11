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
	
	public function __construct($scanner, $message_handler, $config) {
		
		parent::__construct($scanner, $message_handler, $config);

	}

	public function parse() {
			
		$token_array = array();
		$error_array = array();

		$token = NULL;

		while (!(is_a($token, 'Token\EOF_Token2'))) {
	
			$token = $this->make_token();

			// add non-error tokens to the token_array, which will be used to message out
			if($token->get_type() != 'ERROR') {

				array_push($token_array, [

					'text' => $token->get_text(),
					'type' => $token->get_type(),
					'value' => $token->get_value(), 
					'line_number' => $token->get_line_number(),
					'column_number' => $token->get_column_number(),
	
				]);

			// add any error tokens to the error_array, which will be used to message out
			} else {
		
				array_push($error_array, [

					'type' => $token->type,
					'file' => $token->source->file,
					'value' => $token->value,
					'line_number' => $token->line_number,
					'column_number' => $token->column_number,
					'choke' => $token->choke,
				
				]);

			}
			
		}
		
		// verbose config to turn on and off message sending
		if($this->config['messaging'] == TRUE) {
			
			// handle the errors
			if(!(empty($error_array))) {

				//to be developed as permanent error handling solution
				$errors = new My_Language_Error_Handler('ERROR', $error_array, $this);
				
				$errors->flag('ERROR', $error_array, $this);
				
			// if no errors, then display the token information	
			} else {

				// when php enums are available Nov 25th, switch to that approach, rather than the config associative array
				if(in_array('TOKEN', $this->config['message_type'])) {$type = 'TOKEN';}

				$message = New Message($type, $token_array);

				$this->send_message($message);

			}
			
		}

	}
	
}