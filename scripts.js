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