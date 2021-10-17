<?php

/*
** Class which extends the basic source class.
** Provides specific functionality for string input.
*/

namespace Source;

use Source\Source as Source;

include('Source/Source.php');

class File_Source extends Source {
	
	/* properties */
	
	protected $source;
	
	protected $f_open;
	
	protected $current_char;
	
	protected $current_pos;
	
	protected $line;
	
	protected $line_number;
	
	public $config;
	
	/* methods */
	
	public function __construct($file, $config) {
		
		$this->current_pos = -2;
		$this->line_number = 0;
		$this->config = $config;

		if(file_exists($file)) {
					
			$this->source = $file;
		
			$this->f_open = fopen($file, 'r');
			
		} else {
			
			echo "hell no";
			
		}
		
	}
	
	// return the source string
	public function get_source() {
		
		return $this->source;
		
	}
	
	public function get_resource() {
		
		return $this->f_open;
		
	}
	
	// look at the current line number
	public function get_line_number() {
		
		return $this->line_number;
		
	}
		
	public function make_line() {
		
		$this->line = fgets($this->f_open);

		$this->current_pos = -1;

		if($this->line != FALSE) {

			++ $this->line_number;

		}
		
	}

	public function get_current_line() {
		
		if($this->line == FALSE) {
			
			return "FALSE";
			
		}
		
		return $this->line;
		
	}

	// update the current_char depending on certain contexts
	// much of this based on the book, i might try to figure out
	// a personalized approach later, for now, just practice
	public function select_char() {

		// first time in
		if($this->current_pos == -2) {

			$this->make_line();

			return $this->make_char();

		// EOF	
		} else if($this->line == FALSE){

			if(feof($this->f_open)) {
				
				fclose($this->f_open);
				
			} else {
				
				echo "gonna have to fix this";
				
			}
			
			return $this->config['EOF'];
			
		// EOL		
		} else if(($this->current_pos == -1) || ($this->current_pos == strlen($this->line))) {

			$this->current_pos = $this->current_pos + 1;
			
			return $config['EOL'];
			
		// read new line
		} else if($this->current_pos > strlen($this->line)) {

			$this->make_line();

			return $this->make_char();
		
		// return char at current position
		} else {

			$this->current_char = $this->line[$this->current_pos];

			$this->current_pos = $this->current_pos + 1;
	
			return $this->current_char;
			
		}
		
	}
	
	public function make_char() {
		
		++ $this->current_pos;

		return $this->select_char();
		
	}
	
	public function get_current_char() {
		
		return $this->current_char;
		
	}
	
}