#!/bin/bash

#attempt to write a script to create prefilled class definition files
#$1=directory name, can also be used for namespace
#$2=file name


cat << EOF > c:/xampp/htdocs/compiler/$1/$2.php
<?php

namespace $1;

class $2 {

	/*Properties
	**
	**
	*/

	/*Methods
	**
	**
	*/

}
EOF