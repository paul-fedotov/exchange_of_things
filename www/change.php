<?php
session_start();
if ($_SESSION['authorized'] == 1) {
if (isset($_POST['name'])){//���� ���������� ���
    $name = $_POST['name'];
    $name = stripslashes($name);
    $name = htmlspecialchars($name);
    $name = trim($name);//������� ��� ������
    
    if ($name == '') {
      exit("�� �� ����� ���<br><a class='btn btn-large btn-primary' href='cabinet.php'>��������� �����</a>");
    }
	
    $sql = mysql_query("UPDATE users SET name='$name' WHERE id=$_SESSION['id_user']");//��������� ���
	if ($sql) {
	    exit("��������� ���������!<br><a class='btn btn-large btn-primary' href='cabinet.php'>��������� � �������</a>");
	}
	else {
	    exit("������ ���������. ��������� �� ���������!<br><a class='btn btn-large btn-primary' href='cabinet.php'>��������� �����</a>");
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