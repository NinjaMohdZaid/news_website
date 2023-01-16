<?php
define('DB_SERVER','bh-61');
define('DB_USER','siweiat8_newsportal');
define('DB_PASS' ,'Nb?DCrPJXW.l');
define('DB_NAME','siweiat8_newsportal');
$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
// Check connection
if (mysqli_connect_errno())
{
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>