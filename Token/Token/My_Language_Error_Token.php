<?php

namespace Token\Token;

use Error\My_Language_Error_Type;

class My_Language_Error_Token extends My_Language_Token {

	/*Properties
	**
	**
	*/

	/*Methods
	**
	**
	*/

	public function __construct($source, My_Language_Error_Type $error_code, String $text) {
		
		parent::__construct($source);

		$this->text = $text;
		
		$this->type = 'ERROR';

		$this->value = $error_code;

		$this->extract($source);
		
	}
	
	public function extract($source) {

	}

}
