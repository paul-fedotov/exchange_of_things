<?php
session_start();
if ($_SESSION['authorized'] == 1) {
echo <<<lk
<html>
<head>
<link href="css/bootstrap.css" rel="stylesheet">  
<title> ����� ���������� </title>
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
	<form class="form-signin" action="change.php" method="POST" autocomplete="off" >
        <h3 class="form-signin-heading">��������� ������</h3>
        <input name="password" type="password" class="input-block-level" placeholder="������" required>
		<input name="re-password" type="password" class="input-block-level" placeholder="������� ��� ��� ������" required>
	    <h3 class="form-signin-heading">��������� �����</h3>
        <input name="password" type="password" class="input-block-level" placeholder="email">
        <h3 class="form-signin-heading">��������� �����</h3>
        <input name="password" type="password" class="input-block-level" placeholder="name">
        <h3 class="form-signin-heading">��������� ��������</h3>
        <input name="password" type="password" class="input-block-level" placeholder="telephone">
        <h3 class="form-signin-heading">��������� ������</h3>
		<select name="city">
		<option selected disabled="">�������� �����</option>
		<option value="������">������</option>
		<option value="�����-���������">�����-���������</option>
		</select>
		<button class="btn btn-large btn-primary" type="submit">�������� ������</button>
	  </form>
    </div>
</body>
</html>
lk;
}
else {
echo '<script type="text/javascript">';
echo 'window.location.href="index.html";';
echo '</script>';
}
?>