<?
require 'login.php';

/* Соединяемся с сервером СУБД */
$link = mysql_connect($dblocation, $dbuser, $dbpasswd)
	or die("Невозможно подключиться к серверу СУБД на " . $dblocation . ": " . mysql_error() . "<br />");






/* Закрываем соединение */
mysql_close($link);
	
?>