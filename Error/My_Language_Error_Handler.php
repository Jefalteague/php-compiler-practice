<?php

namespace Error;

use Message\Message;

class My_Language_Error_Handler {

    /* Properties
    ** 
    **
    */

    private $type;
    private $array;
    private $parser;
    

    /* Methods
    ** 
    **
    */

    public function __construct($type, $array, $parser) {

        $this->type = $type;
        $this->value = $array;
        $this->parser = $parser;

    }

    public function flag($type, $array, $parser) {

        
        // temp just for test
        /*
        echo "<pre>";
        var_dump($type);
        var_dump($array);
        var_dump($parser);
        die;
        */

        $message = new Message($type, $array);


        $parser->send_message($message);

    }

}