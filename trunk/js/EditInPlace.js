/**
 * @author Robertux
 */

/*!
 * Metodo que se encarga de Mostrar un Post como Activo, permitiendo editar todos los elementos que posee, como el titulo, contenido, fecha, etc.
 * \param idPost el id del Post, usado para hacer referencia a los elementos HTML que lo conforman
 */
function EnablePost(idPost, plainTextContent){
	//Cambiamos la clase CSS del control Texto, para que permita modificar su texto
	document.getElementById("txt-" + idPost).disabled = false;
	document.getElementById("txt-" + idPost).className = "innerTitleEdit";
	document.getElementById("txt-" + idPost).focus();
	
	//Activamos el calendario
	if (document.getElementById("fch-" + idPost) != null) {
		document.getElementById("fch-" + idPost).className = "PostDateEdit";
		document.getElementById("fch-" + idPost).disabled = false;
		document.getElementById("fch-" + idPost).onkeypress = function() { return false; }
		try{
			Calendar.setup({
				inputField: ("fch-" + idPost), // id of the input field
				ifFormat: "%Y-%m-%d", // format of the input field
				align: "Tl", // alignment (defaults to "Bl")
				displayArea: ("fch-" + idPost), // ID of the span where the date is to be shown
				singleClick: true
			});
			document.getElementById("fch-" + idPost).value = document.getElementById("fch-" + idPost).value.substr(0, 10);
		}catch(e){ /*pass */ }
	}
	
	//Activamos el contenido interno del Post
	EnablePostContent(idPost, plainTextContent);	
}

/*!
 * Metodo que nos permite activar el contenido interno de un Post, sin necesidad de activar su titulo
 * \param idPost El id del Post, usado para hacer referencia a los elementos HTML que lo conforman
 * \param plainTextContext Valor booleano que nos indica si el contenido del Post es texto plano (como por ejemplo, los Post de las Novedades de la Unidad), para los cuales, todo el contenido es un campo que se activa con el TinyMCE, o es contenido compuesto por una tabla, para la cual, cada fila tiene su propio INPUT a activar.
 */
function EnablePostContent(idPost, plainTextContent){
	
	//!Ocultamos los botones de agregar/editar/eliminar y desactivamos los botones que no pertenecen a este post
	ToggleEditButtons(idPost, false);
	//!Si la tabla que estamos mostrando es de usuarios, vamos a mostrar el contenido completo del post a menos que lo desee editar.
	if(document.getElementById("tbl-" + idPost).value == "usuario")
		document.getElementById("area-" + idPost).style.display = "block";

	//!Si el contenido es texto plano, simplemente invocamos al TinyMCE para que convierta ese DIV en un Editor Rich Text
	if (plainTextContent) {
		tinymceInitOneRow();
		tinyMCE.execCommand('mceAddControl', false, ("area-" + idPost));
	}
	//!Si no es asi...
	else {
		//!Revisamos todos los elementos INPUT de la pagina...
		elements = document.getElementsByTagName("input");		
		for (var i = 0; i < elements.length; i++) {
			//!Filtramos para almacenar solamente los que forman parte del post que estamos activando
			if (elements[i].id == ("input-" + idPost) || elements[i].id == ("upld-" + idPost) || elements[i].id == ("fch-" + idPost) || elements[i].id == ("num-" + idPost)) {
				//!Cambiamos su layout CSS para que se vea como un INPUT en edicion
				elements[i].className = "PostInputEdit";
				//!Activamos el control
				elements[i].disabled = false;
			}
		}
		
		//!Si tambien hay de tipo INPUT, estos son elementos DIV que deberan ser activados con el TinyMCE para convertirlos en Rich Text Boxes
		elements = document.getElementsByTagName("div");
		var divIdExtra = 1;
		for (var i = 0; i < elements.length; i++) {
			//!Filtramos solo los que tengan el ID que corresponde a los elementos del post que estamos activando. Si solamente es div- idPost, es porque es el unico DIV de nuestro post
			if (elements[i].id == ("div-" + idPost)) {
				try{
					//!Se invoca al metodo TinyMCEInitTwoRows(), el cual carga el TinyMCE con un Layout de botones en dos filas
					tinymceInitTwoRows();
					//alert("activando: div-" + idPost);
					tinyMCE.execCommand('mceAddControl', false, ("div-" + idPost));
				}catch(e) { alert("error: " + e); }
			}
			//!Si en cambio, coincide con el ID de tipo div- idPost - divIdExtra, es porque son varios DIVS los que forman parte de nuestro Post
			//!divIdExtra es un contador que genera un numero para conformar todos los IDs correlativos de los DIV contenidos en nuestro Post
			if (elements[i].id == ("div-" + idPost + "-" + divIdExtra)) {
				//try{					
					//alert("buscando div-" + idPost + "-" + divIdExtra);
					tinymceInitTwoRows();
					tinyMCE.execCommand('mceAddControl', false, ("div-" + idPost + "-" + divIdExtra));
					divIdExtra++;
				//}catch(e){ /* pass */ }
			}
		}
	}		
}

/*!
 * Metodo que se encarga de Mostrar un Post como Inactivo, impidiendo editar los elementos que posee.
 * \param idPost el id del Post, usado para hacer referencia a los elementos HTML que lo conforman
 */
function DisablePost(idPost, plainTextContent){
	//Cambiamos la clase CSS del control Texto, para que ya no permita modificar su texto
	//alert("id del post a desactivar: " + idPost);
	document.getElementById("txt-" + idPost).disabled = true;	
	document.getElementById("txt-" + idPost).className = "innerTitle";
	
	//!Desactivamos el calendario
	if (document.getElementById("fch-" + idPost) != null) {
		try{
			document.getElementById("fch-" + idPost).className = "PostDate";
			document.getElementById("fch-" + idPost).disabled = true;		
			document.getElementById("fch-" + idPost).innerHTML = "";
		}catch(e) { /*pass */ }
	}	
	
	//desactivamos el TinyMCE
	DisablePostContent(idPost, plainTextContent);
}

/*!
 * Metodo que nos permite desactivar el contenido interno de un Post, sin necesidad de desactivar su titulo
 * \param idPost El id del Post, usado para hacer referencia a los elementos HTML que lo conforman
 * \param plainTextContext Valor booleano que nos indica si el contenido del Post es texto plano (como por ejemplo, los Post de las Novedades de la Unidad), para los cuales, todo el contenido es un campo que se activa con el TinyMCE, o es contenido compuesto por una tabla, para la cual, cada fila tiene su propio INPUT a activar.
 */
function DisablePostContent(idPost, plainTextContent){
	
	//Mostramos los botones de agregar/editar/eliminar y activamos los botones que no pertenecen a este post
	ToggleEditButtons(idPost, true);
	
	//!Si la tabla que estamos mostrando es de usuarios, ocultamos nuevamente el contenido del post
	if(document.getElementById("tbl-" + idPost).value == "usuario")
		document.getElementById("area-" + idPost).style.display = "none";
	
	//!Si el contenido es texto plano, simplemente invocamos al TinyMCE para que convierta ese Editor Rich Text nuevamente en un DIV
	if (plainTextContent) {
		tinyMCE.execCommand('mceRemoveControl', false, "area-" + idPost);
	}
	//!Si no es asi...
	else {
		//!Revisamos todos los elementos INPUT de la pagina...
		elements = document.getElementsByTagName("input");		
		for (var i = 0; i < elements.length; i++) {
			//!Filtramos para almacenar solamente los que forman parte del post que estamos activando
			if (elements[i].id == ("input-" + idPost)) {
				//!Se desactivan dichos elementos
				elements[i].className = "PostInput";
				elements[i].disabled = true;
			}
		}
		//!Si tambien hay de tipo INPUT, estos son elementos DIV que deberan ser activados con el TinyMCE para convertirlos en Rich Text Boxes
		elements = document.getElementsByTagName("div");
		var divIdExtra = 1;
		for (var i = 0; i < elements.length; i++) {
			//!Filtramos solo los que tengan el ID que corresponde a los elementos del post que estamos activando. Si solamente es div- idPost, es porque es el unico DIV de nuestro post
			if (elements[i].id == ("div-" + idPost)) {
				try{
					//alert("desactivando: div-" + idPost);
					//!Desactivamos via TinyMCE
					tinyMCE.execCommand('mceRemoveControl', true, ("div-" + idPost));
				}catch(e){ alert("error: " + e); }
			}
			//!Si en cambio, coincide con el ID de tipo div- idPost - divIdExtra, es porque son varios DIVS los que forman parte de nuestro Post
			//!divIdExtra es un contador que genera un numero para conformar todos los IDs correlativos de los DIV contenidos en nuestro Post
			if (elements[i].id == ("div-" + idPost + "-" + divIdExtra)) {
				//try{					
					//alert("buscando div-" + idPost + "-" + divIdExtra);
					//!Desactivamos via TinyMCE
					tinymceInitTwoRows();
					tinyMCE.execCommand('mceRemoveControl', false, ("div-" + idPost + "-" + divIdExtra));
					divIdExtra++;
				//}catch(e){ /* pass */ }
			}
		}
	}
		
}

/*!
 * Metodo que nos permite mostrar u ocultar los botones de la ToolBox de un Post, estos son Agregar/Modificar/Eliminar. Ademas de ocultar estos botones, muestra los correpondientes de Guardar/Cancelar
 * \param idPost El ID del Post al cual se le desean mostrar/ocultar los botones de edicion
 * \param state El estado que se le desea aplicar a dichos botones. True es para activarlos y False para desactivarlos
 */
function ToggleEditButtons(idPost, state){
	//seleccionar todos los elementos <div>
	array = document.getElementsByTagName("input");
	
	//esto debido a que en los botones la propiedad es "disabled" en lugar de "enabled" y aca se esta usando un valor true para activarlos y un valor false para desactivarlos (es mas logico)
	state = !state;
	
	//recorrer todos los elementos <div>
	for (var i = 0; i < array.length; i++) {
	
		//si el id del elemento contiene 'add-', 'edit-' o 'del-'...
		if ((array[i].id.search(/add-/) != -1) || (array[i].id.search(/edit-/) != -1) || (array[i].id.search(/del-/) != -1)) {
		
			//si es diferente que el post actual...
			array[i].disabled = state;
			//!Mostramos/ocultamos los elementos en base al estilo CSS, dependiendo de su estado
			array[i].style.display = (state? "none": "inline");
		}
	}
	
	//mostramos/ocultamos los botones de agregar/editar/eliminar o los de guardar/cancelar. Dependiendo del estado.
	displayEditStatus = "";
	displaySaveStatus = "";
	if (state) {
		displayEditStatus = "none";
		displaySaveStatus = "inline";
	}
	else {
		displayEditStatus = "inline";
		displaySaveStatus = "none";
	}
	
	//Una vez definidas las variables, las aplicamos a los elementos.
	if(document.getElementById("add-" + idPost) != null)
		document.getElementById("add-" + idPost).style.display = displayEditStatus;
	if(document.getElementById("edit-" + idPost) != null)		
		document.getElementById("edit-" + idPost).style.display = displayEditStatus;
	if(document.getElementById("del-" + idPost) != null)
		document.getElementById("del-" + idPost).style.display = displayEditStatus;
	//mostramos/ocultamos los botones de guardar/cancelar		
	document.getElementById("sav-" + idPost).style.display = displaySaveStatus;
	document.getElementById("can-" + idPost).style.display = displaySaveStatus;
	
}

/*!
 * Metodo que nos permite cambiar un Post a su modo de edicion
 * \param idPost El ID del Post que deseamos editar
 * \param plainTextContent Valor booleano que nos indica si el contenido del post es texto plano o contenido multiple como una tabla
 */
function EditPost(idPost, plainTextContent){	
	//guardamos el contenido del post en elementos temporales
	//alert("editando post: " + idPost);
	document.getElementById("tmpcnt-" + idPost).value = document.getElementById("area-" + idPost).innerHTML;
	document.getElementById("tmptit-" + idPost).value = document.getElementById("txt-" + idPost).value;
	if (document.getElementById("fch-" + idPost) != null) {
		document.getElementById("tmpfch-" + idPost).value = document.getElementById("fch-" + idPost).value;
	}
	EnablePost(idPost, plainTextContent);
	//alert("area guardada: " + document.getElementById("tmp-" + idPost).value);
}

/*!
 * Metodo que nos permite cambiar nada mas el contenido de un Post a su modo de edicion
 * \param idPost El ID del Post que deseamos editar
 * \param plainTextContent Valor booleano que nos indica si el contenido del post es texto plano o contenido multiple como una tabla
 */
function EditPostContent(idPost, plainTextContent){
	
	//guardamos el contenido del post en un elemento temporal
	//alert("editando post: " + idPost);
	document.getElementById("tmpcnt-" + idPost).value = document.getElementById("area-" + idPost).innerHTML;
	document.getElementById("tmptit-" + idPost).value = document.getElementById("txt-" + idPost).value;
	if (document.getElementById("fch-" + idPost) != null) {
		document.getElementById("tmpfch-" + idPost).value = document.getElementById("fch-" + idPost).value;
	}
	EnablePostContent(idPost, plainTextContent);
}

/*!
 * Metodo que nos permite guardar en el servidor, via Ajax, los cambios de un Post nuevo/modificado
 * \param idPost El ID del post que deseamos guardar
 * \param uid El ID del usuario que ha iniciado seccion actualmente
 * \param plainTextContent Define si el contenido del Post nuevo/modificado es texto plano o contenido mas complejo
 */
function SavePost(idPost, uid, plainTextContent){
	//!Primeramente, desactivamos el post
	DisablePost(idPost, plainTextContent);
	//!Creamos una variable para almacenar el objeto xmlHttpRequest
	var xmlHttp;
	//alert("SavePost. uid= " + uid );
	//!Definimos el actionPost (add/edit) en base al ID del post
	actionPost = "edit";
	//alert("idpost: " + document.getElementById("id-" + idPost).value);
	if(document.getElementById("id-" + idPost).value == "-1"){
		actionPost = "add";
		document.getElementById("id-" + idPost).value = "0";
		DelPostNoConfirm("noresults");
		//alert("idpost: " + document.getElementById("id-" + idPost).value);
		
	}
	
	//!Tomamos el valor que nos devuelva el servidor via ajax e invocamos una funcion que se encargara de procesar la respuesta.
	var obj = new Object();
	//!Creamos el metodo ResponseFunction para el objeto ResponseObject que se le pasara al xmlHttpReques y asi obtener la respuesta del servidor
	obj.responseFunction = function(responseText){
		//!Al obtener la respuesta del servidor, invocaremos este metodo:
		CatchSavedPost(tablaPost, uid, responseText, idPost);
	}	
	
	//!Invocamos al metodo AjaxSend apropiado, en base al actionPost y a la tablaPost, pasandole los parametros necesarios
	
	//alert("actionpost: " + actionPost);
	//!Si la accion del Post es editar la seccion de Contacto de la Unidad...
	if(idPost == "contacto"){
		AjaxSendContacto(document.getElementById("area-" + idPost).innerHTML, obj);
		return null;
	}
	
	//!Si la accion del Post es editar la seccion del Acerca de la Unidad...
	if(idPost == "Acerca de la Unidad"){
		AjaxSendAbout(document.getElementById("area-" + idPost).innerHTML, obj);
		return null;
	}
	
	//!Si la accion del Post es editar la seccion de Suscripcion de la Unidad...
	if(idPost == "suscripcion"){
		AjaxSendSuscripcion(document.getElementById("area-" + idPost).innerHTML, obj);
		return null;
	}
	
	//!Obtenemos la tabla a la que pertenece el registro que almacena el Post, ademas del ID del registro
	tablaPost = document.getElementById("tbl-" + idPost).value;
	indexPost = document.getElementById("id-" + idPost).value;
	
	//!Evaluamos en base a la tabla, para saber que parametros mandar al AjaxSend(), tomando los elementos internos del Post para enviarlos como parametros.
	switch(tablaPost){
		case "novedades":
			tituloPost = document.getElementById("txt-" + idPost).value;
			fechaPost = document.getElementById("fch-" + idPost).value.substr(0,10);
			contenidoPost = document.getElementById("area-" + idPost).innerHTML;
			xmlHttp = AjaxSend("action=" + actionPost + "&table=" + tablaPost + "&title=" + tituloPost + "&content=" + contenidoPost + "&date=" + fechaPost + "&id=" + indexPost, obj);
			break;
		
		case "docente":
			var allItems = document.getElementsByTagName("input");
			var postItems = [];			
			for(var i=0; i<allItems.length; i++){
				if(allItems[i].id == ("input-" + idPost)){
					postItems.push(allItems[i].value);
				}
			}
			apellidosPost = postItems[0];
			nombresPost = postItems[1];
			gradoPost = postItems[2];
			descripcionPost = document.getElementById("div-" + idPost).innerHTML;
			xmlHttp = AjaxSend("action=" + actionPost + "&table=" + tablaPost + "&apellidos=" + apellidosPost + "&nombres=" + nombresPost + "&grado=" + gradoPost + "&desc=" + descripcionPost + "&id=" + indexPost, obj);
			break;
			
		case "utileria":
			var allItems = document.getElementsByTagName("input");
			var postItems = [];			
			for(var i=0; i<allItems.length; i++){
				if(allItems[i].id == ("input-" + idPost)){
					postItems.push(allItems[i].value);
				}
			}
			tituloPost = postItems[0];
			vinculoPost = postItems[1];
			descripcionPost = document.getElementById("div-" + idPost).innerHTML;
			xmlHttp = AjaxSend("action=" + actionPost + "&table=" + tablaPost + "&title=" + tituloPost + "&link=" + vinculoPost + "&desc=" + descripcionPost + "&id=" + indexPost, obj);
			break;
			
		case "procesos":
			indexPost = document.getElementById("id-bigimg").value;
			tituloPost = document.getElementById("txt-cont").value;
			descripcionPost = document.getElementById("div-cont").innerHTML;
			if(actionPost == "add"){
				indexPost = "0";
				tituloPost = document.getElementById("input--1").value;
				descripcionPost = document.getElementById("div--1").innerHTML;
				//!En el caso especial de los procesos, como necesitamos enviar un valor binario (la imagen) al servidor, no podemos hacer uso de Ajax por lo que lo enviamos de la forma normal, via PostBack, usando la accion Submit del Form
				document.forms[1].action = "../lib/AjaxManagerServer.php?action=" + actionPost + "&table=" + tablaPost + "&title=" + tituloPost + "&desc=" + descripcionPost + "&id=" + indexPost;
				document.forms[1].submit();
				return;
			}			
			xmlHttp = AjaxSend("action=" + actionPost + "&table=" + tablaPost + "&title=" + tituloPost + "&desc=" + descripcionPost + "&id=" + indexPost, obj);
			break;
		case "postgrado":
			var allItems = document.getElementsByTagName("input");
			var postItems = [];
			var divIdExtra = 1;
			var dt = new Date();
			for(var i=0; i<allItems.length; i++){
				if(allItems[i].id == ("input-" + idPost)){
					postItems.push(allItems[i].value);
				}				
			}
			elements = document.getElementsByTagName("div");
			for (var i = 0; i < elements.length; i++) {
				if (elements[i].id == ("div-" + idPost + "-" + divIdExtra)) {
					postItems.push(elements[i].innerHTML);
					divIdExtra++;
				}
			}
			codigoPost = document.getElementById("txt-" + idPost).value;
			nombrePost = postItems[0];
			desarrolloPost = postItems[1];
			duracionPost = postItems[2];
			cmaPost = (postItems[3] == ""? "0": postItems[3]);
			iniclPost = document.getElementById("fch-" + idPost).value.substr(0, 10) + " 00:00:00";
			alert("inicio clases: " + iniclPost);
			gradoPost = postItems[4];
			invPost = (postItems[5] == ""? "0": postItems[5]);
			descPost = postItems[6];
			misionPost = postItems[7];
			visionPost = postItems[8];
			poblaPost = postItems[9];
			horarioPost = postItems[10];
			cursoPost = (document.getElementById("tipocursos").value == "actual"? 1: 0);
			xmlHttp = AjaxSend("action=" + actionPost + "&table=" + tablaPost + "&codigo=" + codigoPost + "&nombre=" + nombrePost + "&desarrollo=" + desarrolloPost + "&duracion=" + duracionPost + "&cma=" + cmaPost
			+"&inicl=" + iniclPost + "&grado=" + gradoPost + "&inv=" + invPost + "&desc=" + descPost + "&mision=" + misionPost + "&vision=" + visionPost + "&poblac=" + poblaPost + "&horario=" + horarioPost + "&id=" + indexPost + "&esactual=" + cursoPost
			, obj);
			break;
			
		case "evento":			
			tituloPost = document.getElementById("txt-" + idPost).value;
			fechaPost = (document.getElementById("fch-" + idPost).value == ""? (dt.getFullYear() + "-" + dt.getMonth() + "-" + dt.getDate()) : document.getElementById("fch-" + idPost).value.substr(0, 10)) + " 00:00:00";
			lugarPost = document.getElementById("input-" + idPost).value;
			detallePost = document.getElementById("div-" + idPost).innerHTML;
			xmlHttp = AjaxSend("action=" + actionPost + "&table=" + tablaPost + "&titulo=" + tituloPost + "&fecha=" + fechaPost + "&lugar=" + lugarPost + "&detalle=" + detallePost + "&id=" + indexPost, obj);
			break;
		
		case "servsocial":
			var allItems = document.getElementsByTagName("input");
			var postItems = [];
			for(var i=0; i<allItems.length; i++){
				if(allItems[i].id == ("input-" + idPost)){
					postItems.push(allItems[i].value);
				}				
			}
			tituloPost = document.getElementById("txt-" + idPost).value;
			descripcionPost = document.getElementById("div-" + idPost).innerHTML;
			duracionPost = postItems[0];
			horasPost = (postItems[1] == ""? "0": postItems[1]);
			
			xmlHttp = AjaxSend("action=" + actionPost + "&table=" + tablaPost + "&titulo=" + tituloPost + "&desc=" + descripcionPost + "&duracion=" + duracionPost + "&horas=" + horasPost + "&id=" + indexPost, obj);
			break;
			
		case "usuario":
			var allItems = document.getElementsByTagName("input");
			var postItems = [];
			for(var i=0; i<allItems.length; i++){
				if(allItems[i].id == ("input-" + idPost)){
					postItems.push(allItems[i].value);
				}				
			}			
			if (actionPost == "edit") {				
				usuarioPost = postItems[0];
				claveAntPost = postItems[1];
				claveNewPost = postItems[2];
				claveReNewPost = postItems[3];
				//!En el caso especial de los usuarios, si la acccion del Post es editar, debemos verificar si el usuario introdujo una nueva clave. De ser asi, hay que validar si los campos NuevaClave y RepetirNuevaClave son iguales para poder continuar. Si elusuario no agrego una nueva clave, solamente eidtamos el nombre.
				if (claveAntPost != "" || claveNewPost != "" || claveReNewPost != ""){
					if(claveNewPost != claveReNewPost){
						alert("La nueva clave y la repeticion de la nueva clave no coinciden");
						EnablePostContent(idPost, plainTextContent);
						break;
					}
					xmlHttp = AjaxSend("action=" + actionPost + "&table=" + tablaPost + "&usuario=" + usuarioPost + "&claveant=" + hex_md5(claveAntPost) + "&clave=" + hex_md5(claveNewPost) + "&id=" + indexPost, obj);
				}
				else
					xmlHttp = AjaxSend("action=" + actionPost + "&table=" + tablaPost + "&usuario=" + usuarioPost + "&id=" + indexPost, obj);
			}
			else{
				//!Si la accion del Post es agregar uno nuevo, no se muestra un campo ClaveAnterior ya que no la hay :p pero esta vez si es requisito escribir una nueva clave. Se verifica que los campos NuevaClave y RepetirNuevaClave sean iguales para poder continuar.
				usuarioPost = postItems[0];
				claveNewPost = postItems[1];
				claveReNewPost = postItems[2];
				if(claveNewPost != claveReNewPost){
					alert("La nueva clave y la repeticion de la nueva clave no coinciden");
					EnablePostContent(idPost, plainTextContent);
					break;
				}
				xmlHttp = AjaxSend("action=" + actionPost + "&table=" + tablaPost + "&usuario=" + usuarioPost + "&clave=" + hex_md5(claveNewPost) + "&id=" + indexPost, obj);
			}			
			break;
	}
}

/*!
 * Metodo que nos permite cancelar la edicion/agregacion de un Post
 * \param idPost El ID del Post del cual deseamos cancelar su edicion/agregacion
 * \param plainTextContent Define si el contenido interno del Post es texto plano o es mas coplejo, como una tabla
 */
function CancelPost(idPost, plainTextContent){
	//Si estamos agregando un nuevo post y cancelamos la operacion, borramos el post
	if (document.getElementById("id-" + idPost).value == "-1") {
		DisablePost(idPost, plainTextContent);
		document.getElementById("pst-" + idPost).parentNode.removeChild(document.getElementById("pst-" + idPost));
	}	
	//Si es un post existente, mostramos la informacion que tenia en un principio
	else{
		DisablePost(idPost, plainTextContent);
		document.getElementById("area-" + idPost).innerHTML = document.getElementById("tmpcnt-" + idPost).value;
		document.getElementById("txt-" + idPost).value = document.getElementById("tmptit-" + idPost).value;			
		if(document.getElementById("fch-" + idPost) != null)
			document.getElementById("fch-" + idPost).value = document.getElementById("tmpfch-" + idPost).value;
	}
}

/*!
 * Metodo que nos permite agregar la estructura de un nuevo Post en blanco, para que el usuario pueda posteriormente guardarlo como uno nuevo.
 * \param idPost El ID del nuevo Post, por defecto siempre es '-1'
 * \param idTabla La tabla que indicara cual es la estructura del nuevo Post que deseamos agregar
 * \param uid El ID del usuario que ha iniciado sesion actualmente
 */
function AddPost(idPost, idTabla, uid){	
	//!Para agregar la estructura de un nuevo Post, pedimos su HTML via Ajax a los ContentManager existentes y estos deciden cual estructura de Post retornarnos en base a la tabla pasada como paraemtro
	if(idTabla == "novedades")
		AjaxSendRequestPost(idTabla, uid, '1');
	else
		AjaxSendRequestPost(idTabla, uid, '0');	
}

/*!
 * Metodo que nos permite eliminar un Post de la pagina y tambien el registro que este Post representa
 * \param idPost El ID del Post que deseamos eliminar
 * \param uid El ID del usuario que ha iniciado sesion actualmente
 */
function DelPost(idPost, uid){
	//alert("DelPost. uid= " + uid);
	tablaPost = document.getElementById("tbl-" + idPost).value;
	indexPost = document.getElementById("id-" + idPost).value;
	var condicion = "";
	//!Si la tabla es Maestrias, posiblemente tenga una condicion que desee enviar al servidor, guardad en un elemento llamado 'tipocursos'
	if(document.getElementById("tipocursos") != null)
		condicion = document.getElementById("tipocursos").value;
	//!Si la tabla es procesos, el ID del post se encuentra en un elemento llamado 'id-bigimg'
	if(tablaPost == "procesos")
		indexPost = document.getElementById("id-bigimg").value;
	//!Le pregutamos al usuario si esta seguro mediante un mensaje de dialogo del tipo confirm
	if (confirm("Esta seguro que desea eliminar este elemento?")) {
		if (document.getElementById("pst-" + idPost) != null) {
			if(tablaPost != "procesos")
				//!Borramos el elemento que representa al Post, mediante el uso de DOM
				document.getElementById("pst-" + idPost).parentNode.removeChild(document.getElementById("pst-" + idPost));
		}
		//!Creamos el ResponseObject y su respectivo ResponseFunction, que sera invocado una vez que el servidor de una respuesta de esta llamada
		var obj = new Object();
		obj.responseFunction = function(){
				//!Cuando el servidor responda, se invocara esta funcion
				refreshPage(tablaPost, uid, condicion);
		}
		AjaxSend("action=del&table=" + tablaPost + "&id=" + indexPost, obj);
	}
}

/*!
 * Este metodo nos permite borrar Posts temporales sin necesidad de mostrar una confirmacion o de hacer una llamada via Ajax, ya que posiblemente era un post temporal que no representaba un registro de las base de datos.
 * \param idPost El ID del Post que se desea eliminar
 */
function DelPostNoConfirm(idPost){
	//!Simplemente se remueve el elemento HTML mediante DOM
	if(document.getElementById("pst-" + idPost) != null)
		document.getElementById("pst-" + idPost).parentNode.removeChild(document.getElementById("pst-" + idPost));
}

/*!
 * Este metodo es invocado cuando el servidor ha dado una respuesta, una vez que se han guardado exitosamente los cambios de un Post nuevo/modificado
 * \param tablaPost La tabla a la cual pertenece este Post
 * \param uid El ID del usuario que ha iniciado sesion actualmente
 * \param responseText El texto de respuesta que nos ha devuelto el servidor
 * \param postId El ID del post al cual se le han guardado los cambios (ya sea que era un nuevo post o uno modificado)
 */
function CatchSavedPost(tablaPost, uid, responseText, postId){
	var $condicion = "";
	
	if(document.getElementById("tipocursos") != null)
		$condicion = document.getElementById("tipocursos").value;
	
	//!Si estabamos tratando de cambiar la clave de un usurio, pero el servidor determino que la clave anterior era incorrecta, nos devolvera un mensaje que dira "nomatch"
	//!Asi qeu mostraremos el correspondiente mensaje y volveremos a editar el post ya que no fue correctamente editado
	if (responseText == "nomatch"){
		alert("La clave antterior es incorrecta");
		EnablePostContent(postId, false);
		return;
	}
	//!Para cualquier otro caso, despues de agregar un nuevo Post, refrescamos el contenido de la pagina via Ajax, para actualizar tambien a la paginacion de registros
	refreshPage(tablaPost, uid, $condicion);
}

/*!
 * Este metodo es invocado cuando el servidor ha devuelto la estructura de un nuevo Post que va a ser agregado. Se podria decir que esta es la continuacion del metodo AddPost
 * \param tablaPost El nombre de la tabla cuyos registros representa el nuevo Post a ser agregado
 * \param responseText El texto de respuesta que nos ha devuleto el servidor
 */
function CatchNewPost(tablaPost, responseText){	
	//!agregamos el responseText, el cual contiene la estructura del nuevo Post, al arega del Post contenedor, para que se muestre en la pagina
	document.getElementById("area-").innerHTML = responseText + document.getElementById("area-").innerHTML;
	//!Ahora, activamos el nuevo Post para que el usuario pueda introducir la informacion
	if(tablaPost == "novedades")
		EnablePost("-1", '1');
	//!Para este tipo de Posts, no es necesario activar la parte del titulo del Post
	else if (tablaPost == "postgrado" || tablaPost == "evento" || tablaPost == "servsocial")
		EnablePost("-1", '');
	else
		EnablePostContent("-1", '');
	fillup();
}

/*!
 * Metodo que muestra en tamanio mas grande, la imagen seleccionada dentro de la lista de vistas previas en el MotionGallery, en la seccion de Procesos de la Unidad
 * \param id El ID de la imagen a mostrar
 */
function ShowBigImage(id){
	imagenSrc = document.getElementById("img-" + id);
	imagenBig = document.getElementById("img-big");
	rowDesc = document.getElementById("div-cont");
	idBigImg = document.getElementById("id-bigimg");
	rowNewValue = document.getElementById("descr-" + id);
	titulo = document.getElementById("txt-cont");
	if (imagenBig != null && titulo != null && rowDesc != null && rowNewValue != null && idBigImg != null) {
		//!Ya que la imagen la tomamos de la base de datos y no de una ubicacion fisica, utilizamos un archivo externo de PHP para obtenerla y mostrarla en la etiqueta IMG
		imagenBig.src = "../lib/ShowImage.php?id=" + id;
		titulo.value = imagenSrc.alt;
		rowDesc.innerHTML = rowNewValue.value;
		idBigImg.value = id;
	}
}

/*!
 * Metodo que muestra en el titulo del Post, el nombre de la imagen sobre la cual esta posicionada el cursor, dentro de la lista de vistas previas en el MotionGallery, en la seccion de Procesos de la Unidad
 * \param id El ID de la imagen cuyo titulo se mostrara
 */
function ShowImgTitle(id){
	titulo = document.getElementById("txt-prev");
	imgNombre = document.getElementById("img-" + id);
	if(titulo != null && imgNombre != null)
		titulo.value = "Vista Previa - " + imgNombre.alt;
}

/*!
 * Metodo que limpia el nombre de alguna imagen en el titulo del Post, una vez que el cursor ya no esta sobre ninguna de ellas
 */
function ClearImgTitle(){
	titulo = document.getElementById("txt-prev");
	if(titulo != null)	
	titulo.value = "Vista Previa";
}

/*!
 * Metodo que permite filtrar el texto de los INPUT de tipo numerico agregados a algunas tablas, como por ejemplo los campos inversion y calificacion minima de una maestria.
 * El texto se filtra para que en el onKeyPress del INPUT solo se permitan las teclas numericas, el punto decimal, las teclas de cursor, TAB, Backspace, ENTER y la bara espaciadora.
 * \param e Objeto que representa al evento de la funcion y contiene informacion de la tecla presionada
 */
function FilterText(e){
	//alert("tecla presionada.");
	var keynum;
	var keychar;
	var numcheck;

	if(window.event){  //Internet Explorer
		keynum = e.keyCode;
	}
	else if(e.which){ // Netscape/Firefox/Opera
		keynum = e.which;
	}
	//alert("keynum? " + keynum);
	keychar = String.fromCharCode(keynum);
	numcheck = /\d/;
	return /*numcheck.test(keychar) ||*/(keynum > 47 && keynum < 58) || (keynum > 95 && keynum < 106) || keynum == 13 || keynum == 27 || keynum == 32 || keynum == 8 || keynum == 9 || keynum == 46 || keynum == 110 || keynum == 190 || (keynum > 36 && keynum < 41);

}
