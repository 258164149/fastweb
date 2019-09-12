<?php
/**
 * Created by PhpStorm.
 * User: 12t
 * Date: 2019/3/18
 * Time: 16:49
 */

//error_reporting(0);//错误等级
//adodb.inc.php包含所有数据库类包含的使用函数，必须加载
require_once 'E:/mywork/www/fastweb/base/lib/adodb5/adodb.inc.php';
//创建连接对象，接受使用的数据库
$conn = NewADOConnection('mysql');
$conn->Connect('localhost', 'root', 'root', 'base')or die("df"); //连接MySQL数据库
//开始连接mysql数据库了
//设置字符编码
$conn->Execute("set names utf8");
//$res = $conn->Execute("select * from user");
set_time_limit(0);
while(1){
    $order_id=rand(10000,99999);
    $mobile=rand(11111111,99999999);
   // $stmt->execute(array($order_id,$mobile,0));
    $conn->Execute("insert into order_list (order_id,mobile,status) values (".$order_id.",".$mobile.",0)");
    echo date("Y-m-d H:i:s",time())."添加了一条订单，订单号为{$order_id}，手机号为{$mobile}\n";
    sleep(2);
}