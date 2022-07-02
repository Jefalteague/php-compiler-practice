<?php

namespace Token\Token;

class My_Language_Number_Token extends My_Language_Token {

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
		
		while((ctype_digit($source->get_current_char()))) {

			$value = $value . $source->get_current_char();

			$source->current_char = $source->make_char();

			if($source->get_current_char() == '.') {

				$value = $value . $source->get_current_char();

				$source->current_char = $source->make_char();
	
				while((ctype_digit($source->get_current_char()))) {

					$value = $value . $source->get_current_char();

					$source->current_char = $source->make_char();

				}
				
				$this->source->set_back();
				
				$this->text = substr($value, 0, 1);
						
				$this->value = (float)$value;
				
				$this->type = 'FLOAT NUMBER';

				$this->type_value = 'FLOAT NUMBER';
				
				return;

			} 

		}
		
		$this->source->set_back();

		$this->text = substr($value, 0, 1);
		
		$this->value = (int)$value;
		
		$this->type = 'INTEGER NUMBER';

		$this->type_value = 'INTEGER_NUMBER';

	}

}
