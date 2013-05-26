<?php	
	if (isset($_GET['id'])){
		$tabl=new PDO('mysql:host=localhost;dbname=SWAG','root','');//admin/admin 
		$st=$tabl->prepare("SELECT puctureOne as content FROM things WHERE id=:D");
		$st->bindValue(':D',$_GET['id']);
		if (!$st->execute()) var_dump($st->errorInfo());
		$a=$st->fetch(PDO::FETCH_ASSOC);
		header('Content-Type: image/gif');
		echo $a['content'];
	}
?>