<?php
session_start();
include ('bd.php');
include ('cr.php');
if ($_SESSION['authorized'] == 1) {
//Если существует имя
    $name  = $_POST['name'];
    $name  = stripslashes($name);
    $name  = htmlspecialchars($name);
    $name  = trim($name);//удаляем все лишнее
	$phone = $_POST["phone"];
	$phone = trim($phone);
	$id    = $_SESSION['id'];	
	$phone = dsCrypt($phone);
    if (($name == '') && ($phone == '')) {
      echo"Вы не ввели данные<br><a class='btn btn-large btn-primary' href='cabinet.php'>Вернуться назад</a>";

    }
	else {
    $sql = mysql_query("UPDATE users SET name='$name',phone='$phone' WHERE user_id='$id'");//обновляем имя
	if ($sql) {
	    echo"Изменения сохранены!<br><a class='btn btn-large btn-primary' href='cabinet.php'>Вернуться в кабинет</a>";
	}
	else {
	    echo"Ошибка изменения. Изменения не сохранены!<br><a class='btn btn-large btn-primary' href='cabinet.php'>Вернуться назад</a>";
	
	}
	}
}
else {
echo '<script type="text/javascript">';
echo 'window.location.href="index.html";';
echo '</script>';
}
?>
<html>
<head>
    <title>Результат загрузки файла</title>
    <link href="css/bootstrap.css" rel="stylesheet"> 
	<meta http-equiv="content-type" content="text/html" charset="utf-8">
</head>
<body>
</body>
</html>