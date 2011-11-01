<?php


//Initializes GetText
require_once "libraries/functions.lang.php";
initLanguage();

//removes error reporting
error_reporting(0);

//Fetches the converter from nums to text
require_once "libraries/alpha.id.php";

//Function to transpose arrays
require_once "libraries/transpose.php";

//Connects to the local DB
$hostname = "localhost";
$database = "datastory";
$username = "root";
$password = "";

$mysqli = new mysqli($hostname,$username,$password,$database);

$debug = 1;

if ($debug == 1){
	$user_id = "0";
	error_reporting(E_ALL);
	define("BASE_DIR",     "http://localhost/Data-Story/");
}else{
	//Global const
	define("BASE_DIR",     "http://datastory.de/");
}

?>