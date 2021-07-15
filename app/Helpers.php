<?php

namespace App;

class Helpers 
{


public static function shortenString($string, $len = 150) {
        if (strlen($string) > $len) {
            $string = trim(substr($string, 0, $len));
            $string = substr($string, 0, strrpos($string, " "))."&hellip;";
        } else {
            $string .= "&hellip;";
        }
        return $string;
    }



// string helper functions
 
// Splits a string on a given setpoint, then returns what is before
// or after the setpoint. You can include or exclude the setpoint.
public static function split_string($string, $setpoint, $beforaft, $incorexc) {
	$lowercasestring = strtolower ( $string );
	$marker = strtolower ( $setpoint );
	
	if ($beforaft == 'before') {  // Return text before the setpoint
		if ($incorexc == 'exclude') {
			// Return text without the setpoint
			$split_here = strpos ( $lowercasestring, $marker );
		} else {
			// Return text and include the setpoint
			$split_here = strpos ( $lowercasestring, $marker ) + strlen ( $marker );
		}
		$result_string = substr ( $string, 0, $split_here );
	} else {  // Return text after the setpoint
		if ($incorexc == 'exclude') {
			// Return text without the setpoint
			$split_here = strpos ( $lowercasestring, $marker ) + strlen ( $marker );
		} else {
			// Return text and include the setpoint
			$split_here = strpos ( $lowercasestring, $marker );
		}
		$result_string = substr ( $string, $split_here, strlen ( $string ) );
	}
	return $result_string;
}
 
// Finds a string between a given start and end point. You can include
// or exclude the start and end point
public static function find_between($string, $start, $end, $incorexc) {
	$temp = self::split_string ( $string, $start, 'after', $incorexc );
	return self::split_string ( $temp, $end, 'before', $incorexc );
}
 
// Uses a regular expression to find everything between a start
// and end point.
public static function find_all($string, $start, $end) {
	preg_match_all ( "($start(.*)$end)siU", $string, $matching_data );
	return $matching_data [0];
}
 
// Uses str_replace to remove any unwanted substrings in a string
// Includes the start and end
public static function delete($string, $start, $end) {
	// Get array of things that should be deleted from the input string
	$delete_array = self::find_all ( $string, $start, $end );
	
	// delete each occurrence of each array element from string;
	for($i = 0; $i < count ( $delete_array ); $i ++)
		$string = str_replace ( $delete_array, "", $string );
	
	return $string;
}    
}