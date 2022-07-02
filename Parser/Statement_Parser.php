<?php

namespace Parser;

use AST\ASTFactory;
use AST\ASTNodeTypeEnum as ASTNodeTypeEnum;
use Token\Token as Token;
use Scanner\Scanner as Scanner;
use Parser\Statement_Parser as Statement_Parser;
use Parser\My_Language_Parser as My_Language_Parser;
use Parser\Compound_Statement_Parser as Compound_Statement_Parser;

class Statement_Parser extends My_Language_Parser{

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

		$statement_node = NULL;

		$token_array = [];

		$error_array = [];
		
		switch ($this->token->get_type()) {
			
			case 'BEGIN':

				// add token to token_arrow which will allow for viewing/messaging

				$token_array = $this->token_token_array_add($token_array);

				// create the compound statement parser

				$compound_statement_parser =  new Compound_Statement_Parser($this->scanner, $this->token, $this->symbol_table_stack);

				// get the compound statement parser package

				$package = $compound_statement_parser->parse();

				if(array_key_exists( 'statement_node', $package)) {

					$package['statement_node'] = $package['statement_node'];

				}

				if(array_key_exists('token_array', $package)) {

					$tokens = $package['token_array'];

					foreach($tokens as $token) {

						array_push($token_array, $token);

					}

					$package['token_array'] = $token_array;

				} else {

					echo 'big POO error: missing COMPOUND STATEMENT';

				}

				break;

			case 'IDENTIFIER':

				$assignment_statement_parser = new Assignment_Statement_Parser($this->scanner, $this->token, $this->symbol_table_stack);

				$package = $assignment_statement_parser->parse();

				break;

			default:

				$package = [];

				$package['statement_node'] = ASTFactory::create_ASTnode(ASTNodeTypeEnum::NOOP_STATEMENT);
				
				break;

		}

		return $package;

	}

	public function parse_list($parent_node, $terminator) {

		$token_array = [];

		$statement_package = [];

		$error_array = [];

		while (!(is_a($this->token, 'Token\Token\My_Language_EOF_Token'/*'Token\EOF_Token2'*/)) && ($this->token->get_type() != $terminator)) {

			$statement_package_1 = $this->parse();

			$statement_node_1 = NULL;

			if(array_key_exists('statement_node', $statement_package_1)) {

				$statement_node_1 = $statement_package_1['statement_node'];

			}

			if(array_key_exists('token_array', $statement_package_1)) {

				foreach($statement_package_1['token_array'] as $array) {

					array_push($token_array, $array);

				}
		
			}

			$parent_node->add_child_node($statement_node_1);

			$this->token = $this->get_current_token();

			$token_type = $this->token->get_type();

			if($token_type == "SEMI_COLON") {

				$this->token = $this->next_token();

			} elseif($token_type == "IDENTIFIER") {

				echo "ERROR: MISSING SEMICOLON </br>";

			} elseif($token_type == 'EOL') { // blast through the EOLs

				while($token_type == 'EOL') {

					// add token to token_arrow which will allow for viewing/messaging
	
					array_push($token_array, [
					
						'text' => $this->token->get_text(),
						'type' => $this->token->get_type(),
						'value' => $this->token->get_value(),
						'line_number' => $this->token->get_line_number(),
						'column_number' => $this->token->get_column_number(),
					
					]);
	
					$this->token = $this->next_token();

					$token_type = $this->token->get_type();

				}

			} elseif($token_type != $terminator) {

				$this->my_var_dump($this->token, $message = 'statement_parser line 182');

				// add the error to the error array

				array_push($error_array, $this->token);

				 $this->my_var_dump($error_array);

				$this->token = $this->next_token();

				// add token to token_array

				// $token_array = $this->token_token_array_add($token_array);

			}

		}

		if($this->token->get_type() == $terminator) {

			$this_token = $this->next_token();

			//var_dump($this->token->get_type());

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

		} else {

			echo "ERROR";

		}

		

		$package = [];

		$package['token_array'] = $token_array;

		return $package;

	}

}