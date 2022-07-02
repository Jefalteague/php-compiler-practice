<?php

namespace Token\Token;

use Token\Pascal_Token_Type as Pascal_Token_Type;

class My_Language_Special_Symbol_Token extends My_Language_Token {

	/*Properties
	**
	**
	*/

	/*Methods
	**
	**
	*/
		
	public function extract($source) {
		
		$value = '';
		
		if(array_search($source->get_current_char(), $source->config['single-char-tokens'])) {
			
			if($source->get_current_char() == ':') {

				if($source->peek_char() == '=') {

					if(array_search($source->get_current_char() . $source->peek_char(), $source->config['tokens'])) {

						$value = $value . $source->get_current_char();

						$source->make_char();
		
						$value = $value . $source->get_current_char();

					}

				} else {$value = $value . $source->get_current_char();}

			} else {

				$value = $value . $source->get_current_char();
			
			} 

		}

		$this->value = $value;

		//var_dump($value);

		$this->text = substr($value, 0 ,1);
		
		$this->type = 'SPECIAL_SYMBOL';

		$enum = Pascal_Token_Type::tryFrom($value);

		// verbose solution follows, but it is all i have at the moment...need to figure out how to get 
		// just the DOT, not the entire Pascal_Token_Type::DOT, for example
		// must do this for every special symbol for the time being, just to get it working again

		if($enum->special_symbols() == ".") {

			$this->type_value = 'DOT';

			//var_dump($this->type_value);

		} elseif($enum->special_symbols() == ";") {

			$this->type_value = 'SEMI_COLON';

			//var_dump($this->type_value);

		} elseif($enum->special_symbols() == ":") {

			$this->type_value = 'COLON';

		//	var_dump($this->type_value);

		} elseif($enum->special_symbols() == ":=") {

			$this->type_value = 'ASSIGN';

			//var_dump($this->type_value);

		} elseif($enum->special_symbols() == ",") {

			$this->type_value = 'COMMA';

		//	var_dump($this->type_value);

		} elseif($enum->special_symbols() == "..") {

			$this->type_value = 'DOTDOT';

		//	var_dump($this->type_value);

		} elseif($enum->special_symbols() == "=") {

			$this->type_value = 'EQUALS';

		//	var_dump($this->type_value);
			
		} elseif($enum->special_symbols() == "{") {

			$this->type_value = 'LEFT_BRACE';

		//	var_dump($this->type_value);
			
		} elseif($enum->special_symbols() == "}") {

			$this->type_value = 'RIGHT_BRACE';

		//	var_dump($this->type_value);
			
		} elseif($enum->special_symbols() == "[") {

			$this->type_value = 'LEFT_BRACKET';

		//	var_dump($this->type_value);
			
		} elseif($enum->special_symbols() == "]") {

			$this->type_value = 'RIGHT_BRACKET';

		//	var_dump($this->type_value);
			
		} elseif($enum->special_symbols() == "(") {

			$this->type_value = 'LEFT_PARENTHESES';

		//	var_dump($this->type_value);
			
		} elseif($enum->special_symbols() == ")") {

			$this->type_value = 'RIGHT_PARENTHESES';

		//	var_dump($this->type_value);
			
		} elseif($enum->special_symbols() == "<=") {

			$this->type_value = 'LESS_EQUALS';

		//	var_dump($this->type_value);
			
		} elseif($enum->special_symbols() == ">=") {

			$this->type_value = 'GREATER_EQUALS';

		//	var_dump($this->type_value);
			
		} elseif($enum->special_symbols() == "<") {

			$this->type_value = 'LESS_THAN';

		//	var_dump($this->type_value);
			
		} elseif($enum->special_symbols() == ">") {

			$this->type_value = 'GREATER_THAN';

		//	var_dump($this->type_value);
			
		} elseif($enum->special_symbols() == "-") {

			$this->type_value = 'MINUS';

		//	var_dump($this->type_value);
			
		} elseif($enum->special_symbols() == "+") {

			$this->type_value = 'PLUS';

		//	var_dump($this->type_value);
			
		} elseif($enum->special_symbols() == "/") {

			$this->type_value = 'SLASH';

		//	var_dump($this->type_value);
			
		} elseif($enum->special_symbols() == "*") {

			$this->type_value = 'STAR';

		//	var_dump($this->type_value);
			
		} elseif($enum->special_symbols() == "^") {

			$this->type_value = 'UP_ARROW';

		//	var_dump($this->type_value);
			
		}
	}
}
