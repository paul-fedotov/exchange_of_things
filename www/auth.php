<?php
	function generated($length) {  
		$chars = 'abdefhiknrstyzABDEFGHKNQRSTYZ23456789'; // набор символов
		$count_chars = strlen ($chars); // длина строки символов  
		for ($i=0; $i<$length; $i++) {  
			$rand = rand (1,$count_chars); // генерируем случайное число от 1 до числа равному длине строки набора символов  
			$string .= substr ($chars, $rand, 1); //возвращаем строку длиной 1 символ
		}   
		return $string;
	}
	require "cr.php";
	include ("bd.php");
	$key = generated(25);
	$login = $_POST['login'];
	$pass = $_POST['password'];
	$login = trim($login);
	$pass = trim($pass);
	$pass = md5(sha1(md5($pass.$salt)).$salt);
	$login = dsCrypt ($login);
	$result = mysql_query ("SELECT user_id FROM users where login = '$login' and password = '$pass'");
	$auth = mysql_num_rows ($result);
	if ($auth == '1') {
		$result = mysql_fetch_assoc ($result);
		$key = dsCrypt($key);
		session_start();
		$_SESSION['login'] = "$login";
		$_SESSION['id'] = "$result[user_id]";
		$_SESSION['key'] = "$key";
		$_SESSION['authorized'] = 1;
		$result = mysql_query("UPDATE users SET  `key`='$key' WHERE `login`='$login'");
		if ($result) {
			echo '<script type="text/javascript">';
			echo 'window.location.href="index.php";';
			echo '</script>';
		}
		else {
			echo "Произошла ошибка авторизации попробуйте еще раз.";
			sleep(1);
			echo '<script type="text/javascript">';
			echo 'window.location.href="index.php";';
			echo '</script>';
		}
	}
	else {
		echo '<script type="text/javascript">';
		echo 'window.location.href="index.php";';
		echo '</script>';
	}
?>