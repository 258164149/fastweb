<?php
/**
 * Created by PhpStorm.
 * User: xufusheng
 * Date: 2019/1/17
 * Time: 15:59
 * https工具类
 */

class HttpUtils
{
    public  static  function curl_upload($url,$upload_file_path){

        $url = "https://api6.xcx01.5067.org/get_img.php";
        $post_data = array(
         //   "json" => "@E:/mywork/www/bdb/ftp.txt"
            "json" => "@".$upload_file_path//要上传的本地文件地址
        );
        $ch = curl_init();
        curl_setopt($ch , CURLOPT_URL ,$url);
        curl_setopt($ch , CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch , CURLOPT_POST, 1);
        curl_setopt($ch , CURLOPT_POSTFIELDS, $post_data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);//让其不验证ssl证书
        $output = curl_exec($ch);
    //4.错误判断
        if ($output === FALSE){
            echo 'cURL Error:'.curl_error($ch);
        }
       //5.返回cURL执行过程中相关信息(方便调试和查错)
        $info = curl_getinfo($ch);
        curl_close($ch);
        echo $output;
       //curl_close($ch);

}
    public static function download($file_name,$file_dir)
    {

           $file_name_old = $file_name;     //下载文件名
          $file_name=iconv('UTF-8','GB2312',$file_name_old);

          $file_dir = "";        //下载文件存放目录
           //检查文件是否存在
        if (! file_exists ( $file_dir . $file_name )) {

            header('HTTP/1.1 404 NOT FOUND');
        } else {
            //以只读和二进制模式打开文件
            $file = fopen ( $file_dir . $file_name, "rb" );

            //告诉浏览器这是一个文件流格式的文件
            Header ( "Content-type: application/octet-stream" );
            //请求范围的度量单位
            Header ( "Accept-Ranges: bytes" );
            //Content-Length是指定包含于请求或响应中数据的字节长度
            Header ( "Accept-Length: " . filesize ( $file_dir . $file_name ) );
            //用来告诉浏览器，文件是可以当做附件被下载，下载后的文件名称为$file_name该变量的值。
            Header ( "Content-Disposition: attachment; filename=" .$file_name_old);

            //读取文件内容并直接输出到浏览器
            echo fread ( $file, filesize ( $file_dir . $file_name ) );
            fclose ( $file );
            exit ();
        }


    }
}