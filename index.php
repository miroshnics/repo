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
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] == 'add_Driver') require 'add_Driver.php';

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
<a href="init.php"><input type="button" value="������� ���� ������" /></a>
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
$result = mysql_query("SELECT * FROM tbl_Drivers");
if(!$result)
    echo '�� ������� �������� ������ ������� tbl_Drivers: ' . mysql_error();
elseif (is_null($result)){
	echo '<table frame="border" rules="all" cellpadding="3px" cellspacing="0" >';
	while ($row = mysql_fetch_row($result)) {
		echo '<tr>';
		foreach ($row as $value)
			echo "<td>$value</td>";
		echo '</tr>';
	}
	echo "</table>";
}

?>

<? require 'add_Driver_Form.php' ?>

</div>

<? /* ��������� ���������� */
    mysql_close($link); ?>

</body>
</html>