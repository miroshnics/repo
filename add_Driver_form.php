<div class="spoiler1_head" title="�������, ����� ������� �����" onClick='toggle_open_close("s1_c")'>������-���������: ���������� ��������
</div>
<div class="spoiler_content" id="s1_c">
	<form action="<?=$_SERVER['PHP_SELF'] /* index.php */?>" method="post" >
	<input type="hidden" name="action" value="add_Driver" />
	<table>
	<tr><td><span>���:</span></td><td><input type="textarea" size="45" name="name" /></td></tr>
	<tr><td><span>��������:</span></td><td><input type="textarea" size="45" name="sec_name" /></td></tr>
	<tr><td><span>�������:</span></td><td><input type="textarea" size="45" name="last_name" /></td></tr>
	<tr><td><span>����������:</span></td><td><input type="textarea" size="45" name="car" /></td></tr>
	<tr><td><span>��� ��������:</span></td>
	<td>
		<div class="radio"><input type="radio" name="fuel" value="80" /><span onClick="selectRadio(this)">�-80</span></div>
		<div class="radio"><input type="radio" name="fuel" value="92" /><span onClick="selectRadio(this)">��-92</span></div>
		<div class="radio"><input type="radio" name="fuel" value="95" /><span onClick="selectRadio(this)">��-95</span></div>
		<div class="radio"><input type="radio" name="fuel" value="98" /><span onClick="selectRadio(this)">��-98</span></div>
		<div class="radio"><input type="radio" name="fuel" value="DT" /><span onClick="selectRadio(this)">��</span></div>
	</td></tr>
	<tr><td>&nbsp;</td><td><input type="submit" value="�������� ��������"></td></tr>
	</table>
	</form>
</div>