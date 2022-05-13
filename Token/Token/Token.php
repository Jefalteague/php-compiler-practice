<?php

namespace Token\Token;

class Token {

	/*Properties
	**
	**
	*/

	public $text; // the char associated with the token
	public $type; // the token's type
	public $value; // the token's value
	public $source; // the source object
	public $line_number; // the token's line number
	public $column_number; // the token's position in the line

	/*Methods
	**
	**
	*/

	public function __construct($source) {

		$this->source = $source;

		$this->line_number = $source->get_line_number() -1;

		$this->column_number = $source->get_column_number() -1;
		
		$this->extract($source);
		
	}

	protected function extract($source) {

		$this->text = $this->current_char();
		
		$this->value = NULL;

		$this->make_char();

	}
	
	protected function get_current_char() {
		
		return $this->source->get_current_char();
		
	}
	
	protected function select_char() {
		
		return $this->source->select_char();
		
	}
	
	protected function make_char() {
		
		return $this->source->make_char();
		
	}

	protected function peek_char() {
		
		return $this->source->peek_char();
		
	}
	
		
	public function get_message() {
	
		return $this->message;

	}
	
	public function get_text() {
		
		return $this->text;
		
	}
	
	public function get_type() {
		
		return $this->type;	
		
	}
	
	public function get_value() {
	
		return $this->value;

	}
	
	public function get_source() {
	
		return $this->source;

	}
	
	public function get_line_number() {

		return $this->line_number;

	}
	
	public function get_column_number() {
	
		return $this->column_number;

	}

}
