<?php

if($_FILES){
    $filename = $_FILES['json']['name'];
    $tmpname = $_FILES['json']['tmp_name'];
    $file_path=dirname(__FILE__).'/'.$filename;
    if(move_uploaded_file($tmpname,$file_path)){
       // echo json_encode('上传成功');
        //上传到别的分布式服务器

        $conn = ftp_connect("172.16.0.45") or die("Could not connect"); //连接标识ftp_connect("ftp地址")
		ftp_login($conn,"xcx5067","hj5%79M#x5k?"); //进行FTP连接ftp_login($conn,"用户名",“登录密码")
		echo ftp_put($conn,$filename,$file_path,FTP_BINARY);

     //ftp_put($conn,"上传后文件的命名.doc","指定本地要上的文件"，传输模式) *FTP_ASCII   FTP_BINARY（文件中文内容不会乱码）

		ftp_close($conn);

	   echo 1;
    }else{
        $data = json_encode($_FILES);
      //  echo $data;
	  echo 0;
    }
}else{
	 echo 3;
	 exit();

    if($_POST){

        $txt = $_POST['json'];
        $myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
        fwrite($myfile, $txt);

    }else{
        //echo 'error';
    }

}


//

//生成静态文件

?>