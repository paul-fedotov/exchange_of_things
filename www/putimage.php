<?php
	$tabl=new PDO('mysql:host=localhost;dbname=test','root','');
	$tabl->query ('SET NAMES utf8;');
	// for($i=1;$i<=75;$i++){
		// if ($i<10) {
			// $q='00'.$i;
		// } else $q='0'.$i;
		// $image=file_get_contents('Skits/image'.$q.'.jpg');
	if ((!empty( $_FILES['image']['name']))&&($_FILES['image']['error']== 0)&&(substr($_FILES['image']['type'],0,5)=='image')){
		$image = file_get_contents( $_FILES['image']['tmp_name'] );
		if (filesize($image)<=3145728){
			$st=$tabl->prepare("INSERT INTO images(content) VALUES (:image)");
			$st->bindValue(':image',$image);
			if (!$st->execute()) var_dump($st->errorInfo());
			header('Location: first.html');
		} else var_dump('Слишком большой файл');
		// }
	}
?>