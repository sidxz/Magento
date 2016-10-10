<?php
#Define constants 
define('JSON', 'json'); 
define('XML', 'xml'); 
define('CSV', 'csv'); 


require_once 'raz-lib.php';
/*
 * This is build in a factory design pattern.
 * This class creates an object of the format type specified by $formatKey using 
 * corresponding classes from raz-lib
 * Note that json, csv and xml are defined as constants in the beginning of the script. 
 * These objects are then returned to the strategy design pattern
*/

class FormatFactory {

	public static function create($formatKey) {
		$format = null;

		switch ($formatKey) {
			case JSON:
				return new JsonStringOutput();
			case XML:
				return new XMLOutput();
			case CSV:
				return new CSVOutput();
			default:
				throw new \InvalidArgumentException("Unsupported format [$formatKey]");
		}
	}

}


?>
