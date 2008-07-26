/**
 * @author Robertux
 */

function AjaxInit(){
	var xmlHttp;
	try{
		// Firefox, Opera 8.0+, Safari
  		xmlHttp=new XMLHttpRequest();
	}
	catch (e){
		// Internet Explorer
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch (e){
			try{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e){
				//alert("Your browser does not support AJAX!");
				return null;
			}
		}
	}
	return xmlHttp;
}


function AjaxSend(content){
	var xmlHttp = AjaxInit();
	//alert("enviando contenido: " + content);
	//TODO: cambiar por la URL oficial del sitio
    xmlHttp.open("GET", "../lib/AjaxManagerServer.php?" + content, true);
	xmlHttp.send(null);
	return xmlHttp;
}

function AjaxSendAbout(content){	
	AjaxSend("action=editabout&value=" + content);
}

function AjaxSendContacto(content){	
	AjaxSend("action=editcontacto&value=" + content);
}

function AjaxSendSuscripcion(content){	
	AjaxSend("action=editsuscripcion&value=" + content);
}

function AjaxSendRequestPage(currentPage, newPage, uid){
	var xmlHttp = AjaxSend("action=getpage&current=" + currentPage + "&new=" + newPage + "&uid=" + uid);
	
	xmlHttp.onreadystatechange = function(){
		if (xmlHttp.readyState == 4) {
			//alert("response received: " + xmlHttp.responseText);
			CatchNewPage(xmlHttp.responseText);
		}
	}
}