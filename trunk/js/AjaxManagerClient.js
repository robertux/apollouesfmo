/**
 * @author Robertux
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


function AjaxSend(content, responseObject){
	var xmlHttp = AjaxInit();
	//alert("enviando contenido: " + content);
    xmlHttp.open("GET", "../lib/AjaxManagerServer.php?" + content, true);
	if (responseObject != null) {
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

function AjaxSendAbout(content, obj){	
	AjaxSend("action=editabout&value=" + content, obj);
}

function AjaxSendContacto(content, obj){	
	AjaxSend("action=editcontacto&value=" + content, obj);
}

function AjaxSendSuscripcion(content, obj){	
	AjaxSend("action=editsuscripcion&value=" + content, obj);
}

function AjaxSendRequestPage(currentPage, newPage, uid, tabla, condicion){	
	var obj = new Object();
	obj.responseFunction = function(responseText){
		CatchNewPage(responseText);
	}
	pCondicion = "";
	if(condicion)
		pCondicion = "&cond=" + condicion;	
	var xmlHttp = AjaxSend("action=getpage&current=" + currentPage + "&new=" + newPage + "&uid=" + uid + "&tabla=" + tabla + pCondicion, obj);
}

function AjaxSendRequestPost(tabla, uid, showdate){	
	var obj = new Object();
	obj.responseFunction = function(responseText){		
			CatchNewPost(tabla, responseText);
	}
	var xmlHttp = AjaxSend("action=getpost&tabla=" + tabla + "&uid=" + uid + "&showdate=" + showdate, obj);
}
