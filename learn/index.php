<?php


/*setcookie("username","xufusheng",3600);
$username = $_COOKIE['username'];
print_r(username);*/
 setcookie("user", "runoob", time()+3600);
//setcookie("user", "", time()-3600);
// echo "cookie is ".$_COOKIE["test"];

if (isset($_COOKIE["user"]))
    echo "welcome " . $_COOKIE["user"] . "!<br>";
else
    echo "common user<br>";


print_r($_COOKIE);
?>