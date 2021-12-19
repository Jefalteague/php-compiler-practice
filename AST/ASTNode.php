<?php

namespace AST;

class ASTNode implements ASTNodeInterface {

	/*Properties
	**
	**
	*/

	private ASTNodeType $type;
	private Array $nodes;
	private ASTNode $parent;
	private Array $attributes;

	/*Methods
	**
	**
	*/
	
	/**
	 * Method __construct
	 *
	 * @param ASTNodeType $type [explicite description]
	 * @param Array $nodes [explicite description]
	 * @param ASTNode $parent [explicite description]
	 *
	 * @return void
	 */
	public function __construct(ASTNodeType $type) {

		$this->type = $type;
		$this->nodes = array();
		$this->parent = NULL;
		$this->attributes = array();

	}
	
	/**
	 * Method get_type
	 *
	 * @return ASTNodeType
	 */
	public function get_type():ASTNodeType {

		return $this->type;

	}
	
	/**
	 * Method set_parent
	 *
	 * @param ASTNode $parent [explicite description]
	 *
	 * @return void
	 */
	public function set_parent(ASTNode $parent):void {

		$this->parent = $parent;

	}
	
	/**
	 * Method get_parent
	 *
	 * @return ASTNode
	 */
	public function get_parent():ASTNode {

		return $this->parent;

	}
	
	/**
	 * Method add_child_node
	 *
	 * @param ASTNode $child_node [explicite description]
	 *
	 * @return ASTNode
	 */
	public function add_child_node(ASTNode $child_node):ASTNode {

		$child_node_copy = $child_node->set_parent($this);
		array_push($child_node, $this->nodes);

		return $child_node;

	}
	
	/**
	 * Method get_children
	 *
	 * @return Array
	 */
	public function get_child_nodes():Array {

		return $this->nodes;

	}
	
	/**
	 * Method get_attribute
	 *
	 * @param ASTNodeKey $key [explicite description]
	 *
	 * @return Object
	 */
	public function get_attribute(ASTNodeKey $key):Object {

		return $this->attributes[$key];

	}
	
	/**
	 * Method set_attribute
	 *
	 * @param ASTNodeKey $key [explicite description]
	 * @param Object $value [explicite description]
	 *
	 * @return void
	 */
	public function set_attribute(ASTNodeKey $key, Object $value):void {

		array_push($this->attributes[$key], $value);

	}

	public function copy():ASTNode {

		// does this work? how to test?
		return clone($this);

	}

}
