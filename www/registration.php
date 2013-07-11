<?php
include ('cr.php');
$login = $_POST['login'];
$pass = $_POST['password'];
$re_pass = $_POST['re-password'];
$email = $_POST['email'];
$Yname = $_POST['Yname'];
$tel = $_POST['tel'];
$city = $_POST['city'];
$login = trim($login);
$pass = trim($pass);
$re_pass = trim($re_pass);
$email = trim($email);
$Yname = trim($Yname);
$tel = trim($tel);
$login = dsCrypt ($login);
$email = dsCrypt ($email);
if ($pass === $re_pass) {
//connect
include ('bd.php');
$result = mysql_num_rows(mysql_query ("Select user_id FROM users where login = '$login'"));
$result2 = mysql_num_rows(mysql_query ("Select user_id FROM users where email = '$email'"));
if ($result > 0) {
$err = "Такой логин уже занят";
}
else if ($result2 > 0) {
$err = "Такой email уже занят";
}
else {
$pass = md5(sha1(md5($pass.$salt)).$salt);
$tel = dsCrypt ($tel);
//$sql = "INSERT INTO users (name, login, password , email , rating ,foto, phone , city)  VALUES ($Yname, $login , $pass , $email , '1' , '' ,  $tel , $city)";
$result = mysql_query ("INSERT INTO users (name, login, password , email , rating ,foto, phone , city)  VALUES ('$Yname', '$login' , '$pass' , '$email' , '1' , '' ,  '$tel' , '$city')");
if (!$result) {

echo "Ошибка выполнения!";
} 
else {
		echo '<script type="text/javascript">';
		echo 'window.location.href="index.php";';
		echo '</script>';
}
}
}
else {
$err = "Пароли не совпадают!";
}

if ($err != '') {
echo <<<error
<html>
<head>
<link href="css/bootstrap.css" rel="stylesheet">
<title> Добро пожаловать </title>
</head>
<style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }
.form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
		margin-right:5%;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
</style>
<body>
    <div class="container">
      <form class="form-signin" action="registration.php" method="POST" autocomplete="off" >
        <h2 class="form-signin-heading">Please sign in</h2>
        <input name="login" type="text" class="input-block-level" placeholder="Ваш Логин"  required>
        <input name="password" type="password" class="input-block-level" placeholder="Пароль" required>
		<input name="re-password" type="password" class="input-block-level" placeholder="Введите еще раз пароль" required>
		<input name="email" type="email" class="input-block-level" placeholder="E-mail" required>
		<input name="Yname" type="text" class="input-block-level" placeholder="Ваше имя" value="$Yname" required>
		<input name="tel" type="number" class="input-block-level" placeholder="Телефонный номер" value="$tel">
		<select name="city">
		<option disabled="">Выберите город</option>
		<option selected="" value="Москва">Москва</option>
		<option value="Санкт-Петербург">Санкт-Петербург</option>
		</select>
        <button class="btn btn-large btn-primary" type="submit">Зарегистрироваться</button>
		<div class="alert alert-error">
		<h4>$err<h4>
		</div>
      </form>
    </div>
</body>
</html>
error;
}

?>