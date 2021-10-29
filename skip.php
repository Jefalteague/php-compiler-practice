	
	public function skip_white_space() {
		
		$this->current_char = $this->select_char();
			
		while((ctype_space($this->current_char)) || ($this->current_char == "{")) {
			
			if($this->current_char = "{") {
				
				while(($this->current_char != "}") && ($this->current_char != $this->source->config['tokens']['EOF'])) {
					
					$this->current_char = $this->make_char();

				}
				
				if($this->current_char == "}") {

					echo $this->current_char;
					$this->current_char = $this->make_char();
					echo $this->current_char;
					
				}
				
			} else {
				
				$this->current_char = $this->make_char();
				
			}
		}
		
	}