<html>
<head><title>������-��������� ���������</title></head>
<? require 'login.php'; ?>
<body>
<a href="init.php"><input type="button" value="������� ��!" /></a>
<a href="uninit.php"><input type="button" value="�������� ��!" /></a>
  <br />
<? 
	  /* �����������, �������� ���� ������ */
	$link = mysql_connect($dblocation, $dbuser, $dbpasswd)
		or die("���������� ������������ � ���� ������: " . mysql_error());
		
/* ������� ������ MySQL */
	$ver = mysql_query("SELECT VERSION()"); 
  if(!$ver) 
  { 
    echo "<p>������ � �������</p>"; 
    exit(); 
  } 
  echo "MySQL version is " . mysql_result($ver, 0);

/* ������� ���� */
  $date = mysql_query("SELECT CURRENT_DATE;"); 
  echo mysql_result($date, 0);

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
    echo "������ ����, �� ������� �������� ������ ������\n";
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


<? /* ��������� ���������� */
    mysql_close($link); ?>
</body>
</html>