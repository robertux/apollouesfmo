<?php

include_once("../clases/cconexion.php");
$conn = new cConexion();
    
	if(isset($_GET["action"])){
		if($_GET["action"] == "editabout"){
			$newContent = $_GET["value"];
			$conn->Conectar();
			$conn->mysqli->query("update general set contenido = '$newContent' where titulo = 'about'");
		}
	}	
?>
