<?php

/*
** The Number Token class
**
**
*/

namespace Token;

class Number_Token2 extends My_Language_Token2 {

	// properties
	
	// methods
	
	public function __construct($source) {
		
		$this->source = $source;
		
		$this->line_number = $source->get_line_number() -1;
		
		$this->column_number =  $source->get_column_number() -1;
		
		$this->extract($source);
		
	}
	
	public function extract($source) {

		$value = '';
		
		while((ctype_digit($source->get_current_char())) && ($source->get_current_char() != $source->config['tokens']['EOL'])) {

			$value = $value . $source->get_current_char();

			$source->current_char = $source->make_char();

			if($source->get_current_char() == '.') {

				$value = $value . $source->get_current_char();

				$source->make_char();
	
				while((ctype_digit($source->get_current_char())) && ($source->get_current_char() != $source->config['tokens']['EOL'])) {

					$value = $value . $source->get_current_char();

					$source->make_char();

				}
				
				$this->source->set_back();
				
				$this->text = substr($value, 0, 1);
						
				$this->value = (float)$value;
				
				$this->type = 'FLOAT NUMBER';
				
				return;

			} 

		}
		
		$this->source->set_back();

		$this->text = substr($value, 0, 1);
		
		$this->value = (int)$value;
		
		$this->type = 'INTEGER NUMBER';

	}

}