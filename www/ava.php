<?php
	session_start();
	$tabl=new PDO('mysql:host=localhost;dbname=SWAG','admin','admin');
	$st=$tabl->prepare('SELECT foto FROM users WHERE user_id=:D');
	$st->bindValue(':D',$_SESSION['id']);
	$st->execute();
	$a=$st->fetch(PDO::FETCH_ASSOC);
	header('Content-Type: image/png');
	if ($a) {
		echo $a['foto'];
	} else {
		echo file_get_contents('img/noImage.jpg');
	}
?>