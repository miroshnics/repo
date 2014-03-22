<?
function write_daycal_table($N_f) {
	echo "\n<table class=\"daycal\" id=\"day{$N_f}\" frame=\"border\" rules=\"all\" cellpadding=\"3px\" cellspacing=\"0\" >\n";
	for ($i=0; $i<9; $i++) {
		echo "<tr>";
		echo "<td class=\"hour\">" . ($i+9) . ":00</td>";
		echo "<td class=\"driver1\"></td>";
		echo "<td class=\"driver2\"></td>";
		echo "<td class=\"driver3\"></td>";
		echo "</tr>\n";
	}
	echo "\n</table>";

}

/* Настройка локали */
setlocale(LC_ALL, 'ru_RU.CP1251', 'rus_RUS.CP1251', 'Russian_Russia.1251', 'russian');
date_default_timezone_set("Europe/Moscow");

/* Главная таблица: формирование колонки с датами и днями недели */
for ($i=0; $i<7; $i++) {
	$WeekDay[$i]['nixtime'] = mktime(0, 0, 0, date("m"), date("d")+($i-1), date("Y"));
	$WeekDay[$i]['day'] = ucfirst(strftime("%A", $WeekDay[$i]['nixtime']));
	$WeekDay[$i]['date'] = date("d.m", $WeekDay[$i]['nixtime']);
}

require 'login.php';

/* Соединяемся с сервером СУБД */
$link = mysql_connect($dblocation, $dbuser, $dbpasswd)
	or die("Невозможно подключиться к серверу СУБД: " . mysql_error());
	
/* Подключаемся к БД */
if (!mysql_select_db($dbname, $link)) {
    echo('Не удалось выбрать базу ' . $dbname . ': ' . mysql_error() . "<br />");
}

/* Настройка подключения к базе данных */
mysql_query('SET names "cp1251"');

/* Загружаем глобальные данные о водителях */
$str = "SELECT 
	tbl_Drivers.id as Driver_id, 
	tbl_Drivers.name as name, 
	tbl_Drivers.sec_name as sec_name,
	tbl_Drivers.last_name as last_name,
	tbl_Drivers.car as car,
	tbl_Fuels.type_name as fuel_type_name,
	tbl_Fuels.cost as fuel_cost
	FROM tbl_Drivers, tbl_Fuels
	WHERE tbl_Drivers.fuel_id = tbl_Fuels.id
	ORDER by Driver_id asc;";
$sql_drivers = mysql_query($str);
if (!$sql_drivers) echo 'Ошибка MySQL, не удалось получить список таблиц: ' . mysql_error() . "<br />";

/* Загружаем глобальные данные о ближайших поездках */
$str = "SELECT
	tbl_Trips.id as trip_id,
	tbl_Trips.start_point as start_point,
	tbl_Trips.end_point as end_point,
	tbl_Trips.time_start as time_start,
	tbl_Trips.time_end as time_end,
	tbl_Trips.dlina as dlina,
	
	tbl_Drivers.name as Driver_name,
	tbl_Drivers.sec_name as Driver_sec_name,
	tbl_Drivers.last_name as Driver_last_name,
	
	tbl_Trips.client as client,
	tbl_Depts.name as Dept_name,
	tbl_Depts.color as Dept_color
	
	FROM tbl_Trips, tbl_Drivers, tbl_Depts
	
	WHERE 
		(ABS(TO_DAYS(tbl_Trips.time_start) - TO_DAYS(NOW())) < 4)
		AND (tbl_Trips.Driver_id = tbl_Drivers.id)
		AND (tbl_Trips.client_dept_id = tbl_Depts.id)
	ORDER BY tbl_Trips.time_start;";
$sql_day_trips = mysql_query($str);
if (!$sql_day_trips) echo 'Ошибка MySQL, не удалось получить список таблиц: ' . mysql_error();

/* Подключаем модули обработки форм, если есть POST-запрос */
if ($_SERVER['REQUEST_METHOD'] == 'POST')
	switch ($_POST['action']) {
	case 'add_Driver':
		require 'add_Driver.php';
		break;
	case 'add_Trip':
		require 'add_Trip.php';
		break;
}
?>

<html>
<head>
<title>Онлайн-Диспетчер автопарка</title>
<link rel="stylesheet" href="styles.css">
<script type="text/javascript" src="js/scripts.js"></script>
<script type="text/javascript" src="js/calendar_ru.js"></script>
</head>

<body>
<h2 align="center">Онлайн-Диспетчер автопарка</h2>

<!-- **************************** RIGHT SIDEBAR **************************** -->
<div id="r_sidebar">
<a href="create_db.php"><input type="button" value="Создать базу данных" /></a>
<a href="init.php"><input type="button" value="Инициализировать базу данных" /></a>
<a href="uninit.php"><input type="button" value="Удалить базу данных" /></a>
<br />
  
<?

/* Показать список всех таблиц в одной БД */
echo "<div class=\"debug\">";
$result = mysql_query("SHOW TABLES FROM " . $dbname);
if (!$result) {
    echo 'Ошибка MySQL, не удалось получить список таблиц: ' . mysql_error();
} else {
	$N = 0;
	echo "<span style=\"color: 505050;\">Таблицы БД {$dbname}:</span>\n<span> ";
	while ($row = mysql_fetch_row($result)) {
		echo "{$row[0]}, ";
		$N++;
	}
	echo " </span>\n<span style=\"color: 505050;\">(всего " . $N . ")</span>\n<hr />";
}
echo "</div>";

/* Показать все данные таблицы tbl_Drivers */
mysql_data_seek($sql_drivers, 0);
if(!$sql_drivers)
    echo 'Не удалось получить данные таблицы tbl_Drivers: ' . mysql_error();
elseif (!is_null($sql_drivers)){
	echo '<table id="drivers" frame="border" rules="all" cellpadding="3px" cellspacing="0" >';
	$N_sql_drivers = 0;
	while ($row = mysql_fetch_assoc($sql_drivers)) {
		$N_sql_drivers ++;
		echo "\n<tr>"
		 . "\n<td>{$row['Driver_id']}</td>"
		 . "\n<td>{$row['name']} "
		 . "{$row['sec_name']} "
		 . "{$row['last_name']}</td>"
		 . "\n<td>{$row['car']}</td>"
		 . "\n<td>{$row['fuel_type_name']}</td>"
		 . "\n<td>{$row['fuel_cost']}</td>"
		 . "\n</tr>";
	}
	echo "\n</table>";
}

/* Показать все данные в таблице tbl_Depts */
$str = "SELECT
	tbl_Depts.name as name,
	tbl_Depts.color as color
	FROM tbl_Depts;";
$sql_depts = mysql_query($str);
if(!$result)
    echo 'Не удалось получить данные таблицы tbl_Depts: ' . mysql_error();
elseif (!is_null($sql_drivers)){
	echo "\n<table id=\"depts\" frame=\"border\" rules=\"all\" cellpadding=\"3px\" cellspacing=\"0\" >";
	$N_sql_depts = 0;
	while ($row = mysql_fetch_assoc($sql_depts)) {
		$N_sql_drivers ++;
		echo "\n<tr>"
		 . "\n<td style=\"background: #{$row['color']}\">{$row['name']}</td>"
		 . "\n</tr>";
	}
	echo "\n</table>";
}

/* Показать ближайшие поездки из предварительно загруженной переменной $sql_day_trips */
if (!is_null($sql_day_trips)){
	echo "\n<table class=\"debug\" id=\"trips\" frame=\"border\" rules=\"all\" cellpadding=\"2px\" cellspacing=\"0\" >";
	while ($row = mysql_fetch_assoc($sql_day_trips)) {
		echo "\n<tr>";
		foreach ($row as $value)
			echo "\n<td style=\"background: #{$row['Dept_color']}\">$value</td>";
		echo "\n</tr>";
	}
	echo "\n</table>";
}
?>
<hr width="100%" />
<? require 'add_Driver_Form.php' ?><br>
<? require 'add_Trip_Form.php' ?>

</div>
<!--  RIGHT SIDEBAR  -->



<!-- **************************** LEFT MAINTABLE **************************** -->
<div class="main_table_div">

<? /*for ($i=0; $i<7; $i++) $day[$i] = ucfirst(strftime("%A", mktime(0, 0, 0, date("m"), date("d")+($i-3), date("Y"))));*/ ?>
<table id="mtbl_days" frame="border" rules="all" cellpadding="2px" cellspacing="2px" >
	<tr><td>&nbsp;</td>
	<td id="mtbl_td_header">
		<table id="mtbl_header" frame="border" rules="all" cellpadding="2px" cellspacing="2px" ><tr>
		<td><?echo mysql_result($sql_drivers,0,1)
				 . mysql_result($sql_drivers,0,2)
				 . mysql_result($sql_drivers,0,3);
		?></td>
		<td><? echo mysql_result($sql_drivers,1,1)
				 . mysql_result($sql_drivers,1,2)
				 . mysql_result($sql_drivers,1,3);
		?></td>
		<td><? echo mysql_result($sql_drivers,2,1)
				 . mysql_result($sql_drivers,2,2)
				 . mysql_result($sql_drivers,2,3);
		?></td>
		</tr></table></td>
	</tr>
	<tr>
		<td class="date">
		<? echo "<span class=\"date\">" . $WeekDay[0]['date']
			. "</span><br>" . $WeekDay[0]['day']; ?></td>
		<td class="day_cal"><? write_daycal_table(0); ?></td>
	</tr>
	<tr>
		<td class="date" id="today">
		<? echo "\n<span class=\"date\">" . $WeekDay[1]['date']
			. "</span><br>" . $WeekDay[1]['day']; ?></td>
		<td class="day_cal"><? write_daycal_table(1); ?></td>
	</tr>
	<tr>
		<td class="date">
		<? echo "\n<span class=\"date\">" . $WeekDay[2]['date']
			. "</span><br>" . $WeekDay[2]['day']; ?></td>
		<td class="day_cal"><? write_daycal_table(2); ?></td>
	</tr>
	<tr>
		<td class="date">
		<? echo "<span class=\"date\">" . $WeekDay[3]['date']
			. "</span><br>" . $WeekDay[3]['day']; ?></td>
		<td class="day_cal"><? write_daycal_table(3); ?></td>
	</tr>
	<tr>
		<td class="date">
		<? echo "<span class=\"date\">" . $WeekDay[4]['date']
			. "</span><br>" . $WeekDay[4]['day']; ?></td>
		<td class="day_cal"><? write_daycal_table(4); ?></td>
	</tr>
	<tr>
		<td class="date">
		<? echo "<span class=\"date\">" . $WeekDay[5]['date']
			. "</span><br>" . $WeekDay[5]['day']; ?></td>
		<td class="day_cal"><? write_daycal_table(5); ?></td>
	</tr>
	<tr>
		<td class="date">
		<? echo "<span class=\"date\">" . $WeekDay[6]['date']
			. "</span><br>" . $WeekDay[6]['day']; ?></td>
		<td class="day_cal"><? write_daycal_table(6); ?></td>
	</tr>
</table>

</div>
<!-- LEFT MAINTABLE -->


<? /* Закрываем соединение */
    mysql_close($link); ?>

</body>
</html>