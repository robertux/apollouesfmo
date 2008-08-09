<?php

define("RUTA", realpath("../"));
require_once(RUTA . "/clases/cconexion.php");
require_once(RUTA . "/clases/cgeneral.php");
require_once(RUTA . "/lib/PostPager.php");
require_once(RUTA . "/lib/Post.php");
require_once(RUTA . "/lib/ToolBox.php");
require_once(RUTA . "/clases/cusuario.php");
require_once(RUTA . "/clases/cnovedades.php");
require_once(RUTA . "/clases/cdocente.php");
require_once(RUTA . "/clases/cutileria.php");
require_once(RUTA . "/Unidad/UnidadContentManager.php");
require_once(RUTA . "/lib/VerticalTable.php");

$conn = new cConexion();

//echo "entramos";
	if(isset($_GET["action"])){
		switch($_GET["action"]){

			case "add":
				//echo "\naccion agregar";
				switch($_GET["table"]){

					case "novedades":				
						echo "\ntabla novedades";
						
						$id = 0;
						$id = $_GET["id"];
						if($id == 0){
							$conn->Conectar();
							$res = $conn->mysqli->query("select (max(id) + 1) as maxid from novedades;");
							$arr = $res->fetch_array();
							$id = $arr["maxid"];
							$conn->mysqli->close();
						}
						
						$titulo = $_GET["title"];
						$contenido = $_GET["content"];
						$fecha = $_GET["date"];
						$conn->Conectar();
						$conn->mysqli->query("insert into novedades values($id, '$titulo', '', '$contenido', '$fecha');");
						$conn->mysqli->close();
						echo "Consulta: insert into novedades values($id, '$titulo', '', '$contenido', '$fecha');";
						echo "[id]" . $id . "[/id]";
						break;
						
					case "utileria":
						$id = 0;
						$id = $_GET["id"];
						$titulo = $_GET["title"];
						$contenido = $_GET["content"];
						$conn->Conectar();
						$conn->mysqli->query("insert into utileria values($id, '$titulo', '', '$contenido');");
						$conn->mysqli->close();
						echo "insert into utileria values($id, '$titulo', '', '$contenido');";
						echo "[id]" . $id . "[/id]";
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
				echo "[id]" . 0 . "[/id]";
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
				echo "[id]" . 0 . "[/id]";
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
				echo "[id]" . 0 . "[/id]";
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
						echo "[id]" . $id . "[/id]";
						break;
						
					case "docente":
						$id = $_GET["id"];
						$apellidos = $_GET["apellidos"];
						$nombres = $_GET["nombres"];
						$grado = $_GET["grado"];
						$desc = $_GET["desc"];						
						$conn->Conectar();
						$conn->mysqli->query("update docente set apellidos='$apellidos', nombres='$nombres', gradoacademico='$grado', descripcion='$desc' where id=$id;");
						echo "update docentes set apellidos='$apellidos', nombres='$nombres', gradoacademico='$grado', descripcion='$desc' where id=$id;";
						$conn->mysqli->close();
						echo "[id]" . $id . "[/id]";
						break;
						
					case "utileria":
						$id = $_GET["id"];
						$titulo = $_GET["title"];
						$vinculo = $_GET["link"];
						$contenido = $_GET["desc"];
						$conn->Conectar();
						$conn->mysqli->query("update utileria set titulo='$titulo', vinculo='$vinculo', descripcion='$contenido' where id=$id;");
						echo "update utileria set titulo='$titulo', vinculo=$vinculo, descripcion='$contenido' where id=$id;";
						$conn->mysqli->close();
						echo "[id]" . $id . "[/id]";
						
						break;
				}
				break;
				
			case "del":
				$tabla = $_GET["table"];
				$id = $_GET["id"];
				$conn->Conectar();
				$conn->mysqli->query("delete from $tabla where id=$id;");
				$conn->mysqli->close();
				echo "[id]" . 0 . "[/id]";						
				break;
				
			case "getpage":
			
				$currentPg = 0;
				$currentPg = $_GET["current"];
				$uid = $_GET["uid"];
				//echo "uid: " . $uid;
				$_SESSION["CurrentUser"] = $uid;
				//echo "Current: $currentPg<br/>";
				$direction = $_GET["new"];
				//echo "Direction: $direction<br/>";
				
				if($direction == "next"){
					//echo("entered in next<br/>");
					$currentPg++;
					//echo "New: $currentPg";
				}					
				else if ($direction == "prev"){
					$currentPg--;
					//echo("entered in prev<br/>");
					//echo "New: $currentPg";
				}				
				
				//echo("tabla: " . $_GET["tabla"]);
				$ucm = new UnidadContentManager();
				
				switch($_GET["tabla"]){
					
					case "novedades":												
						$ucm->showNews($currentPg, true);					
						break;
						
					case "docente":								
						$ucm->ShowProfs($currentPg, true);
						break;
						
					case "utileria":
						$ucm->ShowUtils($currentPg, true);
						break;
				}
				
				break;
		}
	}
?>
