<?php

namespace Parser;

use AST\ASTFactory;
use AST\ASTNodeTypeEnum;
use Token\Pascal_Token_Type;
use Scanner\Scanner as Scanner;
use Error\My_Language_Error_Type;
use Token\Token\My_Language_Error_Token;
use Parser\Statement_Parser as Statement_Parser;

class Expression_Parser extends Statement_Parser{

	/*Properties
	**
	**
	*/

	public $scanner;

	public $token;

	public $rel_ops;

	public $factor_ops;

	public $symbol_table_stack;

	/*Methods
	**
	**
	*/

	public function __construct(Scanner $scanner, $token, $symbol_table_stack) {

		// set the scanner

		$this->scanner = $scanner;

		// set the token

		$this->token = $token;

		// set the symbol table stack

		$this->symbol_table_stack = $symbol_table_stack;

		// map from the relational operator's token_type to the node_type using enums

		$this->rel_ops = array(
			
			"EQUALS" => ASTNodeTypeEnum::EQUAL_OPERATOR, 
			"NOT_EQUALS" => ASTNodeTypeEnum::NOT_EQUAL_OPERATOR, 
			"GREATER_THAN" => ASTNodeTypeEnum::GREATER_THAN_OPERATOR,
			"GREATER_EQUALS" => ASTNodeTypeEnum::GREATER_THAN_EQUAL_OPERATOR,
			"LESS_THAN" => ASTNodeTypeEnum::LESS_THAN_OPERATOR,
			"LESS_EQUALS" => ASTNodeTypeEnum::LESS_THAN_EQUAL_OPERATOR,
		
		);

		// map from the multiplicative operator's token_type to the node_type using enums

		$this->term_ops = array(

			"PLUS" => ASTNodeTypeEnum::ADD_OPERATOR, 
			"MINUS" => ASTNodeTypeEnum::SUBTRACT_OPERATOR, 
			"OR" => ASTNodeTypeEnum::OR_OPERATOR,
		
		);

		// map from the multiplicative operator's token_type to the node_type using enums

		$this->factor_ops = array(

			"STAR" => ASTNodeTypeEnum::MULTIPLICATION_OPERATOR, 
			"SLASH" => ASTNodeTypeEnum::FLOAT_DIVISION_OPERATOR, 
			"DIV" => ASTNodeTypeEnum::INTEGER_DIVISION_OPERATOR,
			"MOD" => ASTNodeTypeEnum::MODULUS_OPERATOR,
			"AND" => ASTNodeTypeEnum::AND_OPERATOR,

		);

	}

	/**
	 * Method parse
	 * 
	 * The main parse method for expression parser
	 *
	 * @return $package
	 */

	public function parse() {

		// build the token array

		$out_tokens = [];

		// build the error array

		$out_errors = [];

		// parse the expression

		$in_package = $this->parse_expression();

		// break out the nodes

		$in_nodes = $this->breakout_node('statement_node', $in_package);

		// get the package token array

		$ip = $in_package['token_array'];

		// add the package tokens to the token array

		$out_tokens = $this->package_token_array_add($ip, $out_tokens);

		// build the final package

		$out_package = [];

		// assign the parse statement node to the package statement node key

		$out_package['statement_node'] = $in_package['statement_node'];

		// assign the final outgoing token array to the package token array key

		$out_package['token_array'] = $out_tokens;

		// assign the final outgoing error array to the package error array key

		if(!(empty($out_errors))) {

			$out_package['error_array'] = $out_errors;

		}

		// send it off

		return $out_package;

	}
		
	/**
	 * Method parse_expression
	 *
	 * @return void
	 */

	public function parse_expression() {

		// build the error array

		$out_errors = [];

		// build the token array

		$out_tokens = [];

		// get the first simple expression package

		$in_package = $this->parse_simple_expression();

		// break out the statement_node package

		$in_nodes = $this->breakout_node('statement_node', $in_package);

		//break out the token array from the first factor

		$ip = $in_package['token_array'];

		// add the tokens to the outgoing $out_tokens

		$out_tokens = $this->package_token_array_add($ip, $out_tokens);

		// get the current token to get its type to select the correct enum

		$this->token = $this->get_current_token();

		// get the current token type to select the correct enum

		$token_type = $this->token->get_type();

		// move into the operator stuff

		if(array_key_exists($token_type, $this->rel_ops)) {

			// select the operator node type to create the node

			$operator_node_type = $this->rel_ops[$token_type];

			// create the operator node

			$operator_node = ASTFactory::create_ASTNode($operator_node_type);

			// add the first simple expression node to the parent node

			$operator_node->add_child_node($in_nodes);

			// get the next token, which should be a simple expression

			$this->token = $this->next_token();

			// get the second simple expression package

			$in_package = $this->parse_simple_expression();

			// collect the statement_node array from the second simple expression package

			$in_nodes = $this->breakout_node('statement_node', $in_package);

			// break out the tokens from the second package

			$ip = $in_package['token_array'];

			// add the tokens to the outgoing $out_tokens

			$out_tokens = $this->package_token_array_add($ep, $out_tokens);

			// $this->my_var_dump($out_tokens);

			$operator_node->add_child_node($in_nodes);

			// update the first node package to be the final parent node collection

			$in_nodes = $operator_node;

		}

		// the build for the outgoing package

		$out_package = [];

		// add the outgoing parent node collection to the outgoing package

		$out_package['statement_node'] = $in_nodes;

		// add the outgoing $out_tokens to the outgoing package

		$out_package['token_array'] = $out_tokens;

		// assign the finalized error array to the outgoing package's error array key

		if(!(empty($out_errors))) {

			$out_package['error_array'] = $out_errors;

		}

		// send it off

		return $out_package;

	}

	public function parse_simple_expression() {

		// build the error array

		$out_errors = [];

		// the build for the outgoing local token array

		$out_tokens = [];
		
		// get the first term package

		$in_package = $this->parse_term();

		// break out the first term node

		$in_nodes = $this->breakout_node('statement_node', $in_package);

		//break out the token array from the first package

		$ip = $in_package['token_array'];

		// add the tokens from the first package to the $out_tokens for outgoing

		$out_tokens = $this->package_token_array_add($ip, $out_tokens);

		// get the current token (+, -, etc.)

		$this->token = $this->get_current_token();

		// get the current token type (ADD, SUBTRACT, etc.)

		$token_type = $this->token->get_type();

		// get the second term and subsequents 

		while(array_key_exists($token_type, $this->term_ops)) {

			// get the operator node type enum to use for the creation of the node

			$operator_node_type = $this->term_ops[$token_type];

			// create the node based on the operator node type

			$operator_node = ASTFactory::create_ASTNode($operator_node_type);

			// add the node to the parent node

			$operator_node->add_child_node($in_nodes);

			// get the next token

			$this->token = $this->next_token();

			// get the second term package

			$in_package = $this->parse_term();
		
			// break out the second term node

			$in_node = $this->breakout_node('statement_node', $in_package);

			// breakout the second incoming package tokens

			$ip = $in_package['token_array'];

			// add the incoming package tokens to the final token_array to outgo

			$out_tokens = $this->package_token_array_add($ip, $out_tokens);

			// add the second term node to the parent

			$operator_node->add_child_node($in_nodes);

			// convert the original term node variable to the operator node

			$in_nodes = $operator_node;

			// get the current token in order to get the current token type in order to work the while loop

			$this->token = $this->get_current_token();
		
			// get the current token type in order to work the while loop

			$token_type = $this->token->get_type();

		}

		// the build for the final term package

		$out_package = [];

		// set the statement node

		$out_package['statement_node'] = $in_nodes;

		// set the token array

		$out_package['token_array'] = $out_tokens;

		// assign the finalized error array to the outgoing package error array key

		if(!(empty($out_errors))) {

			$out_package['error_array'] = $out_errors;

		}

		// return the package

		return $out_package;

	}

	public function parse_term() {

		// build the error array

		$out_errors = [];

		// the build for the outgoing local token array

		$out_tokens = [];

		// the package from the first factor, containing the nodes and the tokens

		$in_package = $this->parse_factor();

		// the build for the broken out factor element from the first factor

		$in_nodes = NULL;

		// break out the factor element from the first factor

		$in_nodes = $this->breakout_node('statement_node', $in_package);

		// break out the token array from the first factor

		$ip = $in_package['token_array'];

		// add the first incoming package tokens to the final token array

		$out_tokens = $this->package_token_array_add($ip, $out_tokens);

		// get the current token (*, /, etc.)

		$this->token = $this->get_current_token();

		// get the term operator's type (STAR, DIV, etc.)

		$token_type = $this->token->get_type();

		// get the second factor element, and any subsequents

		while(array_key_exists($token_type, $this->factor_ops)) {

			// the operator node type determines the ASTNode to create

			$operator_node_type = $this->factor_ops[$token_type];

			// crete the correct node based on the operator type node

			$operator_node = ASTFactory::create_ASTNode($operator_node_type);

			// add to the parent AST node the the factor node from the first factor package 

			$operator_node->add_child_node($in_nodes);

			// get the next token

			$this->token = $this->next_token();

			//var_dump($this->token->get_type());

			$this->token_token_array_add($out_tokens);

			// get the second factor

			$in_package = $this->parse_factor();

			// break out the second incoming package's nodes

			$in_nodes = $this->breakout_node('statement_node', $in_package);

			// break out the second incoming package's tokens

			$ip = $in_package['token_array'];

			// add the second incoming package's tokens to the final token array

			$out_tokens = $this->package_token_array_add($ip, $out_tokens);

			// add the second factor node to the parent

			$operator_node->add_child_node($in_nodes);

			// modify the first factor node to be the operator node

			$in_nodes = $operator_node;

			// get the current token SEMICOLON in order to get the current token type to work the while loop

			$this->token = $this->get_current_token();

			// get the current token SEMICOLON type in order to work the while loop

			$token_type = $this->token->get_type();

			// add the new token (SEMICOLON) to the local token array

			$this->token_token_array_add($out_tokens);
			
		}

		// return the array package of the node and the $out_tokens

		$out_package = [];

		$out_package['statement_node'] = $in_nodes;

		$out_package['token_array'] = $out_tokens;

		// assign the local error array to the outgoing package error array key

		if(!(empty($out_errors))) {

			$out_package['error_array'] = $out_errors;

		}

		return $out_package;

	}

	public function parse_factor() {

		// build the error array
		
		$out_errors = [];

		// build the token array

		$out_tokens = [];

		$in_nodes = NULL;

		$switcher = $this->token->get_type();

		switch($switcher) {

			case 'INTEGER_NUMBER':

				//$this->my_var_dump($out_tokens);

				// add token to out_tokens

				$out_tokens = $this->token_token_array_add($out_tokens);

				$in_nodes = ASTFactory::create_ASTnode(ASTNodeTypeEnum::INTEGER_CONSTANT_OPERAND);

				$this->token = $this->next_token();

				// add token to out_tokens

				$out_tokens = $this->token_token_array_add($out_tokens);

			break;

			case 'LEFT_PARENTHESES':

				// add token to token array

				$out_tokens = $this->token_token_array_add($out_tokens);

				// get the next token

				$this->token = $this->next_token();

				// get the token type

				$token_type = $this->token->get_type();

				// test the token type for right parantheses

				if($token_type == 'RIGHT_PARENTHESES') {

					// create an error token because this means that no expression exists

					$error = new My_Language_Error_Token($this->scanner->get_source(), My_Language_Error_Type::INVALID_CHARACTER, 'error');

					// push the error token to the error array

					array_push($out_errors, $error);

					// how to handle??
					// lacking a incoming package, a php error will throw when trying to add a child node because of NULL vs. Node

				}

				// in either case, push on to get the package
				// but have to figure out how to deal with the NULL...create a NULL node?

				$in_package = $this->parse_expression();

				// break out the nodes from the incoming package

				$in_nodes = $this->breakout_node('statement_node', $in_package);

				// get the package token array
	
				$ip = $in_package['token_array'];
	
				// add the package token array to the final token array
	
				$out_tokens = $this->package_token_array_add($ip, $out_tokens);
	
				// get the current token
	
				$current_token = $this->get_current_token();

				// get the current token type

				$token_type = $current_token->get_type();

				// test the current token type
	
				if($token_type == 'RIGHT_PARENTHESES') {

					// get the next token
	
					$this->token = $this->next_token();
	
					// add token to $out_tokens
						
					$out_tokens = $this->token_token_array_add($out_tokens);
	
				} else {
	
					// create an error token because the required parentheses does not exist

					$error = new My_Language_Error_Token($this->scanner->get_source(), My_Language_Error_Type::INVALID_CHARACTER, 'error');

					// push the error token to the error array

					array_push($out_errors, $error);

				}
				
			break;

		}

		// build the out going $out_package

		$out_package = [];

		// assign the outgoing nodes to the statement node key

		$out_package['statement_node'] = $in_nodes;

		// assignt the outgoing tokens to the token array key

		$out_package['token_array'] = $out_tokens;

		// assign the outgoing errors to the error array key

		if(!(empty($out_errors))) {

			$out_package['error_array'] = $out_errors;

			// helper view

			//$this->my_var_dump($out_errors);

		}
		
		// deliver the outgoing $out_package

		return $out_package;

	}


}
