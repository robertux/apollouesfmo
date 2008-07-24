<?php

define("RUTA", realpath("../"));
require_once(RUTA . "/clases/cconexion.php");
require_once(RUTA . "/clases/cgeneral.php");
require_once(RUTA . "/lib/PostPager.php");
require_once(RUTA . "/lib/Post.php");
require_once(RUTA . "/lib/ToolBox.php");
require_once(RUTA . "/clases/cusuario.php");

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
						$titulo = $_GET["title"];
						$contenido = $_GET["content"];
						$fecha = $_GET["date"];
						$conn->Conectar();
						$conn->mysqli->query("insert into novedades values($id, '$titulo', '', '$contenido', '$fecha');");
						$conn->mysqli->close();
						echo "Consulta: insert into novedades values($id, '$titulo', '', '$contenido', '$fecha');";
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
				}
				break;
				
			case "del":
				switch($_GET["table"]){

					case "novedades":
						$id = $_GET["id"];
						$conn->Conectar();
						$conn->mysqli->query("delete from novedades where id=$id;");
						$conn->mysqli->close();
						echo "[id]" . 0 . "[/id]";
						break;
				}
				break;
				
			case "getpage":
			
				$currentPg = 0;
				$currentPg = $_GET["current"];
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

				$pPager = new PostPager();
				$novResult = $pPager->GetPosts($currentPg);
				if($novResult->num_rows > 0){
					while($arreglo = $novResult->fetch_array()){
						$tempPost = new InnerPost("", "", 530, false, true, true);
						$tempPost->id = $arreglo["id"];
						$tempPost->tabla = "novedades";
						$tempPost->fecha = substr($arreglo["fecha"],0,10);
						$tempPost->titulo = $arreglo["titulo"];
						$tempPost->contenido = substr($arreglo["descripcion"],3,strlen($arreglo["descripcion"])-4);
						$postList .= $tempPost->ToString();
					}	
				}
				else{
					$tempPost = new InnerPost("No hay resultados", "No hay noticias que mostrar...", 530);
					$postList .= $tempPost->ToString();
				}			
				$pst = new Post("Noticias de la Unidad", $postList, 550, true, false, false);
				$pst->tabla = "novedades";
				$pst->pie = $pPager->ToString();
				
				echo $pst->ToContentString();
				break;
		}
	}
?>
