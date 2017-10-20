<link rel="shortcut icon" href="icon.ico" type="image/ico" />
<?php
/*include 'system/Load.php';
include 'system/Controller.php';
include_once 'bootstrap.php';*/
//include_once 'bootstrap.php';
session_start();
include_once 'config.php';
function __autoload($className){
	include_once 'system/'.$className.'.php';
}
include 'Bootstrap.php';

?>