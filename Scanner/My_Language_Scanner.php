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
use Token\Char_Token as Char_Token;
use Token\Keyword_Token as Keyword_Token;
use Token\Special_Symbol_Token as Special_Symbol_Token;

class My_Language_Scanner extends Scanner{

	public $source;
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
					
					echo "ERROR"; 
					
					die;
					
				}
				
			} else if(ctype_space($this->current_char)) {
				
				$this->current_char = $this->make_char();
				
			}
		}
		
	}
	
	/*
	** Helper function to use after using identifier(), which uses make_char() and leaves the current_char and current_pos set
	** which is then overwritten by select_char() when called by next round of parser. set_back prevents the overwrite by setting
	** current_pos and current_char one back. kind of hacky...might break soon.
	*/
	
	/*
	public function set_back() {
	
		// these need to be accessible through local helper functions
		$this->source->current_pos = $this->source->current_pos - 1;

		$this->source->current_char = $this->source->line[$this->source->current_pos -1];

		$this->current_char = $this->source->current_char;
		
	}
	*/
	
	public function set_back() {
		
		$this->current_char = $this->source->set_back();
		
	}
	
	/*
	** Method to use in the make_token() method. Creates the ID and Reserved Words Tokens.
	** @ return string
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
			
			$message = 'This is the ' .  strtoupper($value) . ' keyword';
		
			$source = $this->source;
			
			$token = new Keyword_Token($message, $value, $source);
			
		} else {
			
			$this->set_back();
			
			$message = 'This is an ID Token.';
			
			$source = $this->source;

			$token = new Char_Token($message, $value, $source);
			
		}
		
		return $token;
		
	}
	
	public function single_char_token() {
		
		$value = $this->current_char;
		
		if(array_search($this->current_char, $this->source->config['single-char-tokens'])) {
			
			$message = 'This is a Special Symbol Token';
		
			$source = $this->source;
			
			return $token = new Special_Symbol_Token($message, $value, $source);
			
		}
		
	}
	
	/*
	** Method to create the various Tokens to return to the Parser.
	** @return object
	*/
	
	public function make_token() {
		
		$this->skip_white_space();
		
		// the textbook contains the following, but i don't understand why: $this->current_char = $this->select_char();

		if ($this->current_char == $this->source->config['tokens']['EOF']) {
			
			$source= $this->source;
			$value = $this->current_char;
			
			return new EOF_Token($message = 'This is a EOF token.', $value, $source);

		} else if($this->current_char == $this->source->config['tokens']['EOL']) {
			
			$source= $this->source;
			$value = $this->current_char;
			
			return new EOL_Token($message = 'This is a EOL token.', $value, $source);
			
		} else if(ctype_alpha($this->current_char)) {
/*
			$source = $this->source;
			$value = $this->identifier();
			
			return new Char_Token($message = 'This is a CHAR token.', $value, $source);
*/
			return $this->identifier();
			
		} else if(array_search($this->current_char, $this->source->config['single-char-tokens'])) {
					
			return $this->single_char_token();
			
		} else {
			
			$source= $this->source;
			$value = $this->current_char;
			
			return new Gen_Token($message = 'This is a general token.', $value, $source);

		}

	}

}
