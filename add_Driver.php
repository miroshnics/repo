<?
if(!$link) die("Невозможно подключиться к серверу СУБД: " . mysql_error());

switch ($_POST['fuel']) {
case "80":
    $fuel_id = '1';
    break;
case "92":
    $fuel_id = '2';
    break;
case "95":
    $fuel_id = '3';
    break;
case "98":
    $fuel_id = '4';
    break;
case "DT":
    $fuel_id = '5';
    break;
}

/* Добавляем в БД нового водителя */
$str = "INSERT INTO tbl_Drivers (name, sec_name, last_name, car, fuel_id) VALUES( '{$_POST['name']}' ,  '{$_POST['sec_name']}' , '{$_POST['last_name']}', '{$_POST['car']}', '{$fuel_id}');";
if (!mysql_query($str)) echo 'Ошибка при добавлении в БД нового водителя: ' . mysql_error() . "<br />";
?>