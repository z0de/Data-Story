
<!-- This file holds all HTML/JS contents for the screen "4.CHECK" -->

<script type="text/javascript">

function js_enterScreen_check(){

	$.post("actions/check.php", { chart_id: chart_id, action: "current" },
   		function(data) {
            
            loader_hide();

   			if (data != ""){

     			data = jQuery.parseJSON(data);

     			if (data.status == 200){
     				
     				
     				var count_rows = 0;
     				var tablehtml = '';

     				var num_rows = data.csv_data.length;

     				tablehtml += '<table>';

     				$.each(data.csv_data, function() {

     					var num_cols = this.length;

     					tablehtml += '<tr>';
     					
     					var count_cols = 0;

    					$.each(this, function() {
    						
    						var current_cell = String(this);

    						var td_class = "";

    						if ((data.vertical_headers == 1 && count_cols == 0) || (data.horizontal_headers == 1 && count_rows == 0)){
    							td_class = " class='header_cell'";
    						}

                            if (current_cell == ""){
                                td_class = " class='empty_cell'";
                            }

    						tablehtml += '<td'+ td_class +'>';

    						tablehtml += current_cell;
    						
    						tablehtml += '</td>';

    						count_cols++;
    						
						});

						if (!--count_cols) tablehtml += '</tr>';
						
						count_rows++;

					});
     				
     				tablehtml += '</table>';
     				
     				//empties the div
     				$("#data_check").html("");

     				//displays the data
     				$("#data_check").append(tablehtml);

     			}else{
     				error(data.error);
     			}

     		}else{
     			error();
     		}

   		});
}

function transpose(chart_id){
	$.post("actions/transpose.php", { chart_id: chart_id },
   		function(data) {
   			if (data != ""){

     			data = jQuery.parseJSON(data);

     			if (data.status == 200){

     				js_enterScreen_check();

   				}else{
     				error(data.error);
     			}
     		}else{
     			error();
     		}
     	});
}

</script>

<div class="screen" id="check">

	<div id="explainer"><?php echo _("Check that your data was correctly understood.") ?><button id="transpose" class="button transpose" onclick="transpose(chart_id)"><?php echo _("Transpose data.") ?></button></div>

	<div id="data_check">

	</div>

</div>