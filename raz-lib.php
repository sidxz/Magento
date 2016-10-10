<?php
require_once 'conversions.php';

/*************************
** Strategy Design Pattern
**************************/
interface FormatInterface
{
    public function start();

    public function formatProduct(array $product);

    public function finish();
}



class JsonStringOutput implements FormatInterface
{   
   /*
    *  All json objects start with [
    */
    public function start() {
        echo '[';
    }

    public function formatProduct(array $product) {
        $conversion = new Conversions();
        echo $conversion->toJSON($product);
    }

    public function finish() {
        echo ']';
    }
}

class XMLOutput implements FormatInterface
{
    /*
    * It's important to pass proper header information for XML Documents
    * The best way is to pass them in the start(), as this is the first thing
    * that will be executed by the script.
    */
    public function start() {
        header("Content-type: text/xml; charset=utf-8");
        echo "<XML>";
    }

    public function formatProduct(array $product) {
        //var_dump($product);
        $conversion = new Conversions();
        //echo "<br>";    
        echo $conversion->toXML($product);
    }

    public function finish() {
        echo "</XML>";

    }
}

class CSVOutput implements FormatInterface
{
    /*
    * Pass CSS Headers, Browsers like chrome and firefox will identify this and start a file 
    * download.
    * We are also setting the first row of the csv file here, as specified in the problem
    * statement.
    */
    public function start() {
        header("Content-type: text");
        header("Content-Disposition: attachment; filename=file.csv");
        header("Pragma: no-cache");
        header("Expires: 0");
        echo "sku,name,short_description,price\r\n";
    }

    public function formatProduct(array $product) {
        $conversion = new Conversions();  
        echo $conversion->toCSV($product);
    }

    public function finish() {

    }
}

/*
** This is Strategic client code
*/
class ProductOutput
{
    protected $products = array();
    /*
    * The $format is of type FormatInterface. Remember the Format interface is implemented by 
    * JsonStringOutput, XMLOutput and CSVOutput. So $fomat will hold an object belonging to either 
    * of the three classes. 
    * The format() then reffers to this object using $this->format->formatProduct(...)
    * $this->format is the object of the above type, e.g jsonStribgOutputObj->formatProduct(...)
    */ 
    protected $format;

    public function setProducts(array $products)
    {
        $this->products = $products;
    }

    public function setFormat(FormatInterface $format)
    {
        $this->format = $format;
    }

    public function format()
    {
        echo $this->format->start();
         foreach ($this->products as $product) {
             echo $this->format->formatProduct($product);
         }
        echo $this->format->finish();
    }

    
}


