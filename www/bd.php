<?php
// $dbh = mysql_connect('localhost', 'admin', 'admin') or die("�� ���� ����������� � MySQL.");
$dbh = mysql_connect('localhost', 'root', '') or die("�� ���� ����������� � MySQL.");
mysql_select_db('swag') or die("�� ���� ������������ � ����.");
?>