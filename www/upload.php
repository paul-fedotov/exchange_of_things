<?php
session_start();	
include ('bd.php');
function get_image($num){
  global $ErrorDescription;
  static $image_size=0;
  // ��������� �� ����� �� ���������� ���������� $_FILES
  if(!empty($_FILES)){ 
    $image_size=$_FILES["file"]["size"][$num];
    // ����������� �� ������ �����, � ��� ������ 3��
    if ($image_size>1024*1024*3||$image_size==0)
    {
        $ErrorDescription="������ ����������� �� ������ ��������� 3��! 
            ����������� � ���� �� ����� ���� ���������.";
            return '';
    }
    // ���� ���� ������, �� ��������� �����������
    // �� �� (�� ����������� ������������)
    if(substr($_FILES['file']['type'][$num], 0, 5)=='image')
    {
        //������ ���������� �����
        $image=file_get_contents($_FILES['file']['tmp_name'][$num]);
        //���������� ����������� ������� � ���������� �����
        $image=mysql_escape_string($image);
        return $image;      
    }else{
        $ErrorDescription ="�� ��������� �� �����������,
            ������� ��� �� ����� ���� ���������.";
            return '';
    }    
  }else{
    $ErrorDescription="�� �� ��������� �����������, ���� ������,
        ������� ���� � ���� �� ����� ���� ��������.";
        return ;
  }
    return $image;
}
$ErrorDescription = '';

$nameCloth = $_POST['nameCloth'];
$description = $_POST['description'];
//...
// ��������� ����� ������������ ������� get_image �����������
// ���������� ���������� ������
$image1=get_image(0);
if ($image1 == ''){
    unset($image1);
}else if ($image2 == ''){
    $image2=get_image(1);
    if ($image2 == ''){
        unset($image2);
    }
}else{ 
	$image3=get_image(2);
    if ($image3 == ''){
        unset($image3);
}
}
$image2=get_image(1);
$image3=get_image(2);
// ...
// ���������, ����������� �� ����������
if (isset($nameCloth) && isset($image1)){
    /* ����� ����� ��� ����� �������� ���������� � ����.
    � ����� ������ � ���� ���������� ��� ���� ����
    MEDIUMBLOB:img_before � img_after  $_SESSION['id_user']*/
	$id = $_SESSION['id'];
    $result = mysql_query (
        "INSERT INTO things (user_id, name , description ,puctureOne,puctureTwo, puctureThree) 
        VALUES ('$id','$nameCloth','$description','$image1','$image2','$image3')");
    if ($result == 'true'){
        echo "�� ������� �������� ����";
    }else{echo "��� - �� ����� �� ���!";}
}else{
    if ($ErrorDescription == ''){
        echo "�� ����� �� ��� ����������, ������� 
            ����������� � ���� �� ����� ���� ���������.";
    }else{echo $ErrorDescription;}
}

?>
<html>
<head>
  <title>��������� �������� �����</title>
</head>
<body>
</body>
</html>