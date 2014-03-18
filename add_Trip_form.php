<div class="spoiler1_head" title="Нажмите, чтобы открыть форму" onClick='toggle_open_close("s2_c")'>Онлайн-Диспетчер: добавление поездки
</div>
<div class="spoiler_content" id="s2_c">
	<form action="<?=$_SERVER['PHP_SELF'] /* index.php */?>" method="post" >
	<input type="hidden" name="action" value="add_Trip" />
	<table>
	<tr><td><span>Пункт назначения:</span></td><td><input type="textarea" size="45" name="end_point" /></td></tr>
	<tr><td><span>Время отправления:</span></td><td><input type="textarea" size="45" name="sec_name" /></td></tr>
	<tr><td><span>Водитель:</span></td><td><input type="textarea" size="45" name="last_name" /></td></tr>
	<tr><td><span>:</span></td><td><input type="textarea" size="45" name="car" /></td></tr>
	<tr><td><span>Вид горючего:</span></td>
	<td>
		<div class="radio"><input type="radio" name="fuel" value="80" /><span onClick="selectRadio(this)">А-80</span></div>
		<div class="radio"><input type="radio" name="fuel" value="92" /><span onClick="selectRadio(this)">АИ-92</span></div>
		<div class="radio"><input type="radio" name="fuel" value="95" /><span onClick="selectRadio(this)">АИ-95</span></div>
		<div class="radio"><input type="radio" name="fuel" value="98" /><span onClick="selectRadio(this)">АИ-98</span></div>
		<div class="radio"><input type="radio" name="fuel" value="DT" /><span onClick="selectRadio(this)">ДТ</span></div>
	</td></tr>
	<tr><td>&nbsp;</td><td><input type="submit" value="Добавить водителя"></td></tr>
	</table>
	</form>
</div>