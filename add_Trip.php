<?
if(!$link) die("Невозможно подключиться к серверу СУБД: " . mysql_error());

$time_end = $_POST['time_end'];
if ($_POST['time_end'] == "") $time_end = $_POST['sql_date_start'] . $_POST['time_start'];

$dlina = $_POST['dlina'];
if ($_POST['dlina'] == "") $dlina = 0;

/* Добавляем в БД новую поездку */
$str = "INSERT 
		INTO tbl_Trips (end_point, time_start, Driver_id, client_dept_id, client, dlina, time_end, start_point)
		VALUES( 
		'{$_POST['end_point']}' ,
		'{$_POST['sql_date_start']} {$_POST['time_start']}' ,
		'{$_POST['Driver_id']}',
		'{$_POST['client_dept_id']}',
		'{$_POST['client']}',
		'{$dlina}',
		'{$time_end}',
		'{$_POST['start_point']}');";


if (!mysql_query($str)) echo 'Ошибка при добавлении в БД новой поездки: ' . mysql_error() . "<br />";
?>