<?php 

/*
** The abstract class for Tokens
**
*/

namespace Token;

abstract class Token {
	
	public $message;
	
	public function __construct($message = '') {
		
		$this->message = $message;
		
	}
	
	public function get_type() {
		
		return $this->type;
		
	}
	
	public function get_message() {
		
		return $this->message;
		
	}
}