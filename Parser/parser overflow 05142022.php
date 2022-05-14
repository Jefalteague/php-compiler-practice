
		$this->ast = ASTFactory::create_AST();
		
		//var_dump($this->ast);

		$token_array = array();

		$error_array = array();

		$token = NULL;

		$start_time = (float)microtime();

		while (!(is_a($token, 'Token\Token\My_Language_EOF_Token'/*'Token\EOF_Token2'*/))) {
			//change to 'Token\My_Language_EOF_Token'
			$token = $this->make_token();

			/* Beginning of the AST work*/
			if($token->get_value() == 'BEGIN') {

				echo "<pre>";
				//var_dump($token->get_value());
				//var_dump($this);

				$statement_parser = new Statement_Parser($this);
				
				//var_dump($statement_parser);
				//die;

				var_dump($statement_parser->parse());
				die;

			}
				

			if($token->get_type() == 'IDENTIFIER') {

				$name = $token->get_value();
				
				$stack = $this->get_symbol_table_stack();

				$entry = $stack->lookup_local($name);

				if($entry == NULL) {

					$entry = $stack->enter_local($name);

				}

				$line_number = $token->get_line_number();

				$entry->append_line_number($line_number);

			}

			// add non-error tokens to the token_array, which will be used to message out
			if($token->get_type() != 'ERROR') {
				
				array_push($token_array, [

					'text' => $token->get_text(),
					'type' => $token->get_type(),
					'value' => $token->get_value(), 
					'line_number' => $token->get_line_number(),
					'column_number' => $token->get_column_number(),
	
				]);

			// add any error tokens to the error_array, which will be used to message out
			} else {
		
				array_push($error_array, [

					'type' => $token->type,
					'file' => $token->source->file,
					'value' => $token->value->get_type(),
					'line_number' => $token->line_number,
					'column_number' => $token->column_number,
					//'choke' => $token->choke,
				
				]);

			}
			
		}

		$end_time = (float)microtime();

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