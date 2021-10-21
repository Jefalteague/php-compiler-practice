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

class Parser_Factory {
	
	/* methods */
	
	// determine which source, scanner, and parser should be created
	public function create_parser($language, $source, $config) {
		
		if($language == 'my_language') {
			
			if (is_file($source) && file_exists($source)) {
				
				//echo "this creates a file parser and scanner for My_Language<br />";
				
				$source = new File_Source($source, $config);
				
				$scanner = new My_Language_Scanner($source, $config);
				
				return new My_Language_Parser($scanner, $config);

			} else if(is_string($source)) { //more to do here, currently only supporting files due to recent changes/improvements
				
				echo "this creates a string parser and scanner for My_Language<br />";
			
				$source = new String_Source($source, $config);
				
				$scanner = new My_Language_Scanner($source, $config);
				
				return new My_Language_Parser($scanner, $config);
				
			} else {
			
				echo "something is wrong<br />";
			
			}
		} else {
			
			echo "<br />unsupported language<br />";
			
		}
	}
}