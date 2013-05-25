<?php
session_start();	
include ('bd.php');
function get_image($num){
  global $ErrorDescription;
  static $image_size=0;
  // Проверяем не пуста ли глобальная переменная $_FILES
  if(!empty($_FILES)){ 
    $image_size=$_FILES["file"]["size"][$num];
    // Ограничение на размер файла, в моём случае 3Мб
    if ($image_size>1024*1024*3||$image_size==0)
    {
        $ErrorDescription="Каждое изображение не должно привышать 3Мб! 
            Изображение в базу не может быть добавлено.";
            return '';
    }
    // Если файл пришел, то проверяем графический
    // ли он (из соображений безопасности)
    if(substr($_FILES['file']['type'][$num], 0, 5)=='image')
    {
        //Читаем содержимое файла
        $image=file_get_contents($_FILES['file']['tmp_name'][$num]);
        //Экранируем специальные символы в содержимом файла
        $image=mysql_escape_string($image);
        return $image;      
    }else{
        $ErrorDescription ="Вы загрузили не изображение,
            поэтому оно не может быть добавлено.";
            return '';
    }    
  }else{
    $ErrorDescription="Вы не загрузили изображение, поле пустое,
        поэтому файл в базу не может быть добавлен.";
        return ;
  }
    return $image;
}
$ErrorDescription = '';

$nameCloth = $_POST['nameCloth'];
$description = $_POST['description'];
//...
// Используя ранее определенную функцию get_image присваиваем
// переменным содержимое файлов
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
// Проверяем, установлены ли переменные
if (isset($nameCloth) && isset($image1)){
    /* Здесь пишем что можно заносить информацию в базу.
    В нашем случае в базе существует два поля типа
    MEDIUMBLOB:img_before и img_after  $_SESSION['id_user']*/
	$id = $_SESSION['id'];
    $result = mysql_query (
        "INSERT INTO things (user_id, name , description ,puctureOne,puctureTwo, puctureThree) 
        VALUES ('$id','$nameCloth','$description','$image1','$image2','$image3')");
    if ($result == 'true'){
        echo "Вы успешно добавили вещь";
    }else{echo "Что - то пошло не так!";}
}else{
    if ($ErrorDescription == ''){
        echo "Вы ввели не всю информацию, поэтому 
            изображения в базу не могут быть добавлены.";
    }else{echo $ErrorDescription;}
}

?>
<html>
<head>
  <title>Результат загрузки файла</title>
</head>
<body>
</body>
</html>