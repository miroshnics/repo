<?
if(!$link) die("���������� ������������ � ������� ����: " . mysql_error());

/* ��������� � �� ����� ������� */
$str = "INSERT 
		INTO tbl_Trips (end_point, time_start, Driver_id, client_dept_id, client, dlina, time_end) 
		VALUES( 
		'{$_POST['end_point']}' ,
		'{$_POST['sql_date']} {$_POST['time_start']}' ,
		'{$_POST['Driver_id']}',
		'{$_POST['client_dept_id']}',
		'{$_POST['client']}',
		'{$_POST['dlina']}',
		'{$_POST['time_end']}');";

mysql_query($str) or die('������ ��� ���������� � �� ������ ��������: ' . mysql_error() . "<br />");
?>