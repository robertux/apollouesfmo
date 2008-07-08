<?php

define("RUTA", realpath("../"));
include_once(RUTA . "/clases/cconexion.php");
require_once(RUTA . "/clases/cgeneral.php");
$conn = new cConexion();

echo "entramos";
	if(isset($_GET["action"])){
		switch($_GET["action"]){

			case "add":
				echo "\naccion agregar";
				switch($_GET["table"]){

					case "novedades":				
						echo "\ntabla novedades";
						
						$id = -1;
						echo "\nmaxid: $id";
						$conn->Conectar();
						echo "\nmaxid: $id";
						$resQuery = $conn->mysqli->query("select (max(id)+1) as newid from novedades;");
						echo "\nquery: select (max(id)+1) as newid from novedades;";
						//echo "error: $conn->mysqli->error";
						echo "\nmaxid: $id";
						$resArray = $resQuery->fetch_array();
						$id = $resArray["newid"];
						
						//$id++;
						echo "\nnuevo id: $id";
						$conn->mysqli->close();
						
						$titulo = $_GET["title"];
						$contenido = $_GET["content"];
						$fecha = $_GET["date"];
						$conn->Conectar();
						$conn->mysqli->query("insert into novedades values($id, '$titulo', '', '$contenido', '$fecha');");
						$conn->mysqli->close();
						echo "Consulta: insert into novedades values($id, '$titulo', '', '$contenido', '$fecha');";
						break;
				}
				break;
			
			case "editcontacto":
				echo "\naccion: editar contacto";				
				$newContent = $_GET["value"];
				echo "\nnew content: $newContent";
				
				$Post = new cGeneral();
				$Post->GetPorTitulo("contacto");
				$Post->contenido = $newContent;
				$Post->Update();
				echo "actualizado";
				
				$conn->Conectar();
				$conn->mysqli->query("update general set contenido = '$newContent' where titulo = 'contacto'");
				$conn->mysqli->close();
				break;
				
			case "editsuscripcion":
				echo "\naccion: editar contacto";				
				$newContent = $_GET["value"];
				echo "\nnew content: $newContent";
				
				$Post = new cGeneral();
				$Post->GetPorTitulo("suscripcion");
				$Post->contenido = $newContent;
				$Post->Update();
				echo "actualizado";
				
				$conn->Conectar();
				$conn->mysqli->query("update general set contenido = '$newContent' where titulo = 'suscripcion'");
				$conn->mysqli->close();
				break;
				
			case "editabout":
				echo "\naccion: editar about";				
				$newContent = $_GET["value"];
				echo "\nnew content: $newContent";
				
				$aboutPost = new cGeneral();
				//echo "contenido anterior: $aboutPost";
				$aboutPost->GetPorTitulo("about");
				
				$aboutPost->contenido = $newContent;
				$aboutPost->Update();
				echo "actualizado";
				
				$conn->Conectar();
				$conn->mysqli->query("update general set contenido = '$newContent' where titulo = 'about'");
				$conn->mysqli->close();
				break;
				
			case "edit":
				switch($_GET["table"]){

					case "novedades":
						$id = $_GET["id"];
						$titulo = $_GET["title"];
						$contenido = $_GET["content"];
						$fecha = $_GET["date"];
						$conn->Conectar();
						$conn->mysqli->query("update novedades set titulo='$titulo', descripcion='$contenido', fecha='$fecha' where id=$id;");
						$conn->mysqli->close();
						break;
				}
				break;
				
			case "del":
				switch($_GET["table"]){

					case "novedades":
						$id = $_GET["id"];
						$conn->Conectar();
						$conn->mysqli->query("delete from novedades where id=$id;");
						$conn->mysqli->close();
						break;
				}
				break;
		}
	}
?>
