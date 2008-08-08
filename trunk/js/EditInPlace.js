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
	//alert("tablapost: " + tablaPost);
	if(tablaPost == "novedades"){
		indexPost = document.getElementById("id-" + idPost).value;
		tituloPost = document.getElementById("txt-" + idPost).value;
		//alert("titulo: " + tituloPost);
		//alert("la fecha contiene: " + document.getElementById("fch-" + idPost).value);
		fechaPost = document.getElementById("fch-" + idPost).value;
		//alert("fecha generada: " + fechaPost);
		contenidoPost = document.getElementById("area-" + idPost).innerHTML;
		xmlHttp = AjaxSend("action=" + actionPost + "&table=" + tablaPost + "&title=" + tituloPost + "&content=" + contenidoPost + "&date=" + fechaPost + "&id=" + indexPost);		
		//if(actionPost == "add"){
			xmlHttp.onreadystatechange = function(){
				if (xmlHttp.readyState == 4) {
					//alert("response received: " + xmlHttp.responseText);	
					CatchNewPost(tablaPost, uid);
				}
			}
		//}
			
	}
	else{
		indexPost = document.getElementById("id-" + idPost).value;
		//alert("indexpost: " + indexPost);
		tituloPost = document.getElementById("txt-" + idPost).value;
		contenidoPost = document.getElementById("area-" + idPost).innerHTML;
		xmlHttp = AjaxSend("action=" + actionPost + "&table=" + tablaPost + "&title=" + tituloPost + "&content=" + contenidoPost + "&id=" + indexPost);
		xmlHttp.onreadystatechange = function(){
			if (xmlHttp.readyState == 4) {
				//alert("response received: " + xmlHttp.responseText);	
				CatchNewPost(tablaPost, uid);
				}
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
	
	//alert("idtabla: " + idTabla);
	dt = new Date();
	var newPost = 
	" <div id='pst-0' class='innerPost' style='width: 530px;'> " +
	" 	<div class='PostTitle' style='width: 526px;'> " +
	"			<div class='toolbox'>			   " +
	"				<input type='button' id='edit-0' title='editar' class='edit' onClick=\"EditPost('0')\" /> " +
	"				<input type='button' id='del-0' title='eliminar' class='del' onClick=\"DelPost('0', " + uid + ")\" /> " +
	"				<input type='button' id='sav-0' title='guardar' class='sav' onClick=\"SavePost('0', " + uid + ")\" /> " +
	"				<input type='button' id='can-0' title='cancelar' class='can' onClick=\"CancelPost('0')\" /> " +
	"			</div> " +
	"			<input type='text' id='fch-0' class='PostDate' value='" +
		
	(dt.getFullYear() + "-" + (dt.getMonth()+1) + "-" + dt.getDate()) +
	
	"			' disabled='true'></input>" +
	"		<input type='text' id='txt-0' class='innerTitle' value='Nuevo Post' disabled='true' /> " +
	"		</div> " +
	"		<div id='cont-0' class='PostContent'> " +
	"		    <div id='area-0' class='innerContent'> " +
	"				Contenido del nuevo post " +
	"			</div> " +
	"		</div> " +
	"		<input type='hidden' id='tmpcnt-0' value=''/> " +
	"		<input type='hidden' id='tmptit-0' value=''/> " +	
	"		<input type='hidden' id='tmpfch-0' value=''/> " +	
	"		<input type='hidden' id='id-0' value='-1'/> " +
	"		<input type='hidden' id='tbl-0' value='" + idTabla + "'/> " +		
   	"	</div> "
   	" </div> "	
		
	document.getElementById("area-" + idPost).innerHTML = newPost + document.getElementById("area-" + idPost).innerHTML;
	EnablePost("0");
}

function DelPost(idPost, uid){
	//alert("DelPost. uid= " + uid);
	indexPost = document.getElementById("id-" + idPost).value;
	tablaPost = document.getElementById("tbl-" + idPost).value;
	if (confirm("Esta seguro que desea eliminar este elemento?")) {
		if (document.getElementById("pst-" + idPost) != null)		
			document.getElementById("pst-" + idPost).parentNode.removeChild(document.getElementById("pst-" + idPost));
		AjaxSend("action=del&table=" + tablaPost + "&id=" + indexPost);
		refreshPage(tablaPost, uid);
		
	}
}

function DelPostNoConfirm(idPost){
	if(document.getElementById("pst-" + idPost) != null)
		document.getElementById("pst-" + idPost).parentNode.removeChild(document.getElementById("pst-" + idPost));
}


function CatchNewPost(tablaPost, uid){
	refreshPage(tablaPost, uid);
}
