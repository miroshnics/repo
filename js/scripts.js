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
	document.getElementById("end_point").focus();

	/* Загружаем в форму данные */
	ptr_cell = event.target;
	document.getElementById("time_start").value = ptr_cell.getAttribute("time");
	document.getElementById("date_start").value = ptr_cell.getAttribute("date");
	document.getElementById("sql_date_start").setAttribute("value", ptr_cell.getAttribute("sql_date_start"));
	document.getElementById("dr"+ptr_cell.getAttribute("driver_id")).selected = 'true';
	return false;
}

function hide_popup(event, is_key) {
	// Если нажата клавиша ESC или по спец.вызову
	if ((is_key == true && event.keyCode == 27) || is_key == false) {
		/* Выключаем popup */
		document.getElementById('w_parent').style.display = 'none';
		document.getElementById('okno').style.display = 'none';
		
		document.getElementById("time_start").value = '';
		document.getElementById("date_start").value = '';
		//Развыделим :) выделенный элемент
		ptr_target = document.getElementById("Driver_id");
		ptr_target.childNodes[ptr_target.selectedIndex].selected = 'false'; // Unselect selected option in list
	}
	return false;
}

function init_display() {/*
	//return;
	document.getElementById("debug2").innerHTML = "0 ";
	var td_array = new Array();
	document.getElementById("debug2").innerHTML += "1 ";
	td_array = Cls("td", "trip");
	document.getElementById("debug2").innerHTML += "2 ";
	var par_table;
	document.getElementById("debug2").innerHTML += "3 ";
	document.getElementById("debug3").innerHTML = "";
	var l = td_array.length;
	for(var k=0; k<l; k++) {
		document.getElementById("debug3").innerHTML += "td_array[" + k + "]=" + td_array[k] + "<br />");
	}
	for (elem in td_array) {
	document.getElementById("debug2").innerHTML += "n ";
	//what the bug??? why td_array[0]=[object HTMLTableCellElement]???
	//	par_table = elem.parentNode.parentNode.parentNode;
	document.getElementById("debug2").innerHTML += "n+1 ";
	//	elem.style.width = (par_table.style.width - 46)/3;
	document.getElementById("debug2").innerHTML += "n+2 ";
	}
	document.getElementById("debug2").innerHTML += "end ";*/
	return false;
}

function Cls(tag, FindClass){
	var allElem, arrE = [], i;
	if(document.getElementsByClassName){
		return document.getElementsByClassName(FindClass);
	}
	else if(document.querySelectorAll){
		return document.querySelectorAll("."+FindClass);
	}
	allElem = document.body.getElementsByTagName(tag);
	i = allElem.length;
	while(i--){
		if(allElem[i].className == FindClass) arrE.push(allElem[i]);
	};
	return arrE;
}
