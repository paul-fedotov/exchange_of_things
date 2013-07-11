<?php
	session_start();
	include ('cr.php');
	$tabl=new PDO('mysql:host=localhost;dbname=SWAG','admin','admin');
	function getTd($a){
		$to=explode(',',$a['toThing']);
		$from=explode(',',$a['fromThing']);
		$s='<td>';
		for($i=0;$i<count($from);$i++) $s.="<img src='gallery/getOneImage.php?id=".$from[$i]."&number=One' width='40'>";//ссылки на вещи приделать
		$s.='</td><td>&rarr;</td><td>';
		for($i=0;$i<count($to);$i++) $s.="<img src='gallery/getOneImage.php?id=".$to[$i]."&number=One' width='40'>";//ссылки на вещи приделать
		$s.='</td>';
		return $s;
	}
	function getTable($tabl,$arr,$vec){
		$s="<table><tr class='shapka'><td>Ваши вещи</td><td></td><td>Не ваши вещи</td><td>".((!$vec)?'Кому предложено':'Кто предложил')."</td><td></td></tr>";
		for($i=0;$i<count($arr);$i++) {
			$st=$tabl->prepare("SELECT login FROM users WHERE user_id=:D");
			if (!$vec) { 
				$st->bindValue(':D',$arr[$i]['toUser']);
			} else $st->bindValue(':D',$arr[$i]['fromUser']);
			$st->execute();
			$a=$st->fetch(PDO::FETCH_ASSOC);
			$s.='<tr>'.getTd($arr[$i]).'<td>'.dsCrypt($a['login'],true)."</td></tr><tr colspan='4'><td>Комментарий</td><td>".$arr[$i]['comments'].'</td></tr>';//+да/нет
		}
		$s.='</table>';
		return $s;
	}
	function getInfo($tabl){
		$stFrom=$tabl->prepare("SELECT * FROM exchanges WHERE fromUser=:D");
		$stFrom->bindValue(':D',$_SESSION['id']);
		$stFrom->execute();
		$from=$stFrom->fetchAll(PDO::FETCH_ASSOC);
		$s='<h3>Ваши предложения:</h3><br>'.getTable($tabl,$from,0);
		$stTo=$tabl->prepare("SELECT * FROM exchanges WHERE toUser=:D");
		$stTo->bindValue(':D',$_SESSION['id']);
		$stTo->execute();
		$to=$stTo->fetchAll(PDO::FETCH_ASSOC);
		$s.='<h3>Вам предложили:</h3><br>'.getTable($tabl,$to,1);
		echo $s;
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
	<script type="text/javascript" src="/gallery/item.js"></script>
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
getInfo($tabl);
		echo <<<str
		</div>
  </div>
	<div class="comments" id="itemComments">
		Комменты<br>coming soon
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