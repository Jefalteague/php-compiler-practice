<?php

/*
** The factory to select which scanner, etc. to use
**
*/

namespace Factory;

use Scanner\My_Language_Scanner as My_Language_Scanner;
use Source\File_Source as File_Source;
use Source\String_Source as String_Source;

include('Scanner/My_Language_Scanner.php');
include('Source/File_Source.php');
include('Source/String_Source.php');

class Scanner_Factory {
	
	/* methods */
	
	// determine which scanner should be created, 
	public function create_scanner($language, $source, $config) {
		
		if($language == 'my_language' && is_file($source) && file_exists($source)) {
			
			echo "this is in the file block<br />";
			
			$source = new File_Source($source, $config);
			return new My_Language_Scanner($source);
			
		}else if($language == 'my_language' && is_string($source)) {
			
			echo "this is in the string block<br />";
			$source = new String_Source($source, $config);
			return new My_Language_Scanner($source);
			
		}else {
			
			echo "something is wrong<br />";
			
		}
		
	}
	
}
