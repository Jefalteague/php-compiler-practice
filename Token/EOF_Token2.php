<?php

/*
** The EOF token class to return to the parser
**
*/

namespace Token;

use Token\My_Language_Token2 as My_Language_Token2;
use Source as Source;

class EOF_Token2 extends My_Language_Token2 {
	
	// properties

	// methods
	
	public function __construct($source) {
		
		$this->source = $source;
		
		$this->line_number = $source->get_line_number()-1;
		
		$this->column_number = $source->get_column_number()-1;
		
		$this->extract($source);
		
	}
	
	public function extract($source) {
		
		$this->value = 'EOF';
		
		$this->type = 'EOF';
		
	}

}