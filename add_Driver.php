<?
require 'login.php';

/* ����������� � �������� ���� */
$link = mysql_connect($dblocation, $dbuser, $dbpasswd)
	or die("���������� ������������ � ������� ���� �� " . $dblocation . ": " . mysql_error() . "<br />");






/* ��������� ���������� */
mysql_close($link);
	
?>