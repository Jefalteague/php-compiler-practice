<?php

require_once('autoloader.php');

$dirs = __DIR__ ;
autoloader::init($dirs);

$bob = new apple\Apple();
$carly = new Pear();

echo $bob->get_bob();
echo "<br />";
echo $carly->get_carly();