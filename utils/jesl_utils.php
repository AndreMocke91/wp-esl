<?php

function dwwp_admin_enqueue_scripts() {
	//These varibales allow us to target the post type and the post edit screen.
	global $pagenow, $typenow;
	if ( ($pagenow == 'post.php' || $pagenow == 'post-new.php') && $typenow == 'job' ) {
		//Plugin Main CSS File.
		wp_enqueue_style( 'dwwp-admin-css', plugins_url( 'css/admin-jobs.css', __FILE__ ) );
		//Plugin Main js File.
		wp_enqueue_script( 'dwwwp-job-js', plugins_url( 'js/admin-jobs.js', __FILE__ ), array( 'jquery', 'jquery-ui-datepicker' ), '20150204', true );
		//Quicktags js file.
		wp_enqueue_script( 'dwwp-custom-quicktags', plugins_url( 'js/dwwp-quicktags.js', __FILE__ ), array( 'quicktags' ), '20150206', true );
		//Datepicker Styles
		wp_enqueue_style( 'jquery-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css' );
	}
}

function jesl_word_printer_builder($words, $level, $tax){

	wp_enqueue_style( 'jesl-word-printer-css', plugins_url( '../jesl-card-printer/css/jesl-word-printer-styles.css', __FILE__ ) );

	wp_enqueue_script( 'jesl-jquery', plugins_url( '../jesl-card-printer/js/jquery-3.1.1.min.js', __FILE__ ));
	wp_enqueue_script( 'jesl-word-printer-js', plugins_url( '../jesl-card-printer/js/jesl-word-printer.js', __FILE__ ), array('jquery'), null, true);
	wp_enqueue_script( 'jesl-print-area', plugins_url( '../jesl-card-printer/js/jquery.PrintArea.js', __FILE__ ));

	$htmlString = '
		<br>
		<textarea id="wordInput" rows=10 style="width: 400px;">#jesl_words#
		</textarea>
	<br><br>	
	
	<label>Post Script : </label><input type="text" id="postScript" value="#jesl_post_script#">
	<br><br>
	
	<label>Card Width : </label><input type="number" id="cardWidth" min="50" max="700" value="600" onchange="generateWordCards()">
	<br><br>		
	
	<label>Font Color : </label> <input type="color" id="fontColor"></input> &nbsp <label>Font Size : </label> <input type="number" id="fontSize" value = 120 onchange="generateWordCards()"></input> 
	<br><br>
	
	<label>Font : </label> <br>
	  <input type="radio" name="fontFamily" value="Century Gothic" checked> Gothic Century <br>	  
	  <input type="radio" name="fontFamily" value="Trace" > Trace <br> 	  
	  <br><br>
	
	<label>Border Color : </label> <input type="color" id="borderColor" value="#FFFF00"></input>
	<br><br>
	
	<input type="button" onclick="generateWordCards()" value="Generate Cards">
	<br><br>
		<div class="cardContainer" id="cardContainer">
	<!-- 	
		<div class="wordCard" id="wordCard">
			
			<p id="contentParagraph" style="width: #cardWidth#px">#ShadyName#</p>
				
					<div class="postScript">
						<p>#postScript#</p>
					</div>
				
			
		</div>
		 -->
			
		</div>
		
		<input type="button" id="print_button1" value="Print" onclick="printShit()">
		
		<script>

   		function printShit(){
        
            var mode = "iframe"; // popup
            var close = mode == "popup";
            var options = { mode : mode, popClose : close};
            $("div.cardContainer").printArea( options );
                 
		}

  </script>

	';

	$words_string = '';

	foreach ($words as $key => $value) {
		$words_string .= $value . ',';
	}
	$words_string = rtrim($words_string, ',');	

	$post_script_string = strtoupper($level) . ' - ' . $tax['name'];	

	//echo $htmlString;

	$htmlString = str_replace('#jesl_words#', $words_string, $htmlString);
	$htmlString = str_replace('#jesl_post_script#', $post_script_string, $htmlString);

	echo $htmlString;

}
