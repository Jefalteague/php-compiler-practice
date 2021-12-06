<?php

/*
** Class which extends the basic source class.
** Provides specific functionality for file input.
*/

namespace Source;

use Source\Source as Source;

class File_Source extends Source {
	
	/* properties */
		
	protected $f_open;
	
	public $current_char;
	
	public $current_pos;
	
	public $line;
	
	public $line_number;
	
	public $config;
	
	public $file;
	
	/* methods */
	
	
	/*
	** Constructor
	**
	*/
	
	public function __construct($file, $config) {
		
		$this->current_pos = -2;
		
		$this->line_number = 0;
		
		$this->config = $config;
		
		$this->file = $file;

		if(file_exists($file)) {
					
			$this->source = $file;
		
			$this->f_open = fopen($file, 'r');
			
		}
		
	}
	
	/*
	** Method to rollback the current pos and current char to account for trip into select_char() from skip_white_space().
	** Helper function to use with identifier(), which uses make_char() and leaves the current_char and current_pos set
	** which is then overwritten by select_char() when called by next round of parser. set_back() allows the overwrite to
	** be done correctly, by setting current_pos and current_char one back.
	**
	** Use with scanner's identiier() method
	**
	** Might need to work with lines?
	**
	** @return string current_char
	*/
	
	public function set_back() {
		
		$this->current_pos = $this->current_pos - 1;

		$this->current_char = $this->line[$this->current_pos -1];
		
		return $this->current_char;
		
	}

	/*
	** Method to return the opened file.
	**
	** @return
	*/
	
	public function get_resource() {
		
		return $this->f_open;
		
	}
	
	/*
	** Method to return the current line number.
	**
	** @return int
	*/
	
	public function get_line_number() { // look at the current line number
		
		return $this->line_number;
		
	}
	
	/*
	** Method to read and return the next line from the open file.
	** Increments current pos. Increments line number on success.
	**
	*/

	public function make_line() {
	
		$this->line = fgets($this->f_open);
		
		// NOTE: including the following prevents the parser from reading the next line
		// of code after a blank line
		// $this->line = rtrim($this->line, "\n\r");

		// 11/10 move the following to the if statement
		
		// COMMENT OUT TO TEST...
		// $this->current_pos = -1;

		if($this->line != FALSE) {
			
			$this->current_pos = -1;
			
			++ $this->line_number;

		}
		
	}

	/*
	** Method to return the current line.
	**
	** @return string
	*/
	
	public function get_current_line() {
		
		if($this->line == FALSE) {
			
			return "FALSE";
			
		}
		
		return $this->line;
		
	}

	/* 
	** Method to return the current_char, depending on certain contexts.
	** 
	** @return string
	*/

	public function select_char() {
		
		if($this->current_pos == -2) { // first time in

			$this->make_line();
			
			$this->current_pos = $this->current_pos + 1;

			return $this->make_char();

		} else if($this->line == FALSE) { // EOF	

			if(is_resource($this->f_open)) {
				
				if(feof($this->f_open)) {
					
					fclose($this->f_open);
					
				}
				
			} // else error?

			return $this->config['tokens']['EOF'];
			
		// EOL		
		} else if(($this->current_pos == -1) || ($this->current_pos == strlen($this->line))) {

			$this->current_pos = $this->current_pos + 1;
			
			return $this->config['tokens']['EOL'];

		// read new line
		} else if($this->current_pos > strlen($this->line)) {

			$this->make_line();
			
			// 11/09 added
			// UNCOMMENT OUT TO TEST...
			$this->current_pos = $this->current_pos + 1;

			return $this->make_char();

		// return char at current position
		} else {

			$this->current_char = $this->line[$this->current_pos];
			
			$this->current_pos = $this->current_pos + 1;
				
			return $this->current_char;
	
		}
		
	}
	
	public function make_char() {

		return $this->select_char();
		
	}
	
	public function peek_char() {
		
		$peek_pos = $this->current_pos;
		
		$peek_char = $this->line[$peek_pos];
		
		return $peek_char;
		
	}
	
	public function get_current_char() {
		
		return $this->current_char;
		
	}
	
	public function get_column_number() {
		
		return $this->current_pos;
		
	} 
	
}