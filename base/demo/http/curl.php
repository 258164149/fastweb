<?php
/**
 * Created by PhpStorm.
 * User: 12t
 * Date: 2019/1/17
 * Time: 16:13
 */
include_once "../../utils/HttpUtils.php";

//"http://base.test.com/demo/http/get_img.php";
$url = "https://mytest.xcx01.5067.org/get_img.php";
HttpUtils::curl_upload($url,"E:/mywork/www/fastweb/base/files/ftp.txt");
//HttpUtils::curl_upload("http://base.test.com/demo/http/get_img.php","ftp.txt");



