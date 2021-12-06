<?php

/*
** The Special Symbol Token class.
**
**
*/

namespace Token;

use Token\My_Language_Token2 as My_Language_Token2;

class Special_Symbol_Token2 extends My_Language_Token2 {

	// properties
	
	// methods
	
	public function __construct($source) {
	
		$this->source = $source;
		
		$this->line_number = $source->get_line_number() -1;
		
		$this->column_number = $source->get_column_number() -1;
		
		$this->extract($source);
	
	}
	/*
	public function extract($source) {
		
		$value = '';
		
		if(array_search($source->get_current_char() . $source->peek_char(), $source->config['tokens'])) {

			$source->get_current_char() . $source->peek_char();

			$value = $source->get_current_char() . $source->peek_char();
			
			$source->make_char();
			
		} else {

			$value = $source->get_current_char();
			
		}
		
		$this->value = $value;
		
		$this->text = substr($value, 0 ,1);
		
		$this->type = 'SPECIAL_SYMBOL';

	}*/
	
		public function extract($source) {
		
		$value = '';
		
		if(array_search($source->get_current_char(), $source->config['single-char-tokens'])) {
			
			$value = $value . $source->get_current_char();
			
			//$source->make_char();
			
		} else if($source->get_current_char() == ':') {
			
			$value = $value . $source->get_current_char();

			$source->make_char();
			
			if($source->get_current_char() == '=') {
				
				$value = $value . $source->get_current_char();
			}
			
		}
		
		$this->value = $value;
		
		$this->text = substr($value, 0 ,1);
		
		$this->type = 'SPECIAL_SYMBOL';

	}

}