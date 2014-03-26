function selectRadio(e) {
	t=e.previousSibling;
	if((t.tagName=='INPUT')&&(t.type=='radio')) 
		t.click();
	return;
}

function toggle_open_close(id_spoiler_content) {
	var obj = "";
	if (document.getElementById)
		obj = document.getElementById(id_spoiler_content).style;
	else if (document.all)
		obj = document.all[id_spoiler_content];
	else if (document.layers)
		obj = document.layers[id_spoiler_content];
	else return 1;

	if (obj.display != "block")
		obj.display = "block";
	else obj.display = "none";
}

function show_popup(event) {
	/* Включаем popup */
	document.getElementById('w_parent').style.display = 'block';
	document.getElementById('okno').style.display = 'block';

	/* Загружаем в форму данные */
	ptr_cell = event.target;
	document.getElementById("time_start").value = ptr_cell.getAttribute("time");
	document.getElementById("date_start").value = ptr_cell.getAttribute("date");
	document.getElementById("dr"+ptr_cell.getAttribute("driver_id")).selected = 'true';
	return false;
}

function hide_popup() {
	/* Выключаем popup */
	document.getElementById('w_parent').style.display = 'none';
	document.getElementById('okno').style.display = 'none';
	
	document.getElementById("time_start").value = '';
	document.getElementById("date_start").value = '';
	//Развыделим :) выделенный элемент
	ptr_target = document.getElementById("Driver_id");
	ptr_target.childNodes[ptr_target.selectedIndex].selected = 'false'; // Unselect selected option in list
	return false;
}