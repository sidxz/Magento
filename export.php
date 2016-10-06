<?php

/**
 *
 *
 * The goal of this mini-project is to develop some PHP classes
 * that allow Magento product information to be displayed in several
 * different formats (CSV, XML, and JSON). Each record should ONLY include
 * the sku, product name, price, and short description.
 *
 * The CSV format must have a header row sku,name,price,short_description
 * 
 * You are not allowed to use any of the built-in PHP encoding functions (i.e. json_encode, SimpleXML, etc)
 *
 * You will be connecting to a Magento store that sells personalized greeting cards.
 * Be sure to use the SOAP V1 protocol.
 * It will take more than 1 API call to retreive the neccessary product information
 *
 * Magento API docs: http://www.magentocommerce.com/api/soap/introduction.html
 *
 * There are 2 external files that are included into this script.
 * 1. raz-lib.php -  provided classes and interfaces
 * 2. dev-lib.php - Where you should put any of your classes
 *
 * Feel free to email me if you have any questions
 *
 */

require_once 'raz-lib.php';
require_once 'dev-lib.php';

$apiUrl = 'http://www.wellpennedgreetings.com/api/?wsdl';
$apiUser = 'dev-test';
$apiKey = 'SsdqpVN7wNdAmj';
$formatKey = 'csv'; // I should be able to change this to csv, xml, or json to adjust outputted format

// Logic for gathering product data goes here
// Connect to SOAP API using PHP's SoapClient class
// Feel free to create your own classes to simplify multiple API calls
$soap = new SoapClient($apiUrl);
// ...
// ...

// Output logic goes here, most will be encapsulated in your classes
// View ProductOutput in raz-lib.php for help on what else goes here
$factory = new FormatFactory(); // You will need to create this class. Be sure to use constants for the format keys!
$format = $factory->create($formatKey);
$output = new ProductOutput();
// ...
// ...
$output->format();
