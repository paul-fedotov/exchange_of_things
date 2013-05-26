<?php
	// $tabl=new PDO('mysql:host=localhost;dbname=SWAG','root','');
	$tabl=new PDO('mysql:host=localhost;dbname=SWAG','admin','admin');
	$tabl->query ('SET NAMES utf8;');
	$st=$tabl->query("SELECT id FROM things ORDER BY id ASC LIMIT 1");
	$a=$st->fetch();
	if ($a['id']==$_POST['id']) {
		echo 1;
	} else echo 0;
?>