<!-- 
You can add this to make a spoiler:
<div class="spoiler1_head" onClick='toggle_open_close("s2_c")'>...</div> 
<div class="spoiler_content" id="s2_c">...</div>
-->

<h3>������-���������: ���������� �������
</h3>

<div>
	<form action="<?=$_SERVER['PHP_SELF'] /* index.php */?>" method="post" >
	<input type="hidden" name="action" value="add_Trip" />
	<table>
	<tr><td><span>����� ����������:</span></td>
	<td><input type="textarea" size="45" name="end_point" /></td></tr>
	
	<tr><td><span>���� �����������:</span></td>
	<td><input type="textarea" size="45" id="date_start" name="date_start" placeholder="� ������� ��-��" /></td></tr>
	
	<tr><td><span>����� �����������:</span></td>
	<td><input type="textarea" size="45" id="time_start" name="time_start" placeholder="� ������� ��:��" /></td></tr>
	
	<tr><td class="delim"><span>��������:</span></td>
	<td class="delim"><select size="1" id="Driver_id" name="Driver_id">
	<? mysql_data_seek($sql_drivers, 0);
	$N = 1;
	while ($row = mysql_fetch_assoc($sql_drivers)) {
		echo "<option id=\"dr{$N}\" value=\"{$N}\">"
		 . "{$row['name']}&nbsp;{$row['sec_name']}&nbsp;{$row['last_name']}"
		 . "</option>"; $N++;} ?>	
	</select></td></tr>
	
	<tr><td><span>��������:</span></td><td><input type="textarea" size="45" name="client" /></td></tr>
	<tr><td><span>�����:</span></td><td><input type="textarea" size="45" name="client_dept_id" /></td></tr>
	<tr><td><span>����� ��������:</span></td><td><input type="textarea" size="45" name="time_end" /></td></tr>
	<tr><td><span>����� ��������:</span></td><td><input type="textarea" size="45" name="dlina" /></td></tr>
	<tr><td>&nbsp;</td><td><input type="submit" value="�������� �������"></td></tr>
	</table>
	</form>
</div>