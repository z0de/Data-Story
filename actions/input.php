<?php

/*********************************************************************************************
 *  This file parses the values in the textarea and store them in a matrix format in the DB  *
 ********************************************************************************************/

require_once "../config.php";

$data = $_POST['data'];

//Contains the CSV data
$formatted_data = array();

//Contains the JSON that'll be sent back to the front
$return_array = array();


//Parses the rows
$rows = explode("\n", $data);

$top_headers = 0;
$horizontal_header = 0;
$vert_headers = 0;
$vertical_header = 0;

foreach ($rows as $key_row=>$row){
	
	//If the row isn't just one empty cell
	if (count($row)>1 || $row!=""){

		$formatted_data[$key_row] = array();

		//Parses the columns in an array
		$row_array = explode("\t", $row);

		//adds the column array to the formatted array
		foreach ($row_array as $key_col => $cell_raw){
			
			$cell = trim($cell_raw);

			//Converts commas to dots
			if (!(is_numeric($cell)) && is_numeric(str_replace(",", ".", $cell)))
				$cell = str_replace(",", ".", $cell);

			//detects if there are headers on the top row. 	
			if ($key_row == 0 && $key_col>0){
				if (!(is_numeric($cell)))
					$top_headers++;
			}else if ($key_col == 0){
				//detects if there are headers on the first column
				if (!(is_numeric($cell)))
					$vert_headers++;
			}

			$formatted_data[$key_row][$key_col] = trim($cell);
		}
	}

}

//If more than 50% of the rows are not numeric, there are horizontal headers
if ($top_headers >= (count($formatted_data[0])/2))
	$horizontal_header = 1;

//If more than 50% of the cells on the first col are not numeric, there are vertical headers
if ($vert_headers >= (count($formatted_data)/2))
	$vertical_header = 1;

//Empties the top left cell if there are vertical and horizontal headers
if ($vertical_header && $horizontal_header)
	$formatted_data[0][0] = "";

//Transposes automatically so that we only have 1 kind of single-header tables to deal with
if ($vertical_header == 0 && $horizontal_header == 1){
	//transposes
	$formatted_data = transpose($formatted_data);

	//corrects the headers description
	$vertical_header = 1;
	$horizontal_header = 0;

}

$serialized_data = serialize($formatted_data);

//Stores the data in the DB
$q = "INSERT INTO charts (user_id, chart_csv_data, date_create, horizontal_headers, vertical_headers) VALUES ('$user_id', '$serialized_data', '" . date('Y-m-d H:i:s') . "', $horizontal_header, $vertical_header)";

if ($result = $mysqli->query($q)) {
	
	$chart_id = $mysqli->insert_id;

	$return_array["status"] = "200";
	
	//returns the id of the chart
	$return_array["chart_id"] = $chart_id;

}else{

	$return_array["status"] = "600";
	$return_array["error"] = _("Could not store the data on the database.");
	$return_array["error_details"] = $mysqli->error;
} 

echo json_encode($return_array);

$mysqli->close();

?>