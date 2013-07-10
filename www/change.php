<?php
session_start();
if ($_SESSION['authorized'] == 1) {
if (isset($_POST['name'])){//Если существует имя
    $name = $_POST['name'];
    $name = stripslashes($name);
    $name = htmlspecialchars($name);
    $name = trim($name);//удаляем все лишнее
    
    if ($name == '') {
      exit("Вы не ввели имя<br><a class='btn btn-large btn-primary' href='cabinet.php'>Вернуться назад</a>");
    }
	
    $sql = mysql_query("UPDATE users SET name='$name' WHERE id=$_SESSION['id_user']");//обновляем имя
	if ($sql) {
	    exit("Изменения сохранены!<br><a class='btn btn-large btn-primary' href='cabinet.php'>Вернуться в кабинет</a>");
	}
	else {
	    exit("Ошибка изменения. Изменения не сохранены!<br><a class='btn btn-large btn-primary' href='cabinet.php'>Вернуться назад</a>");
	}
}
else {
}
else {
}
else {
}
else {
}
}
else {
echo '<script type="text/javascript">';
echo 'window.location.href="index.html";';
echo '</script>';
}
?>