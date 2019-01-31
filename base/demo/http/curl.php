<?php
/**
 * Created by PhpStorm.
 * User: 12t
 * Date: 2019/1/17
 * Time: 16:13
 */
use utils\HttpUtils;


HttpUtils::curl_upload("http://base.test.com/demo/http/get_img.php","ftp.txt");
echo 1;


