<html>
<head><title>������-��������� ���������</title></head>
<? require 'login.php'; ?>
<body>
<h2 align="center">������-��������� ���������</h2>
<a href="init.php"><input type="button" value="������� ���� ������" /></a>
<a href="uninit.php"><input type="button" value="������� ���� ������" /></a>
<a href="add_Driver.php"><input type="button" value="�������� ��������" /></a>
  <br />
<? 
	  /* ����������� � �������� ���� */
	$link = mysql_connect($dblocation, $dbuser, $dbpasswd)
		or die("���������� ������������ � ������� ����: " . mysql_error());
		
/* ������� ������ MySQL */
	$ver = mysql_query("SELECT VERSION()"); 
  if(!$ver) 
  { 
    echo "<p>������ � �������</p>"; 
    exit(); 
  } 
  echo "MySQL version is " . mysql_result($ver, 0) . "<br />";

/* ������� ���� */
  $date = mysql_query("SELECT CURRENT_DATE;"); 
  echo "Now is " . mysql_result($date, 0);

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
    echo "������ ��, �� ������� �������� ������ ������\n";
    echo '������ MySQL: ' . mysql_error();
} else {
	$N = 0;
	while ($row = mysql_fetch_row($result)) {
		echo "�������: {$row[0]}<br />";
		$N++;
	}
	echo "<br />����� ������: " . $N . "<hr />";
}
?>

<h2 align="center">������-���������: ���������� ��������</h2>
<a href="index.php"><input type="button" value="�� �������" /></a>
<br />

<form action="add_Driver.php method="post" >
<table>
<tr><td><span>���: </span></td><td><input type="textarea" width="30" name="name"></td></tr>
<tr><td><span>�������: </span></td><td><input type="textarea" width="30" name="sec_name"></td></tr>
<tr><td><span>��������: </span></td><td><input type="textarea" width="30" name="last_name"></td></tr>
<tr><td><span>����������: </span></td><td><input type="textarea" width="30" name="car"></td></tr>
<tr><td><span>��� ��������: </span></td><td><input type="textarea" width="30" name="car"></td></tr>
<tr><td>&nbsp;</td><td><input type="submit" value="�������� ��������"></td></tr>
</table>
</form>


<? /* ��������� ���������� */
    mysql_close($link); ?>
</body>
</html>