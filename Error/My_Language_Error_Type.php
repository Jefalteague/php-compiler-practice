<?php

namespace Error;

enum My_Language_Error_Type:string {

	/*Properties
	**
	**
	*/

	case INVALID_CHARACTER = 'INVALID CHARACTER';

	/*Methods
	**
	**
	*/

	public function get_type() {

		return match($this) {

			My_Language_Error_Type::INVALID_CHARACTER => 'INVALID_CHARACTER',

		};

	}

}
