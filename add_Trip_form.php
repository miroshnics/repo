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
	<td><input  autofocus tabindex="1" type="textarea" size="45" name="end_point" /></td></tr>
	
	<tr><td><span>Дата отправления:</span></td>
	<td><input tabindex="2" type="textarea" size="45" id="date_start" name="date_start" placeholder="в формате ДД-ММ" /></td></tr>
	
	<tr><td><span>Время отправления:</span></td>
	<td><input tabindex="3" type="textarea" size="45" id="time_start" name="time_start" placeholder="в формате ЧЧ:ММ" /></td></tr>
	
	<tr><td class="delim"><span>Водитель:</span></td>
	<td class="delim"><select tabindex="4" size="1" id="Driver_id" name="Driver_id">
	<? mysql_data_seek($sql_drivers, 0);
	$N = 1;
	while ($row = mysql_fetch_assoc($sql_drivers)) {
		echo "<option id=\"dr{$N}\" value=\"{$N}\">"
		 . "{$row['name']}&nbsp;{$row['sec_name']}&nbsp;{$row['last_name']}"
		 . "</option>"; $N++;} ?>	
	</select></td></tr>
	<tr><td><span>Заказчик:</span></td>
	<td><input tabindex="5" type="textarea" size="45" name="client" /></td></tr>
	
	
	<!-- -----============================----- -->
	<? $sql_depts; ?>
	<tr><td><span>Отдел:</span></td>
	<td><select tabindex="6" size="1" id="client_dept_id" name="client_dept_id">
		<? mysql_data_seek($sql_depts, 0);
		$N = 1;
		while ($row = mysql_fetch_assoc($sql_depts)) {
			echo "<option id=\"dept{$N}\"  value=\"{$N}\">"
			 . "{$row['name']}"
			 . "</option>"; $N++;} ?>
	</select>
	</td>
	<!-- -----============================----- -->
	
	
	</tr>
	<tr><td><span>Время прибытия:</span></td>
	<td><input tabindex="7" type="textarea" size="45" name="time_end" /></td></tr>
	<tr><td><span>Длина маршрута:</span></td>
	<td><input tabindex="8" type="textarea" size="45" name="dlina" /></td></tr>
	<tr><td>&nbsp;</td><td><input tabindex="9" type="submit" value="Добавить поездку"></td></tr>
	</table>
	</form>
</div>