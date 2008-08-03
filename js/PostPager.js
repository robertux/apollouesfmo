/**
 * @author Robertux
 */

 function nextPage(tabla, uid){
 	currentPage = 0;
 	currentPage = document.getElementById("currentPage").value;
	AjaxSendRequestPage(currentPage, "next", uid, tabla);
 	//alert("siguiente pagina");
 }

 function prevPage(tabla, uid){
 	currentPage = 0;
 	currentPage = document.getElementById("currentPage").value;
	AjaxSendRequestPage(currentPage, "prev", uid, tabla);
 	//alert("pagina anterior");
 }

function refreshPage(tabla, uid){
	currentPage = 0;
 	currentPage = document.getElementById("currentPage").value;
	AjaxSendRequestPage(currentPage, "current", uid, tabla);
}

 function CatchNewPage(ajaxResponse){
 	//alert("respuesta recibida: " + ajaxResponse);
	document.getElementById("pst-").innerHTML = ajaxResponse;
 }
