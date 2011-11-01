

/*
 * @desc: Triggers error messages
 * @param1: The message to be displayed
 * @returns: Nothing
 *
 */

function error(msg){

	$('#error').html("");

	if(msg == "" || msg == undefined){
		msg = "Oops, that's not supposed to happen.";
	}

    $('#error').html(msg);
    $('#error').show();
    $('#error').effect("bounce", {
        times:3
    }, 300);

}


/*
 * @desc: Checks if the param is a numeric value
 * @param1: A variable of any type
 * @returns: true if n is a number, false otherwise
 *
 */

 function isNumber(n) {
  return !isNaN(parseFloat(n)) && isFinite(n);
}

/*
 * @desc: Rounds number with precision
 * @param1: The number to be rounded
 * @param2: The precision (decimals)
 * @returns: The rounded number
 *
 */

 function roundNumber(num, dec) {
	var result = Math.round(num*Math.pow(10,dec))/Math.pow(10,dec);
	return result;
}


/****************************************************************/
/* These functions have to do with Highchart (tooltip & labels) */
/****************************************************************/

function pieLabels(value) {return '<b>'+ value.point.name +'</b>: '+ roundNumber(value.percentage, 2) +' %';}

function pieTooltip(value) { return '' + value.point.name + ': ' + value.y ; }

function barTooltip(value) { return '' + value.x +': '+ value.y ; }

/****************************************************************/
/* These functions show/hide the loading animations             */
/****************************************************************/

function loader_show(){
	$("#black_veil").fadeIn("fast", function(){
		
	});
	$("#loader").show();
}

function loader_hide(){

	$("#loader").hide();
	$("#black_veil").fadeOut("fast");
}

function initInputs(){
	$(document).find("input").each(function(){
		var default_content = jQuery(this).val();
		jQuery(this).focus(function(){
			if (jQuery(this).val() == default_content){
				jQuery(this).val("");
			}
		});
		jQuery(this).blur(function(){
			if (jQuery(this).val() == ""){
				jQuery(this).val(default_content);

				//So that the graph renders
				update_options();
			}
		});
	});
}