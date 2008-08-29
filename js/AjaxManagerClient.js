/**
 * @author Robertux
 */

/*!
 * Metodo que se encarga de crear un objeto xmlHttpRequest, el cual permite la comunicacion con el servidor via Ajax.
 * Para ello, intenta detectar el navegador que utiliza el usuario para generar e inicializar el objeto correspondiente para este.
 */
function AjaxInit(){
	var xmlHttp;
	var browser = navigator.appName;
	//alert("browser: " + browser);
	if(browser == "Netscape" | browser == "Opera"){
		try{
			xmlHttp=new XMLHttpRequest();
		}catch(e){
			alert("Tu navegador no soporta AJAX!");
			return null;
		}
	}
	else if (browser == "Microsoft Internet Explorer"){
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");			
		}
		catch (e){
			try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				alert("Tu navegador no soporta AJAX!");
				return null;
			}
		}
	}
	return xmlHttp;
}

/*!
 * Metodo que se encarga de enviar un mensaje al sevidor a traves del objeto xmlHttpRequest generado por el metodo AjaxInit()
 * \param content El contenido que se desea enviar al servidor como un parametro GET a traves de la URL.
 * \param responseObject Objeto que se le pasa como parametro opcional el cual contiene un metodo llamado ResponseFunction. Este metodo es invocado cuando el servidor ha devuelto una respuesta y dicha respuesta se pasa como parametro al metodo del objeto.
 */
function AjaxSend(content, responseObject){
	//!Generando el objeto xmlHttpRequest usando el metodo AjaxInit()
	var xmlHttp = AjaxInit();
	//alert("enviando contenido: " + content);
	//!Enviando el contenido al servidor usando el objeto xmlHttpRequest
    xmlHttp.open("GET", "../lib/AjaxManagerServer.php?" + content, true);
	if (responseObject != null) {
		//!Si responseObject es diferente de null, quien invoco esta funcion desea que la respuesta del servidor (responseText) sea pasada como parametro al metodo ResponseFunction, del objeto en cuestion
		if (responseObject.responseFunction != null) {
			xmlHttp.onreadystatechange = function(){
				//alert("readystate: " + xmlHttp.readyState);
				if (xmlHttp.readyState == 4) {
					//alert("respuesta: " + xmlHttp.responseText);
					responseObject.responseFunction(xmlHttp.responseText);
				}
			}
		}
	}
	xmlHttp.send(null);
	return xmlHttp;
}

/*!
 * Metodo que se encarga de enviar los cambios en la seccion de Acerca de la Unidad, haciendo uso del metodo AjaxSend()
 * \param content Este contiene los cambios realizados en la seccion de Acerca de la Unidad, para enviarlos al servidor
 * \param obj El objeto ResponseObject, el cual es pasado como parametro opcional, si quien invoco a este metodo desea recibir una respuesta del servidor
 */
function AjaxSendAbout(content, obj){	
	AjaxSend("action=editabout&value=" + content, obj);
}

/*!
 * Metodo que se encarga de enviar los cambios en la seccion de Contacto de la Unidad, haciendo uso del metodo AjaxSend()
 * \param content Este contiene los cambios realizados en la seccion de de Contacto, para enviarlos al servidor
 * \param obj El objeto ResponseObject, el cual es pasado como parametro opcional, si quien invoco a este metodo desea recibir una respuesta del servidor
 */
function AjaxSendContacto(content, obj){	
	AjaxSend("action=editcontacto&value=" + content, obj);
}

/*!
 * Metodo que se encarga de enviar los cambios en la seccion de Suscripcion de la Unidad, haciendo uso del metodo AjaxSend()
 * \param content Este contiene los cambios realizados en la seccion de de Suscripcion, para enviarlos al servidor
 * \param obj El objeto ResponseObject, el cual es pasado como parametro opcional, si quien invoco a este metodo desea recibir una respuesta del servidor
 */
function AjaxSendSuscripcion(content, obj){	
	AjaxSend("action=editsuscripcion&value=" + content, obj);
}

/*!
 * Metodo que se encarga de pedir una nueva pagina (hablando de paginacion de registros) al servidor, haciendo uso del metodo AjaxSend()
 * \param currentPage La pagina que se esta mostrando actualmente
 * \param newPage La pagina que se desea mostrar
 * \param uid El ID del usuario que ha iniciado sesion en el sitio (si es que existe uno) para definir si la nueva pagina mostrara los posts con los botones de agregar/modificar/eliminar, lo cual solo es permitido si el usuario es administrador
 * \param tabla La tabla de la base de datos de la cual se esta pidiendo la nueva pagina de registros
 * \param condicion Condicion opcional, si los registros paginados poseen algun tipo de condicion. Ejemplo, si se piden nada mas las maestrias actuales o solo las proximas
 */
function AjaxSendRequestPage(currentPage, newPage, uid, tabla, condicion){	
	//!creando el objeto ResponseObject
	var obj = new Object();
	//!Creando la funcion ResponseFunction para el ResponseObject
	obj.responseFunction = function(responseText){
		//!Esta funcion, la cual sera invocada cuando se reciba un mensaje de vuelta del servidor, ejecutara el metodo CatchNewPage, ubicado en EditInPlace.js
		CatchNewPage(responseText);
	}
	pCondicion = "";
	if(condicion)
		pCondicion = "&cond=" + condicion;	
	var xmlHttp = AjaxSend("action=getpage&current=" + currentPage + "&new=" + newPage + "&uid=" + uid + "&tabla=" + tabla + pCondicion, obj);
}

/*!
 * Metodo que se encarga de pedir un nuevo Post al servidor, haciendo uso del metodo AjaxSend()
 * \param tabla La tabla de la base de datos de la cual se esta pidiendo la nueva pagina de registros
 * \param uid El ID del usuario que ha iniciado sesion en el sitio (si es que existe uno) para definir si el nuevo post a agregar debera poseer habilitados los botones de agrega/modificar/eliminar, lo cual solo es permitido si el usuario es administrador
 * \param showdate Valor booleano que define si el titulo del nuevo post debera mostrar y activar el campo de la fecha, como es el cado de los posts de Novedades de la Unidad.
 */
function AjaxSendRequestPost(tabla, uid, showdate){	
	//!creando el objeto ResponseObject
	var obj = new Object();
	//!Creando la funcion ResponseFunction para el ResponseObject
	obj.responseFunction = function(responseText){		
		//!Esta funcion, la cual sera invocada cuando se reciba un mensaje de vuelta del servidor, ejecutara el metodo CatchNewPost, ubicado en EditInPlace.js
		CatchNewPost(tabla, responseText);
	}
	var xmlHttp = AjaxSend("action=getpost&tabla=" + tabla + "&uid=" + uid + "&showdate=" + showdate, obj);
}