<?php

class Advance {
	
	private $source;
	
	private $f_open;
	
	private $current_char;
	
	private $current_pos = 0;
	
	private $line;
	
	private $f_open_counter = 0;
	
	public function __construct($source) {
		
		$this->source = $source;
		
		if (is_file($this->source)) {
			
			$this->f_open = fopen($this->source, "r");
			
		} else if(is_string($this->source)) {
			
			$this->f_open = explode("\r\n", $this->source);
			
		} else {
			
			echo "Error";
			
		}
		
		$this->get_next_line();
		
	}
	
	public function advance() {

		while($this->current_pos <= (strlen($this->line) -1) ) {
			
			$this->current_char = $this->current_char . $this->get_current_line()[$this->current_pos];
			
			++ $this->current_pos;
			
		}
		
		if (is_resource($this->f_open) && feof($this->f_open)) {
			
			//echo "<br /> EOF <br />";
			
			return;
			
		} else if (is_string($this->f_open)) {
			
			echo "<br /> EOS <br />";
			
		}
		
		$this->get_next_line();
		
		$this->current_pos = 0;

	}
	
	public function get_current_line() {
		
		return $this->line;
		
	}
	
	public function get_next_line() {
		
		if (is_resource($this->f_open)) {
			
			$this->line = fgets($this->f_open);
			
		} else if (is_array($this->f_open)) {
			
			if ($this->f_open_counter <= count($this->f_open) - 1) {
				
				$this->line = $this->f_open[$this->f_open_counter];
			
				++ $this->f_open_counter;
				
			}
			
		}
		
	}
	
	public function get_current_char() {
		
		return $this->current_char;
	}
	
}

$advance = new Advance(

'jeffrey.txt'

);

$line_1 = $advance->get_current_line();

echo "This is LINE 1..." . $line_1 . "<br />";

$forward = $advance->advance();

$current_char = $advance->get_current_char();

echo "This should be the same as LINE1 above..." . $current_char . "<br />";

$line_2 = $advance->get_current_line();

echo "This is LINE 2..." . $line_2 . "<br />";

$forward = $advance->advance();

$current_char = $advance->get_current_char();

echo "This should be LINE1 and LINE2 concatenated..." . $current_char . "<br />";

$line_3 = $advance->get_current_line();

echo "This is LINE 3..." . $line_3 . "<br />";

$forward = $advance->advance();

$current_char = $advance->get_current_char();

echo "This should be LINE1, LINE2, and LINE3 concatenated..." . $current_char . "<br />";

/*What to do when user requests functionality beyond length of source?
**Beginning to think I should split into separate string and file classes.

$line_4 = $advance->get_current_line();

echo "This is LINE 4..." . $line_4 . "<br />";

$forward = $advance->advance();

$current_char = $advance->get_current_char();

echo "This should be LINE1, LINE2, LINE3, and LINE_4 concatenated..." . $current_char . "<br />";
*/

/*
'hello there bob. 
how are you doing? 
I am fine.'
*/





