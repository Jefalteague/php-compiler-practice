<?php

namespace Token\Token;

class My_Language_EOF_Token extends My_Language_Token {

	/*Properties
	**
	**
	*/

	/*Methods
	**
	**
	*/

	public function extract($source) {

		$this->text = 'EOF';
		$this->type = 'EOF';
		$this->value = 'EOF';

	}

}
