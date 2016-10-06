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
    public function start() {
        echo '[';
    }

    public function formatProduct(array $product) {
        //echo json_encode($product);
        $conversion = new Conversions();
        //echo "<br>";        
        echo $conversion->toJSON($product);
    }

    public function finish() {
        echo ']';
    }
}

class XMLOutput implements FormatInterface
{
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

        //echo $this->format->formatProduct($this->products);

        echo $this->format->finish();
    }

    
}


