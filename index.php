<html>
<head><title>Онлайн-Диспетчер автопарка</title></head>
<? require 'login.php'; ?>
<body>

  <br />
<? 
	  /* Соединяемся, выбираем базу данных */
	$link = mysql_connect($dblocation, $dbuser, $dbpasswd)
		or die("Невозможно подключиться к базе данных: " . mysql_error());
		
/* Текущая версия MySQL */
	$ver = mysql_query("SELECT VERSION()"); 
  if(!$ver) 
  { 
    echo "<p>Ошибка в запросе</p>"; 
    exit(); 
  } 
  echo "MySQL version is " . mysql_result($ver, 0);

/* Текущая дата */
  $date = mysql_query("SELECT CURRENT_DATE;"); 
  echo mysql_result($date, 0);

/* Показать все БД на данном сервере */
	$DBs = mysql_query("SHOW DATABASES");
	
	$N = 0;
	while ($row = mysql_fetch_assoc($DBs)) {
		echo "<br />" . $row['Database'];
		$N++;
	}
	echo "<br />Всего баз данных: " . $N . "<hr />";
  
/* Показать все таблицы в одной БД */
$Tables = "SHOW TABLES FROM " . /*$dbname*/'mysql';
$result = mysql_query($Tables);

if (!$result) {
    echo "Ошибка базы, не удалось получить список таблиц\n";
    echo 'Ошибка MySQL: ' . mysql_error();
} else {
	$N = 0;
	while ($row = mysql_fetch_row($result)) {
		echo "Таблица: {$row[0]}<br />";
		$N++;
	}
	echo "<br />Всего таблиц: " . $N . "<hr />";
}
?>


<? include ('uninit.php'); ?>
</body>
</html>