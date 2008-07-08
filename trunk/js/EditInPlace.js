/**
 * @author Robertux
 */

function EnablePost(idPost){
	//Cambiamos la clase CSS del control Texto, para que permita modificar su texto
	document.getElementById("txt-" + idPost).disabled = false;
	document.getElementById("txt-" + idPost).className = "innerTitleEdit";
	document.getElementById("txt-" + idPost).focus();
	
	//Ocultamos los botones de agregar/editar/eliminar
	if(document.getElementById("add-" + idPost) != null)
		document.getElementById("add-" + idPost).style.display = "none";
	if(document.getElementById("edit-" + idPost) != null)		
		document.getElementById("edit-" + idPost).style.display = "none";
	if(document.getElementById("del-" + idPost) != null)
		document.getElementById("del-" + idPost).style.display = "none";
	//mostramos los botones de guardar/cancelar
	document.getElementById("sav-" + idPost).style.display = "inline";
	document.getElementById("can-" + idPost).style.display = "inline";
	
	//activamos el TinyMCE para que se aplique al <div class='innerContent'>
	tinyMCE.execCommand('mceAddControl', false, ("area-" + idPost));
}

function DisablePost(idPost){
	//Cambiamos la clase CSS del control Texto, para que ya no permita modificar su texto	
	document.getElementById("txt-" + idPost).disabled = true;	
	document.getElementById("txt-" + idPost).className = "innerTitle";
	
	//Mostramos los botones de agregar/editar/eliminar
	if(document.getElementById("add-" + idPost) != null)
		document.getElementById("add-" + idPost).style.display = "inline";
	if(document.getElementById("edit-" + idPost) != null)		
		document.getElementById("edit-" + idPost).style.display = "inline";
	if(document.getElementById("del-" + idPost) != null)
		document.getElementById("del-" + idPost).style.display = "inline";
	//ocultamos los botones de guardar/cancelar		
	document.getElementById("sav-" + idPost).style.display = "none";
	document.getElementById("can-" + idPost).style.display = "none";
	
	//desactivamos el TinyMCE
	tinyMCE.execCommand('mceRemoveControl', false, "area-" + idPost);
}

function EditPost(idPost){
	EnablePost(idPost);
	//guardamos el contenido del post en un elemento temporal
	document.getElementById("tmp-" + idPost).value = document.getElementById("area-" + idPost).innerHTML;
	//alert("area guardada: " + document.getElementById("tmp-" + idPost).value);
}

function SavePost(idPost){
	DisablePost(idPost);
	actionPost = "edit";
	if(idPost == "NuevoPost"){
		actionPost = "add";
	}
	
	if(idPost == "Acerca de la Unidad"){
		AjaxSendAbout(document.getElementById("area-" + idPost).innerHTML);
	}
	tablaPost = document.getElementById("tbl-" + idPost).value;
	//alert("tablapost: " + tablaPost);
	if(tablaPost == "novedades"){
		indexPost = document.getElementById("id-" + idPost).value;
		tituloPost = document.getElementById("txt-" + idPost).value;
		alert("titulo: " + tituloPost);
		fechaPost = "1900-01-01 00:00:00";
		contenidoPost = document.getElementById("area-" + idPost).innerHTML;
		AjaxSend("action=" + actionPost + "&table=" + tablaPost + "&title=" + tituloPost + "&content=" + contenidoPost + "&date=" + fechaPost + "&id=" + indexPost);
	}
	else{
		indexPost = document.getElementById("id-" + idPost).value;
		tituloPost = document.getElementById("txt-" + idPost).value;
		contenidoPost = document.getElementById("area-" + idPost).innerHTML;
		AjaxSend("action=" + actionPost + "&table=" + tablaPost + "&title=" + tituloPost + "&content=" + contenidoPost + "&id=" + indexPost);
	}
}

function CancelPost(idPost){
	//Si estamos agregando un nuevo post y cancelamos la operacion, borramos el post
	if (idPost == "NuevoPost") {
			DelPost(idPost);
	}	
	//Si es un post existente, mostramos la informacion que tenia en un principio
	else{
		DisablePost(idPost);
		document.getElementById("area-" + idPost).innerHTML = document.getElementById("tmp-" + idPost).value;
	}		
	
}

function AddPost(idPost, idTabla){
	
	//alert("idtabla: " + idTabla);
	var newPost =
	" <div id='pst-NuevoPost' class='innerPost' style='width: 530px;'> " +
	" 	<div class='PostTitle' style='width: 526px;'> " +
	"			<div class='toolbox'>			   " +
	"				<input type='button' id='edit-NuevoPost' title='editar' class='edit' onClick=\"EditPost('NuevoPost')\" /> " +
	"				<input type='button' id='del-NuevoPost' title='eliminar' class='del' onClick=\"DelPost('NuevoPost')\" /> " +
	"				<input type='button' id='sav-NuevoPost' title='guardar' class='sav' onClick=\"SavePost('NuevoPost')\" /> " +
	"				<input type='button' id='can-NuevoPost' title='cancelar' class='can' onClick=\"CancelPost('NuevoPost')\" /> " +
	"			</div> " +
	"		<input type='text' id='txt-NuevoPost' class='innerTitle' value='Nuevo Post' disabled='true' /> " +
	"		</div> " +
	"		<div id='cont-NuevoPost' class='PostContent'> " +
	"		    <div id='area-NuevoPost' class='innerContent'> " +
	"				Contenido del nuevo post " +
	"			</div> " +
	"			<input type='hidden' id='tmp-NuevoPost' value=''/> " +
	"			<input type='hidden' id='id-NuevoPost' value='-1'/> " +
	"			<input type='hidden' id='tbl-NuevoPost' value='" + idTabla + "'/> " +
	"		</div> " +
   	"	</div> "
   	" </div> "	
		
	document.getElementById("area-" + idPost).innerHTML = newPost + document.getElementById("area-" + idPost).innerHTML;
	EditPost("NuevoPost");
}

function DelPost(idPost){
	indexPost = document.getElementById("id-" + idPost).value;
	tablaPost = document.getElementById("tbl-" + idPost).value;
	if (confirm("Esta seguro que desea eliminar este elemento?")) {
		if (document.getElementById("pst-" + idPost) != null) 
			document.getElementById("pst-" + idPost).parentNode.removeChild(document.getElementById("pst-" + idPost));
		AjaxSend("action=del&table=" + tablaPost + "&id=" + indexPost);
	}
}