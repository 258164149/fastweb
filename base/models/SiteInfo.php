<?php

class SiteInfo
{
    var $WebName;
    var $WebUrl;
    var $BeiAnHao;
    var $RcKeywords;
    var $MobileUrl;
    var $HasKefu;
    var $LockWindow;
    var $MobileImg;
    var $CodeImg;
    var $CodeRemark;
    var $WebTitle;
    var $WebKeywords;
    var $WebDesc;
    var $WebAuthor;
    var $LinkName;
    var $Tel;
    var $Fax;
    var $Phone;
    var $Address;
    var $Email;
    var $QQHao;
    var $HeadCode;
    var $FootCode;

    public static function Load($Lang)
    {
        $SiteInfo = new SiteInfo;
        $xml = simplexml_load_file(dirname(__FILE__)."/../data/lang_$Lang.config");
        $SiteInfo->WebName = $xml->WebName;
        $SiteInfo->WebUrl = $xml->WebUrl;
        $SiteInfo->BeiAnHao = $xml->BeiAnHao;
        $SiteInfo->RcKeywords = $xml->RcKeywords;
        $SiteInfo->MobileUrl = $xml->MobileUrl;
        $SiteInfo->HasKefu = $xml->HasKefu;
        $SiteInfo->LockWindow = $xml->LockWindow;
        $SiteInfo->MobileImg = $xml->MobileImg;
        $SiteInfo->CodeImg = $xml->CodeImg;
        $SiteInfo->CodeRemark = $xml->CodeRemark;
        $SiteInfo->WebTitle = $xml->WebTitle;
        $SiteInfo->WebKeywords = $xml->WebKeywords;
        $SiteInfo->WebDesc = $xml->WebDesc;
        $SiteInfo->WebAuthor = $xml->WebAuthor;
        $SiteInfo->LinkName = $xml->LinkName;
        $SiteInfo->Tel = $xml->Tel;
        $SiteInfo->Fax = $xml->Fax;
        $SiteInfo->Phone = $xml->Phone;
        $SiteInfo->Address = $xml->Address;
        $SiteInfo->Email = $xml->Email;
        $SiteInfo->QQHao = $xml->QQHao;
        $SiteInfo->HeadCode = $xml->HeadCode;
        $SiteInfo->FootCode = $xml->FootCode;
        return $SiteInfo;
    }

    public function Save($Lang)
    {
        $fileName = dirname(__FILE__)."/../data/lang_$Lang.config";
        $xmlStr = "<?xml version=\"1.0\"?>\n";
        $xmlStr = $xmlStr . "<SiteInfo xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xmlns:xsd=\"http://www.w3.org/2001/XMLSchema\">\n";
        $xmlStr = $xmlStr."<WebName>".$this->WebName."</WebName>\n";
        $xmlStr = $xmlStr."<WebUrl>".$this->WebUrl."</WebUrl>\n";
        $xmlStr = $xmlStr."<BeiAnHao>".$this->BeiAnHao."</BeiAnHao>\n";
        $xmlStr = $xmlStr."<RcKeywords>".$this->RcKeywords."</RcKeywords>\n";
        $xmlStr = $xmlStr."<MobileUrl>".$this->MobileUrl."</MobileUrl>\n";
        $xmlStr = $xmlStr."<HasKefu>".$this->HasKefu."</HasKefu>\n";
        $xmlStr = $xmlStr."<LockWindow>".$this->LockWindow."</LockWindow>\n";
        $xmlStr = $xmlStr."<MobileImg>".$this->MobileImg."</MobileImg>\n";
        $xmlStr = $xmlStr."<CodeImg>".$this->CodeImg."</CodeImg>\n";
        $xmlStr = $xmlStr."<CodeRemark>".$this->CodeRemark."</CodeRemark>\n";
        $xmlStr = $xmlStr."<WebTitle>".$this->WebTitle."</WebTitle>\n";
        $xmlStr = $xmlStr."<WebKeywords>".$this->WebKeywords."</WebKeywords>\n";
        $xmlStr = $xmlStr."<WebDesc>".$this->WebDesc."</WebDesc>\n";
        $xmlStr = $xmlStr."<WebAuthor>".$this->WebAuthor."</WebAuthor>\n";
        $xmlStr = $xmlStr."<LinkName>".$this->LinkName."</LinkName>\n";
        $xmlStr = $xmlStr."<Tel>".$this->Tel."</Tel>\n";
        $xmlStr = $xmlStr."<Fax>".$this->Fax."</Fax>\n";
        $xmlStr = $xmlStr."<Phone>".$this->Phone."</Phone>\n";
        $xmlStr = $xmlStr."<Address>".$this->Address."</Address>\n";
        $xmlStr = $xmlStr."<Email>".$this->Email."</Email>\n";
        $xmlStr = $xmlStr."<QQHao>".$this->QQHao."</QQHao>\n";
        $xmlStr = $xmlStr."<HeadCode>".$this->HeadCode."</HeadCode>\n";
        $xmlStr = $xmlStr."<FootCode>".$this->FootCode."</FootCode>\n";
        $xmlStr = $xmlStr . "</SiteInfo>";
        file_put_contents($fileName, $xmlStr);
    }
}