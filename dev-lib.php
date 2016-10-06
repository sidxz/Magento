<?php
#Define constants 
define('JSON', 'json'); 
define('XML', 'xml'); 
define('CSV', 'csv'); 


require_once 'raz-lib.php';


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