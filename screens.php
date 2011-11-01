<!DOCTYPE html>
<html>
    <head>

        <meta http-equiv="content-type" content="text/html; charset=utf-8" />

        <title><?php echo _("Data Story") ?></title>

        <!-- General styles -->
        <link rel="stylesheet" type="text/css" href="css/stylesheets/general.css" />

        <!-- JQuery library -->
        <script src="js/jquery-1.6.4.js" type="text/javascript"></script>

        <!-- JQueryUI library -->
        <script src="js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>       
        
        <!-- The JS function that help navigate the app -->
        <script src="js/navigation.js.php" type="text/javascript"></script> 
        
        <!-- More general functions for the app -->
        <script src="js/functions.js" type="text/javascript"></script> 

    </head>


    <body>
    
	    <script type="text/javascript">
	    
	    /********************/
	    /* Global vars init */
	    /********************/

	    //Keeps track of the screen we're at
	    var currentSlide;
	    //Keeps track of the chart that's being worked on
	    var chart_id;

	    /* END global vars init */

	     $(document).ready(function() {
	     	//hides all screens on startup
	     	$('.screen').hide();
	        
	       //Starts the slideshow 
	       showSlide("input", "login");
	        
            //Init all inputs fields so they react properly onBlur
            initInputs();

	        //Tells the next prev buttons what to do
	        $('#next').click(function(){
                dispatchNext(currentSlide);
            });

            $('#prev').click(function(){
                showPrev();
            });

            //init the error box
            $('#error').click(function() {
                $(this).hide();
            });		

	     });
	    </script>

        <!-- A div that serves for popups and loading screens -->
        <div id="black_veil"></div>

        <!-- A div that serves for loading screens -->
        <div id="loader">
            Loading...   
        </div>

        <div id="container">
    	    <div id="error" style="display:none;"><?php echo _("Errors are displayed here") ?></div>

        	<div id="header">
                <div id="logo">
                <div id="logo_text">
                        <span class="data">Data</span><span class="story">Story</span>
                    </div>
                </div>
                <div id="navbar">
                </div>
        	</div>
        	

        	<div id="breadcrumbs">
        		<div id="crumbs_input" class="off">
                    <?php echo _("1. Input data") ?>
                </div>
        		<div id="crumbs_check" class="off">
                    <?php echo _("2. Check data") ?>
                </div>
        		<div id="crumbs_visualize" class="off">
                    <?php echo _("3. Visualize") ?>
                </div>
        		<div id="crumbs_publish" class="off">
                    <?php echo _("4. Publish") ?>
                </div>
        	</div>

            <div id="buttons">
            	<div id="button_next">
            		<button id="next" class="button nav">
            			<?php echo _("Next") ?>&nbsp;&rsaquo;
            		</button>
            	</div>
            	<div id="button_prev">
            		<button id="prev" class="button nav">
            			&lsaquo;&nbsp;<?php echo _("Prev") ?>
            		</button>
            	</div>
            </div>

        	<div id="screen_container">

        		<!-- Loads the different screens -->
        		<?php require_once "templates/login.php"; ?>
        		<?php require_once "templates/input.php"; ?>
        		<?php require_once "templates/check.php"; ?>
        		<?php require_once "templates/visualize.php"; ?>
        		<?php require_once "templates/publish.php"; ?>
        	</div>
        </div>
    </body>
</html>