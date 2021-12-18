<?php

namespace AST;

interface ASTInterface {

	/*Properties
	**
	**
	*/

	/*Methods
	**
	**
	*/

	public function get_root():ASTNode;

	public function set_root(ASTNode $node):ASTNode;

}
