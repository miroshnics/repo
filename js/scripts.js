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

function init_display() {
	//return;
	var par_table = new Array();
	var td_array = new Array();
	td_array = Cls("td", "trip");
	var l = td_array.length;
	document.getElementById("debug3").innerHTML += "td_array.length: "+l;
	document.getElementById("debug3").innerHTML += "<br />";
	for(var k=0; k<l; k++) {
		document.getElementById("debug3").innerHTML += "td_array[" + k + "] = " + td_array[k] + "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		par_table[k] = td_array[k].parentNode.parentNode.parentNode;
		document.getElementById("debug3").innerHTML += "par_table[" + k + "] = " + par_table[k]/* + "<br />"*/;
		//document.getElementById("debug3").innerHTML += "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;td_array[k].style.width = " + td_array[k].style.width;
		document.getElementById("debug3").innerHTML += "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;par_table.scrollWidth = " + par_table.scrollWidth + "<br />";
		td_array[k].style.width = ((par_table.width - 46)/3);
	}
	document.getElementById("debug2").innerHTML += "end ";
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
