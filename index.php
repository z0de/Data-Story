<?php 

require_once "config.php"; 

//If the user's loading a visualization
if (isset($_GET["c"]))
	require_once "embed.php";

//If the user's here to build a visualization
else
	require_once "screens.php";

?>
