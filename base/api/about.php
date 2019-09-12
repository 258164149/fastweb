<?php
/**
 * Created by PhpStorm.
 * User: waypdc
 * Date: 2018/12/14
 * Time: 17:19
 */
error_reporting(0);//错误等级
//adodb.inc.php包含所有数据库类包含的使用函数，必须加载
require_once '../lib/adodb5/adodb.inc.php';
//创建连接对象，接受使用的数据库
$conn = NewADOConnection('mysql');
$conn->Connect('localhost', 'root', 'root', 'base')or die("df"); //连接MySQL数据库
//开始连接mysql数据库了
//设置字符编码
$conn->Execute("set names utf8");
$res = $conn->Execute("select * from user");
if (!$res){
     echo $conn->ErrorMsg();
}else{
    while (!$res->EOF) {
// 秀出所有字段，$FieldCount() 会传回字段总数
        for ($i=0, $max=$res->FieldCount(); $i < $max; $i++) {

            print $res->fields[$i] . " ";
        }
// 移至下一笔记录
        $res->MoveNext();
// 换列
        echo "<br>\n";

}
}








