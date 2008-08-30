/**
 * @author Robertux
 */

/*!
 * Metodo que nos permite cambiar via Ajax el contenido actual de la lista de registros por la siguiente pagina (hablando de paginacion) de estos
 * \param tabla El nombre de la tabla a la que pertenecen dichos registros
 * \param uid El ID del usuario que ha iniciado sesion actualmente
 * \param condicion Si existe algun tipo de condicion para los Posts que se van a mostrar, como por ejemplo las maestrias que pueden ser actuales o proximas
 */
 function nextPage(tabla, uid, condicion){
 	var currentPage = 0;
 	currentPage = document.getElementById("currentPage").value;
	AjaxSendRequestPage(currentPage, "next", uid, tabla, condicion);
 }

/*!
 * Metodo que nos permite cambiar via Ajax el contenido actual de la lista de registros por la pagina anterior (hablando de paginacion) de estos
 * \param tabla El nombre de la tabla a la que pertenecen dichos registros
 * \param uid El ID del usuario que ha iniciado sesion actualmente
 * \param condicion Si existe algun tipo de condicion para los Posts que se van a mostrar, como por ejemplo las maestrias que pueden ser actuales o proximas
 */
 function prevPage(tabla, uid, condicion){
 	var currentPage = 0;
 	currentPage = document.getElementById("currentPage").value;
	AjaxSendRequestPage(currentPage, "prev", uid, tabla, condicion);
 }

/*!
 * Metodo que nos permite actualizar via Ajax el contenido actual de la lista de registros
 * \param tabla El nombre de la tabla a la que pertenecen dichos registros
 * \param uid El ID del usuario que ha iniciado sesion actualmente
 * \param condicion Si existe algun tipo de condicion para los Posts que se van a mostrar, como por ejemplo las maestrias que pueden ser actuales o proximas
 */
function refreshPage(tabla, uid, condicion){
	var currentPage = 0;
	if(document.getElementById("currentPage") != null)
	 	currentPage = document.getElementById("currentPage").value;
	else
		currentPage = -1;
	AjaxSendRequestPage(currentPage, "current", uid, tabla, condicion);
}

/*!
 * Metodo invocado cuando el servidor ha devuelto la nueva pagina de registros a mostrar
 * \param ajaxResponse el texto que contiene la nueva pagina de Posts a mostrar
 */
 function CatchNewPage(ajaxResponse){
 	//alert("respuesta recibida: " + ajaxResponse);
	if(document.getElementById("pst-") != null)
		document.getElementById("pst-").innerHTML = ajaxResponse;
	else /*if (document.getElementById("pst-Acerca de la Unidad") != null)*/
		document.getElementById("pst-Acerca de la Unidad").innerHTML = ajaxResponse;
	fillup();
 }
