/**
 * @author Robertux
 */

 function nextPage(uid){
 	currentPage = 0;
 	currentPage = document.getElementById("currentPage").value;
	AjaxSendRequestPage(currentPage, "next", uid);
 	//alert("siguiente pagina");
 }

 function prevPage(uid){
 	currentPage = 0;
 	currentPage = document.getElementById("currentPage").value;
	AjaxSendRequestPage(currentPage, "prev", uid);
 	//alert("pagina anterior");
 }

function refreshPage(uid){
	currentPage = 0;
 	currentPage = document.getElementById("currentPage").value;
	AjaxSendRequestPage(currentPage, "current", uid);
}

 function CatchNewPage(ajaxResponse){
 	//alert("respuesta recibida: " + ajaxResponse);
	document.getElementById("pst-").innerHTML = ajaxResponse;
 }
