<? 
require 'login.php';

 /* �����������, �������� ���� ������ */
$link = mysql_connect($dblocation, $dbuser, $dbpasswd)
	or die("���������� ������������ � ���� ������: " . mysql_error());
	
/* ������� ���� ������ db_Dispetcher */
if (!mysql_query($sql, 'CREATE DATABASE db_Dispetcher;'))
	echo '������ ��� �������� ���� ������ db_Dispetcher: ' . mysql_error() . "<br />";

/* ������� ������� tbl_Drivers */
if (!mysql_query($sql, 'CREATE TABLE tbl_Drivers (\
						id INT AUTO_INCREMENT NOT NULL,\
						name CHAR(30) NOT NULL,\
						sec_name CHAR(30) NOT NULL,\
						last_name CHAR(30) NOT NULL,\
						car CHAR(30) NOT NULL,\
						fuel CHAR (10),\
						PRIMARY KEY(id));'))
	echo '������ ��� �������� ������� tbl_Drivers: ' . mysql_error() . "<br />";

/* ������� ������� tbl_Trips */
if (!mysql_query($sql, 'CREATE TABLE tbl_Trips (\
						id INT AUTO_INCREMENT NOT NULL,\
						start_point CHAR(30) NOT NULL,\
						end_point CHAR(30) NOT NULL,\
						dlina DECIMAL(9,3),\
						Driver_id INT NOT NULL,\
						client_id INT NOT NULL,\
						PRIMARY KEY(id),\
						FOREIGN KEY (Driver_id) REFERENCES tbl_Drivers(id),\
						FOREIGN KEY (client_id) REFERENCES tbl_Clients(id));'))
	echo '������ ��� �������� ������� tbl_Trips: ' . mysql_error() . "<br />";

/* ������� ������� tbl_Clients */
if (!mysql_query($sql, 'CREATE TABLE tbl_Clients (\
						id INT AUTO_INCREMENT NOT NULL,\
						name CHAR(30) NOT NULL,\
						dept CHAR(30) NOT NULL;'))
	echo '������ ��� �������� ������� tbl_Clients: ' . mysql_error() . "<br />";
?>