<html>
<head><title>������-��������� ���������: �������������</title></head>
<? require 'login.php'; ?>
<body>
<h2 align="center">������-��������� ���������: �������������</h2>

<? 
require 'login.php';

$status=0;

 /* ����������� � �������� ���� */
$link = mysql_connect($dblocation, $dbuser, $dbpasswd)
	or die("���������� ������������ � ������� ����: " . mysql_error());
	
/* ������� ���� ������ db_Dispetcher */
if (!mysql_query('CREATE DATABASE ' . $dbname . ';', $link))
	die('������ ��� �������� ���� ������ ' . $dbname . ': ' . mysql_error() . "<br />");

/* ������������ � ��������� �� */
if (!mysql_select_db($dbname, $link)) {
    die('�� ������� ������� ���� ' . $dbname . ': ' . mysql_error() . "<br />");
}

/* ������� ������� tbl_Drivers */
if (!mysql_query('CREATE TABLE tbl_Drivers (
						id INT AUTO_INCREMENT NOT NULL,
						name CHAR(30) NOT NULL,
						sec_name CHAR(30) NOT NULL,
						last_name CHAR(30) NOT NULL,
						car CHAR(30) NOT NULL,
						fuel CHAR (10),
						PRIMARY KEY(id));', $link))
	echo '������ ��� �������� ������� tbl_Drivers: ' . mysql_error() . "<br />";
	else $status+=1;

/* ������� ������� tbl_Trips */
if (!mysql_query('CREATE TABLE tbl_Trips (
						id INT AUTO_INCREMENT NOT NULL,
						start_point CHAR(30) NOT NULL,
						end_point CHAR(30) NOT NULL,
						time_start DATETIME NOT NULL,
						time_end DATETIME,
						dlina DECIMAL(9,3),
						Driver_id INT NOT NULL,
						client_id INT NOT NULL,
						PRIMARY KEY(id),
						FOREIGN KEY (Driver_id) REFERENCES tbl_Drivers(id),
						FOREIGN KEY (client_id) REFERENCES tbl_Clients(id));', $link))
	echo '������ ��� �������� ������� tbl_Trips: ' . mysql_error() . "<br />";
	else $status+=1*10;

/* ������� ������� tbl_Clients */
if (!mysql_query('CREATE TABLE tbl_Clients (
						id INT AUTO_INCREMENT NOT NULL,
						name CHAR(30) NOT NULL,
						dept CHAR(30) NOT NULL,
						PRIMARY KEY(id));', $link))
	echo '������ ��� �������� ������� tbl_Clients: ' . mysql_error() . "<br />";
	else $status+=1*100;
	
/* �������� ���������� �������� �� */
if ($status==111) echo '���� ������ ������� �������.<br />';
else echo '��������� � ��������. ��� ������: ' . $status . '<br />';
?>
<a href="index.php"><input type="button" value="�� �������" /></a>
</body>
</html>