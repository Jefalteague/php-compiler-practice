<?php

namespace Message;

class Parser_Listener {
	
	// properties
	
	public $message;
	public $token_array;
	
	// methods

	public function message_got($message, $token_array) {
		
		echo "<br />";
		echo "My_Language Output";
		echo "<hr>";
		
		echo "<br />";
		echo $message;
		echo "<br />";
		
		if(!($token_array === NULL)) {
			
			foreach($token_array as $token) {
				
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

	}
	
}