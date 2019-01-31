<?php
$path = dirname(__FILE__);
$path = str_replace('\\','/',$path).'/';
include ($path ."/../lib/adodb5/adodb.inc.php");
$DB = @ADOnewConnection('pdo');
$DB->connect('sqlite:' . $path . '/../data/site.ascx', 'root');