<div class="spoiler1_head" title="�������, ����� ������� �����" onClick='toggle_open_close("s2_c")'>������-���������: ���������� �������
</div>
<div class="spoiler_content" id="s2_c">
	<form action="<?=$_SERVER['PHP_SELF'] /* index.php */?>" method="post" >
	<input type="hidden" name="action" value="add_Trip" />
	<table>
	<tr><td><span>����� ����������:</span></td><td><input type="textarea" size="45" name="end_point" /></td></tr>
	<tr><td><span>���� �����������:</span></td><td><input type="textarea" size="45" name="date_start" placeholder="� ������� ��-��" /></td></tr>
	<tr><td><span>����� �����������:</span></td><td><input type="textarea" size="45" name="time_start" placeholder="� ������� ��:��" /></td></tr>
	<tr><td><span>��������:</span></td><td><select size="1" name="Driver_id">
	<? mysql_data_seek($sql_drivers, 0);
	while ($row = mysql_fetch_assoc($sql_drivers)) {
		echo "<option>"
		 . "{$row['name']} {$row['sec_name']} {$row['last_name']}"
		 . "</option>";} ?>	
	</select></td></tr>	
	<tr><td>&nbsp;</td><td><input type="submit" value="�������� �������"></td></tr>
	</table>
	</form>
</div>