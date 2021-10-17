<?php

namespace Source;

use Source\Source as Source;

require_once('Source/Source.php');

class String_source extends Source {
	
	/* properties*/
	
	protected $f_open;
	
	protected $current_char;
	
	protected $current_pos;
	
	protected $line;
	
	protected $line_number;
	
	/*methods*/
	
	public function __construct($text) {
		
		$this->source = $text;
		
		if($this->source) {
			
			$this->f_open = explode("\r\n", $this->source);
			
		} else {
			
			echo "hell no";
			
		}
		
	}

	public function make_line() {
		
		if ($this->line_number <= count($this->f_open) - 1) {
				
			$this->line = $this->f_open[$this->line_number];
			
			++ $this->line_number;
				
		}
		
	}
		
	public function get_current_line() {
		
		return $this->line;
		
	}
	
	public function make_char() {
		
		$this->current_char = $this->get_current_line()[$this->current_pos];
			
		++ $this->current_pos;
		
	}
	
	public function get_current_char() {
		
		return $this->current_char;
		
	}
	
}
