/**
 * @author Robertux
 */

function EnablePost(idPost){
	//Cambiamos la clase CSS del control Texto, para que permita modificar su texto
	document.getElementById("txt-" + idPost).disabled = false;
	document.getElementById("txt-" + idPost).className = "innerTitleEdit";
	document.getElementById("txt-" + idPost).focus();
	
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
	//alert("id del post a desactivar: " + idPost);
	document.getElementById("txt-" + idPost).disabled = true;	
	document.getElementById("txt-" + idPost).className = "innerTitle";
	
	if (document.getElementById("fch-" + idPost) != null) {
		document.getElementById("fch-" + idPost).className = "PostDate";
		document.getElementById("fch-" + idPost).disabled = true;
		document.getElementById("fch-" + idPost).innerHTML = "";
	}
	
	
	
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
	//alert("editando post: " + idPost);
	document.getElementById("tmpcnt-" + idPost).value = document.getElementById("area-" + idPost).innerHTML;
	document.getElementById("tmptit-" + idPost).value = document.getElementById("txt-" + idPost).value;
	if (document.getElementById("fch-" + idPost) != null) {
		document.getElementById("tmpfch-" + idPost).value = document.getElementById("fch-" + idPost).value;
	}
	//alert("area guardada: " + document.getElementById("tmp-" + idPost).value);
}

function SavePost(idPost, uid){
	DisablePost(idPost);
	//alert("SavePost. uid= " + uid );
	actionPost = "edit";
	//alert("idpost: " + parseInt(document.getElementById("id-" + idPost).value));
	if(document.getElementById("id-" + idPost).value == "-1"){
		actionPost = "add";
		document.getElementById("id-" + idPost).value = GetMaxId() + 1;
		//alert("idpost: " + parseInt(document.getElementById("id-" + idPost).value));
		
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
		if(actionPost == "add"){
			xmlHttp.onreadystatechange = function(){
				if (xmlHttp.readyState == 4) {
					//alert("response received: " + xmlHttp.responseText);	
					CatchNewPost(uid);
				}
			}
		}
			
	}
	else{
		indexPost = document.getElementById("id-" + idPost).value;
		alert("indexpost: " + indexPost);
		tituloPost = document.getElementById("txt-" + idPost).value;
		contenidoPost = document.getElementById("area-" + idPost).innerHTML;
		AjaxSend("action=" + actionPost + "&table=" + tablaPost + "&title=" + tituloPost + "&content=" + contenidoPost + "&id=" + indexPost);
	}
}

function CancelPost(idPost){
	//Si estamos agregando un nuevo post y cancelamos la operacion, borramos el post
	if (document.getElementById("id-" + idPost).value == "-1") {
		DisablePost(idPost);
		document.getElementById("pst-" + idPost).parentNode.removeChild(document.getElementById("pst-" + idPost));
	}	
	//Si es un post existente, mostramos la informacion que tenia en un principio
	else{
		DisablePost(idPost);
		document.getElementById("area-" + idPost).innerHTML = document.getElementById("tmpcnt-" + idPost).value;
		document.getElementById("txt-" + idPost).value = document.getElementById("tmptit-" + idPost).value;
		if(document.getElementById("fch-" + idPost) != null)
			document.getElementById("fch-" + idPost).value = document.getElementById("tmpfch-" + idPost).value;
	}	
}

function AddPost(idPost, idTabla, uid){
	
	//alert("idtabla: " + idTabla);
	dt = new Date();
	newId = GetMaxId() + 1;
	//alert("newid: " + newId);
	var newPost = 
	" <div id='pst-" + newId + "' class='innerPost' style='width: 530px;'> " +
	" 	<div class='PostTitle' style='width: 526px;'> " +
	"			<div class='toolbox'>			   " +
	"				<input type='button' id='edit-" + newId + "' title='editar' class='edit' onClick=\"EditPost('" + newId + "')\" /> " +
	"				<input type='button' id='del-" + newId + "' title='eliminar' class='del' onClick=\"DelPost('" + newId + "', " + uid + ")\" /> " +
	"				<input type='button' id='sav-" + newId + "' title='guardar' class='sav' onClick=\"SavePost('" + newId + "', " + uid + ")\" /> " +
	"				<input type='button' id='can-" + newId + "' title='cancelar' class='can' onClick=\"CancelPost('" + newId + "')\" /> " +
	"			</div> " +
	"			<input type='text' id='fch-" + newId + "' class='PostDate' value='" +
		
	(dt.getFullYear() + "-" + (dt.getMonth()+1) + "-" + dt.getDate()) +
	
	"			' disabled='true'></input>" +
	"		<input type='text' id='txt-" + newId + "' class='innerTitle' value='Nuevo Post' disabled='true' /> " +
	"		</div> " +
	"		<div id='cont-" + newId + "' class='PostContent'> " +
	"		    <div id='area-" + newId + "' class='innerContent'> " +
	"				Contenido del nuevo post " +
	"			</div> " +
	"		</div> " +
	"		<input type='hidden' id='tmpcnt-" + newId + "' value=''/> " +
	"		<input type='hidden' id='tmptit-" + newId + "' value=''/> " +	
	"		<input type='hidden' id='tmpfch-" + newId + "' value=''/> " +	
	"		<input type='hidden' id='id-" + newId + "' value='-1'/> " +
	"		<input type='hidden' id='tbl-" + newId + "' value='" + idTabla + "'/> " +		
   	"	</div> "
   	" </div> "	
		
	document.getElementById("area-" + idPost).innerHTML = newPost + document.getElementById("area-" + idPost).innerHTML;
	EnablePost(newId);		
}

function DelPost(idPost, uid){
	//alert("DelPost. uid= " + uid);
	indexPost = document.getElementById("id-" + idPost).value;
	tablaPost = document.getElementById("tbl-" + idPost).value;
	if (confirm("Esta seguro que desea eliminar este elemento?")) {
		if (document.getElementById("pst-" + idPost) != null) 
			document.getElementById("pst-" + idPost).parentNode.removeChild(document.getElementById("pst-" + idPost));
		AjaxSend("action=del&table=" + tablaPost + "&id=" + indexPost);
		refreshPage(uid);
	}
}

function GetMaxId(){
	elements = document.getElementsByTagName("input");
	maxId = 0;
	for (i in elements) {
		try{
			if (elements[i].id.search("id-") != -1) {
				id = parseInt(elements[i].value);
				if(id > maxId){
					maxId = id;
				}
			}
		}catch(ex){
			//pass
		}		
	}
	return maxId;	
}


function CatchNewPost(uid){
	refreshPage(uid);
}
