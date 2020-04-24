<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2020/2/25
 * Time: 14:21
 */

$str=trim('测试    ');//半角空格
$str2=trim("测试    ");                 //全角空格

echo $str.'字符串';
echo "<br>".$str2.'字符串';
echo '<br/>'.unicode_encode($str);
echo '<br />'.unicode_encode($str2);




//字符串转Unicode编码
function unicode_encode($strLong) {
    $strArr = preg_split('/(?<!^)(?!$)/u', $strLong);//拆分字符串为数组(含中文字符)
    $resUnicode = '';
    foreach ($strArr as $str)
    {
        $bin_str = '';
        $arr = is_array($str) ? $str : str_split($str);//获取字符内部数组表示,此时$arr应类似array(228, 189, 160)
        foreach ($arr as $value)
        {
            $bin_str .= decbin(ord($value));//转成数字再转成二进制字符串,$bin_str应类似111001001011110110100000,如果是汉字"你"
        }
        $bin_str = preg_replace('/^.{4}(.{4}).{2}(.{6}).{2}(.{6})$/', '$1$2$3', $bin_str);//正则截取, $bin_str应类似0100111101100000,如果是汉字"你"
        $unicode = dechex(bindec($bin_str));//返回unicode十六进制
        $_sup = '';
        for ($i = 0; $i < 4 - strlen($unicode); $i++)
        {
            $_sup .= '0';//补位高字节 0
        }
        $str =  '\\u' . $_sup . $unicode; //加上 \u  返回
        $resUnicode .= $str;
    }
    return $resUnicode;
}


//$str = addslashes('Shanghai is the "biggest" city in China.');
//get_magic_quotes_gpc();
//$value = mysql_real_escape_string($str);

//echo($value);