<?php

/**
 * code goes here
 */

/*
** Strategy Design Pattern
*/
interface FormatInterface
{
    public function start();

    public function formatProduct(array $product);

    public function finish();
}

class JsonStringOutput implements FormatInterface
{
    public function start() {
        echo '<br><br>++JSON STRING OUTPUT START() <br>';
    }

    public function formatProduct(array $product) {
        echo '<br><br>++JSON STRING OUTPUT FORMAT-PRODUCT() <br>';
        echo json_encode($product);
    }

    public function finish() {
        echo '<br><br>++JSON STRING OUTPUT FINISH() <br>';


    }
}

class XMLOutput implements FormatInterface
{
    public function start() {
        echo '<br><br>++XMLOutput OUTPUT START() <br>';
    }

    public function formatProduct(array $product) {
        echo '<br><br>++JXMLOutput OUTPUT FORMAT-PRODUCT() <br>';
        $xml = new SimpleXMLElement('<root/>');
        array_walk_recursive($product, array ($xml, 'addChild'));
        echo $xml->asXML();
    }

    public function finish() {
        echo '<br><br>++XMLOutput OUTPUT FINISH() <br>';


    }
}

class CSVOutput implements FormatInterface
{
    public function start() {
        echo '<br><br>++CSVOutput OUTPUT START() <br>';
    }

    public function formatProduct(array $product) {
        echo '<br><br>++CSVOutput OUTPUT FORMAT-PRODUCT() <br>';
        echo ($product);
    }

    public function finish() {
        echo '<br><br>++JCSVOutput OUTPUT FINISH() <br>';


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
        //echo '**** setProducts';
        //var_dump($products);
        $this->products = $products;
        //var_dump($this->products);
    }

    public function setFormat(FormatInterface $format)
    {
        $this->format = $format;
    }

    public function format()
    {
        echo $this->format->start();
        // foreach ($this->products as $product) {
        //     echo $this->format->formatProduct($product);
        // }

        echo $this->format->formatProduct($this->products);

        echo $this->format->finish();
    }

    
}


