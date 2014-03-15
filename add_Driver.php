<?
/* Добавляем в БД нового водителя */
$str = "INSERT INTO tbl_Drivers (name, sec_name, last_name, car, fuel) VALUES( '{$_POST['name']}' ,  '{$_POST['sec_name']}' , '{$_POST['last_name']}', '{$_POST['car']}', '{$_POST['fuel']}');";
if (!mysql_query($str)) echo 'Ошибка при добавлении в БД нового водителя: ' . mysql_error() . "<br />";
?>