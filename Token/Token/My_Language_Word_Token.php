<?php

namespace Token\Token;

use Token\Pascal_Token_Type as Pascal_Token_Type;

class My_Language_Word_Token extends My_Language_Token {

	/*Properties
	**
	**
	*/

	/*Methods
	**
	**
	*/
/*
	public function __construct($source) {
		
		$this->source = $source;
		
		$this->line_number = $this->source->get_line_number() -1;
		
		$this->column_number = $this->source->get_column_number() -1;
		
		$this->extract($source);
	
	}
	*/
	public function extract($source) {

		$value = '';

		while(ctype_alpha($source->get_current_char()) && ($source->get_current_char() != $source->config['tokens']['EOL'])) {
			
			$value = $value . $source->get_current_char();
			
			$source->current_char = $this->make_char();

		}

		$enum = Pascal_Token_Type::tryFrom($value);

		if(($enum != NULL) && ($enum->reserved_words())) {

		//if((isset($this->source->config['reserved-word-tokens'][strtolower($value)])) || isset($this->source->config['reserved-word-tokens'][strtoupper($value)])) {
			
			$this->source->set_back();
			
			$this->text = substr($value, 0, 1);

			$this->value = $value;

			$this->type = Pascal_Token_Type::tryFrom($value);

			$this->type_value = $value;

			//var_dump($this->type_value);

		} else {
			
			$this->source->set_back();
			
			$this->text = substr($value, 0, 1);
			
			$this->value = $value;
			
			$this->type = 'IDENTIFIER';

			$this->type_value = 'IDENTIFIER';
			
		}
		
	}

}
