<?php

namespace Parser;


use AST\ASTFactory;
use AST\ASTNodeTypeEnum;
use Scanner\Scanner as Scanner;

class Compound_Statement_Parser extends Statement_Parser {

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

	public function __construct (Scanner $scanner, $token, $symbol_table_stack) {

		$this->token = $token;

		$this->scanner = $scanner;

		$this->symbol_table_stack = $symbol_table_stack;

	}

	public function parse() {

		// eat BEGIN token

		$token_array = [];

		$this->token = $this->next_token();

		// add token to token_array

		if($this->token->get_type() != 'ERROR') {
				
			$array = [

				'text' => $this->token->get_text(),
				'type' => $this->token->get_type(),
				'value' => $this->token->get_value(),
				'line_number' => $this->token->get_line_number(),
				'column_number' => $this->token->get_column_number(),

			];

			array_push($token_array, $array);

		}

		$compound_statement_node = ASTFactory::create_ASTnode(ASTNodeTypeEnum::COMPOUND_STATEMENT);

		$statement_parser = new Statement_Parser($this->scanner, $this->token, $this->symbol_table_stack);

		$tokens = $statement_parser->parse_list($compound_statement_node, $terminator = 'END');

		foreach($tokens['token_array'] as $token) {

			array_push($token_array, $token);

/*
			echo '</br></br>';

			var_dump($token);

			echo '</br></br>';
*/
		}

		$package = [];

		$package['statement_node'] = $compound_statement_node;

		$package['token_array'] = $token_array;

/*
			echo '</br></br>';

			var_dump($package);

			echo '</br></br>';
*/

		return $package;

	}

}
