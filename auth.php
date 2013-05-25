<?php
include ('cr.php');
$login = $_POST['login'];
$pass = $_POST['password'];
$login = trim($login);
$pass = trim($pass);
$login = dsCrypt ($login);
$pass = $pass = md5(sha1(md5($pass.$salt)).$salt);
$result = mysql_query ("SELECT user_id FROM users where login = '$login' and password = '$password'");
$auth = mysql_num_rows ($result);
if ($auth == '1') {
// допиисать авторизацию
setcookie("login", "$login",time() + 172800);
$result = mysql_fetch_assoc ($result);
setcookie("id", "$result['id_user']", time() + 172800);
setcookie("key" , "" , time () + 172800");
echo '<script type="text/javascript">';
echo 'window.location.href="main.html";';
echo '</script>';
}
else {
echo '<script type="text/javascript">';
echo 'window.location.href="index.html";';
echo '</script>';
}
?>