<?
require_once 'login.php';

/* Соединяемся с сервером СУБД */
$link = mysql_connect($dblocation, $dbuser, $dbpasswd)
	or die("Невозможно подключиться к серверу СУБД на " . $dblocation . ": " . mysql_error() . "<br />");
	
/* Удаляем базу данных db_Dispetcher */
if (!mysql_query('DROP DATABASE ' . $dbname, $link)) {
	echo 'Ошибка при удалении базы данных ' . $dbname . ': ' . mysql_error() . "<br />";
}

    /* Закрываем соединение */
    mysql_close($link);
?>

<a href="index.php"><input type="button" value="На главную" /></a>
</body>
</html>