<?php

class LangSet
{
    var $Content;

    public static function Load()
    {
        $LangSet = new LangSet;
        $xml = simplexml_load_file(dirname(__FILE__)."/../data/lang.config");
        $LangSet->Content = $xml->Content;
        return $LangSet;
    }

    public function Save()
    {
        $fileName = dirname(__FILE__) . "/../data/lang.config";
        $xmlStr = "<?xml version=\"1.0\"?>\n";
        $xmlStr = $xmlStr . "<LangSet xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xmlns:xsd=\"http://www.w3.org/2001/XMLSchema\">\n";
        $xmlStr = $xmlStr . "<Content>" . $this->Content . "</Content>\n";
        $xmlStr = $xmlStr . "</LangSet>";
        file_put_contents($fileName, $xmlStr);
    }
}