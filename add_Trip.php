<?
if(!$link) die("���������� ������������ � ������� ����: " . mysql_error());

/* ��������� � �� ������ �������� */
$str = "INSERT INTO tbl_Drivers (name, sec_name, last_name, car, fuel) VALUES( '{$_POST['name']}' ,  '{$_POST['sec_name']}' , '{$_POST['last_name']}', '{$_POST['car']}', '{$fuel_id}');";
if (!mysql_query($str)) echo '������ ��� ���������� � �� ������ ��������: ' . mysql_error() . "<br />";
?>