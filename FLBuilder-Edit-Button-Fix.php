<?php

//Add hooks into WP, to have our function called. Sort of like events
//https://developer.wordpress.org/reference/hooks/post_row_actions/
add_filter('post_row_actions', 'edit_row_actions', 10, 1);
add_filter('page_row_actions', 'edit_row_actions', 10, 1);

//Our custom middleman function
function edit_row_actions($actions) {
    if (get_post_type() === 'post' || get_post_type() === 'page') {
        //unset($actions['clone']); //clone button
        //unset($actions['trash']); //trash button
		
		//remove default edit button (we want to use FL-Builder editor)
		if (isset($actions['edit'])) {
			unset($actions['edit']); 
		}
		
		//Rename FL-Builder to Edit Page
		if (isset($actions['fl-builder'])) {
			$actions['fl-builder'] = preg_replace('@>(.*)<@', '>Edit Page<', $actions['fl-builder']);
		}
		
		//Log everything poorly to the console for testing
		//consoleLog(json_encode($actions));
        return $actions;
    }
}

//Very shitty way to log things to JS console on the backend.
//Not great but like it works...
function consoleLog( $message ) {

    $message = htmlspecialchars( stripslashes( $message ) );
    //Replacing Quotes, so that it does not mess up the script
    //$message = str_replace( '"', "-", $message );
    $message = str_replace( "'", "-", $message );

    echo "<script>console.log('ERIC DEBUG:','{$message}')</script>";
}
