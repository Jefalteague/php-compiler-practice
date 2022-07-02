<?php

namespace Parser;

use AST\ASTFactory;
use AST\ASTNodeTypeEnum;
use Scanner\Scanner as Scanner;
use Parser\Statement_Parser as Statement_Parser;
use Parser\Expression_Parser as Expression_Parser;

class Assignment_Statement_Parser extends Statement_Parser {

	
	/*Properties
	**
	**
	*/

	public $token;

	public $scanner;

	public $symbol_table_stack;

	/*Methods
	**
	**
	*/

	public function __construct(Scanner $scanner, $token, $symbol_table_stack) {

		$this->token = $token;

		$this->scanner = $scanner;

		$this->symbol_table_stack = $symbol_table_stack;

	}

	public function parse() {

		// build the error array

		$out_errors = [];

		// build the token array

		$out_tokens = [];

		// add token to token_arrary

		$out_tokens = $this->token_token_array_add($out_tokens);

		// get the identifier for the symbol table work

		$identifier = $this->token->get_value();

		// get the symbol table

		$stack = $this->get_symbol_table_stack();

		// look up the identifier in the symbol table

		$result = $stack->lookup($identifier);

		// enter the identifier if it hasn't already been entered

		if($result == NULL) {

			// enter it

			$entry = $stack->enter_local($identifier);

			// append the line number

			$entry->append_line_number($this->token->get_line_number());

			// view helper

			// $this->my_var_dump($entry);

		}

		// create the first assignment statement operator node

		$assignment_node_1 = ASTFactory::create_ASTnode(ASTNodeTypeEnum::ASSIGNMENT_STATEMENT);

		// create the variable operand

		$variable_operand = ASTNodeTypeEnum::VARIABLE_OPERAND;

		// create the variable operand node

		$variable_node = ASTFactory::create_ASTNode($variable_operand);

		// add the variable node to the operator node

		$assignment_node_1->add_child_node($variable_node);

		// blast through the IDENTIFIER token

		$this->token = $this->next_token();

		// add token to token_arrow which will allow for viewing/messaging

		$out_tokens = $this->token_token_array_add($out_tokens);

		// blast through the := token

		if($this->token->get_type() == 'ASSIGN') {

			// get the next token

			$this->token = $this->next_token();

		}

		// create the expression parser

		$expression_parser = new Expression_Parser($this->scanner, $this->token, $this->symbol_table_stack);

		// get the expression parser package

		$in_package = $expression_parser->parse();

		// break out the expression parser package node

		$in_nodes = $in_package['statement_node'];

		$this->my_var_dump($in_nodes);

		// break out the expression parser package $out_tokens

		$ip = $in_package['token_array'];

		// add $expression_package_1 tokens to token array

		$out_tokens = $this->package_token_array_add($ip, $out_tokens);

		// add child node to parent node

		$assignment_node_1->add_child_node($in_nodes);

		// assign $assignment_node_1 to the outgoing package statement_node key

		$out_package['statement_node'] = $in_nodes;

		// assigh the final $out_tokens to the outgoing package token_array key

		$out_package['token_array'] = $out_tokens;

		// assign the local error array to the outgoing package error array key

		if(!(empty($out_errors))) {

			$out_package['error_array'] = $out_errors;
		
		}

		// send off the package
		
		return $out_package;

	}

}
