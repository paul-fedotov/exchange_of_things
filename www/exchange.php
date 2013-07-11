<?php
	session_start();
	function getTd($a){
		if (!is_null($a)){
			$q="<td><input type='checkbox' name='".$a['id']."'><img src='gallery/getOneImage.php?id=".$a['id']."&number=One' width='40'>".$a['thingType']." : ".$a['name']."</td>";
		} else $q='<td></td>';
		return $q;
	}
	function checkId($tabl,$id){
		$st=$tabl->prepare("SELECT user_id FROM things WHERE id=:D");
		$st->bindValue(':D',$id);
		$st->execute();
		$a=$st->fetch(PDO::FETCH_ASSOC);
		if ($a['user_id']==$_SESSION['id']) {
			$sost=true;
		} else $sost=$a['user_id'];
		return $sost;
	}
	include 'temp.php';
	$tabl=new PDO('mysql:host=localhost;dbname=SWAG','admin','admin');
	function prepEx($tabl){
		if (checkId($tabl,$_GET['id'])===true) {
			echo 'Нельзя поменяться с самим собой';//выводим сообщение об ошибке
		} else {
			$stLeft=$tabl->prepare("SELECT id,thingType,name FROM things WHERE user_id=:D");
			$stLeft->bindValue(':D',$_SESSION['id']);
			$stLeft->execute();
			$stRight=$tabl->prepare("SELECT id,thingType,name FROM things WHERE user_id=(SELECT user_id FROM things WHERE id=:D)");
			$stRight->bindValue(':D',$_GET['id']);
			$stRight->execute();
			$arrRight=$stRight->fetchAll(PDO::FETCH_ASSOC);
			$arrLeft=$stLeft->fetchAll(PDO::FETCH_ASSOC);
			if (count($arrLeft)<count($arrRight)){
				$len=count($arrRight);
			} else $len=count($arrLeft);
			$s="<form method='POST' id='exForm'><a class='btn btn-primary btn-large' onclick=document.getElementById('exForm').submit(); return false;>Предложить обмен</a><br><table class='exchangeTable'>";
			for ($i=0;$i<$len;$i++) $s.='<tr>'.getTd($arrLeft[$i]).getTd($arrRight[$i]).'</tr>';
			$s.='</table></form>';
			echo $s;
		}
	}
	function add($tabl){
		if (!empty($_POST)){
			if ((!empty($_POST))&&(checkId($tabl,$_GET['id'])!==true)) {
				$left = Array();
				$right = Array();
				foreach ($_POST as $q => $v)
					if ($v=='on') {
						if (checkId($tabl,$q)===true) {
							$left[]=$q;
						} else $right[]=$q;
					}
				if (empty($left)) echo "<div class='error'>Не выбраны вещи к обмену</div>";
				if (empty($right)) echo "<div class='error'>Не на что менять</div>";
				if ((!empty($left))&&(!empty($right))){
					$st=$tabl->prepare("INSERT INTO exchanges(toUser,fromUser,toThing,fromThing) VALUES (:tU,:fU,:tT,:fT)");
					$st->bindValue(':tU',checkId($tabl,$_GET['id']));
					$st->bindValue(':fU',$_SESSION['id']);
					$st->bindValue(':tT',implode(',',$right));
					$st->bindValue(':fT',implode(',',$left));
					$st->execute();
					echo "<div class='unerror'>Предложение об обмене отослано</div>";
				} 
			}
		} else prepEx($tabl);
	}
if ($_SESSION['authorized'] == 1) {
	require_once('temp.php');
	echo <<<str
		<html>
<head>
<link href="css/bootstrap.css" rel="stylesheet">  
<title> Добро пожаловать </title>
	<script type="text/javascript" src="/js/jquery.js"></script>
	<script type="text/javascript" src="/js/scripts.js"></script>
	<meta http-equiv="content-type" content="text/html" charset="utf-8">
</head>
<body onload="loadPuctures()">
  <div class="navbar">
		<div class="navbar-inner">
			<a class="brand"><h2 class="form-signin-heading">Картинка</h2></a>
str;
	
	if ($_SESSION['authorized']==1) {
		$item = new template('tpl/afterAuthForm.tpl');
		$item->assign('src','ava.php');
		echo $item->getHTML();
	} else echo file_get_contents('tpl/authForm.tpl');
	echo <<<str
	</div>
  </div>
  <div class="container">
		<div class="span13">
			
str;
	add($tabl);
	echo <<<str
			
		</div>
  </div>
	<div class="comments" id="itemComments">
		Комменты
	</div>
  <div class="navbar navbar-fixed-bottom"> А тут подвал </div>
</body>
</html>
str;
} else {
	echo '<script type="text/javascript">';
	echo 'window.location.href="index.php";';
	echo '</script>';
}
?>