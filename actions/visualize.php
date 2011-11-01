<?php

/*********************************************************************************************
 *  This file stores the code for the 														 *
 *  visualization in the DB (action=next)													 *
 ********************************************************************************************/

require_once "../config.php";

$data = stripslashes($_POST['data']);

$chart_id = $_POST['chart_id'];

$action = $_POST['action'];

if ($action == "next"){
	//If user has pressed the 'next' button

	//Fetches the JSON data sent by the client and stores it in the DB
	$data_json = json_decode($data);

	$chart_library = $data_json->chart_lib;

	$chart_type = "";
	if ($chart_library == "Highcharts"){
		$chart_type = $data_json->chart->defaultSeriesType;
	}

	$chart_js_code = addslashes($data);

	$q = "UPDATE charts SET chart_js_code = '$chart_js_code', chart_type='$chart_type', chart_library='$chart_library' WHERE chart_id='$chart_id'";

	if ($result = $mysqli->query($q)) {
		
		//success
		$return_array["status"] = "200";

		//returns the id of the chart
		$return_array["chart_id"] = $chart_id;
			
	}else{

		$return_array["status"] = "600";
		$return_array["error"] = _("Could not fetch the data from the database.");
		$return_array["error_details"] = $mysqli->error;
	}
}


echo json_encode($return_array);

$mysqli->close();



?>