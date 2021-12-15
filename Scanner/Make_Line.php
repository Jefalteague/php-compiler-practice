<?php

namespace Scanner;

/**
 * Make_Line
 */
class Make_Line {
	
	// properties
	
	public $file;
	public $f_open = NULL;
	public $line;
	public $line_number = -1;
	
	// methods
	
	public function __construct($file) {
		
		if(is_file($file)) {
			
			$this->file = $file;
		
		} else {
			
			echo "EXCEPTION: file required";
			
		}
		
	}
	
	public function make_line() {
	
		if(!(is_resource($this->f_open))) {
		
			$this->f_open = fopen($this->file, "r");
		
		}
	
		$this->line = rtrim(fgets($this->f_open), "\n\r");
		$this->line_number = $this->line_number + 1;

		if(feof($this->f_open)) {
			
			fclose($this->f_open);
			
			//echo "<br />";
			//echo "EOF";
			//echo "<br />";
			
		}
		
		return $this->line;
	
	}
	
}
