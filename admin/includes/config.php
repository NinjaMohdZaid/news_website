<?php
define('DB_SERVER','localhost');
define('DB_USER','u295837195_in360_news');
define('DB_PASS' ,'7;$ZA:T#Ng#');
define('DB_NAME','u295837195_in360_news');
$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
// Check connection
if (mysqli_connect_errno())
{
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>