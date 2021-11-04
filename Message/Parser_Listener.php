<?php

namespace Message;

use Message\Message_Listener as Message_Listener;

class Parser_Listener implements Message_Listener{
	
	// properties
	
	public $message;
	public $token_array = [];
	
	// methods

	public function message_got($message, $token_array) {
		
		$this->message = $message;
		$this->token_array = $token_array;
		
		echo "<br />";
		echo "My_Language Output";
		echo "<hr>";
		
		echo "<br />";
		echo $message->get_message_type();
		echo "<br />";
		
		$type = $message->get_message_type();
		
		switch($type) {
			
			case 'PARSER_SUMMARY':
			
				if(!($token_array === NULL)) {
				
					foreach($this->token_array as $token) {
						
						echo "<i>";
						echo "<br />Token Message: ";
						echo "</i>";
						echo $token->message;
						echo "<br />";
						
						echo "<i>";
						echo "<br /> Token Value: ";
						echo "</i>";
						echo "<b>";
						echo $token->value;
						echo "</b>";
						echo "<br />";

						echo "<i>";
						echo "<br />Token Column Number: ";
						echo "</i>";
						echo $token->column_number;
						echo "<br />";

						echo "<i>";
						echo "<br />Token Line Number: ";
						echo "</i>";
						echo $token->line_number;
						echo "<br />";
						
						echo "<hr style='width:50%;text-align:left;margin-left:0'>";
						
					}

				}
				
				break;
			
			case 'SYNTAX_ERROR':
			
				echo 'There is a syntax error somewherror.';
				
				break;
				
			case 'default':
			
				echo 'default';
				
				break;
			
		}

	}
	
}