<?php
print_r($_FILES);
exit();
if($_FILES){
    $filename = $_FILES['json']['name'];
    $tmpname = $_FILES['json']['tmp_name'];
    if(move_uploaded_file($tmpname,dirname(__FILE__).'/'.$filename)){
        echo json_encode('上传成功');
    }else{
        $data = json_encode($_FILES);
        echo $data;
    }
}else{


    if($_POST){
        $txt = $_POST['json'];
        print_r("txt:".$txt);
        $myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
        fwrite($myfile, $txt);
        fclose($file);
    }else{
        echo 'error';
    }

}


//

//生成静态文件

?>