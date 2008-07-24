/**
 * @author Robertux
 */

 function nextPage(){
 	currentPage = 0;
 	currentPage = document.getElementById("currentPage").value;
	AjaxSendRequestPage(currentPage, "next");
 	//alert("siguiente pagina");
 }

 function prevPage(){
 	currentPage = 0;
 	currentPage = document.getElementById("currentPage").value;
	AjaxSendRequestPage(currentPage, "prev");
 	//alert("pagina anterior");
 }

 function CatchNewPage(ajaxResponse){
 	//alert("respuesta recibida: " + ajaxResponse);
	document.getElementById("pst-").innerHTML = ajaxResponse;
 }
