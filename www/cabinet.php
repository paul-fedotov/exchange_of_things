<?php
session_start();
if ($_SESSION['authorized'] == 1) {
echo <<<lk
<html>
<head>
<link href="css/bootstrap.css" rel="stylesheet">  
<meta http-equiv="content-type" content="text/html" charset="UTF-8">
<meta name="description" content="ЛК">
<script type="text/javascript" src="/gallery/gallery.js"></script>
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
<body onLoad="pageLoad()">
		<div class="gallery">
			<h3 class="form-signin-heading">Ваши вещи</h3>
			<table id="tableOut" align="center"></table>
			<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
		</div>
    <div class="container">
	<form class="form-signin" action="change.php" method="POST" autocomplete="off" >
        <h3 class="form-signin-heading">Изменение пароля</h3>
        <input name="password" type="password" class="input-block-level" placeholder="Пароль" required>
		<input name="re-password" type="password" class="input-block-level" placeholder="Введите еще раз пароль" required>
	    <h3 class="form-signin-heading">Изменение почты</h3>
        <input name="password" type="password" class="input-block-level" placeholder="email">
        <h3 class="form-signin-heading">Изменение имени</h3>
        <input name="password" type="password" class="input-block-level" placeholder="name">
        <h3 class="form-signin-heading">Изменение телефона</h3>
        <input name="password" type="password" class="input-block-level" placeholder="telephone">
        <h3 class="form-signin-heading">Изменение города</h3>
		<select name="city">
		<option selected disabled="">Выберите город</option>
		<option value="Москва">Москва</option>
		<option value="Санкт-Петербург">Санкт-Петербург</option>
		</select>
		<button class="btn btn-large btn-primary" type="submit">Изменить данные</button>
	  </form>
    </div>
</body>
</html>
lk;
}
else {
	echo '<script type="text/javascript">';
	echo 'window.location.href="index.php";';
	echo '</script>';
}
?>