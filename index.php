<?
/* ��������� ������ */
setlocale(LC_ALL, 'ru_RU.CP1251', 'rus_RUS.CP1251', 'Russian_Russia.1251', 'russian');
date_default_timezone_set("Europe/Moscow");

/* ������� �������: ������������ ������� � ������ � ����� ������ */
for ($i=0; $i<7; $i++) {
	$WeekDay[$i]['nixtime'] = mktime(0, 0, 0, date("m"), date("d")+($i-0), date("Y"));
	$WeekDay[$i]['day'] = ucfirst(strftime("%A", $WeekDay[$i]['nixtime']));
	$WeekDay[$i]['date'] = date("d.m", $WeekDay[$i]['nixtime']);
	if ($WeekDay[$i]['day'] == '�������' || $WeekDay[$i]['day'] == '�����������')
		$WeekDay[$i]['is_holiday'] = ' holiday';
	else $WeekDay[$i]['is_holiday'] = '';
}

/* ������������ ��������� ������ �� ���� */
function write_daycal_table($N_f) {
	echo "\n<table class=\"daycal\" id=\"day{$N_f}\" frame=\"border\" rules=\"all\" cellpadding=\"3px\" cellspacing=\"0\" >\n";
	for ($i=9; $i<18; $i++) {
		echo "<tr>";
		echo "<td class=\"hour\">{$i}:00</td>";
		echo "<td class=\"trip\" 
					date=\"" . date("d.m.Y", $GLOBALS['WeekDay'][$N_f]['nixtime']) . "\" 
					driver_id=\"1\" 
					time=\"{$i}:00\" 
					day_num=\"{$N_f}\" 
					onclick=\"show_popup(event);\"></td>";
		echo "<td class=\"trip\" 
					date=\"" . date("d.m.Y", $GLOBALS['WeekDay'][$N_f]['nixtime']) . "\" 
					driver_id=\"2\" 
					time=\"{$i}:00\" 
					day_num=\"{$N_f}\" 
					onclick=\"show_popup(event);\"></td>";
		echo "<td class=\"trip\" 
					date=\"" . date("d.m.Y", $GLOBALS['WeekDay'][$N_f]['nixtime']) . "\" 
					driver_id=\"3\" 
					time=\"{$i}:00\" 
					day_num=\"{$N_f}\" 
					onclick=\"show_popup(event);\"></td>";
		echo "</tr>\n";
	}
	echo "\n</table>";
}

require_once 'login.php';

/* ����������� � �������� ���� */
$link = mysql_connect($dblocation, $dbuser, $dbpasswd)
	or die("���������� ������������ � ������� ����: " . mysql_error());
	
/* ������������ � �� */
if (!mysql_select_db($dbname, $link)) {
    echo('�� ������� ������� ���� ' . $dbname . ': ' . mysql_error() . "<br />");
}
  
/* ��������� ���������� ������ � ��������� */
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
if (!$sql_drivers) echo '������ MySQL, �� ������� �������� ������ ������: ' . mysql_error() . "<br />";

/* ��������� ���������� ������ � ��������� �������� */
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
if (!$sql_day_trips) echo '������ MySQL, �� ������� �������� ������ ������: ' . mysql_error();

/* ���������� ������ ��������� ����, ���� ���� POST-������ */
if ($_SERVER['REQUEST_METHOD'] == 'POST')
	switch ($_POST['action']) {
	case 'add_Driver':
		require_once 'add_Driver.php';
		break;
	case 'add_Trip':
		require_once 'add_Trip.php';
		break;
}
?>

<html>
<head>
<title>������-��������� ���������</title>
<link rel="stylesheet" href="styles.css">
<script type="text/javascript" src="js/scripts.js"></script>
<script type="text/javascript" src="js/calendar_ru.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
</head>

<body onkeyup="hide_popup()">


<!-- **************************** HEADER **************************** -->
<div id="header">
<h2 >������-��������� ���������</h2>
<span id="debug"></span>
<a class="debug" href="create_db.php"><input type="button" value="������� ���� ������" /></a>
<a class="debug" href="init.php"><input type="button" value="���������������� ���� ������" /></a>
<a class="debug" href="uninit.php"><input type="button" value="������� ���� ������" /></a>
<br />

<!-- ������ ���������� -->
<table id="depts" frame="border" rules="all" cellpadding="3px" cellspacing="0">
<tr>
<td style="background: #FF0000">�����������</td>
<td style="background: #99CC00">����� ����</td>
</tr>
<tr>
<td style="background: #FFFF00">����� ����</td>
<td style="background: #00CCFF">����� �� � ���</td>
</tr>
</table>

</div>
<!--  HEADER  -->



<!-- **************************** LEFT MAINTABLE **************************** -->
<div class="main_table_div">
<table class="mtbl_days" frame="border" rules="all" cellpadding="2px" cellspacing="2px" >
	<tr><td>&nbsp;</td>
	<td class="mtbl_td_header">
		<table class="mtbl_header" frame="border" rules="all" cellpadding="2px" cellspacing="2px" ><tr>
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
		<td class="date<? echo $WeekDay[0]['is_holiday']; ?>" id="today" >
		<? echo "<span class=\"date\">" . $WeekDay[0]['date']
			. "</span><br>" . $WeekDay[0]['day']; ?></td>
		<td class="day_cal"><? write_daycal_table(0); ?></td>
	</tr>
	<tr>
		<td class="date<? echo $WeekDay[1]['is_holiday']; ?>" >
		<? echo "\n<span class=\"date\">" . $WeekDay[1]['date']
			. "</span><br>" . $WeekDay[1]['day']; ?></td>
		<td class="day_cal"><? write_daycal_table(1); ?></td>
	</tr>
	<tr>
		<td class="date<? echo $WeekDay[2]['is_holiday']; ?>" >
		<? echo "\n<span class=\"date\">" . $WeekDay[2]['date']
			. "</span><br>" . $WeekDay[2]['day']; ?></td>
		<td class="day_cal"><? write_daycal_table(2); ?></td>
	</tr>
</table>

</div>
<!-- LEFT MAINTABLE -->

<div class="main_table_div">
<table class="mtbl_days" frame="border" rules="all" cellpadding="2px" cellspacing="2px" >
	<tr><td>&nbsp;</td>
	<td class="mtbl_td_header">
		<table class="mtbl_header" frame="border" rules="all" cellpadding="2px" cellspacing="2px" ><tr>
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
		<td class="date<? echo $WeekDay[3]['is_holiday']; ?>" >
		<? echo "<span class=\"date\">" . $WeekDay[3]['date']
			. "</span><br>" . $WeekDay[3]['day']; ?></td>
		<td class="day_cal"><? write_daycal_table(3); ?></td>
	</tr>
	<tr>
		<td class="date<? echo $WeekDay[4]['is_holiday']; ?>" >
		<? echo "<span class=\"date\">" . $WeekDay[4]['date']
			. "</span><br>" . $WeekDay[4]['day']; ?></td>
		<td class="day_cal"><? write_daycal_table(4); ?></td>
	</tr>
	<tr>
		<td class="date<? echo $WeekDay[5]['is_holiday']; ?>" >
		<? echo "<span class=\"date\">" . $WeekDay[5]['date']
			. "</span><br>" . $WeekDay[5]['day']; ?></td>
		<td class="day_cal"><? write_daycal_table(5); ?></td>
	</tr>
</table>
</div>

<? /* ��������� ���������� */
    mysql_close($link); ?>
	
<!-- ����� ������������ ���� -->
<div id="w_parent" onclick="hide_popup();">&nbsp;</div>
<div id="okno">
	<div class="telo-okna">
	<? include_once 'add_Trip_form.php'; ?>
	</div>
</div>

</body>
</html>