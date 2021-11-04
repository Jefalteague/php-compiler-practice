<?php

/* A specific implementation of
** the Scanner class. For my tinkering.
*/

namespace Scanner;

use Scanner\Scanner as Scanner;
use Source\Source as Source;
use Token\Gen_Token as Gen_Token;
use Token\EOF_Token as EOF_Token;
use Token\EOL_Token as EOL_Token;
//use Token\Char_Token as Char_Token;
use Token\Keyword_Token as Keyword_Token;
use Token\Special_Symbol_Token as Special_Symbol_Token;
use Token\ID_Token as ID_Token;
use Token\Number_Token as Number_Token;
use Token\Assignment_Token as Assignment_Token;

class My_Language_Scanner extends Scanner{
	
	/* Moved to Parent
	public $source;
	protected $current_char;
	protected $line;
	private $token;
	*/
	
	public function __construct(Source $source) {
		
		$this->source = $source;

	}
	
	/* Moved to Parent
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
	/*
	// helper function make a char using source class
	public function select_char() {

		return $this->source->select_char();
		
	}
	
	// helper function make a line using source class
	public function make_line() {
		
		$this->line = $this->source->make_line();
		
	}
	*/
	
	/*
	// look at the opened file
	public function get_resource() {
		
		return $this->source->get_resource();
		
	}
	
	// look at the current line number
	public function get_line_number() {
		
		return $this->source->get_line_number();
		
	}
	
	public function make_char() {
		
		return $this->source->make_char();
		
	}
	
	public function vardump ($object) {
		
		echo "<br />Var Dump: ";
		var_dump($object);
		echo "<br />";
		
	}
*/
	public function skip_white_space() {
		
		$this->current_char = $this->select_char();

		while((ctype_space($this->current_char)) || ($this->current_char == "{")) {

			if($this->current_char == "{") {
				
				while(($this->current_char != "}") && ($this->current_char != $this->source->config['tokens']['EOL'])) {
					
					$this->current_char = $this->make_char();

				}
				
				if($this->current_char == "}") {

					$this->current_char = $this->make_char();

				} else {
				// need proper exception handling
				echo "ERROR: missing '}' " . "line number: " . $this->source->line_number- 1 . " column number: " . $this->source->current_pos -1 ; //make helpers to keep protected properties in source
					
					die;
					
				}
				
			} else if(ctype_space($this->current_char)) {
				
				$this->current_char = $this->make_char();
				
			}
		}
		
	}

	/* Moved to Parent
	** Helper function to use with identifier(), which uses make_char() and leaves the current_char and current_pos set
	** which is then overwritten by select_char() when called by next round of parser. set_back() allows the overwrite to
	** be done correctly, by setting current_pos and current_char one back. kind of hacky.
	*/
	/*
	public function set_back() {
		
		$this->current_char = $this->source->set_back();
		
	}
	*/
	/*
	** Method to use in the make_token() method. Creates the ID and Reserved Words Tokens.
	**
	** @return object Keyword_Token || ID_Token
	*/
	
	public function identifier() {
		
		$value = '';
		$token;

		while(ctype_alpha($this->current_char) && ($this->current_char != $this->source->config['tokens']['EOL'])) {
			
			$value = $value . $this->current_char;
			
			$this->current_char = $this->make_char();

		}
		
		if((isset($this->source->config['reserved-word-tokens'][strtolower($value)])) || isset($this->source->config['reserved-word-tokens'][strtoupper($value)])) {
			
			$this->set_back();
			
			$message = 'This is the ' .  strtoupper($value) . ' Keyword ID Token';
		
			$source = $this->source;
			
			$token = new Keyword_Token($message, $value, $source);
			
		} else {
			
			$this->set_back();
			
			$message = 'This is an ID Token.';
			
			$source = $this->source;

			$token = new ID_Token($message, $value, $source);
			
		}
		
		return $token;
		
	}
	
	/*
	** Method to create a special symbol token.
	**
	** @return object Special_Symbol_Token
	*/
	
	public function single_char_token() {
		
		$value = $this->current_char;
		
		if(array_search($this->current_char, $this->source->config['single-char-tokens'])) {
			
			$message = 'This is a Special Symbol Token';
		
			$source = $this->source;
			
			return $token = new Special_Symbol_Token($message, $value, $source);
			
		}
		
	}
	
	/*
	** Method to create and return number token.
	** Handles integer and floats, depending upon input.
	**
	** @return object Number_Token
	*/
	
	public function number() {

		$value = '';
		
		while((ctype_digit($this->current_char)) && ($this->current_char != $this->source->config['tokens']['EOL'])) {

			$value = $value . $this->current_char;

			$this->current_char = $this->make_char();

			if($this->current_char == '.') {

				$value = $value . $this->current_char;
				
				$this->current_char = $this->make_char();

				while((ctype_digit($this->current_char)) && ($this->current_char != $this->source->config['tokens']['EOL'])) {

					$value = $value . $this->current_char;

					$this->current_char = $this->make_char();

				}
				
				$this->set_back();
				
				$message = 'This is a FLOAT NUMBER Token';

				$source = $this->source;
						
				$value = (float)$value;

				return new Number_Token($message, $value, $source);

			} 

		}
		
		$this->set_back();
		
		$message = 'This is a INTEGER NUMBER Token';

		$source = $this->source;
		
		$value = (int)$value;

		return new Number_Token($message, $value, $source);

	}
	
	public function peek_char() {
		
		return $this->source->peek_char();
		
	}

	/*
	** Method to create the various tokens to return to the parser.
	**
	** @return object *_Token
	*/

	public function make_token() {
		
		$this->skip_white_space();

		// the textbook contains the following, but i don't understand why: $this->current_char = $this->select_char();

		if ($this->current_char == $this->source->config['tokens']['EOF']) {
			
			$source= $this->source;
			
			$value = $this->current_char;
			
			return new EOF_Token($message = 'This is a EOF Token.', $value, $source);

		} else if($this->current_char == $this->source->config['tokens']['EOL']) {
			
			$source= $this->source;
			
			$value = $this->current_char;
			
			return new EOL_Token($message = 'This is a EOL Token.', $value, $source);
			
		} else if(ctype_alpha($this->current_char)) {

			return $this->identifier();
			
		} else if(ctype_digit($this->current_char)) {

			return $this->number(); 
			
		} else if($this->current_char == ':' && $this->peek_char() == '=') {

			$message = 'This is an Assignment Token.';
			
			$value = $this->source->config['tokens']['ASSIGN'];
			
			$source = $this->source;
			
			$this->make_char();
			
			return new Assignment_Token($message, $value, $source);
			
		} else if(array_search($this->current_char, $this->source->config['single-char-tokens'])) {
					
			return $this->single_char_token();
			
		} else {
			
			$message = 'This is a GENERAL Token.';
			
			$source= $this->source;
			
			$value = $this->current_char;
			
			return new Gen_Token($message, $value, $source);

		}

	}

}
