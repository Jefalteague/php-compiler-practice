<?php 

/*
** The abstract class for Tokens
**
*/

namespace Token;


abstract class Token {
	
	// properties
	
	public $message; // the message passed in
	public $type; // the token's type
	public $value; // the token's value
	public $source; // the source object
	public $line_number; // the token's line number
	public $column_number; // the token's position in the line
	
	// methods
	
	public function __construct($message = '', $value, $source) {
		
		$this->message = $message;
		$this->value =  $value;
		$this->source = $source;
		$this->line_number = $source->get_line_number() -1;
		$this->column_number = $source->get_column_number() -1;
		
	}
	
	public function get_message() {
	
		return $this->message;

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