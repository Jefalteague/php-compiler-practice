<?php

namespace AST;

use AST\ASTNodeTypeEnum;

interface ASTNodeInterface {

	/*Properties
	**
	**
	*/

	/*Methods
	**
	**
	*/

	/**
	 * Method get_type
	 *
	 * @return ASTNodeTypeEnum
	 */
	public function get_type():ASTNodeTypeEnum;
	
	/**
	 * Method add_child_node
	 *
	 * @param ASTNode $child_node [explicite description]
	 *
	 * @return ASTNode
	 */
	public function add_child_node(ASTNode $child_node):ASTNode;
	
	/**
	 * Method get_children
	 *
	 * @return Array
	 */
	public function get_child_nodes():Array;
		
	/**
	 * Method set_parent
	 *
	 * @param ASTNode $parent [explicite description]
	 *
	 * @return void
	 */
	public function set_parent(ASTNode $parent):void;

	/**
	 * Method get_parent
	 *
	 * @return ASTNode
	 */
	public function get_parent():ASTNode;
	
	/**
	 * Method set_attribute
	 *
	 * @return void
	 */
	public function set_attribute(ASTNodeKey $key, Object $value):void;
	
	/**
	 * Method get_attribute
	 *
	 * @return Object
	 */
	public function get_attribute(ASTNodeKey $key):Object;

	/**
	 * Method copy
	 *
	 * @return ASTNode
	 */
	public function copy():ASTNode;

}