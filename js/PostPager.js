/**
 * @author Robertux
 */

 function nextPage(tabla, uid, condicion){
 	var currentPage = 0;
 	currentPage = document.getElementById("currentPage").value;
	AjaxSendRequestPage(currentPage, "next", uid, tabla, condicion);
 }

 function prevPage(tabla, uid, condicion){
 	var currentPage = 0;
 	currentPage = document.getElementById("currentPage").value;
	AjaxSendRequestPage(currentPage, "prev", uid, tabla, condicion);
 }

function refreshPage(tabla, uid, condicion){
	var currentPage = 0;
	if(document.getElementById("currentPage") != null)
	 	currentPage = document.getElementById("currentPage").value;
	else
		currentPage = -1;
	AjaxSendRequestPage(currentPage, "current", uid, tabla, condicion);
}

 function CatchNewPage(ajaxResponse){
 	//alert("respuesta recibida: " + ajaxResponse);
	document.getElementById("pst-").innerHTML = ajaxResponse;
	fillup();
 }
