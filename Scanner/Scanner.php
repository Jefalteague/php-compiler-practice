<?php

/*
** The abstract Scanner class
**
*/

namespace Scanner;

abstract class Scanner {
	
	/*Properties
	**
	**
	*/

	public $source;
	protected $current_char;
	protected $line;
	protected $token;
	
	/*Methods
	**
	**
	*/
		
	/**
	 * Method __construct
	 *
	 * @return void
	 */
	public function __construct() {}
		
	/**
	 * Method get_source
	 *
	 * @return void
	 */
	public function get_source() {
		
		return $this->source;
		
	}
			
	/**
	 * Method get_current_char
	 *
	 * @return void
	 */
	public function get_current_char() {
		
		return $this->current_char;
		
	}
	
	/**
	 * Method get_source_current_char
	 *
	 * @return void
	 */
	public function get_source_current_char() {
		
		return $this->source->get_current_char();
		
	}
		
	/**
	 * Method select_char
	 *
	 * @return void
	 */
	public function select_char() {

		return $this->source->select_char();
		
	}
	
	/**
	 * Method make_line
	 *
	 * @return void
	 */
	public function make_line() {
		
		$this->line = $this->source->make_line();
		
	}
		
	/**
	 * Method make_char
	 *
	 * @return void
	 */
	public function make_char() {
		
		return $this->source->make_char();
		
	}

	/**
	 * Method set_back
	 *
	 * @return void
	 */
	public function set_back() {
		
		$this->current_char = $this->source->set_back();
		
	}

}
