<?php

namespace Token\Token;

use Token\Pascal_Token_Type;

class My_Language_String_Token extends My_Language_Token {

	/*Properties
	**
	**
	*/

	/*Methods
	**
	**
	*/

	public function extract($source) {

		/*handle all cases of strings
		string begins with ' and ends with '
		when current char is the second ', the string ends
		any text between is captured and included in the string value
		white spaces between the 's are captured as blank spaces
		" are captured as double quotes

		start with eating the '

		*/

		$text = $source->get_current_char();

		$current_char = $source->make_char();

		$value = '';

		do {

			if($current_char != '\'' && $current_char != 'EOF') {
				
				$text = $text . $current_char;

				$value = $value . $current_char;

				$current_char = $source->make_char();

			}
	
		} while($current_char != '\'' && $current_char != 'EOF');

		if($current_char = '\'') {

			$text = $text . $current_char;

		}

		$this->text = $text;
		
		$this->value = $value;

		$this->type = Pascal_Token_Type::STRING->not_reserved();

	}

}
