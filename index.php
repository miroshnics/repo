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
<style>span.radio:hover {background: #e0e0e0}</style>
<script type="text/javascript">function selectRadio(e) {t=e.previousSibling;if((t.tagName=='INPUT')&&(t.type=='radio')) t.click();return;}</script>
</head>

<body>
<h2 align="center">������-��������� ���������</h2>
<div style="position: relative; width: 50%; float: right;">
<a href="init.php"><input type="button" value="������� ���� ������" /></a>
<a href="uninit.php"><input type="button" value="������� ���� ������" /></a>
<a href="add_Driver.php"><input type="button" value="�������� ��������" /></a>
<br />
  
<?

/* �������� ��� �� �� ������ ������� */
	$DBs = mysql_query("SHOW DATABASES");
	
	$N = 0;
	while ($row = mysql_fetch_assoc($DBs)) {
		echo "<br />" . $row['Database'];
		$N++;
	}
	echo "<br />����� ��� ������: " . $N . "<hr />";
  
/* �������� ��� ������� � ����� �� */
$result = mysql_query("SHOW TABLES FROM " . $dbname);

if (!$result) {
    echo '������ MySQL, �� ������� �������� ������ ������: ' . mysql_error();
} else {
	$N = 0;
	while ($row = mysql_fetch_row($result)) {
		echo "�������: {$row[0]}<br />";
		$N++;
	}
	echo "<br />����� ������: " . $N . "<hr />";
}
/* �������� ��� ������ ������� tbl_Drivers */
$result = mysql_query("SELECT * FROM tbl_Drivers");
if(!$result)
    echo '�� ������� �������� ������ ������� tbl_Drivers: ' . mysql_error();
else {
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

<h2 align="center">������-���������: ���������� ��������</h2>

<form action="<?=$_SERVER['PHP_SELF']?>" method="post" >
<input type="hidden" name="action" value="add_Driver" />
<table>
<tr><td><span>���:</span></td><td><input type="textarea" size="30" name="name"></td></tr>
<tr><td><span>��������:</span></td><td><input type="textarea" size="30" name="sec_name"></td></tr>
<tr><td><span>�������:</span></td><td><input type="textarea" size="30" name="last_name"></td></tr>
<tr><td><span>����������:</span></td><td><input type="textarea" size="30" name="car"></td></tr>
<tr><td><span>��� ��������:</span></td>
<td>
	<input type="radio" name="fuel" value="80" /><span class="radio" onClick="selectRadio(this)">�-80</span>
	<input type="radio" name="fuel" value="92" /><span class="radio" onClick="selectRadio(this)">��-92</span>
	<input type="radio" name="fuel" value="95" /><span class="radio" onClick="selectRadio(this)">��-95</span>
	<input type="radio" name="fuel" value="98" /><span class="radio" onClick="selectRadio(this)">��-98</span>
	<input type="radio" name="fuel" value="DT" /><span class="radio" onClick="selectRadio(this)">��</span>
</td></tr>
<tr><td>&nbsp;</td><td><input type="submit" value="�������� ��������"></td></tr>
</table>
</form>

</div>

<? /* ��������� ���������� */
    mysql_close($link); ?>

</body>
</html>