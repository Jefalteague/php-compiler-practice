<?php

namespace Message;

use Message\Message_Listener as Message_Listener;

class Parser_Listener implements Message_Listener {
	
	// properties
	
	public $message;
	public $token_array = [];

	// methods
	
	// DESCRIPTION OF MOD: extensive rewrite to handle new messages
	// COMMENT OUT TO TEST...
	/*
	public function message_got($message, $token_array) {
		
		$this->message = $message;
		$this->token_array = $token_array;
		
		echo "<br />";
		echo "My_Language Output";
		echo "<hr>";
		
		echo "<br />";
		echo $this->message->get_message_type();
		echo "<br />";
		
		$type = $this->message->get_message_type();
		
		switch($type) {
			
			case 'PARSER_SUMMARY':
			
				if(!($this->token_array === NULL)) {
				
					foreach($this->token_array as $token) {
						
						echo "<i>";
						echo "<br />Token Text: ";
						echo "</i>";
						// the cause of the message being incorrect is that the other tokens are still the old approah of the scanner holding all the logic, rather than the tokens
						echo $token->message;
						echo "<br />";
						
						echo "<i>";
						echo "<br /> Token Value: ";
						echo "</i>";
						echo "<b>";
						// the cause of the message being incorrect is that the other tokens are still the old approah of the scanner holding all the logic, rather than the tokens
						echo $token->get_value();	
						echo "</b>";
						echo "<br />";

						echo "<i>";
						echo "<br />Token Column Number: ";
						echo "</i>";
						// the cause of the message being incorrect is that the other tokens are still the old approah of the scanner holding all the logic, rather than the tokens
						echo $token->column_number;
						echo "<br />";

						echo "<i>";
						echo "<br />Token Line Number: ";
						echo "</i>";
						// the cause of the message being incorrect is that the other tokens are still the old approah of the scanner holding all the logic, rather than the tokens
						echo $token->line_number;
						echo "<br />";
						
						echo "<hr style='width:50%;text-align:left;margin-left:0'>";
				
					}

				}
				
				break;
			
			case 'SYNTAX_ERROR':
			
				echo 'There is a syntax error somewherror.';
				
				break;
				
			case 'TOKEN':
			
				echo 'Token';
			
				break;
				
			case 'default':
			
				echo 'Default';
				
				break;
			
		}

	}
	*/
	
	// rewritten function to handle new messages
	// UNCOMMENT OUT TO TEST...
	public function message_got($message) {
		
		$this->message = $message;

		$type = $this->message->get_message_type();
		
		if(!($this->token_array === NULL)) { // check to make certain the data is there	
		
			switch($type) {

				case 'TOKEN': // if token type is not ERROR
			
					// formatted message
					echo "<br />";
					echo "My_Language Output";
					echo "<hr style='width:50%;text-align:left;margin-left:0'>"; // echo styled line
					
					echo "<br />";
					echo $type;
					echo "<br />";
					
					foreach($this->message->get_data() as $data) { // loop through the array of arrays
					
						foreach($data as $key => $datum) { // loop through the second level of arrays, $x is the key
							
							echo "<i>"; // echo block starts
							echo "<br />Token " . $key . ": "; // echo key value
							echo "</i>";
							echo $datum; // echo data value
							echo "<br />"; // echo block ends
							
						}
					
						echo "<hr style='width:50%;text-align:left;margin-left:0'>"; // echo styled line
					
					}

					break;
				
				case 'ERROR': // if token type is ERROR
					
					// formatted message
					echo "<br />";
					echo "My_Language Errors";
					echo "<hr style='width:50%;text-align:left;margin-left:0'>"; // echo styled line
					
					echo "<br />";
					echo $type;
					echo "<br />";

					foreach($this->message->get_data() as $data) { // loop through the array of arrays
						
						foreach($data as $key => $datum) { // loop through the second level of arrays, $x is the key
							
							echo "<i>"; // echo block starts
							echo "<br />Token " . $key . ": "; // echo key value
							echo "</i>";
							echo $datum; // echo data value
							echo "<br />"; // echo block ends
							
						}
					
						echo "<hr style='width:50%;text-align:left;margin-left:0'>"; // echo styled line
					
					}

					break;
				break;
					
				case 'PARSER_SUMMARY':
				
					echo 'Parser Summary';
				
					break;
					
				case 'default':
				
					echo 'Default';
					
					break;
			}
			
		} else { echo 'Need data';}// if the data isn't there?

	}
	
}