/**
 * @author Robertux
 */

 function nextPage(tabla, uid){
 	//alert("siguiente pagina");
 	var currentPage = 0;
 	currentPage = document.getElementById("currentPage").value;
	AjaxSendRequestPage(currentPage, "next", uid, tabla); 	
 }

 function prevPage(tabla, uid){
 	//alert("pagina anterior");
 	var currentPage = 0;
 	currentPage = document.getElementById("currentPage").value;
	AjaxSendRequestPage(currentPage, "prev", uid, tabla); 	
 }

function refreshPage(tabla, uid){
	var currentPage = 0;
	if(document.getElementById("currentPage") != null)
	 	currentPage = document.getElementById("currentPage").value;
	else
		currentPage = -1;
	AjaxSendRequestPage(currentPage, "current", uid, tabla);
}

 function CatchNewPage(ajaxResponse){
 	//alert("respuesta recibida: " + ajaxResponse);
	document.getElementById("pst-").innerHTML = ajaxResponse;
	fillup();
 }
