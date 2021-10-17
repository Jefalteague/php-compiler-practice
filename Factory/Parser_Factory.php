<?php

/*
** The Parser Factory class to determine which parser to use
**
*/

namespace Factory;

use Parser\My_Language_Parser as My_Language_Parser;
use Scanner\My_Language_Scanner as My_Language_Scanner;
use Source\File_Source as File_Source;
use Source\String_Source as String_Source;

require_once('Parser/My_Language_Parser.php');
require_once('Scanner/My_Language_Scanner.php');
require_once('Source/File_Source.php');
require_once('Source/String_Source.php');

class Parser_Factory {
	
	/* methods */
	
	// determine which source, scanner, and parser should be created
	public function create_parser($language, $source, $config) {
		
		if($language == 'my_language') {
			
			if (is_file($source)) {
				
				echo "this creates a file parser and scanner for My_Language<br />";
				
				$source = new File_Source($source, $config);
				
				$scanner = new My_Language_Scanner($source);
				
				return new My_Language_Parser($scanner);

			} else if(is_string($source)) {
				
				echo "this creates a string parser and scanner for My_Language<br />";
			
				$source = new String_Source($source, $config);
				
				$scanner = new My_Language_Scanner($source);
				
				return new My_Language_Parser($scanner);
				
			} else {
			
				echo "something is wrong<br />";
			
			}
		} else {
			
			echo "<br />unsupported language<br />";
			
		}
	}
}