<? require 'login.php'; ?>

<html>
<head><title>������-��������� ���������: �������� ��</title></head>
<body>
<h2 align="center">������-��������� ���������: �������� ��</h2>

<?
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

/* ������� ������� tbl_Fuels */
if (!mysql_query('CREATE TABLE tbl_Fuels (
					id INT AUTO_INCREMENT NOT NULL,
					type_name CHAR(30) NOT NULL,
					cost DECIMAL(9,2) NOT NULL,
					PRIMARY KEY(id));', $link))
	echo '������ ��� �������� ������� tbl_Fuels: ' . mysql_error() . "<br />";
	else $status += 1*1;
	
/* ������� ������� tbl_Depts */
if (!mysql_query('CREATE TABLE tbl_Depts (
					id INT AUTO_INCREMENT NOT NULL,
					name CHAR(30) NOT NULL,
					color CHAR(6) NOT NULL,' . // HEX digit
					'PRIMARY KEY(id));', $link))
	echo '������ ��� �������� ������� tbl_Depts: ' . mysql_error() . "<br />";
	else $status += 1*10;

/* ������� ������� tbl_Drivers */
if (!mysql_query('CREATE TABLE tbl_Drivers (
					id INT AUTO_INCREMENT NOT NULL,
					name CHAR(30) NOT NULL,
					sec_name VARCHAR(30) NOT NULL,
					last_name VARCHAR(30) NOT NULL,
					car VARCHAR(30) NOT NULL,
					fuel_id INT NOT NULL,
					PRIMARY KEY(id),
					FOREIGN KEY (fuel_id) REFERENCES tbl_Fuels(id));', $link))
	echo '������ ��� �������� ������� tbl_Drivers: ' . mysql_error() . "<br />";
	else $status += 100;

/* ������� ������� tbl_Trips */
if (!mysql_query('CREATE TABLE tbl_Trips (
					id INT AUTO_INCREMENT NOT NULL,
					start_point CHAR(30) NOT NULL,
					end_point CHAR(30) NOT NULL,
					time_start DATETIME NOT NULL,
					time_end DATETIME,
					dlina DECIMAL(9,3),
					Driver_id INT NOT NULL,
					client_dept_id INT NOT NULL,
					client CHAR(50) NOT NULL,
					PRIMARY KEY(id),
					FOREIGN KEY (Driver_id) REFERENCES tbl_Drivers(id),
					FOREIGN KEY (client_dept_id) REFERENCES tbl_Depts(id));', $link))
	echo '������ ��� �������� ������� tbl_Trips: ' . mysql_error() . "<br />";
	else $status += 1*1000;
	
/* �������� ���������� �������� �� */
if ($status == 1111) echo '���� ������ ������� �������.<br />';
else echo '�������� �� ��������� � ��������. ��� ������: ' . $status . '<br />';
?>
<a href="index.php"><input type="button" value="�� �������" /></a>
</body>
</html>