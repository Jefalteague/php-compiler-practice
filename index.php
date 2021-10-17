<?php

// a test of updates
// global constants

//define("EOF", "EOF"); // END OF FILE;
//define("EOL", "EOL"); // END OF LINE char

$config = include('config.php');
	
abstract class Source {
	
	/* abstract methods*/
	
	abstract public function get_source();
	
	abstract public function make_line();

	abstract public function get_current_line();
	
	abstract public function make_char();
	
	abstract public function get_current_char();
	
}

/*
** Class which extends the basic source class.
** Provides specific functionality for string input.
*/

class String_source extends Source {
	
	/* properties*/
	
	protected $source;
	
	protected $f_open;
	
	protected $current_char;
	
	protected $current_pos;
	
	protected $line;
	
	protected $line_number;
	
	/*methods*/
	
	public function __construct($text) {
		
		$this->source = $text;
		
		if($this->source) {
			
			$this->f_open = explode("\r\n", $this->source);
			
		} else {
			
			echo "hell no";
			
		}
		
	}
	
	public function get_source() {
		
		return $this->source;
		
	}
	
	public function make_line() {
		
		if ($this->line_number <= count($this->f_open) - 1) {
				
			$this->line = $this->f_open[$this->line_number];
			
			++ $this->line_number;
				
		}
		
	}
		
	public function get_current_line() {
		
		return $this->line;
		
	}
	
	public function make_char() {
		
		$this->current_char = $this->get_current_line()[$this->current_pos];
			
		++ $this->current_pos;
		
	}
	
	public function get_current_char() {
		
		return $this->current_char;
		
	}
	
}

class File_source extends Source {
	
	/* properties */
	
	protected $source;
	
	protected $f_open;
	
	protected $current_char;
	
	protected $current_pos;
	
	protected $line;
	
	protected $line_number;
	
	public $config;
	
	/* methods */
	
	public function __construct($file, $config) {
		
		$this->current_pos = -2;
		$this->line_number = 0;
		$this->config = $config;

		if(file_exists($file)) {
					
			$this->source = $file;
		
			$this->f_open = fopen($file, 'r');
			
		} else {
			
			echo "hell no";
			
		}
		
	}
	
	// return the source string
	public function get_source() {
		
		return $this->source;
		
	}
	
	public function get_resource() {
		
		return $this->f_open;
		
	}
	
	// look at the current line number
	public function get_line_number() {
		
		return $this->line_number;
		
	}
		
	public function make_line() {
		
		$this->line = fgets($this->f_open);

		$this->current_pos = -1;

		if($this->line != FALSE) {

			++ $this->line_number;

		}
		
	}

	public function get_current_line() {
		
		if($this->line == FALSE) {
			
			return "FALSE";
			
		}
		
		return $this->line;
		
	}

	// update the current_char depending on certain contexts
	// much of this based on the book, i might try to figure out
	// a personalized approach later, for now, just practice
	public function select_char() {

		// first time in
		if($this->current_pos == -2) {

			$this->make_line();

			return $this->make_char();

		// EOF	
		} else if($this->line == FALSE){

			if(feof($this->f_open)) {
				
				fclose($this->f_open);
				
			} else {
				
				echo "gonna have to fix this";
				
			}
			
			return $this->config['EOF'];
			
		// EOL		
		} else if(($this->current_pos == -1) || ($this->current_pos == strlen($this->line))) {

			$this->current_pos = $this->current_pos + 1;
			
			return $config['EOL'];
			
		// read new line
		} else if($this->current_pos > strlen($this->line)) {

			$this->make_line();

			return $this->make_char();
		
		// return char at current position
		} else {

			$this->current_char = $this->line[$this->current_pos];

			$this->current_pos = $this->current_pos + 1;
	
			return $this->current_char;
			
		}
		
	}
	
	public function make_char() {
		
		++ $this->current_pos;

		return $this->select_char();
		
	}
	
	public function get_current_char() {
		
		return $this->current_char;
		
	}
	
}

class Scanner_factory {
	
	/* methods */
	
	// determine which scanner should be created, 
	public function create_scanner($language, $source, $config) {
		
		if($language == 'my_language' && is_file($source)) {
			
			echo "this is in the file block<br />";
			
			$source = new File_Source($source, $config);
			return new My_language_scanner($source);
			
		}else if($language == 'my_language' && is_string($source)) {
			
			echo "this is in the string block<br />";
			$source = new String_source($source, $config);
			return new My_language_scanner($source);
			
		}else {
			
			echo "something is wrong<br />";
			
		}
		
	}
	
}

abstract class Scanner {
	
	/* methods */
	
	// look at the source
	public function var_dump_source() {
		
		echo "<pre>";
		echo var_dump($this->source);
		echo "</pre>";
		
	}
	
	// get the source string
	abstract public function get_source();
	
}

	/* A specific implementation of
	** the Scanner class. For my tinkering.
	*/
	
class My_language_scanner extends Scanner{

	protected $source;
	protected $current_char;
	protected $line;
	private $token;
	
	public function __construct(Source $source) {
		
		$this->source = $source;

	}
	
	public function get_source() {
		
		return $this->source;
		
	}
		
	// return the current char that is taken from the source
	public function get_current_char() {
		
		return $this->current_char;
		
	}
	
	/*
	** Helper methods that access the source
	** object methods to make it go
	*/
	
	// helper function make a char using source class
	public function select_char() {

		$this->current_char = $this->source->select_char();
		
		return $this->current_char;
		
	}
	
	// helper function make a line using source class
	public function make_line() {
		
		$this->line = $this->source->make_line();
		
	}
	
	// look at the opened file
	public function get_resource() {
		
		return $this->source->get_resource();
		
	}
	
	// look at the current line number
	public function get_line_number() {
		
		return $this->source->get_line_number();
		
	}
		
	public function make_token() {
		
		$this->current_char = $this->select_char();
		
		if ($this->current_char == $this->source->config['EOF']) {
			
			return new EOF_Token($message = 'This is a EOF token.');
			
		} else {
			
			return new Gen_token($message = 'This is a general token.');
			
		}
		
	}
		
		
}
abstract class Token {
	
	public $message;
	
	public function __construct($message = '') {
		
		$this->message = $message;
		
	}
	
	public function get_type() {
		
		return $this->type;
		
	}
	
	public function get_message() {
		
		return $this->message;
		
	}
}

class Gen_token extends Token {
	
	public $type = "GEN";
	
}

class EOF_Token extends Token {
	
	public $type = "EOF";
	
}

$scanner = new Scanner_factory();

$scanner = $scanner->create_scanner('my_language', 'bob.txt', $config);

$token = $scanner->make_token();

echo $token->get_message();


/*
$resource = $scanner->get_resource();
$line_number = $scanner->get_line_number();
echo $line_number;

for ($x=0; $x<=18; $x++) {
	
	$current_char = $scanner->select_char();
	echo "<br />";
	echo $current_char;	
	
}
*/
	
