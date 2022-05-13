<?php

namespace Token\Token;

class My_Language_EOL_Token extends My_Language_Token {

	/*Properties
	**
	**
	*/

	/*Methods
	**
	**
	*/

	public function extract($source) {
		
		$this->text = 'EOL';
		$this->type = 'EOL';
		$this->value = 'EOL';
		
	}

}
