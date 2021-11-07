<?php

/*
** The EOL Token
**
**
*/

namespace Token;

class EOL_Token2 extends My_Language_Token2 {

	// properties
	
	// methods
	
	public function __construct($source) {
		
		$this->source = $source;
		
		$this->line_number = $source->get_line_number() -1;
		
		$this->column_number = $source->get_column_number() -1;

		$this->extract($source);
		
	}
	
	public function extract($source) {
		
		$this->value = 'EOL';
		
		$this->type = 'EOL';
		
	}
}