<?php

setcookie("user", "xufusheng", time()+3600);
 //setcookie("user","",time()-1);
// 设置 cookie 过期时间为过去 1 小时
//setcookie("user", "", time()-3600);
setcookie("user", "", time()-3600);
print_r($_COOKIE);



?>