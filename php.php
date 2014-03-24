<?php 
  phpinfo(); 
  echo "йцкарпавыордвалжрож";
  
  
  
  for ($i=0; $i<7; $i++) {
	$WeekDay[$i]['nixtime'] = mktime(0, 0, 0, date("m"), date("d")+($i-0), date("Y"));
	$WeekDay[$i]['day'] = ucfirst(strftime("%A", $WeekDay[$i]['nixtime']));
	$WeekDay[$i]['date'] = date("d.m", $WeekDay[$i]['nixtime']);
	if ($WeekDay[$i]['day'] == 'Суббота' || $WeekDay[$i]['day'] == 'Воскресенье')
		$WeekDay[$i]['is_holiday'] = ' holiday';
	else $WeekDay[$i]['is_holiday'] = '';
}


/* Настройка локали */
setlocale(LC_ALL, 'ru_RU', 
						'rus_RUS',
						'Russian_Russia', 
						'ru_RU.CP1251', 
						'rus_RUS.CP1251', 
						'Russian_Russia.1251', 
						'russian');
echo setlocale(LC_ALL, 'ru_RU', 
						'rus_RUS',
						'Russian_Russia', 
						'ru_RU.CP1251', 
						'rus_RUS.CP1251', 
						'Russian_Russia.1251', 
						'russian');
date_default_timezone_set("Europe/Moscow");


?>


<!-- **************************** LEFT MAINTABLE **************************** -->
<div class="main_table_div">
<table class="mtbl_days" frame="border" rules="all" cellpadding="2px" cellspacing="2px" >
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