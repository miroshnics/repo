<?
require 'login.php';
/* ����������� � �������� ���� */
$link = mysql_connect($dblocation, $dbuser, $dbpasswd)
	or die("���������� ������������ � ������� ����: " . mysql_error());
	
/* ������������ � �� */
if (!mysql_select_db($dbname, $link)) {
    echo('�� ������� ������� ���� ' . $dbname . ': ' . mysql_error() . "<br />");
}

/* ���������� ������ ��������� ����, ���� ���� POST-������ */
if ($_SERVER['REQUEST_METHOD'] == 'POST')
	switch ($_POST['action']) {
	case 'add_Driver':
		require 'add_Driver.php';
		break;
	case 'add_Trip':
		require 'add_Trip.php';
		break;
}
?>

<html>
<head>
<title>������-��������� ���������</title>
<link rel="stylesheet" href="styles.css">
<script type="text/javascript" src="scripts.js"></script>
</head>

<body>
<h2 align="center">������-��������� ���������</h2>

<div id="main_table_div">

<? 
$str = "SELECT
	tbl_Trips.id as trip_id,
	tbl_Trips.start_point as start_point,
	tbl_Trips.end_point as end_point,
	tbl_Trips.time_start as time_start,
	tbl_Trips.time_end as time_end,
	tbl_Trips.dlina as dlina,
	tbl_Trips.client as client,
	
	tbl_Drivers.name as Driver_name,
	tbl_Drivers.sec_name as Driver_sec_name,
	tbl_Drivers.last_name as Driver_last_name,
	
	tbl_Depts.name as Dep_name,
	tbl_Depts.color as Dep_color
	
	FROM tbl_Trips, tbl_Drivers, tbl_Depts
	
	WHERE 
		(TO_DAYS(NOW()) - TO_DAYS(tbl_Trips.time_start) = 0)
		AND (tbl_Trips.Driver_id = tbl_Drivers.id)
		AND (tbl_Trips.client_dept_id = tbl_Depts.id);";

$Day_trips = mysql_query($str);
if (!$Day_trips) {
    echo '������ MySQL, �� ������� �������� ������ ������: ' . mysql_error();
} elseif (!is_null($Day_trips)){
	echo '<table frame="border" rules="all" cellpadding="3px" cellspacing="0" >';
	while ($row = mysql_fetch_row($Day_trips)) {
		echo '<tr>';
		foreach ($row as $value)
			echo "<td>$value</td>";
		echo '</tr>';
	}
	echo "</table>";
}


?>

<table id="mtbl_days" frame="border" rules="all" cellpadding="2px" cellspacing="2px" >
	<tr><td>&nbsp;</td>
	<td id="mtbl_td_header">
		<table id="mtbl_header" frame="border" rules="all" cellpadding="2px" cellspacing="2px" ><tr>
		<td>Driver_1</td>
		<td>Driver_2</td>
		<td>Driver_3</td>
		</tr></table></td>
	</tr>
	<tr>
		<td>15.03<br>�������</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>16.03<br>�����</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>17.03<br>�������</td>
		<td>&nbsp;</td>
	</tr>
</table>

</div>

<div id="r_sidebar">
<a href="create_db.php"><input type="button" value="������� ���� ������" /></a>
<a href="init.php"><input type="button" value="���������������� ���� ������" /></a>
<a href="uninit.php"><input type="button" value="������� ���� ������" /></a>
<br />
  
<?

/* �������� ��� �� �� ������ ������� 
	$DBs = mysql_query("SHOW DATABASES");
	
	$N = 0;
	while ($row = mysql_fetch_assoc($DBs)) {
		echo "<br />" . $row['Database'];
		$N++;
	}
	echo "<br />����� ��� ������: " . $N . "<hr />";*/
 

/* �������� ��� ������� � ����� �� */
$result = mysql_query("SHOW TABLES FROM " . $dbname);
if (!$result) {
    echo '������ MySQL, �� ������� �������� ������ ������: ' . mysql_error();
} else {
	$N = 0;
	echo "<span style=\"color: 505050;\">������� �� {$dbname}:</span><span> ";
	while ($row = mysql_fetch_row($result)) {
		echo "{$row[0]}, ";
		$N++;
	}
	echo " </span><span style=\"color: 505050;\">(����� " . $N . ")</span><hr />";
}

/* �������� ��� ������ ������� tbl_Drivers */
$str = "SELECT 
	tbl_Drivers.id as Driver_id, 
	tbl_Drivers.name as name, 
	tbl_Drivers.sec_name as sec_name,
	tbl_Drivers.last_name as last_name,
	tbl_Drivers.car as car,
	tbl_Fuels.type_name as fuel_type_name,
	tbl_Fuels.cost as fuel_cost
	FROM tbl_Drivers, tbl_Fuels
	WHERE tbl_Drivers.fuel_id = tbl_Fuels.id
	ORDER by Driver_id asc;";
$sql_drivers = mysql_query($str);
if(!$result)
    echo '�� ������� �������� ������ ������� tbl_Drivers: ' . mysql_error();
elseif (!is_null($sql_drivers)){
	echo '<table id="drivers" frame="border" rules="all" cellpadding="3px" cellspacing="0" >';
	$N_sql_drivers = 0;
	while ($row = mysql_fetch_assoc($sql_drivers)) {
		$N_sql_drivers ++;
		echo "<tr>"
		 . "<td>{$row['Driver_id']}</td>"
		 . "<td>{$row['name']}</td>"
		 . "<td>{$row['sec_name']}</td>"
		 . "<td>{$row['last_name']}</td>"
		 . "<td>{$row['car']}</td>"
		 . "<td>{$row['fuel_type_name']}</td>"
		 . "<td>{$row['fuel_cost']}</td>"
		 . "</tr>";
	}
	echo "</table>";
}

/* �������� ��� ������ ������� tbl_Depts */
$str = "SELECT
	tbl_Depts.name as name,
	tbl_Depts.color as color
	FROM tbl_Depts;";
$sql_depts = mysql_query($str);
if(!$result)
    echo '�� ������� �������� ������ ������� tbl_Depts: ' . mysql_error();
elseif (!is_null($sql_drivers)){
	echo '<table id="depts" frame="border" rules="all" cellpadding="3px" cellspacing="0" >';
	$N_sql_depts = 0;
	while ($row = mysql_fetch_assoc($sql_depts)) {
		$N_sql_drivers ++;
		echo "<tr>"
		 . "<td style=\"background: #{$row['color']}\">{$row['name']}</td>"
		 . "</tr>";
	}
	echo "</table>";
}
?>
<hr width="100%" />
<? require 'add_Driver_Form.php' ?>
<? require 'add_Trip_Form.php' ?>

</div>

<? /* ��������� ���������� */
    mysql_close($link); ?>

</body>
</html>