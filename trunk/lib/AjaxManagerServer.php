<?php

/*!
 * Definimos todos los archivos que vamos a necesitar incluir
 */
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
require_once(RUTA . "/clases/cpostgrado.php");
require_once(RUTA . "/clases/cevento.php");
require_once(RUTA . "/clases/cservsoc.php");
require_once(RUTA . "/Unidad/UnidadContentManager.php");
require_once(RUTA . "/Cursos/CursosContentManager.php");
require_once(RUTA . "/lib/VerticalTable.php");
require_once(RUTA . "/lib/MGalleryManager.php");

//!Creamos una instancia de la clase conexion, para gestionar todas las operaciones en la base de datos
$conn = new cConexion();

	//!Verificamos que nos haya enviado una accion para decidir que hacer con la llamada
	if(isset($_GET["action"])){
		switch($_GET["action"]){

			//!Si vamos a agregar un nuevo post...
			case "add":
				//!Tomamos el parametro ID, el cual por defecto es 0, pero por las dudas...
				$id = 0;
				$id = $_GET["id"];				
				//!Tomamos el parametro table, para saber en que tabla estamos trabajando
				$tabla = $_GET["table"];
				//!Si el ID es cero (como debe de ser) hacemos una consulta para obtener el ultimo ID de los registros existentes y sumarle 1 para obtener el nuevo Id para nuestro registro
				if($id == 0){
					$id++;
					$query = "select (max(id) + 1) as maxid from $tabla;";
					$conn->Conectar();
					$res = $conn->mysqli->query($query);
					if($arr = $res->fetch_array()){
						$id = ($arr["maxid"] == ""? 1: $arr["maxid"]);
					}
					$conn->mysqli->close();
				}
				
				//!Verificamos en que tabla vamos a agregar el nuevo registro. Cada tabla requiere diferentes parametros. Con estos parametros armamos la consulta y la guardamos en $query
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
						
						/*echo "agregando a la tabla procesos.";
						echo "existe? " . (isset($_FILES)? "sip. ": "nop. ");
						echo "cuantos elementos tiene post? " . count($_POST);
						echo "post[0]? " . $_POST[0];
						echo "post[1]? " . $_POST[1];
						echo "cuantos elementos tiene files? " . count($_FILES);*/
						
						//!La tabla procesos toma parametros especiales ya que no fue llamada via ajax sino via postback. Estos parametros definen caracteristicas de la imagen que se va a agregar a la BD
						if($_FILES['upld']['size'] > 0){							
							$fileName = $_FILES['upld']['name'];
							//echo "nombre original del archivo: $fileName";
							$tmpName  = $_FILES['upld']['tmp_name'];
							$fileSize = $_FILES['upld']['size'];
							//echo "tamanio: $fileSize";
							$fileType = $_FILES['upld']['type'];
							//echo "tipo: $fileType";
							
							$fp      = fopen($tmpName, 'r');
							$content = fread($fp, filesize($tmpName));
							$content = addslashes($content);
							fclose($fp);
						}
						
						$query = "insert into procesos values($id, '$content', '$titulo', '$descripcion', null);";
						//echo "query: $query";
						break;
						
					case "postgrado":					
						$codigoPost = $_GET["codigo"];
						$nombrePost = $_GET["nombre"];
						$descPost = $_GET["desc"];
						$esactual = $_GET["esactual"];
						
						$query = "insert into postgrado values($id, '$nombrePost', '$descPost', '$codigoPost', $esactual);";
						echo $query;
						break;
						
					case "evento":
						$titulo = $_GET["titulo"];
						$fecha = $_GET["fecha"];
						$lugar = $_GET["lugar"];
						$detalle = $_GET["detalle"];
						$query = "insert into evento values($id, 0, '$titulo', '$fecha', '$lugar', '$detalle');";
						break;
						
					case "servsocial":
						$titulo = $_GET["titulo"];
						$descripcion = $_GET["desc"];
						$duracion = $_GET["duracion"];
						$horas = $_GET["horas"];
						$query = "insert into servsocial values($id, '$titulo', '$descripcion', '$duracion', $horas);";
						break;
						
					case "usuario":
						$usuario = $_GET["usuario"];
						$clave = $_GET["clave"];
						$query = "insert into usuario values($id, '$clave', '$usuario');";
						$conn->Conectar();
						$res = $conn->mysqli->query($query);
						$conn->mysqli->close();
						
						$query = "select (max(id) +  1) as maxid from asignacion;";
						$conn->Conectar();
						$res = $conn->mysqli->query($query);
						$arr = $res->fetch_array();
						$assignId = $arr["maxid"];
						$conn->mysqli->close();						
						
						$query = "insert into asignacion values($assignId, $id, 4);";
						echo $query;
						break;
				}
				
				//!Una vez que tenemos formada la consulta, abrimos la conexion y la ejecutamos
				$conn->Conectar();
				$res = $conn->mysqli->query($query);
				//!Para el caso de los procesos, volvemos via redirect a la pagina original
				if($_GET["table"] == "procesos")
					header("location: ../Unidad/index.php?opt=proc");
				break;
			
			//!Para las acciones de edicion, es el mismo rollo. Verificamos que tabla es y en base a los parametros recibidos via GET, armamos la consulta. Al final la ejecutamos
			case "editcontacto":
				$newContent = $_GET["value"];
				
				/*$Post = new cGeneral();
				$Post->GetPorTitulo("contacto");
				$Post->contenido = $newContent;
				$Post->Update();*/
				
				$conn->Conectar();
				$conn->mysqli->query("update general set contenido = '$newContent' where titulo = 'contacto'");
				$conn->mysqli->close();
				break;
				
			case "editsuscripcion":
				$newContent = $_GET["value"];
				
				/*$Post = new cGeneral();
				$Post->GetPorTitulo("suscripcion");
				$Post->contenido = $newContent;
				$Post->Update();*/
				
				$conn->Conectar();
				$conn->mysqli->query("update general set contenido = '$newContent' where titulo = 'suscripcion'");
				$conn->mysqli->close();
				break;
				
			case "editabout":
				$newContent = $_GET["value"];
				
				/*$aboutPost = new cGeneral();
				$aboutPost->GetPorTitulo("about");
				
				$aboutPost->contenido = $newContent;
				$aboutPost->Update();*/
				
				$conn->Conectar();
				$conn->mysqli->query("update general set contenido = '$newContent' where titulo = 'about'");
				$conn->mysqli->close();
				break;
			
			//!Para las acciones de edicion, es el mismo rollo. Verificamos que tabla es y en base a los parametros recibidos via GET, armamos la consulta. Al final la ejecutamos	
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
					case "postgrado":
						//echo "postgrado";
						$codigoPost = $_GET["codigo"];
						$nombrePost = $_GET["nombre"];
						$descPost = $_GET["desc"];
						
						$query = "update postgrado set nombre='$nombrePost', descripcion='$descPost', codigo='$codigoPost' where id=$id";
						break;
						
					case "evento":
						$titulo = $_GET["titulo"];
						$fecha = $_GET["fecha"];
						$lugar = $_GET["lugar"];
						$detalle = $_GET["detalle"];
						$query = "update evento set titulo='$titulo', fecha='$fecha', lugar='$lugar', detalle='$detalle' where id=$id;";
						break;
						
					case "servsocial":
						$titulo = $_GET["titulo"];
						$descripcion = $_GET["desc"];
						$duracion = $_GET["duracion"];
						$horas = $_GET["horas"];
						$query = "update servsocial set nombre='$titulo', descripcion='$descripcion', duracion='$duracion', total_horas=$horas where id=$id;";						
						break;
						
					case "usuario":
						$usuario = $_GET["usuario"];
						$claveant = $_GET["claveant"];
						$clave = $_GET["clave"];
						
						//!Para el caso especial de editar un usuario existente, hay que verificar si deseaba cambiar la clave y de ser asi, verificar si el campo ClaveAnterior que escribio, coincide con la clave del usuario
						if($claveant != ""){
							$query = "select clave from usuario where id=$id;";
							$conn->Conectar();
							$res = $conn->mysqli->query($query);
							$arr = $res->fetch_array();
							$claveantReal = $arr["clave"];
							$conn->mysqli->close();
							
							//!Si no coincide, se devuelve el texto 'nomatch' Al otro lado saben que hacer si devolvemos esto
							if($claveant != $claveantReal){
								echo "nomatch";
								break;
							}
							else
								$query = "update usuario set nombre='$usuario', clave='$clave' where id=$id;";
						}
						else
							$query = "update usuario set nombre='$usuario' where id=$id;";
						break;
				}
				$conn->Conectar();
				//echo "query: " . $query;
				$conn->mysqli->query($query);
				$conn->mysqli->close();
				break;
				
			//!Para el caso de eliminar registros es mas sencillo todavia ya que no requerimos preguntar por cada tabla ya que para cada tabla lo unico que necesitaremos para armar la consulta es el id del registro a borrar y el nombre de la tabla a la que pertenece
			case "del":
				$tabla = $_GET["table"];
				$id = $_GET["id"];
				$conn->Conectar();
				$conn->mysqli->query("delete from $tabla where id=$id;");
				$conn->mysqli->close();
				break;
			
			//!Si la accion es obtener una nueva pagina (hablando de paginacion...)	
			case "getpage":
			
				//!Obtenemos los parametros que nos enviaron...
				$currentPg = 0;
				$currentPg = $_GET["current"];
				$uid = $_GET["uid"];				
				$_SESSION["CurrentUser"] = $uid;
				$direction = $_GET["new"];
				$condicion = $_GET["cond"];
				
				//!Verificamos que pagina quieren...
				if($direction == "next")
					$currentPg++;
				else if ($direction == "prev")
					$currentPg--;
				
				//!Verificamos de que tabla quieren la nueva pagina e invocamos al ContentManager adecuado, pasandole los parametros.
				//!Y mostramos la lista de posts que posee en base a la pagina que el usuario desea ver
				$ucm = new UnidadContentManager();
				$ccm = new CursosContentManager();
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
					case "postgrado":
						if($condicion == "actual")
							$ccm->ShowCursos($currentPg, true, true);
						elseif($condicion == "proximo")
							$ccm->ShowCursos($currentPg, true, false);
						break;
					case "evento":
						$ccm->ShowEventos($currentPg, true);
						break;
					case "servsocial":
						$ccm->ShowServSoc($currentPg, true);
						break;
					case "usuario":
						$ucm->ShowUsr($currentPg, true);
						break;
				}				
				break;
			
			//!Si la accion es agregar un nuevo post y desean la estructura en blanco de ese nuevo post...				
			case "getpost":
				//!Obtenemos los parametros que nos enviaron, entre ellos la tabla
				$tabla = $_GET["tabla"];
				$showDate = $_GET["showdate"];
				$uid = $_GET["uid"];
				$_SESSION["CurrentUser"] = $uid;
				
				$pst = new InnerPost("", "", 530, false, true, true);
				$pst->id = "-1";
				$pst->tabla = $tabla;				
								
				if($showDate == '1')
					$pst->fecha = date("Y-m-d") . " 00:00:00";
				
				//!En base a la tabla, generamos el nuevo Post, asi como lo hacen los ContentManagers, solo que este tendra los campos vacios y un id de '-1'
				if($tabla == "novedades"){
					$pst->tituloMaxLength="50";
				}
				if($tabla == "docente"){
					$vTable = new VerticalTable();
					$vTable->rows[] = new VerticalTableRow(array("Apellidos", ""), $pst->id, "text", "200");
					$vTable->rows[] = new VerticalTableRow(array("Nombres", ""), $pst->id, "text", "200");
					$vTable->rows[] = new VerticalTableRow(array("Grado Academico", ""), $pst->id, "text", "50");
					$vTable->rows[] = new VerticalTableRow(array("Descripcion", ""), $pst->id, "area");
					$pst->contenido = $vTable->ToString();
					$pst->plainTextContent = false;
				}				
				if($tabla == "utileria"){
					$vTable = new VerticalTable();
					$vTable->rows[] = new VerticalTableRow(array("Titulo", ""), $pst->id, "text", "50");
					$vTable->rows[] = new VerticalTableRow(array("Vinculo", ""), $pst->id, "text", "100");
					$vTable->rows[] = new VerticalTableRow(array("Descripcion", ""), $pst->id, "area");
					$pst->contenido = $vTable->ToString();
					$pst->plainTextContent = false;
				}
				if($tabla == "procesos"){
					$vTable = new VerticalTable();
					$pst->contenido .= "<form id='frmProcs' method='post' enctype='multipart/form-data'>";
					$vTable->rows[] = new VerticalTableRow(array("Nombre", ""), $pst->id, "text", "20");
					$vTable->rows[] = new VerticalTableRow(array("Archivo (max. 2Mb)", ""), $pst->id, "file");
					$vTable->rows[] = new VerticalTableRow(array("Descripcion", ""), $pst->id, "area");					
					$pst->contenido .= $vTable->ToString();
					$pst->contenido .= "</form>";
					$pst->plainTextContent = false;
					$pst->editableTitle = false;
				}
				if($tabla == "postgrado"){
					$vTable = new VerticalTable();
					$vTable->rows[] = new VerticalTableRow(array("Nombre", ""), $pst->id, "text", "200");
					$vTable->rows[] = new VerticalTableRow(array("Descripcion", ""), $pst->id . "-1", "area");
					$pst->contenido .= $vTable->ToString();
					$pst->plainTextContent = false;
					$pst->editableTitle = true;
					$pst->tituloMaxLength = "10";
				}
				if($tabla == "evento"){
					$vTable = new VerticalTable();
					$vTable->rows[] = new VerticalTableRow(array("Fecha", date("Y-m-d")), $pst->id, "fecha");
					$vTable->rows[] = new VerticalTableRow(array("Lugar", ""), $pst->id, "text", "300");
					$vTable->rows[] = new VerticalTableRow(array("Detalle", ""), $pst->id, "area");
					
					$pst->contenido = $vTable->ToString();
					$pst->plainTextContent = false;
					$pst->editableTitle = true;
					$pst->tituloMaxLength = "300";
					
				}
				if($tabla == "servsocial"){
					$vTable = new VerticalTable();
					$vTable->rows[] = new VerticalTableRow(array("Descripcion", ""), $pst->id, "area");
					$vTable->rows[] = new VerticalTableRow(array("Duracion", ""), $pst->id, "text", "200");
					$vTable->rows[] = new VerticalTableRow(array("Total Horas", ""), $pst->id, "numero");
					
					$pst->contenido = $vTable->ToString();
					$pst->plainTextContent = false;
					$pst->editableTitle = true;
					$pst->tituloMaxLength = "300";
				}
				if($tabla == "usuario"){
					$vTable = new VerticalTable();
					$vTable->rows[] = new VerticalTableRow(array("Nombre", ""), $pst->id, "text", "15");
					$vTable->rows[] = new VerticalTableRow(array("Nueva Clave", ""), $pst->id, "password", "10");
					$vTable->rows[] = new VerticalTableRow(array("Repita la Nueva Clave", ""), $pst->id, "password", "10");
					
					$pst->contenido = $vTable->ToString();
					$pst->plainTextContent = false;
					$pst->editableTitle = false;
				}
				//!Y al final, solo lo imprimimos, par que le llegue como respuesta al usuario
				$pst->Show();
				break;
		}
	}
?>
