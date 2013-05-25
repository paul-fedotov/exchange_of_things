<?php
	$tabl=new PDO('mysql:host=localhost;dbname=test','root','');
	$tabl->query ('SET NAMES utf8;');
	$st=$tabl->query("SELECT id FROM images ORDER BY id ASC LIMIT 1");
	$a=$st->fetch();
	if ($a['id']==$_POST['id']) {
		echo 1;
	} else echo 0;
?>