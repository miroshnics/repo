<!-- 
You can add this to make a spoiler:
<div class="spoiler1_head" onClick='toggle_open_close("s2_c")'>...</div> 
<div class="spoiler_content" id="s2_c">...</div>
-->

<h3>Онлайн-Диспетчер: добавление поездки
</h3>

<div>
	<form action="<?=$_SERVER['PHP_SELF'] /* index.php */?>" method="post" >
	<input type="hidden" name="action" value="add_Trip" />
	<table>
	<tr><td><span>Пункт назначения:</span></td>
	<td><input type="textarea" size="45" name="end_point" /></td></tr>
	
	<tr><td><span>Дата отправления:</span></td>
	<td><input type="textarea" size="45" id="date_start" name="date_start" placeholder="в формате ДД-ММ" /></td></tr>
	
	<tr><td><span>Время отправления:</span></td>
	<td><input type="textarea" size="45" id="time_start" name="time_start" placeholder="в формате ЧЧ:ММ" /></td></tr>
	
	<tr><td class="delim"><span>Водитель:</span></td>
	<td class="delim"><select size="1" id="Driver_id" name="Driver_id">
		<option id="dr1" value="1">В. И. Миронов</option>
		<option id="dr2" value="2">Н. Н. Устов</option>
		<option id="dr3" value="3">С. И. Хотькин</option>
	<? /*mysql_data_seek($sql_drivers, 0);
	$N = 1;
	while ($row = mysql_fetch_assoc($sql_drivers)) {
		echo "<option value=\"{$N}\">"
		 . "{$row['name']} {$row['sec_name']} {$row['last_name']}"
		 . "</option>"; $N++;} */ ?>	
	</select></td></tr>
	
	<tr><td><span>Заказчик:</span></td><td><input type="textarea" size="45" name="client" /></td></tr>
	<tr><td><span>Отдел:</span></td><td><input type="textarea" size="45" name="client_dept_id" /></td></tr>
	<tr><td><span>Время прибытия:</span></td><td><input type="textarea" size="45" name="time_end" /></td></tr>
	<tr><td><span>Длина маршрута:</span></td><td><input type="textarea" size="45" name="dlina" /></td></tr>
	<tr><td>&nbsp;</td><td><input type="submit" value="Добавить поездку"></td></tr>
	</table>
	</form>
</div>