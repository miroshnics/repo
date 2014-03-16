function toggle_open_close(id_spoiler) {
	var obj = "";
	if (document.getElementById)
		obj = document.getElementById(id_spoiler).style;
	else if (document.all)
		obj = document.all[id_spoiler];
	else if (document.layers)
		obj = document.layers[id_spoiler];
	else return 1;

	if (obj.display == "")
		obj.display = "none";
	else if (obj.display != "none")
		obj.display = "none";
	else obj.display = "block";
}