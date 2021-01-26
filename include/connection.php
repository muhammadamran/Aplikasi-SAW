<?php
$conhost='localhost';
$conuser='root';
$conpassword='';
$dbname='db_saw';
$koneksi=mysql_connect($conhost,$conuser,$conpassword) or die(mysql_error());
$dbselect=mysql_select_db($dbname);
?>