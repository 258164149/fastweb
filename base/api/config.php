<?php
header('Content-type: text/html; charset=utf-8');
@session_start();
date_default_timezone_set('Asia/Shanghai');
include dirname(__FILE__)."../init.inc.php";
include dirname(__FILE__)."./../models/DBHelper.php";
