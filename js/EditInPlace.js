/**
 * @author Robertux
 */

function EditPost(idTxt){
	
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

function SavePost(idTxt){
	
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

function CancelPost(idTxt){
	SavePost(idTxt);
}

function AddPost(idPost){
	
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
	"		</div> " +
   	"	</div> "
   	" </div> "	
		
	document.getElementById("area-" + idPost).innerHTML = newPost + document.getElementById("area-" + idPost).innerHTML;
}

function DelPost(idPost){
	
	document.getElementById("pst-" + idPost).parentNode.removeChild(document.getElementById("pst-" + idPost));
	
}
