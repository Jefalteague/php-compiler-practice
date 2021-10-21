<?php

/*
** Class which extends the basic source class.
** Provides specific functionality for string input.
*/

namespace Source;

use Source\Source as Source;

class File_Source extends Source {
	
	/* properties */
		
	public $f_open;
	
	protected $current_char;
	
	protected $current_pos;
	
	protected $line;
	
	protected $line_number;
	
	public $config;
	
	protected $file;
	
	/* methods */
	
	public function __construct($file, $config) {
		
		$this->current_pos = -2;
		$this->line_number = 0;
		$this->config = $config;
		$this->file = $file;

		if(file_exists($file)) {
					
			$this->source = $file;
		
			$this->f_open = fopen($file, 'r');
			
		} else {
			
			echo "hell no";
			
		}
		
	}

	public function get_resource() {
		
		return $this->f_open;
		
	}
	

	public function get_line_number() { // look at the current line number
		
		return $this->line_number;
		
	}
		
	public function make_line() {
	
		$this->line = fgets($this->f_open);
		
		// problem: if i do right trim, i can't read following lines
		// problem: if i dont right trim, i get extra white spaces at end of line
		// problem: if i use white space function, i don't get EOL token returned
		//$this->line = rtrim($this->line, "\n\r"); //have to move this somewhere else?

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
	
	public function skip_white_space() {
		
		//$this->current_pos = $this->current_pos ++;
		$this->select_char();
		
	}
	
	public function skip_comment() {
		
		
		
	}

	// update the current_char depending on certain contexts
	// much of this based on the book, i might try to figure out
	// a personalized approach later, for now, just practice

	public function select_char() {
		
		if ($this->f_open) {
				
			if($this->current_pos == -2) { // first time in

				$this->make_line();

				return $this->make_char();

			} else if($this->line == FALSE){ // EOF	

				if (feof($this->f_open)){
					
					fclose($this->f_open);
					
				}
				
				return $this->config['tokens']['EOF'];
				
			// EOL		
			} else if(($this->current_pos == -1) || ($this->current_pos == strlen($this->line))) {
				//echo strlen($this->line);
				
				// does this fix it?
				$this->current_pos = $this->current_pos + 1;
		
				return $this->config['tokens']['EOL'];
				
			// read new line
			} else if($this->current_pos > strlen($this->line)) {

				$this->make_line();

				return $this->make_char();

			// return char at current position
			} else {

				$this->current_char = $this->line[$this->current_pos];
				
				//echo $this->current_char;
				
				$this->current_pos = $this->current_pos + 1; //
				
				
				// skip white spaces
				if (ctype_space($this->current_char)) {
					
					while(ctype_space($this->current_char)) {
						
						$this->skip_white_space();
					
					}
					
					//while ($this->current_char = '{') {}
					
					
				}
				
				return $this->current_char;
				
			}
			
		} else {echo 'help';}
		
	}
	
	public function make_char() {
		
		++ $this->current_pos;

		return $this->select_char();
		
	}
	
	public function get_current_char() {
		
		return $this->current_char;
		
	}
	
	public function get_column_number() {
		
		return $this->current_pos;
		
	} 
	
}