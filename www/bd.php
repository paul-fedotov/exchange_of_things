<?php
// $dbh = mysql_connect('localhost', 'admin', 'admin') or die("Не могу соединиться с MySQL.");
$dbh = mysql_connect('localhost', 'root', '') or die("Не могу соединиться с MySQL.");
mysql_select_db('swag') or die("Не могу подключиться к базе.");
?>