<?
if(!$link) die("���������� ������������ � ������� ����: " . mysql_error());

/* ��������� � �� ����� ������� */
$str = "INSERT 
		INTO tbl_Trips (end_point, time_start, time_end, Driver_id, client_dept_id, client, dlina) 
		VALUES( 
		'{$_POST['end_point']}' ,
		'{$_POST['sql_date'] . $_POST['time_start']}' ,
		'{$_POST['last_name']}',
		'{$_POST['car']}',
		'{$fuel_id}');";


if (!mysql_query($str)) echo '������ ��� ���������� � �� ������ ��������: ' . mysql_error() . "<br />";

echo $_POST['end_point'] . $_POST['date_start'] . $_POST['time_start'] . $_POST['Driver_id'] . "<br />";
?>