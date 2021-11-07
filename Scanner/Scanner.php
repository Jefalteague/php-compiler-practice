<?php

/*
** The abstract Scanner class
**
*/

namespace Scanner;

abstract class Scanner {
	
	/* properties */
	
	public $source;
	protected $current_char;
	protected $line;
	protected $token;
	
	/* methods */
	
	public function __construct() {}
	
	// look at the source
	
	public function get_source() {
		
		return $this->source;
		
	}
		
	// return the current char that is taken from the source
	public function get_current_char() {
		
		return $this->current_char;
		
	}

	public function get_source_current_char() {
		
		return $this->source->get_current_char();
		
	}
	
	/*
	** Helper methods that access the source
	** object methods to make it go
	*/
	
	// helper function make a char using source class
	public function select_char() {

		return $this->source->select_char();
		
	}
	
	// helper function make a line using source class
	public function make_line() {
		
		$this->line = $this->source->make_line();
		
	}
	
	public function make_char() {
		
		return $this->source->make_char();
		
	}
		
	/*
	** Helper function to use with identifier(), which uses make_char() and leaves the current_char and current_pos set
	** which is then overwritten by select_char() when called by next round of parser. set_back() allows the overwrite to
	** be done correctly, by setting current_pos and current_char one back. kind of hacky.
	*/
	
	public function set_back() {
		
		$this->current_char = $this->source->set_back();
		
	}
	
	
	// get the source string
	//abstract public function get_source();
	
}
