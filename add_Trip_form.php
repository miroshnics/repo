<!-- 
You can add this to make a spoiler:
<div class="spoiler1_head" onClick='toggle_open_close("s2_c")'>...</div> 
<div class="spoiler_content" id="s2_c">...</div>
-->

<h3>������-���������: ���������� �������
</h3>

<form id="add_Trip_form" action="<?=$_SERVER['PHP_SELF'] /* index.php */?>" method="post" >
	<input type="hidden" name="action" value="add_Trip" />
	<input type="hidden" name="sql_date_start" id="sql_date_start" value="" />
	<table>
	<tr><td><span>����� ����������:</span></td>
	<td><input  autofocus autocomplete="on" tabindex="1" type="textarea" size="45" id="end_point" name="end_point" /></td></tr>
	
	<tr><td><span>���� �����������:</span></td>
	<td><input tabindex="2" type="textarea" size="45" id="date_start" name="date_start" placeholder="� ������� ��-��" /></td></tr>
	
	<tr><td><span>����� �����������:</span></td>
	<td><input tabindex="3" type="textarea" size="45" id="time_start" name="time_start" placeholder="� ������� ��:��" /></td></tr>
	
	<tr><td><span>��������:</span></td>
	<td><select tabindex="4" size="1" id="Driver_id" name="Driver_id">
	<? mysql_data_seek($sql_drivers, 0);
	$N = 1;
	while ($row = mysql_fetch_assoc($sql_drivers)) {
		echo "<option id=\"dr{$N}\" value=\"{$N}\">"
		 . "{$row['name']}&nbsp;{$row['sec_name']}&nbsp;{$row['last_name']}"
		 . "</option>"; $N++;} ?>	
	</select></td></tr>
	<tr><td><span>��������:</span></td>
	<td><input autocomplete="on" tabindex="5" type="textarea" size="45" name="client" /></td></tr>

	<tr><td><span>�����:</span></td>
	<td>
		<select tabindex="6" size="1" id="client_dept_id" name="client_dept_id">
			<? mysql_data_seek($sql_depts, 0);
			$N = 1;
			while ($row = mysql_fetch_assoc($sql_depts)) {
				echo "\n\t<option id=\"dept{$N}\"  value=\"{$N}\">"
				 . "{$row['name']}"
				 . "</option>"; $N++;} ?>
		
		</select>
	</td>
	<!-- -----============================----- -->
	<tr class="delim"><td colspan="2"><hr color="#eee" size="8px"/></td></tr>
	
	</tr>
	<tr><td><span>����� ��������:</span></td>
	<td><input tabindex="7" autocomplete="off" type="textarea" size="45" name="time_end" /></td></tr>
	<tr><td><span>����� ��������:</span></td>
	<td><input tabindex="8" autocomplete="off" type="textarea" size="45" name="dlina" /></td></tr>
	<tr><td><span>����� ��������:</span></td>
	<td><input autocomplete="on" tabindex="8" type="textarea" size="45" value="����������" name="start_point" /></td></tr>
	<tr><td>&nbsp;</td><td><input tabindex="9" type="submit" value="�������� �������"></td></tr>
	</table>
</form>