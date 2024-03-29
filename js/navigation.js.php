<?php
    Header("content-type: application/x-javascript");
?>

/*
 * This file contains JS functions required to navigate within the app
 */

var slideOrder = new Array();
slideOrder["input"] = new Array(null, "check");
slideOrder["check"] = new Array("input", "visualize");
slideOrder["visualize"] = new Array("check", "publish");
slideOrder["publish"] = new Array("visualize", null);

function showSlide(next, current){
    
    currentSlide = next;

    $("#"+current).hide("drop", 500, function(){

        //changes the color of the breadcrumbs
        $("#crumbs_"+current).attr("class", "off");
        $('#crumbs_'+next).attr("class", "on");

        //Changes the hash in the URL
        window.location.hash = currentSlide;

        //Removes or add the prev next buttons if need be
        if (slideOrder[currentSlide][0]){
            $("#button_prev").show();
        }else{
            $("#button_prev").hide();
        }

        if (slideOrder[currentSlide][1]){
            $("#button_next").show();
        }else{
            $("#button_next").hide();
        }

        $('#'+next).show("drop", 500, function(){
            
            //repeats the command in case the slide didn't go fast enough
            $("#"+current).hide();

            return false;
               
        });

        return false;

    });
    
}

function dispatchNext(){
	
	var data = "";

	data = $("#"+ currentSlide +"_data").val();

    if (data == ""){
        error("<?php echo _("No data was input.") ?>");
        return false;
    }

    loader_show();

	$.post("actions/"+currentSlide+".php", { data: data, chart_id: chart_id, action: "next" },
   		function(data) {
     		
     		if (data != ""){

     			data = jQuery.parseJSON(data);

     			if (data.status == 200){

     				//Updates the current working chart
     				chart_id = data.chart_id;
     				
     				//Goes to the next slide
     				showNext();
     				
     			}else{
     				error(data.error);
     			}

     		}else{
     			error();
     		}

     		
    });
}

function showNext(){

	var nextSlide = slideOrder[currentSlide][1];
	var nextSlide_JS = "js_enterScreen_"+nextSlide;

	//Advances to the next slide
    showSlide(nextSlide, currentSlide);

    //Executes the javascript of the new slide
    eval(nextSlide_JS)();

}

function showPrev(){
    showSlide(slideOrder[currentSlide][0], currentSlide);
}