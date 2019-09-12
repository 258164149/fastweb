<?php
 
header("Content-Type: text/html;charset=utf-8");
echo $str= '你好,这里是卖咖啡!';
echo '<br />';

echo iconv('GB2312', 'UTF-8', $str);      //将字符串的编码从GB2312转到UTF-8
echo '<br />';

echo iconv_substr($str, 1, 1, 'UTF-8');   //按字符个数截取而非字节
print_r(iconv_get_encoding());            //得到当前页面编码信息

echo iconv_strlen($str, 'UTF-8');         //得到设定编码的字符串长度
//也有这样用的
$content = iconv("UTF-8","gbk//TRANSLIT",$content);
