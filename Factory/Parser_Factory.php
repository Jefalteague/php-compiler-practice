<?php

/*
** The Parser Factory class to determine which parser to use
**
*/

namespace Factory;

use Parser\My_Language_Parser as My_Language_Parser;
use Scanner\My_Language_Scanner as My_Language_Scanner;
use Message\Message_Handler as Message_Handler;
use Source\File_Source as File_Source;
use Source\String_Source as String_Source;

/**
 * Parser_Factory
 * The particular parser is to be determined by configuration and the logic which follows 
 */

class Parser_Factory {

	/* Properties
	**
	*/
	
	/* Methods 
	**
	*/
	
	// Determine which source, scanner, and parser should be created
	public function create_parser($language, $source, $config) {
		
		// My_Langugage implementations
		if($language == 'My_Language') {
			
			// File source logic
			if (is_file($source) && file_exists($source)) {
				
				// Create a file source object
				$source = new File_Source($source, $config);
				
				// Create a my_language_scanner object
				$scanner = new My_Language_Scanner($source, $config);

				$message_handler = new Message_Handler();
				
				// Create a my_language_parser object, pass in the file source object and the my_language_scanner object and return
				return new My_Language_Parser($scanner, $message_handler, $config);
				
			// string source
			} else if(is_string($source)) { //more to do here, currently only supporting files due to recent changes/improvements
				
				echo "this will create a string parser and scanner for My_Language<br />";
			
				$source = new String_Source($source, $config);
				
				$scanner = new My_Language_Scanner($source, $config);
				
				return new My_Language_Parser($scanner, $config);
				
			} else {
			
				echo "something is wrong<br />";
			
			}
		// other language implementations not yet supported
		} else {
			
			echo "<br />unsupported language<br />";
			die;
			
		}
	}
}