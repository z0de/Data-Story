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

$prod_domain = "windowonthemedia.com";

if (strstr($_SERVER['SERVER_NAME'], $prod_domain)){		

	// PROD ENVIRONMENT //

	$user_id = "0";

	//Global const
	define("BASE_DIR", "http://windowonthemedia.com/datastory/");

	//Fetches passwords
	require_once('passwords.php');
	

}else{

	// DEV ENVIRONMENT //

	$user_id = "0";
	error_reporting(E_ALL);
	define("BASE_DIR", "http://localhost/Data-Story/");

	//Connects to the local DB
	$hostname = "localhost";
	$database = "datastory";
	$username = "root";
	$password = "";
}

$mysqli = new mysqli($hostname,$username,$password,$database);

?>