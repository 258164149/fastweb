<?php
$xml = simplexml_load_file("test.xml");

print_r($xml->getNamespaces());
echo $xml->getName() . "<br />";

foreach($xml->children() as $child)
{
    echo $child->getName() . ": " . $child . "<br />";
}
?>