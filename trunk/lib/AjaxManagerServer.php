<?php

include_once("../clases/cconexion.php");
$conn = new cConexion();
$arch = fopen("serverlog.txt","w");
fwrite($arch, "entramos");
	if(isset($_GET["action"])){
		switch($_GET["action"]){

			case "editabout":
				fwrite($arch, "\naccion editar about");
				$newContent = $_GET["value"];
				$conn->Conectar();
				$conn->mysqli->query("update general set contenido = '$newContent' where titulo = 'about'");
				$conn->mysqli->close();
				break;
				
			case "edit":
				fwrite($arch, "\naccion editar");
				switch($_GET["table"]){

					case "novedades":
						fwrite($arch, "\ntabla novedades");
						$id = $_GET["id"];
						$titulo = $_GET["title"];
						$contenido = $_GET["content"];
						$fecha = $_GET["date"];
						$conn->Conectar();
						$conn->mysqli->query("update novedades set titulo='$titulo', descripcion='$contenido', fecha='$fecha' where id=$id;");
						fwrite($arch, "error: " . $conn->mysqli->error);
						$conn->mysqli->close();
						fwrite($arch, "consulta: update novedades set titulo='$titulo', descripcion='$contenido', fecha='$fecha' where id=$id");
						break;
				}
				break;
		}
	}
fclose($arch);
?>
