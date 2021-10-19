<?php

/* A specific implementation of
** the Scanner class. For my tinkering.
*/

namespace Scanner;

use Scanner\Scanner as Scanner;
use Source\Source as Source;
use Token\Gen_Token as Gen_Token;
use Token\EOF_Token as EOF_Token;
use Token\Char_Token as Char_Token;

include('Scanner/Scanner.php');
include('Token/Gen_Token.php');
include('Token/EOF_Token.php');
require_once('Token/Char_Token.php');

class My_Language_Scanner extends Scanner{

	protected $source;
	protected $current_char;
	protected $line;
	private $token;
	
	public function __construct(Source $source) {
		
		$this->source = $source;

	}
	
	public function get_source() {
		
		return $this->source;
		
	}
		
	// return the current char that is taken from the source
	public function get_current_char() {
		
		return $this->current_char;
		
	}
	
	/*
	** Helper methods that access the source
	** object methods to make it go
	*/
	
	// helper function make a char using source class
	public function select_char() {

		$this->current_char = $this->source->select_char();
		
		return $this->current_char;
		
	}
	
	// helper function make a line using source class
	public function make_line() {
		
		$this->line = $this->source->make_line();
		
	}
	
	// look at the opened file
	public function get_resource() {
		
		return $this->source->get_resource();
		
	}
	
	// look at the current line number
	public function get_line_number() {
		
		return $this->source->get_line_number();
		
	}

	public function make_token() {

		$this->current_char = $this->select_char();

		if ($this->current_char == $this->source->config['tokens']['EOF']) {
			
			$source= $this->source;
			$value = $this->current_char;
			
			return new EOF_Token($message = 'This is a EOF token.', $value, $source);

		} else if(ctype_alpha($this->current_char)) {
			
			$source= $this->source;
			$value = $this->current_char;
			
			return new Char_Token($message = 'This is a character token.', $value, $source);

		} else {
			
			$source= $this->source;
			$value = $this->current_char;
			
			return new Gen_Token($message = 'This is a general token.', $value, $source);

		}

	}

}
