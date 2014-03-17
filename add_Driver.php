<?
if(!$link) die("Невозможно подключиться к серверу СУБД: " . mysql_error());

switch ($_POST['fuel']) {
case "80":
    $fuel = 'А-80';
    break;
case "92":
    $fuel = 'АИ-92';
    break;
case "95":
    $fuel = 'АИ-95';
    break;
case "98":
    $fuel = 'АИ-98';
    break;
case "DT":
    $fuel = 'ДТ';
    break;
}

/* Добавляем в БД нового водителя */
$str = "INSERT INTO tbl_Drivers (name, sec_name, last_name, car, fuel) VALUES( '{$_POST['name']}' ,  '{$_POST['sec_name']}' , '{$_POST['last_name']}', '{$_POST['car']}', '{$fuel}');";
if (!mysql_query($str)) echo 'Ошибка при добавлении в БД нового водителя: ' . mysql_error() . "<br />";
?>