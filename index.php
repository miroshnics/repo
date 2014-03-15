<?
require 'login.php';
/* Соединяемся с сервером СУБД */
$link = mysql_connect($dblocation, $dbuser, $dbpasswd)
	or die("Невозможно подключиться к серверу СУБД: " . mysql_error());
	
/* Подключаемся к БД */
if (!mysql_select_db($dbname, $link)) {
    echo('Не удалось выбрать базу ' . $dbname . ': ' . mysql_error() . "<br />");
}

/* Подключаем модули обработки форм, если есть POST-запрос */
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] == 'add_Driver') require 'add_Driver.php';

?>

<html>
<head>
<title>Онлайн-Диспетчер автопарка</title>
<style>span.radio:hover {background: #e0e0e0}</style>
<script type="text/javascript">function selectRadio(e) {t=e.previousSibling;if((t.tagName=='INPUT')&&(t.type=='radio')) t.click();return;}</script>
</head>

<body>
<h2 align="center">Онлайн-Диспетчер автопарка</h2>
<div style="position: relative; width: 50%; float: right;">
<a href="init.php"><input type="button" value="Создать базу данных" /></a>
<a href="uninit.php"><input type="button" value="Удалить базу данных" /></a>
<a href="add_Driver.php"><input type="button" value="Добавить водителя" /></a>
<br />
  
<?

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
    echo 'Ошибка MySQL, не удалось получить список таблиц: ' . mysql_error();
} else {
	$N = 0;
	while ($row = mysql_fetch_row($result)) {
		echo "Таблица: {$row[0]}<br />";
		$N++;
	}
	echo "<br />Всего таблиц: " . $N . "<hr />";
}
/* Показать все данные таблицы tbl_Drivers */
$result = mysql_query("SELECT * FROM tbl_Drivers");
if(!$result)
    echo 'Не удалось получить данные таблицы tbl_Drivers: ' . mysql_error();
else {
	echo '<table frame="border" rules="all" cellpadding="3px" cellspacing="0" >';
	while ($row = mysql_fetch_row($result)) {
		echo '<tr>';
		foreach ($row as $value)
			echo "<td>$value</td>";
		echo '</tr>';
	}
	echo "</table>";
}

?>

<h2 align="center">Онлайн-Диспетчер: добавление водителя</h2>

<form action="<?=$_SERVER['PHP_SELF']?>" method="post" >
<input type="hidden" name="action" value="add_Driver" />
<table>
<tr><td><span>Имя:</span></td><td><input type="textarea" size="30" name="name"></td></tr>
<tr><td><span>Отчество:</span></td><td><input type="textarea" size="30" name="sec_name"></td></tr>
<tr><td><span>Фамилия:</span></td><td><input type="textarea" size="30" name="last_name"></td></tr>
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