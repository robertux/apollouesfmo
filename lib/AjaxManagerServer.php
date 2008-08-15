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
require_once(RUTA . "/clases/cprocesos.php");
require_once(RUTA . "/Unidad/UnidadContentManager.php");
require_once(RUTA . "/lib/VerticalTable.php");
require_once(RUTA . "/lib/MGalleryManager.php");

$conn = new cConexion();

	if(isset($_GET["action"])){
		switch($_GET["action"]){

			case "add":
				$id = 0;
				$id = $_GET["id"];
				$tabla = $_GET["table"];
				if($id == 0){
					$query = "select (max(id) + 1) as maxid from $tabla;";
					$conn->Conectar();
					$res = $conn->mysqli->query($query);
					$arr = $res->fetch_array();
					$id = $arr["maxid"];
					$conn->mysqli->close();
				}
	
				switch($_GET["table"]){
					case "novedades":						
						$titulo = $_GET["title"];
						$contenido = $_GET["content"];
						$fecha = $_GET["date"];
						$query = "insert into novedades values($id, '$titulo', '', '$contenido', '$fecha');";
						break;
						
					case "docente":
						$apellidos = $_GET["apellidos"];
						$nombres = $_GET["nombres"];
						$grado = $_GET["grado"];
						$desc = $_GET["desc"];
						$query = "insert into docente values($id, '$apellidos', '$nombres', '$grado', 1, '$desc');";
						echo $query;
						break;						
						
					case "utileria":
						$titulo = $_GET["title"];
						$vinculo = $_GET["link"];
						$contenido = $_GET["desc"];
						$query = "insert into utileria values($id, '$titulo', '$vinculo', '$contenido');";
						break;
						
					case "procesos":
						$titulo = $_GET["title"];
						$descripcion = $_GET["desc"];
						
						echo "agregando a la tabla procesos.";
						echo "existe? " . (isset($_FILES)? "sip. ": "nop. ");
						echo "text? " . $_POST["input--1"];
						echo "cuantos elementos tiene? " . count($_FILES);
						//if($_FILES[0]['size'] > 0){													
							$fileName = $_FILES[0]['name'];
							echo "nombre original del archivo: $fileName";
							$tmpName  = $_FILES[0]['tmp_name'];
							$fileSize = $_FILES[0]['size'];
							echo "tamanio: $fileSize";
							$fileType = $_FILES[0]['type'];
							echo "tipo: $fileType";
							
							$fp      = fopen($tmpName, 'r');
							$content = fread($fp, filesize($tmpName));
							$content = addslashes($content);
							fclose($fp);
						//}
						
						$query = "insert into procesos values($id, '$content', '$titulo', '$descripcion', null);";
						echo "query: $query";
						$query = "";
						break;
				}
				$conn->Conectar();
				$res = $conn->mysqli->query($query);				
				break;
			
			case "editcontacto":
				$newContent = $_GET["value"];
				
				$Post = new cGeneral();
				$Post->GetPorTitulo("contacto");
				$Post->contenido = $newContent;
				$Post->Update();
				
				$conn->Conectar();
				$conn->mysqli->query("update general set contenido = '$newContent' where titulo = 'contacto'");
				$conn->mysqli->close();
				break;
				
			case "editsuscripcion":
				$newContent = $_GET["value"];
				
				$Post = new cGeneral();
				$Post->GetPorTitulo("suscripcion");
				$Post->contenido = $newContent;
				$Post->Update();
				
				$conn->Conectar();
				$conn->mysqli->query("update general set contenido = '$newContent' where titulo = 'suscripcion'");
				$conn->mysqli->close();
				break;
				
			case "editabout":
				$newContent = $_GET["value"];
				
				$aboutPost = new cGeneral();
				$aboutPost->GetPorTitulo("about");
				
				$aboutPost->contenido = $newContent;
				$aboutPost->Update();
				
				$conn->Conectar();
				$conn->mysqli->query("update general set contenido = '$newContent' where titulo = 'about'");
				$conn->mysqli->close();
				break;
				
			case "edit":
				$query = "";
				$id = $_GET["id"];
				switch($_GET["table"]){

					case "novedades":						
						$titulo = $_GET["title"];
						$contenido = $_GET["content"];
						$fecha = $_GET["date"];
						$query = "update novedades set titulo='$titulo', descripcion='$contenido', fecha='$fecha' where id=$id;";
						break;
						
					case "docente":
						$apellidos = $_GET["apellidos"];
						$nombres = $_GET["nombres"];
						$grado = $_GET["grado"];
						$desc = $_GET["desc"];						
						$query = "update docente set apellidos='$apellidos', nombres='$nombres', gradoacademico='$grado', descripcion='$desc' where id=$id;";
						break;
						
					case "utileria":
						$titulo = $_GET["title"];
						$vinculo = $_GET["link"];
						$contenido = $_GET["desc"];
						$query = "update utileria set titulo='$titulo', vinculo='$vinculo', descripcion='$contenido' where id=$id;";
						break;
						
					case "procesos":
						$titulo = $_GET["title"];
						$descripcion = $_GET["desc"];						
						
						$query = "update procesos set nombre='$titulo', descripcion='$descripcion'  where id=$id;";
						break;
				}
				$conn->Conectar();
				echo "query: " . $query;
				$conn->mysqli->query($query);
				$conn->mysqli->close();
				break;
				
			case "del":
				$tabla = $_GET["table"];
				$id = $_GET["id"];
				$conn->Conectar();
				$conn->mysqli->query("delete from $tabla where id=$id;");
				$conn->mysqli->close();
				break;
				
			case "getpage":
			
				$currentPg = 0;
				$currentPg = $_GET["current"];
				$uid = $_GET["uid"];
				$_SESSION["CurrentUser"] = $uid;
				$direction = $_GET["new"];
				
				if($direction == "next")
					$currentPg++;
				else if ($direction == "prev")
					$currentPg--;
				
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
					case "procesos":
						$ucm->ShowProcs($currentPg, true);
						break;
				}				
				break;
				
			case "getpost":
				$tabla = $_GET["tabla"];
				$showDate = $_GET["showdate"];
				$uid = $_GET["uid"];
				$_SESSION["CurrentUser"] = $uid;
				
				$pst = new InnerPost("", "", 530, false, true, true);
				$pst->id = "-1";
				$pst->tabla = $tabla;
								
				if($showDate == '1')
					$pst->fecha = date("Y-m-d") . " 00:00:00";
				
				if($tabla == "docente"){
					$vTable = new VerticalTable();
					$vTable->rows[] = new VerticalTableRow(array("Apellidos", ""), $pst->id);
					$vTable->rows[] = new VerticalTableRow(array("Nombres", ""), $pst->id);
					$vTable->rows[] = new VerticalTableRow(array("Grado Academico", ""), $pst->id);
					$vTable->rows[] = new VerticalTableRow(array("Descripcion", ""), $pst->id, "area");
					$pst->contenido = $vTable->ToString();
					$pst->plainTextContent = false;
				}				
				if($tabla == "utileria"){
					$vTable = new VerticalTable();
					$vTable->rows[] = new VerticalTableRow(array("Titulo", ""), $pst->id);
					$vTable->rows[] = new VerticalTableRow(array("Vinculo", ""), $pst->id);
					$vTable->rows[] = new VerticalTableRow(array("Descripcion", ""), $pst->id, "area");
					$pst->contenido = $vTable->ToString();
					$pst->plainTextContent = false;
				}
				if($tabla == "procesos"){
					$vTable = new VerticalTable();
					$pst->contenido .= "<form id='frmProcs' method='post' enctype='multipart/form-data'>";
					$vTable->rows[] = new VerticalTableRow(array("Nombre", ""), $pst->id);
					$vTable->rows[] = new VerticalTableRow(array("Archivo (max. 2Mb)", ""), $pst->id, "file");
					$vTable->rows[] = new VerticalTableRow(array("Descripcion", ""), $pst->id, "area");					
					$pst->contenido .= $vTable->ToString();
					$pst->contenido .= "</form>";
					$pst->plainTextContent = false;
					$pst->editableTitle = false;
				}
				$pst->Show();
				break;
		}
	}
?>
