<?php

namespace AST;

class AST implements ASTInterface {

	/*Properties
	**
	**
	*/
	
	/**
	 * root
	 *
	 * @var mixed
	 */
	private ASTNode $root;

	/*Methods
	**
	**
	*/

	public function set_root(ASTNode $node) {

		$this->root = $node;

		return $this->root;

	}

	public function get_root() {

		return $this->root;

	}

}
