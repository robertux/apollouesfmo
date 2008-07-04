/**
 * @author Robertux
 */

function EditText(idTxt){
	
	//Cambiamos la clase CSS del control Texto, para que permita modificar su texto
	document.getElementById("txt-" + idTxt).disabled = false;
	document.getElementById("txt-" + idTxt).className = "innerTitleEdit";
	document.getElementById("txt-" + idTxt).focus();
	
	//Ocultamos los botones de agregar/editar/eliminar
	if(document.getElementById("add-" + idTxt) != null)
		document.getElementById("add-" + idTxt).style.display = "none";
	if(document.getElementById("edit-" + idTxt) != null)		
		document.getElementById("edit-" + idTxt).style.display = "none";
	if(document.getElementById("del-" + idTxt) != null)
		document.getElementById("del-" + idTxt).style.display = "none";
	//mostramos los botones de guardar/cancelar
	document.getElementById("sav-" + idTxt).style.display = "inline";
	document.getElementById("can-" + idTxt).style.display = "inline";
	
	//activamos el TinyMCE para que se aplique al <div class='innerContent'>
	tinyMCE.execCommand('mceAddControl', false, ("area-" + idTxt));
}

function SaveText(idTxt){
	
	//Cambiamos la clase CSS del control Texto, para que ya no permita modificar su texto	
	document.getElementById("txt-" + idTxt).disabled = true;	
	document.getElementById("txt-" + idTxt).className = "innerTitle";
	
	//Mostramos los botones de agregar/editar/eliminar
	if(document.getElementById("add-" + idTxt) != null)
		document.getElementById("add-" + idTxt).style.display = "inline";
	if(document.getElementById("edit-" + idTxt) != null)		
		document.getElementById("edit-" + idTxt).style.display = "inline";
	if(document.getElementById("del-" + idTxt) != null)
		document.getElementById("del-" + idTxt).style.display = "inline";
	//ocultamos los botones de guardar/cancelar		
	document.getElementById("sav-" + idTxt).style.display = "none";
	document.getElementById("can-" + idTxt).style.display = "none";
	
	//desactivamos el TinyMCE
	tinyMCE.execCommand('mceRemoveControl', false, "area-" + idTxt);
}

function CancelText(idTxt){
	SaveText(idTxt);
}