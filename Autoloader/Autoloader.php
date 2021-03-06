<?php

/*
** Autoloader class based on https://subscription.packtpub.com/book/application_development/9781785883446/1/ch01lvl1sec14/implementing-class-autoloading
** To be used with compiler local dev
*/

namespace Autoloader;

class Autoloader {

	// Dirs is an array which holds the directories in which to search for the files that contain the required classes
	public static $dirs = array();

	// The variable to use as a flag to enforce singleton instantiation of autoloader
	public static $singleton;

	// To be a singleton, really, should return the single/same instantiation when another attempt to create a new autoloader is made
	// As of 03/05/2022 his code will not return the single/same instantiation upon multiple attempts, because it is not stored
	
	// The first of two approaches to instantiation, which uses the second approach
	public function __construct($dirs) {
		
		self::init($dirs);
		
	}
	
	// The second of two approaches to instantiation
	public static function init($dirs) {
		
		if($dirs) { //set the dirs
		
			self::add_dirs($dirs);
		
		}
		
		if(self::$singleton == 0) { // make a singleton
		
			spl_autoload_register(__class__ . '::autoload');
			
			self::$singleton ++;
		
		}
		
	}

	public static function load_file($file) {
		
		if (file_exists($file)) {
				 
			require_once $file;
			
			return TRUE;
		
		}
		
		return FALSE;
		
	}
	
	public static function add_dirs($dirs) {
		
		if(is_array($dirs)) {
			
			self::$dirs = array_merge(self::$dirs, $dirs);// merge the added dirs with the dirs array

		} else {
			
			self::$dirs[] = $dirs;

		}
		
	}

	public static function autoload($class_name) {
			
			$success = FALSE;

			$new_class_name = str_replace('\\', DIRECTORY_SEPARATOR, $class_name);
	
			$file = $new_class_name . '.php';
		
			foreach(self::$dirs as $dir) {
							
				$file = $dir . DIRECTORY_SEPARATOR . $file;
				
				if(self::load_file($file)) {
					
					$success = TRUE;
					
					break;
				
				}
				
			}
			
			// There is a better way to do the following
			if(!$success) {
				
				$last_chance = __DIR__ . DIRECTORY_SEPARATOR . $file;
				
				if(!self::load_file($last_chance)) {
					
					echo 'HELP!!';
					
				}
				
			}
			
			return $success;

	}

}
