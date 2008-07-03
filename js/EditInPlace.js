/**
 * @author Robertux
 */

function EditText(idTxt, idBtnAdd, idBtnEdit, idBtnDel, idBtnSave, idBtnCancel){
	//alert("pase por aca1!. idTxt es " + idTxt);
	//alert("id: " + idBtnSave);
	//Cambiamos la clase CSS del control Texto, para que permita modificar su texto
	document.getElementById(idTxt).disabled = false;
	document.getElementById(idTxt).className = "innerTitleEdit";
	document.getElementById(idTxt).focus();
	//alert("pase por aca2!. idTxt es " + idTxt);
	//alert("pase por aca3!. idSav es " + idBtnSave);	
	//alert("pase por aca3!. idCan es " + idBtnCancel);	
	//Ocultamos el boton de editar
	//alert("btnEdit es: " + idBtnEdit);
	if(document.getElementById(idBtnAdd) != null)
		document.getElementById(idBtnAdd).style.display = "none";
	if(document.getElementById(idBtnEdit) != null)		
		document.getElementById(idBtnEdit).style.display = "none";
	if(document.getElementById(idBtnDel) != null)
		document.getElementById(idBtnDel).style.display = "none";
	document.getElementById(idBtnSave).style.display = "inline";
	document.getElementById(idBtnCancel).style.display = "inline";

}

function SaveText(idTxt, idBtnAdd, idBtnEdit, idBtnDel, idBtnSave, idBtnCancel){
	document.getElementById(idTxt).disabled = true;	
	document.getElementById(idTxt).className = "innerTitle";
	
	if(document.getElementById(idBtnAdd) != null)
		document.getElementById(idBtnAdd).style.display = "inline";
	if(document.getElementById(idBtnEdit) != null)		
		document.getElementById(idBtnEdit).style.display = "inline";
	if(document.getElementById(idBtnDel) != null)
		document.getElementById(idBtnDel).style.display = "inline";
	document.getElementById(idBtnSave).style.display = "none";
	document.getElementById(idBtnCancel).style.display = "none";
}

function CancelText(idTxt, idBtnAdd, idBtnEdit, idBtnDel, idBtnSave, idBtnCancel){
	document.getElementById(idTxt).disabled = true;	
	document.getElementById(idTxt).className = "innerTitle";
	
	if(document.getElementById(idBtnAdd) != null)
		document.getElementById(idBtnAdd).style.display = "inline";
	if(document.getElementById(idBtnEdit) != null)		
		document.getElementById(idBtnEdit).style.display = "inline";
	if(document.getElementById(idBtnDel) != null)
		document.getElementById(idBtnDel).style.display = "inline";
	document.getElementById(idBtnSave).style.display = "none";
	document.getElementById(idBtnCancel).style.display = "none";
}