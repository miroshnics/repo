<div class="spoiler1_head" title="Нажмите, чтобы открыть форму" onClick="toggle_open_close('s1_c')"><h2 align="center">Онлайн-Диспетчер: добавление водителя</h2>
</div>
<div class="spoiler_content" id="s1_c">
	<form action="<?=$_SERVER['PHP_SELF']?>" method="post" >
	<input type="hidden" name="action" value="add_Driver" />
	<table>
	<tr><td><span>Имя:</span></td><td><input type="textarea" size="45" name="name" /></td></tr>
	<tr><td><span>Отчество:</span></td><td><input type="textarea" size="45" name="sec_name" /></td></tr>
	<tr><td><span>Фамилия:</span></td><td><input type="textarea" size="45" name="last_name" /></td></tr>
	<tr><td><span>Автомобиль:</span></td><td><input type="textarea" size="45" name="car" /></td></tr>
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