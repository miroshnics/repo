<?
require_once 'login.php';

/* ����������� � �������� ���� */
$link = mysql_connect($dblocation, $dbuser, $dbpasswd)
	or die("���������� ������������ � ������� ���� �� " . $dblocation . ": " . mysql_error() . "<br />");
	
/* ������� ���� ������ db_Dispetcher */
if (!mysql_query('DROP DATABASE ' . $dbname, $link)) {
	echo '������ ��� �������� ���� ������ ' . $dbname . ': ' . mysql_error() . "<br />";
}

    /* ��������� ���������� */
    mysql_close($link);
?>

<a href="index.php"><input type="button" value="�� �������" /></a>
</body>
</html>