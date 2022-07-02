<?php

namespace AST;

use AST\AST as AST;
use AST\ASTNode;
use AST\ASTNodeTypeEnum;

class ASTFactory {

	/*Properties
	**
	**
	*/

	/*Methods
	**
	**
	*/
	
	/**
	 * Method create_AST
	 *
	 * @return AST
	 */
	public static function create_AST():AST {

		return new AST();

	}
	
	/**
	 * Method create_ASTNode
	 *
	 * @param ASTNodeTypeEnum $type [explicite description]
	 *
	 * @return ASTNode
	 */
	public static function create_ASTNode(ASTNodeTypeEnum $type):ASTNode {

		return new ASTNode($type);

	}

}
