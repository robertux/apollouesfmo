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
	alert("enviando contenido: " + content);
	//TODO: cambiar por la URL oficial del sitio
    xmlHttp.open("GET", "http://localhost/apollo/lib/AjaxManagerServer.php?" + content, true);
	xmlHttp.send(null);
}

function AjaxSendAbout(content){	
	AjaxSend("action=editabout&value=" + content);
}
