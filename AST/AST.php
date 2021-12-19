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
	
	/**
	 * Method set_root
	 *
	 * @param ASTNode $node [explicite description]
	 *
	 * @return ASTNode
	 */
	public function set_root(ASTNode $node):ASTNode {

		$this->root = $node;

		return $this->root;

	}
	
	/**
	 * Method get_root
	 *
	 * @return ASTNode
	 */
	public function get_root():ASTNode {

		return $this->root;

	}

}
