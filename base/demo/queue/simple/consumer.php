<?php
/**
 * Created by xufusheng.
 * User: 12t
 * Date: 2019/3/18
 * Time: 17:34
 */


require_once 'E:/mywork/www/fastweb/base/lib/adodb5/adodb.inc.php';
//$stmt=$pdo->prepare("update order_list set status=? where status=? limit 1");
//$stmt_select=$pdo->prepare("select order_id from order_list where status=1");//正在处理的订单号
$conn = NewADOConnection('mysql');
$conn->Connect('localhost', 'root', 'root', 'base')or die("df"); //连接MySQL数据库
set_time_limit(0);
while(1){
    $init=0;//初始status
    $lock=1;//标记为正在处理
    $success=2;//成功接单
    //为了保证数据的一致性，处理订单之前，要先锁定一个订单，将其status由0改为1，然后才可处理
    //处理完毕后，然后再将status从1改为2

   // $stmt->execute(array($lock,$init));//锁定要处理的订单

    $conn->Execute("update order_list set status=".$lock." where status=".$init." limit 1");

   // $result=$stmt_select->fetch(PDO::FETCH_ASSOC);//查询正在处理的订单号

    $res = $conn->Execute("select order_id from order_list where status=1");
    $order_id= $res->fields[0];
	echo "order id:".$order_id."\n";
	if($order_id==''){
		break;
	}
   // echo date("Y-m-d H:i:s")."准备处理订单，订单号为{$order_id}\n";
    sleep(3);//处理3秒

    $conn->Execute("update order_list set status=".$success." where status=".$lock." limit 1");
  //  echo date("Y-m-d H:i:s")."订单处理完成，订单号为{$order_id}\n";
    sleep(1);//休息1秒
}