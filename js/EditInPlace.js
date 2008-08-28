/**
 * @author Robertux
 */

function EnablePost(idPost, plainTextContent){
	//Cambiamos la clase CSS del control Texto, para que permita modificar su texto
	document.getElementById("txt-" + idPost).disabled = false;
	document.getElementById("txt-" + idPost).className = "innerTitleEdit";
	document.getElementById("txt-" + idPost).focus();
	
	//Activamos el calendario
	if (document.getElementById("fch-" + idPost) != null) {
		document.getElementById("fch-" + idPost).className = "PostDateEdit";
		document.getElementById("fch-" + idPost).disabled = false;
		document.getElementById("fch-" + idPost).onkeypress = function() { return false; }
		try{
			Calendar.setup({
				inputField: ("fch-" + idPost), // id of the input field
				ifFormat: "%Y-%m-%d", // format of the input field
				align: "Tl", // alignment (defaults to "Bl")
				displayArea: ("fch-" + idPost), // ID of the span where the date is to be shown
				singleClick: true
			});
			document.getElementById("fch-" + idPost).value = document.getElementById("fch-" + idPost).value.substr(0, 10);
		}catch(e){ /*pass */ }
	}
	
	//activamos el TinyMCE para que se aplique al <div class='innerContent'>
	EnablePostContent(idPost, plainTextContent);	
}

function EnablePostContent(idPost, plainTextContent){
	
	//Ocultamos los botones de agregar/editar/eliminar y desactivamos los botones que no pertenecen a este post
	ToggleEditButtons(idPost, false);
	if(document.getElementById("tbl-" + idPost).value == "usuario")
		document.getElementById("area-" + idPost).style.display = "block";
	
	if (plainTextContent) {
		tinymceInitOneRow();
		tinyMCE.execCommand('mceAddControl', false, ("area-" + idPost));
	}
	else {
		elements = document.getElementsByTagName("input");		
		for (var i = 0; i < elements.length; i++) {
			if (elements[i].id == ("input-" + idPost) || elements[i].id == ("upld-" + idPost) || elements[i].id == ("fch-" + idPost) || elements[i].id == ("num-" + idPost)) {
				elements[i].className = "PostInputEdit";
				elements[i].disabled = false;
			}
		}
		
		elements = document.getElementsByTagName("div");
		var divIdExtra = 1;
		for (var i = 0; i < elements.length; i++) {
			if (elements[i].id == ("div-" + idPost)) {
				try{
					tinymceInitTwoRows();
					//alert("activando: div-" + idPost);
					tinyMCE.execCommand('mceAddControl', false, ("div-" + idPost));
				}catch(e) { alert("error: " + e); }
			}
			if (elements[i].id == ("div-" + idPost + "-" + divIdExtra)) {
				//try{					
					//alert("buscando div-" + idPost + "-" + divIdExtra);
					tinymceInitTwoRows();
					tinyMCE.execCommand('mceAddControl', false, ("div-" + idPost + "-" + divIdExtra));
					divIdExtra++;
				//}catch(e){ /* pass */ }
			}
		}
	}		
}

function DisablePost(idPost, plainTextContent){
	//Cambiamos la clase CSS del control Texto, para que ya no permita modificar su texto
	//alert("id del post a desactivar: " + idPost);
	document.getElementById("txt-" + idPost).disabled = true;	
	document.getElementById("txt-" + idPost).className = "innerTitle";
	
	if (document.getElementById("fch-" + idPost) != null) {
		try{
			document.getElementById("fch-" + idPost).className = "PostDate";
			document.getElementById("fch-" + idPost).disabled = true;		
			document.getElementById("fch-" + idPost).innerHTML = "";
		}catch(e) { /*pass */ }
	}	
	
	//desactivamos el TinyMCE
	DisablePostContent(idPost, plainTextContent);
}

function DisablePostContent(idPost, plainTextContent){
	
	//Mostramos los botones de agregar/editar/eliminar y activamos los botones que no pertenecen a este post
	ToggleEditButtons(idPost, true);
	
	if(document.getElementById("tbl-" + idPost).value == "usuario")
		document.getElementById("area-" + idPost).style.display = "none";
	
	if (plainTextContent) {
		tinyMCE.execCommand('mceRemoveControl', false, "area-" + idPost);
	}
	else {
		elements = document.getElementsByTagName("input");
		for (var i = 0; i < elements.length; i++) {
			if (elements[i].id == ("input-" + idPost)) {
				elements[i].className = "PostInput";
				elements[i].disabled = true;
			}
		}
		
		elements = document.getElementsByTagName("div");
		var divIdExtra = 1;
		for (var i = 0; i < elements.length; i++) {
			if (elements[i].id == ("div-" + idPost)) {
				try{
					//alert("desactivando: div-" + idPost);
					tinyMCE.execCommand('mceRemoveControl', true, ("div-" + idPost));
				}catch(e){ alert("error: " + e); }
			}
			if (elements[i].id == ("div-" + idPost + "-" + divIdExtra)) {
				//try{					
					//alert("buscando div-" + idPost + "-" + divIdExtra);
					tinymceInitTwoRows();
					tinyMCE.execCommand('mceRemoveControl', false, ("div-" + idPost + "-" + divIdExtra));
					divIdExtra++;
				//}catch(e){ /* pass */ }
			}
		}
	}
		
}

function ToggleEditButtons(idPost, state){
	//seleccionar todos los elementos <div>
	array = document.getElementsByTagName("input");
	
	//esto debido a que en los botones la propiedad es "disabled" en lugar de "enabled" y aca se esta usando un valor true para activarlos y un valor false para desactivarlos (es mas logico)
	state = !state;
	
	//recorrer todos los elementos <div>
	for (var i = 0; i < array.length; i++) {
	
		//si el id del elemento contiene 'add-', 'edit-' o 'del-'...
		if ((array[i].id.search(/add-/) != -1) || (array[i].id.search(/edit-/) != -1) || (array[i].id.search(/del-/) != -1)) {
		
			//si es diferente que el post actual...
			array[i].disabled = state;
			array[i].style.display = (state? "none": "inline");
		}
	}
	
	//mostramos/ocultamos los botones de agregar/editar/eliminar o los de guardar/cancelar. Dependiendo del estado.
	displayEditStatus = "";
	displaySaveStatus = "";
	if (state) {
		displayEditStatus = "none";
		displaySaveStatus = "inline";
	}
	else {
		displayEditStatus = "inline";
		displaySaveStatus = "none";
	}
	
	//Una vez definidas las variables, las aplicamos a los elementos.
	if(document.getElementById("add-" + idPost) != null)
		document.getElementById("add-" + idPost).style.display = displayEditStatus;
	if(document.getElementById("edit-" + idPost) != null)		
		document.getElementById("edit-" + idPost).style.display = displayEditStatus;
	if(document.getElementById("del-" + idPost) != null)
		document.getElementById("del-" + idPost).style.display = displayEditStatus;
	//ocultamos los botones de guardar/cancelar		
	document.getElementById("sav-" + idPost).style.display = displaySaveStatus;
	document.getElementById("can-" + idPost).style.display = displaySaveStatus;
	
}

function EditPost(idPost, plainTextContent){	
	//guardamos el contenido del post en un elemento temporal
	//alert("editando post: " + idPost);
	document.getElementById("tmpcnt-" + idPost).value = document.getElementById("area-" + idPost).innerHTML;
	document.getElementById("tmptit-" + idPost).value = document.getElementById("txt-" + idPost).value;
	if (document.getElementById("fch-" + idPost) != null) {
		document.getElementById("tmpfch-" + idPost).value = document.getElementById("fch-" + idPost).value;
	}
	EnablePost(idPost, plainTextContent);
	//alert("area guardada: " + document.getElementById("tmp-" + idPost).value);
}

function EditPostContent(idPost, plainTextContent){
	
	//guardamos el contenido del post en un elemento temporal
	//alert("editando post: " + idPost);
	document.getElementById("tmpcnt-" + idPost).value = document.getElementById("area-" + idPost).innerHTML;
	document.getElementById("tmptit-" + idPost).value = document.getElementById("txt-" + idPost).value;
	if (document.getElementById("fch-" + idPost) != null) {
		document.getElementById("tmpfch-" + idPost).value = document.getElementById("fch-" + idPost).value;
	}
	EnablePostContent(idPost, plainTextContent);
}

function SavePost(idPost, uid, plainTextContent){
	DisablePost(idPost, plainTextContent);
	var xmlHttp;
	//alert("SavePost. uid= " + uid );
	actionPost = "edit";
	//alert("idpost: " + document.getElementById("id-" + idPost).value);
	if(document.getElementById("id-" + idPost).value == "-1"){
		actionPost = "add";
		document.getElementById("id-" + idPost).value = "0";
		DelPostNoConfirm("noresults");
		//alert("idpost: " + document.getElementById("id-" + idPost).value);
		
	}
	
	//Tomamos el valor que nos devuelva el servidor via ajax e invocamos una funcion que se encargara de procesar la respuesta.
	var obj = new Object();
	obj.responseFunction = function(){
		CatchSavedPost(tablaPost, uid);
	}	
	
	//alert("actionpost: " + actionPost);
	if(idPost == "contacto"){
		AjaxSendContacto(document.getElementById("area-" + idPost).innerHTML, obj);
		return null;
	}
	
	if(idPost == "Acerca de la Unidad"){
		AjaxSendAbout(document.getElementById("area-" + idPost).innerHTML, obj);
		return null;
	}
	
	if(idPost == "suscripcion"){
		AjaxSendSuscripcion(document.getElementById("area-" + idPost).innerHTML, obj);
		return null;
	}
	
	tablaPost = document.getElementById("tbl-" + idPost).value;
	indexPost = document.getElementById("id-" + idPost).value;
	
	switch(tablaPost){
		case "novedades":
			tituloPost = document.getElementById("txt-" + idPost).value;
			fechaPost = document.getElementById("fch-" + idPost).value.substr(0,10);
			contenidoPost = document.getElementById("area-" + idPost).innerHTML;
			xmlHttp = AjaxSend("action=" + actionPost + "&table=" + tablaPost + "&title=" + tituloPost + "&content=" + contenidoPost + "&date=" + fechaPost + "&id=" + indexPost, obj);
			break;
		
		case "docente":
			var allItems = document.getElementsByTagName("input");
			var postItems = [];			
			for(var i=0; i<allItems.length; i++){
				if(allItems[i].id == ("input-" + idPost)){
					postItems.push(allItems[i].value);
				}
			}
			apellidosPost = postItems[0];
			nombresPost = postItems[1];
			gradoPost = postItems[2];
			descripcionPost = document.getElementById("div-" + idPost).innerHTML;
			xmlHttp = AjaxSend("action=" + actionPost + "&table=" + tablaPost + "&apellidos=" + apellidosPost + "&nombres=" + nombresPost + "&grado=" + gradoPost + "&desc=" + descripcionPost + "&id=" + indexPost, obj);
			break;
			
		case "utileria":
			var allItems = document.getElementsByTagName("input");
			var postItems = [];			
			for(var i=0; i<allItems.length; i++){
				if(allItems[i].id == ("input-" + idPost)){
					postItems.push(allItems[i].value);
				}
			}
			tituloPost = postItems[0];
			vinculoPost = postItems[1];
			descripcionPost = document.getElementById("div-" + idPost).innerHTML;
			xmlHttp = AjaxSend("action=" + actionPost + "&table=" + tablaPost + "&title=" + tituloPost + "&link=" + vinculoPost + "&desc=" + descripcionPost + "&id=" + indexPost, obj);
			break;
			
		case "procesos":
			indexPost = document.getElementById("id-bigimg").value;
			tituloPost = document.getElementById("txt-cont").value;
			descripcionPost = document.getElementById("div-cont").innerHTML;
			if(actionPost == "add"){
				indexPost = "0";
				tituloPost = document.getElementById("input--1").value;
				descripcionPost = document.getElementById("div--1").innerHTML;
				document.forms[1].action = "../lib/AjaxManagerServer.php?action=" + actionPost + "&table=" + tablaPost + "&title=" + tituloPost + "&desc=" + descripcionPost + "&id=" + indexPost;
				document.forms[1].submit();
				return;
			}			
			xmlHttp = AjaxSend("action=" + actionPost + "&table=" + tablaPost + "&title=" + tituloPost + "&desc=" + descripcionPost + "&id=" + indexPost, obj);
			break;
		case "postgrado":
			var allItems = document.getElementsByTagName("input");
			var postItems = [];
			var divIdExtra = 1;
			var dt = new Date();
			for(var i=0; i<allItems.length; i++){
				if(allItems[i].id == ("input-" + idPost)){
					postItems.push(allItems[i].value);
				}				
			}
			elements = document.getElementsByTagName("div");
			for (var i = 0; i < elements.length; i++) {
				if (elements[i].id == ("div-" + idPost + "-" + divIdExtra)) {
					postItems.push(elements[i].innerHTML);
					divIdExtra++;
				}
			}
			codigoPost = document.getElementById("txt-" + idPost).value;
			nombrePost = postItems[0];
			desarrolloPost = postItems[1];
			duracionPost = postItems[2];
			cmaPost = (postItems[3] == ""? "0": postItems[3]);
			iniclPost = document.getElementById("fch-" + idPost).value.substr(0, 10) + " 00:00:00";
			alert("inicio clases: " + iniclPost);
			gradoPost = postItems[4];
			invPost = (postItems[5] == ""? "0": postItems[5]);
			descPost = postItems[6];
			misionPost = postItems[7];
			visionPost = postItems[8];
			poblaPost = postItems[9];
			horarioPost = postItems[10];
			cursoPost = (document.getElementById("tipocursos").value == "actual"? 1: 0);
			xmlHttp = AjaxSend("action=" + actionPost + "&table=" + tablaPost + "&codigo=" + codigoPost + "&nombre=" + nombrePost + "&desarrollo=" + desarrolloPost + "&duracion=" + duracionPost + "&cma=" + cmaPost
			+"&inicl=" + iniclPost + "&grado=" + gradoPost + "&inv=" + invPost + "&desc=" + descPost + "&mision=" + misionPost + "&vision=" + visionPost + "&poblac=" + poblaPost + "&horario=" + horarioPost + "&id=" + indexPost + "&esactual=" + cursoPost
			, obj);
			break;
			
		case "evento":			
			tituloPost = document.getElementById("txt-" + idPost).value;
			fechaPost = (document.getElementById("fch-" + idPost).value == ""? (dt.getFullYear() + "-" + dt.getMonth() + "-" + dt.getDate()) : document.getElementById("fch-" + idPost).value.substr(0, 10)) + " 00:00:00";
			lugarPost = document.getElementById("input-" + idPost).value;
			detallePost = document.getElementById("div-" + idPost).innerHTML;
			xmlHttp = AjaxSend("action=" + actionPost + "&table=" + tablaPost + "&titulo=" + tituloPost + "&fecha=" + fechaPost + "&lugar=" + lugarPost + "&detalle=" + detallePost + "&id=" + indexPost, obj);
			break;
		
		case "servsocial":
			var allItems = document.getElementsByTagName("input");
			var postItems = [];
			for(var i=0; i<allItems.length; i++){
				if(allItems[i].id == ("input-" + idPost)){
					postItems.push(allItems[i].value);
				}				
			}
			tituloPost = document.getElementById("txt-" + idPost).value;
			descripcionPost = document.getElementById("div-" + idPost).innerHTML;
			duracionPost = postItems[0];
			horasPost = (postItems[1] == ""? "0": postItems[1]);
			
			xmlHttp = AjaxSend("action=" + actionPost + "&table=" + tablaPost + "&titulo=" + tituloPost + "&desc=" + descripcionPost + "&duracion=" + duracionPost + "&horas=" + horasPost + "&id=" + indexPost, obj);
			break;
	}
}

function CancelPost(idPost, plainTextContent){
	//Si estamos agregando un nuevo post y cancelamos la operacion, borramos el post
	if (document.getElementById("id-" + idPost).value == "-1") {
		DisablePost(idPost, plainTextContent);
		document.getElementById("pst-" + idPost).parentNode.removeChild(document.getElementById("pst-" + idPost));
	}	
	//Si es un post existente, mostramos la informacion que tenia en un principio
	else{
		DisablePost(idPost, plainTextContent);
		document.getElementById("area-" + idPost).innerHTML = document.getElementById("tmpcnt-" + idPost).value;
		document.getElementById("txt-" + idPost).value = document.getElementById("tmptit-" + idPost).value;			
		if(document.getElementById("fch-" + idPost) != null)
			document.getElementById("fch-" + idPost).value = document.getElementById("tmpfch-" + idPost).value;
	}
}

function AddPost(idPost, idTabla, uid){	
	if(idTabla == "novedades")
		AjaxSendRequestPost(idTabla, uid, '1');
	else
		AjaxSendRequestPost(idTabla, uid, '0');	
}

function DelPost(idPost, uid){
	//alert("DelPost. uid= " + uid);
	tablaPost = document.getElementById("tbl-" + idPost).value;
	indexPost = document.getElementById("id-" + idPost).value;
	var condicion = "";
	if(document.getElementById("tipocursos") != null)
		condicion = document.getElementById("tipocursos").value;
	if(tablaPost == "procesos")
		indexPost = document.getElementById("id-bigimg").value;
	if (confirm("Esta seguro que desea eliminar este elemento?")) {
		if (document.getElementById("pst-" + idPost) != null) {
			if(tablaPost != "procesos")
				document.getElementById("pst-" + idPost).parentNode.removeChild(document.getElementById("pst-" + idPost));
		}
		var obj = new Object();
		obj.responseFunction = function(){
				refreshPage(tablaPost, uid, condicion);
		}
		AjaxSend("action=del&table=" + tablaPost + "&id=" + indexPost, obj);
	}
}

function DelPostNoConfirm(idPost){
	if(document.getElementById("pst-" + idPost) != null)
		document.getElementById("pst-" + idPost).parentNode.removeChild(document.getElementById("pst-" + idPost));
}


function CatchSavedPost(tablaPost, uid){
	var $condicion = "";
	if(document.getElementById("tipocursos") != null)
		$condicion = document.getElementById("tipocursos").value;
	refreshPage(tablaPost, uid, $condicion);
}

function CatchNewPost(tablaPost, responseText){	
	document.getElementById("area-").innerHTML = responseText + document.getElementById("area-").innerHTML;
	if(tablaPost == "novedades")
		EnablePost("-1", '1');
	else if (tablaPost == "postgrado" || tablaPost == "evento" || tablaPost == "servsocial")
		EnablePost("-1", '');
	else
		EnablePostContent("-1", '');
	fillup();
}

function ShowBigImage(id){
	imagenSrc = document.getElementById("img-" + id);
	imagenBig = document.getElementById("img-big");
	rowDesc = document.getElementById("div-cont");
	idBigImg = document.getElementById("id-bigimg");
	rowNewValue = document.getElementById("descr-" + id);
	titulo = document.getElementById("txt-cont");
	if (imagenBig != null && titulo != null && rowDesc != null && rowNewValue != null && idBigImg != null) {
		imagenBig.src = "../lib/ShowImage.php?id=" + id;
		titulo.value = imagenSrc.alt;
		rowDesc.innerHTML = rowNewValue.value;
		idBigImg.value = id;
	}
}

function ShowImgTitle(id){
	titulo = document.getElementById("txt-prev");
	imgNombre = document.getElementById("img-" + id);
	if(titulo != null && imgNombre != null)
		titulo.value = "Vista Previa - " + imgNombre.alt;
}

function ClearImgTitle(){
	titulo = document.getElementById("txt-prev");
	if(titulo != null)	
	titulo.value = "Vista Previa";
}

function FilterText(e){
	//alert("tecla presionada.");
	var keynum;
	var keychar;
	var numcheck;

	if(window.event){  //IE
		keynum = e.keyCode;
	}
	else if(e.which){ // Netscape/Firefox/Opera
		keynum = e.which;
	}
	//alert("keynum? " + keynum);
	keychar = String.fromCharCode(keynum);
	numcheck = /\d/;
	return /*numcheck.test(keychar) ||*/(keynum > 47 && keynum < 58) || (keynum > 95 && keynum < 106) || keynum == 13 || keynum == 27 || keynum == 32 || keynum == 8 || keynum == 9 || keynum == 46 || keynum == 110 || keynum == 190 || (keynum > 36 && keynum < 41);

}
