<?php

namespace Token\Token;

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

		$this->text = substr($value, 0 ,1);
		
		$this->type = 'SPECIAL_SYMBOL';

	}

}
