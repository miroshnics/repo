<?

switch ($_POST['fuel']) {
case "80":
    $fuel = "�-80";
    break;
case "92":
    $fuel = "��-92";
    break;
case "95":
    $fuel = "��-95";
    break;
case "98":
    $fuel = "��-98";
    break;
case "DT":
    $fuel = "��";
    break;
}

/* ��������� � �� ������ �������� */
$str = "INSERT INTO tbl_Drivers (name, sec_name, last_name, car, fuel) VALUES( '{$_POST['name']}' ,  '{$_POST['sec_name']}' , '{$_POST['last_name']}', '{$_POST['car']}', '{$fuel}');";
if (!mysql_query($str)) echo '������ ��� ���������� � �� ������ ��������: ' . mysql_error() . "<br />";
?>