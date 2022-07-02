<?php

namespace Scanner;

//use Scanner\Scanner as Scanner;
//use Token\Assignment_Token as Assignment_Token;
//use Token\Error_Token as Error_Token;

use Token\Error_Token;
// change to use Token\My_Language_Error_Token
use Source\Source as Source;
use Token\Pascal_Token_Type;
// rename Pascal_Token_Type to y_Language_Token_Type and change to use it 
use Error\My_Language_Error_Type;
// change to use Token\My_Language_EOF_Token
use Token\EOF_Token2 as EOF_Token2;
// change to use Token\My_Language_EOL_Token
use Token\EOL_Token2 as EOL_Token2;
// change to use Token\My_Language_Word_Token
use Token\Word_Token2 as Word_Token2;
// change to use Token\Token\My_Language_Number_Token
use Token\Token\My_Language_EOF_Token;
use Token\Token\My_Language_EOL_Token;
use Token\Token\My_Language_Word_Token;
use Token\Token\My_Language_Error_Token;
use Token\Token\My_Language_String_Token;
use Token\Number_Token2 as Number_Token2;
use Token\Token\My_Language_Number_Token;
use Token\Token\My_Language_Special_Symbol_Token;
use Token\Special_Symbol_Token2 as Special_Symbol_Token2;
// change to use Token\My_Language_Special_Symbol_Token

/**
 * My_Language_Scanner
 */
class My_Language_Scanner extends Scanner {

	/*Properties
	**
	**
	*/

	/*Methods
	**
	**
	*/
	
	/**
	 * Method __construct
	 *
	 * @param Source $source [explicite description]
	 *
	 * @return void
	 */
	public function __construct(Source $source) {
		
		$this->source = $source;

	}
	
	/**
	 * Method skip_white_space
	 *
	 * @return void
	 */
	public function skip_white_space() {
		
		$this->current_char = $this->select_char();

		while((ctype_space($this->current_char)) || ($this->current_char == "{")) {

			if($this->current_char == "{") {
				
				while(($this->current_char != "}" && $this->current_char != "EOF") ) {
					
					$this->current_char = $this->make_char();

				}
				
				if($this->current_char == "}") {

					$this->current_char = $this->make_char();

				}
				
			} else if(ctype_space($this->current_char)) {
				
				$this->current_char = $this->make_char();
				
			}
		}
		
	}
	
	/**
	 * Method identifier
	 *
	 * @return void
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
		
	/**
	 * Method single_char_token
	 *
	 * @return void
	 */
	public function single_char_token() {
		
		$value = $this->current_char;
		
		if(array_search($this->current_char, $this->source->config['single-char-tokens'])) {
			
			$message = 'This is a Special Symbol Token';
		
			$source = $this->source;
			
			return $token = new Special_Symbol_Token($message, $value, $source);
			
		}
		
	}
	
	/**
	 * Method number
	 *
	 * @return void
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
		
	/**
	 * Method peek_char
	 *
	 * @return void
	 */
	public function peek_char() {
		
		return $this->source->peek_char();
		
	}
	
	/**
	 * Method make_token
	 *
	 * @return void
	 */
	public function extract_token() {
		
		$this->skip_white_space();

		// the textbook contains the following, but i don't understand why: $this->current_char = $this->select_char();

		if ($this->current_char == Pascal_Token_Type::EOF->not_reserved()) {
			
			$source = $this->source;

			//return new EOF_Token2($source);
			// change to My_Language_EOF_Token($source)
			return new My_Language_EOF_Token($source);

		} else if($this->current_char == Pascal_Token_Type::EOL->not_reserved()) {
			
			$source = $this->source;
			
			//return new EOL_Token2($source);
			// change to My_Language_EOL_Token($source)
			return new My_Language_EOL_Token($source);

		} else if(ctype_alpha($this->current_char)) {

			$source = $this->source;

			//return new Word_Token2($source);
			// change to My_Language_Word_Token($source)
			return new My_Language_Word_Token($source);

		} else if(ctype_digit($this->current_char)) {

			$source = $this->source;

			//var_dump($source);

			//return new Number_Token2($source);
			// change to My_Language_Number_Token($source)
			return new My_Language_Number_Token($source);

		} else if($this->current_char == '\'') {

			$source = $this->source;

			return new My_Language_String_Token($source);

		} else if((array_search($this->current_char, $this->source->config['single-char-tokens'], true))
			
			|| (array_search($this->current_char . $this->peek_char(), $this->source->config['tokens']))) {
			
			$source = $this->source;

			//return new Special_Symbol_Token2($source);
			// change to My_Language_Special_Symbol_Token($source)
			return new My_Language_Special_Symbol_Token($source);
			
		} else {
			
			$source = $this->source;

			//var_dump($this->current_char);
			
			//return new Error_Token($source);
			// change to My_Language_Error_Token($source, $error_code, $text)

			//$error_code = My_Language_Error_Type::INVALID_CHARACTER->get_type();
			return new My_Language_Error_Token($source, My_Language_Error_Type::INVALID_CHARACTER, 'error');

		}

	}

}
