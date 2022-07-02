<?php

namespace Parser;

use AST\ASTFactory as ASTFactory;
use Message\Message as Message;
use Error\My_Language_Error_Handler;
use Parser\Statement_Parser;
use Scanner\Scanner as Scanner;

/**
 * My_Language_Parser
 */

class My_Language_Parser extends Parser {

	/* Properties
	**
	**
	*/

	public $scanner;

	//public $ast;

	public $token_array = [];

	public $error_array = array();

	/* Methods 
	**
	**
	*/

	/**
	 * Method incoming
	 * 
	 * Helper method for testing the incoming token
	 *
	 * @param $section 
	 *
	 * @return void
	 */
	
	public function incoming($section) {

		// view the incoming token

		echo '</br>';

		echo $section . ' incoming token ';

		var_dump($this->token->get_type());

		echo '</br>';

	}

	/**
	 * Method breakout_node
	 * 
	 * Method to replace the following block of often repeated code
	 * 
	 * 	if(array_key_exists('statement_node', $simple_expression_package_1)) {
     *
	 *		$simple_expression_node_1 = $simple_expression_package_1['statement_node'];
     *
	 *	}
	 *
	 * @param String $package_node the key for the array parameter
	 * @param Array $package the incoming package array of arrays
	 *
	 * @return Array $outgoing
	 */

	public function breakout_node(String $package_node, Array $package) {

		$outgoing = [];

		if(array_key_exists($package_node, $package)) {

			$outgoing = $package['statement_node'];

		}

		return $outgoing;

	}

	/**
	 * Method package_token_array_add
	 * 
	 * The following method replaces this code chunk, which was being reused over and over, might need to be in the parent class
	 * along with the other helper classes
	 *
 	 *	if(array_key_exists('token_array', $simple_expression_package_2)) {
	 *	
	 *		foreach($simple_expression_package_2['token_array'] as $array) {
	 *				
	 *			array_push($token_array, $array);
	 *
	 * @param $package $package [explicite description]
	 * @param $token_array $token_array [explicite description]
	 *
	 * @return $token_array
	 */

	public function package_token_array_add($package, $token_array) {

		foreach($package as $array) {

			array_push($token_array, $array);

		}

		return $token_array;

	}

	/**
	 * Method token_token_array_add
	 * 
	 * Replaces all this code being repeated in the body, now just a short method call
	 *
	 * @param $token_array the array into which the tokens are piled
	 *
	 * @return $token_array
	 */
	
	public function token_token_array_add($token_array) {

		// create array

		$array = [

			'text' => $this->token->get_text(),
			'type' => $this->token->get_type(),
			'value' => $this->token->get_value(),
			'line_number' => $this->token->get_line_number(),
			'column_number' => $this->token->get_column_number(),

		];

		// push array to $token_array

		array_push($token_array, $array);

		// return

		return $token_array;

	}
		
	/**
	 * Method my_var_dump
	 *
	 * @param $variable $variable [explicite description]
	 * @param String $message [explicite description]
	 *
	 * @return void
	 */

	public function my_var_dump($variable, String $message = NULL ) {

		echo '</br></br>';

		if($message != NULL) {

			echo $message;

			echo '</br></br>';

		}

		var_dump($variable);
		
		echo '</br></br>';

	}
		
	/**
	 * Method __construct
	 *
	 * @param Scanner $scanner [explicite description]
	 * @param $config $config [explicite description]
	 *
	 * @return void
	 */
	
	public function __construct(Scanner $scanner, $config) { //changed $parent back to $scanner to fix the scanner passing issue 061922
		
		$this->scanner = $scanner;

		parent::__construct($scanner, $config); //changed $parent back to $scanner to fix the scanner passing issue 061922

	}
	
	/**
	 * Method parse
	 * 
	 * The main parse method which gets the ball rolling
	 *
	 * @return void
	 */

	public function parse() {

		// build the error array

		$error_array = [];

		// build the token array

		$token_array = [];

		// start the parse clock

		$start_time = (float)microtime();

		// create the AST object for making all the nodes

		$this->ast = ASTFactory::create_AST();

		// get the ball rolling

		try {

			// build the root node holder

			$root_node = NULL;

			// get the first token, which is, due to the fact of development staging, for the time being BEGIN, but will
			// eventually be PROGRAM
			
			$this->token = $this->next_token();

			// test the token type for BEGIN

			if($this->token->get_type() == 'BEGIN') {



				$statement_parser = new Statement_Parser($this->scanner, $this->token, $this->symbol_table_stack);

				$root_node = $statement_parser->parse();

				foreach($root_node['token_array'] as $array) {

					array_push($token_array, $array);

				}

				$tok = $this->get_current_token();

				// add non-error tokens to the token_array
				
				array_push($token_array, [

					'text' => $tok->get_text(),
					'type' => $tok->get_type(),
					'value' => $tok->get_value(),
					'line_number' => $tok->get_line_number(),
					'column_number' => $tok->get_column_number(),

				]);
				
			}

			// get the next token, which should be DOT

			$token = $this->get_current_token();

			// get the tokens type

			$token_type = $token->get_type();

			// test the type for not being DOT, in order to conclude the program properly

			if($token_type != 'DOT') {

				// do something if it isn't DOT

				$this->my_var_dump($token->get_type(), $message = "ERROR: missing terminating DOT. Dumped my_language_parser line 279.");

				exit;

			}

			// set the root

			if($root_node != NULL) {

				$root = $root_node['statement_node'];

				$this->ast->set_root($root);

			}

			$end_time = (float)microtime();

			// helper view

			$message = 'my_language_parser line 257';

			$variable = $this->symbol_table_stack;

			$this->my_var_dump($variable, $message);

			$time_dif = $end_time - $start_time;

			// verbose config to turn on and off message sending
			if($this->config['messaging'] == TRUE) {
			
				// handle the errors
				if(!(empty($error_array))) {

					//to be developed as permanent error handling solution
					$errors = new My_Language_Error_Handler('ERROR', $error_array, $this);
				
					$errors->flag('ERROR', $error_array, $this);
				
				// if no errors, then display the token information	
				} else {

					// when php enums are available Nov 25th, switch to that approach, rather than the config associative array
					if(in_array('TOKEN', $this->config['message_type'])) {$type = 'TOKEN';}

					echo "Elapsed Time: " . $time_dif . " seconds";
		
					$message = New Message($type, $token_array);

					$this->send_message($message);

				}
		
			}

		}
		
		catch (Exception $e) {
				echo $e;
			}

	}
	
}