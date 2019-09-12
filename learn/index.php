<?php

/*error_reporting(0);
$con = mysql_connect("localhost","root","root");
if (!$con)
{
    die('Could not connect: ' . mysql_error());
}

mysql_select_db("test", $con);

$sql = "call  insert_data_p(1000000);";
mysql_query($sql);
/*$result = mysql_query("SELECT * FROM user");

while($row = mysql_fetch_array($result))
{
    echo $row['name'] . ": " . $row['age'];
    echo "<br />";
}*/

//mysql_close($con);

$mysqli = new mysqli("192.168.5.245", "root", "root", "b2b","3307");

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

$query  = "call  insert_data_p(100);";

$query2  = "SELECT * FROM user;";
/* execute multi query */
if ($mysqli->multi_query($query)) {
    do {
        /* store first result set */
        if ($result = $mysqli->use_result()) {
         /*   while ($row = $result->fetch_row()) {
             //   printf("%s\n", $row[1]);
            }*/
          //  $result->free_result();
            $result->close();
        }
        /* print divider */
       /* if ($mysqli->more_results()) {
         // printf("-----------------\n");
        }*/
    } while ($mysqli->next_result());
}

if ($mysqli->multi_query($query2)) {
    do {
       /* /* store first result set */
        if ($result = $mysqli->use_result()) {
            while ($row = $result->fetch_row()) {
         //       printf("%s\n", $row[1]);
            }
            $result->free_result();
         //   $result->close();
        }
        /* print divider */
     //   if ($mysqli->more_results()) {
        //    printf("-----------------\n");
     //   }*/
    } while ($mysqli->next_result());
}



/* close connection */
$mysqli->close();

exit();
//setcookie("username","xufusheng",3600);
//$username = $_COOKIE['username'];
//print_r(username);*/
// setcookie("user", "runoob", time()+3600);
//setcookie("user", "", time()-3600);
// echo "cookie is ".$_COOKIE["test"];

//if (isset($_COOKIE["user"]))
 //   echo "welcome " . $_COOKIE["user"] . "!<br>";
//else
  //  echo "common user<br>";


//print_r($_COOKIE);
?>