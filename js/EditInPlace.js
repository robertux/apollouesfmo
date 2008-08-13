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
		
		Calendar.setup({
			inputField: ("fch-" + idPost), // id of the input field
			ifFormat: "%Y-%m-%d", // format of the input field
			align: "Tl", // alignment (defaults to "Bl")
			displayArea: ("fch-" + idPost), // ID of the span where the date is to be shown
			singleClick: true
		});
	}
	
	//activamos el TinyMCE para que se aplique al <div class='innerContent'>
	EnablePostContent(idPost, plainTextContent);	
}

function EnablePostContent(idPost, plainTextContent){
	
	//Ocultamos los botones de agregar/editar/eliminar y desactivamos los botones que no pertenecen a este post
	ToggleEditButtons(idPost, false);
		
	if (plainTextContent) {
		tinymceInitOneRow();
		tinyMCE.execCommand('mceAddControl', false, ("area-" + idPost));
	}
	else {
		elements = document.getElementsByTagName("input");
		for (var i = 0; i < elements.length; i++) {
			if (elements[i].id == ("input-" + idPost)) {
				elements[i].className = "PostInputEdit";
				elements[i].disabled = false;
			}
		}
		
		elements = document.getElementsByTagName("div");
		for (var i = 0; i < elements.length; i++) {
			if (elements[i].id == ("div-" + idPost)) {				
				try{
					tinymceInitTwoRows();
					//alert("activando: div-" + idPost);
					tinyMCE.execCommand('mceAddControl', false, ("div-" + idPost));				
				}catch(e) { alert("error: " + e); }
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
		document.getElementById("fch-" + idPost).className = "PostDate";
		document.getElementById("fch-" + idPost).disabled = true;		
		document.getElementById("fch-" + idPost).innerHTML = "";
	}	
	
	//desactivamos el TinyMCE
	DisablePostContent(idPost, plainTextContent);
}

function DisablePostContent(idPost, plainTextContent){
	
	//Mostramos los botones de agregar/editar/eliminar y activamos los botones que no pertenecen a este post
	ToggleEditButtons(idPost, true);
	
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
		for (var i = 0; i < elements.length; i++) {
			if (elements[i].id == ("div-" + idPost)) {
				try{
					//alert("desactivando: div-" + idPost);
					tinyMCE.execCommand('mceRemoveControl', true, ("div-" + idPost));
				}catch(e){ alert("error: " + e); }
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
	//alert("actionpost: " + actionPost);
	if(idPost == "contacto"){
		AjaxSendContacto(document.getElementById("area-" + idPost).innerHTML);
		return null;
	}
	
	if(idPost == "Acerca de la Unidad"){
		AjaxSendAbout(document.getElementById("area-" + idPost).innerHTML);
		return null;
	}
	
	if(idPost == "suscripcion"){
		AjaxSendSuscripcion(document.getElementById("area-" + idPost).innerHTML);
		return null;
	}
	
	tablaPost = document.getElementById("tbl-" + idPost).value;
	indexPost = document.getElementById("id-" + idPost).value;
	
	switch(tablaPost){
		case "novedades":
			tituloPost = document.getElementById("txt-" + idPost).value;
			fechaPost = document.getElementById("fch-" + idPost).value;
			contenidoPost = document.getElementById("area-" + idPost).innerHTML;
			xmlHttp = AjaxSend("action=" + actionPost + "&table=" + tablaPost + "&title=" + tituloPost + "&content=" + contenidoPost + "&date=" + fechaPost + "&id=" + indexPost);
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
			xmlHttp = AjaxSend("action=" + actionPost + "&table=" + tablaPost + "&apellidos=" + apellidosPost + "&nombres=" + nombresPost + "&grado=" + gradoPost + "&desc=" + descripcionPost + "&id=" + indexPost);
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
			xmlHttp = AjaxSend("action=" + actionPost + "&table=" + tablaPost + "&title=" + tituloPost + "&link=" + vinculoPost + "&desc=" + descripcionPost + "&id=" + indexPost);
			break;
			
		case "procesos":
			indexPost = document.getElementById("id-bigimg").value;
			tituloPost = document.getElementById("txt-cont").value;
			descripcionPost = document.getElementById("div-cont").innerHTML;
			xmlHttp = AjaxSend("action=" + actionPost + "&table=" + tablaPost + "&title=" + tituloPost + "&desc=" + descripcionPost + "&id=" + indexPost);
			break;
	}

	//Tomamos el valor que nos devuelva el servidor via ajax e invocamos una funcion que se encargara de procesar la respuesta.
	xmlHttp.onreadystatechange = function(){
		if (xmlHttp.readyState == 4) {
			//alert("response received: " + xmlHttp.responseText);	
			CatchSavedPost(tablaPost, uid);
		}
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
	if(tablaPost == "procesos")
		indexPost = document.getElementById("id-bigimg").value;
	if (confirm("Esta seguro que desea eliminar este elemento?")) {
		if (document.getElementById("pst-" + idPost) != null) {
			if(tablaPost != "procesos")
				document.getElementById("pst-" + idPost).parentNode.removeChild(document.getElementById("pst-" + idPost));
		}
		AjaxSend("action=del&table=" + tablaPost + "&id=" + indexPost);
		refreshPage(tablaPost, uid);
		
	}
}

function DelPostNoConfirm(idPost){
	if(document.getElementById("pst-" + idPost) != null)
		document.getElementById("pst-" + idPost).parentNode.removeChild(document.getElementById("pst-" + idPost));
}


function CatchSavedPost(tablaPost, uid){
	refreshPage(tablaPost, uid);
}

function CatchNewPost(tablaPost, responseText){
	document.getElementById("area-").innerHTML = responseText + document.getElementById("area-").innerHTML;
	if(tablaPost == "novedades")
		EnablePost("-1", '1');
	else
		EnablePostContent("-1", '');
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
