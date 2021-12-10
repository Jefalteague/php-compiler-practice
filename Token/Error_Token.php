<?php

/*
** The Error_Token class.
** Scanner returns upon scanner error, such as finding an invalid character.
**
*/

namespace Token;

use Token\My_Language_Token2 as My_Language_Token2;

class Error_Token extends My_Language_Token2 {

	// properties

	public $source;
	public $line_number;
	public $column_number;
	public $text;
	public $type;
	public $value;
	public $choke;
	
	// methods
	
	public function __construct($source) {
		
		$this->source = $source;
		
		$this->line_number = $source->get_line_number()-1;
		
		$this->column_number = $source->get_column_number()-1;
		
		$this->extract($source);
		
	}
	
	public function extract($source) {
		
		$this->text = $this->get_current_char();
		
		$this->type = 'ERROR';
		
		$this->value = 'SYNTAX_ERROR';

		$this->choke = 'Invalid Character';

	}

}