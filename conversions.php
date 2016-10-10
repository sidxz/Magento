<?php

class Conversions
{
	

/*
* Note we are sending hearders in the begin() function and not here
* The API used in magento store does not return nested arrays.
* Iterating over the returned array once will do the job 
*/

/*
* Helper function to convert array to CSV
*/
function toCSV($array) {
	$csv='';
	foreach ($array as $key=>$value) {
		$csv .= str_replace(',',' ',$value). ",";
	}
	$csv = rtrim($csv, ",");
	$csv = $csv . "\r\n";
	return $csv;

}

/*
* Helper function to convert array to JSON
* I am reusing a standard function for json. This supports for nested arrays,
* which is an added functionality (Though Maganto API will not need it)
* Reference : PHP json_encode manual implementation for php < 4.0 
* http://php.net/manual/en/function.json-encode.php
*/
function toJSON($arr) { 
    $parts = array(); 
    $is_list = false; 

    //Find out if the given array is a numerical array 
    $keys = array_keys($arr); 
    $max_length = count($arr)-1; 
    if(($keys[0] == 0) and ($keys[$max_length] == $max_length)) {//See if the first key is 0 and last key is length - 1
        $is_list = true; 
        for($i=0; $i<count($keys); $i++) { //See if each key correspondes to its position 
            if($i != $keys[$i]) { //A key fails at position check. 
                $is_list = false; //It is an associative array. 
                break; 
            } 
        } 
    } 

    foreach($arr as $key=>$value) { 
        if(is_array($value)) { //Custom handling for arrays 
            if($is_list) $parts[] = $this->toJSON($value); /* :RECURSION: */ 
            else $parts[] = '"' . $key . '":' . $this->toJSON($value); /* :RECURSION: */ 
        } else { 
            $str = ''; 
            if(!$is_list) $str = '"' . $key . '":'; 

            //Custom handling for multiple data types 
            //if(is_numeric($value)) $str .= $value; //Numbers 
            //elseif($value === false) $str .= 'false'; //The booleans 
            //elseif($value === true) $str .= 'true'; 
            //else
             $str .= '"' . addslashes($value) . '"'; //All other things 

            $parts[] = $str; 
        } 
    } 
    $json = implode(',',$parts); 
     
    if($is_list) return '[' . $json . ']';//Return numerical JSON 
    return '{' . $json . '}';//Return associative JSON 

}

/*
* Helper function to convert array into XML Document
*/

function toXML($array, $wrap="DATA", $upper=true) {
	
    // set initial value for XML string
    $xml = '';
    // wrap XML with $wrap TAG
    if ($wrap != null) {
        $xml .= "<$wrap>\n";
    }
    // main loop
    foreach ($array as $key=>$value) {
        // set tags in uppercase if needed
        if ($upper == true) {
            $key = strtoupper($key);
        }
        // append to XML string
        $xml .= "<$key>" . htmlspecialchars(trim($value)) . "</$key>";
    }
    // close wrap TAG if needed
    if ($wrap != null) {
        $xml .= "\n</$wrap>\n";
    }
    // return prepared XML string
    return $xml;
}

}

?>
