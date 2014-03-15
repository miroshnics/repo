<html>
<head>
<title>Онлайн-Диспетчер автопарка</title>
<style>span.radio:hover {background: #e0e0e0}</style>
<script type="text/javascript">function selectRadio(e) {t=e.previousSibling;if((t.tagName=='INPUT')&&(t.type=='radio')) t.click();return;}</script>
</head>

<? require 'login.php'; ?>
<body>
<h2 align="center">Онлайн-Диспетчер автопарка</h2>
<div style="position: relative; width: 50%; float: right;">
<a href="init.php"><input type="button" value="Создать базу данных" /></a>
<a href="uninit.php"><input type="button" value="Удалить базу данных" /></a>
<a href="add_Driver.php"><input type="button" value="Добавить водителя" /></a>
<br />
  
<? 
/* Соединяемся с сервером СУБД */
$link = mysql_connect($dblocation, $dbuser, $dbpasswd)
	or die("Невозможно подключиться к серверу СУБД: " . mysql_error());
		
/* Текущая версия MySQL */
	$ver = mysql_query("SELECT VERSION()"); 
  if(!$ver) 
  { 
    echo "<p>Ошибка в запросе</p>"; 
    exit(); 
  } 
  echo "MySQL version is " . mysql_result($ver, 0) . "<br />";

/* Текущая дата */
  $date = mysql_query("SELECT CURRENT_DATE;"); 
  echo "Now is " . mysql_result($date, 0);

/* Показать все БД на данном сервере */
	$DBs = mysql_query("SHOW DATABASES");
	
	$N = 0;
	while ($row = mysql_fetch_assoc($DBs)) {
		echo "<br />" . $row['Database'];
		$N++;
	}
	echo "<br />Всего баз данных: " . $N . "<hr />";
  
/* Показать все таблицы в одной БД */
$result = mysql_query("SHOW TABLES FROM " . $dbname);

if (!$result) {
    echo "Ошибка БД, не удалось получить список таблиц\n";
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

<h2 align="center">Онлайн-Диспетчер: добавление водителя</h2>
<a href="index.php"><input type="button" value="На главную" /></a>
<br />

<form action="add_Driver.php method="post" >
<table>
<tr><td><span>Имя:</span></td><td><input type="textarea" size="30" name="name"></td></tr>
<tr><td><span>Фамилия:</span></td><td><input type="textarea" size="30" name="sec_name"></td></tr>
<tr><td><span>Отчество:</span></td><td><input type="textarea" size="30" name="last_name"></td></tr>
<tr><td><span>Автомобиль:</span></td><td><input type="textarea" size="30" name="car"></td></tr>
<tr><td><span>Вид горючего:</span></td>
<td>
	<input type="radio" name="fuel" value="80" /><span class="radio" onClick="selectRadio(this)">А-80</span>
	<input type="radio" name="fuel" value="92" /><span class="radio" onClick="selectRadio(this)">АИ-92</span>
	<input type="radio" name="fuel" value="95" /><span class="radio" onClick="selectRadio(this)">АИ-95</span>
	<input type="radio" name="fuel" value="98" /><span class="radio" onClick="selectRadio(this)">АИ-98</span>
	<input type="radio" name="fuel" value="DT" /><span class="radio" onClick="selectRadio(this)">ДТ</span>
</td></tr>
<tr><td>&nbsp;</td><td><input type="submit" value="Добавить водителя"></td></tr>
</table>
</form>

</div>
<? /* Закрываем соединение */
    mysql_close($link); ?>
	


</body>
</html>