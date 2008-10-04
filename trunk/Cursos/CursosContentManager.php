<?php

	/*!
	 * \brief Clase que se encarga de manejar el contenido de la seccion Cursos
	 * Entre sus opciones se encuentran las de mostrar las maestrias actuales, las maestrias proximas, eventos de las maestrias y proyectos disponibles para el servicio social
	 */
    class CursosContentManager{
    	
		/*!
		 * Campo que define cual opcion se mostrara en la pagina
		 */
		var  $opcion;
		
		/*!
		 * Constructor. Inicializa la opcion a mostrar en base al parametro recibido
		 * \param $opt Opcion que se desea mostrar en el ContentManager
		 */
		public function CursosContentManager($opt = "actual"){
			$this->opcion = $opt;
		}
		
		/*!
		 * Invoca al metodo Show correspondiente, en base a la opcion seleccionada.
		 */
		public function Show(){
			switch($this->opcion){
				/*case "mine": $this->ShowMisCursos();
					break;*/
				case "actual": $this->ShowCursos(-1, false, true);
					break;
				case "next": $this->ShowCursos(-1, false, false);
					break;
				case "event": $this->ShowEventos();
					break;
				case "serv": $this->ShowServSoc();
					break;
				case "usr": $this->ShowUsr();
					break;
				default: $this->ShowCursos(-1, false, true);
			}
		}
		
		/*!
		 * Muestra los cursos pertenecientes o relacionados con el usuario actualmente logueado
		 */
		public function ShowMisCursos(){
			$cmaf = new CursoMAF();
			$pstMaf = new InnerPost($cmaf->GetTitulo(), $cmaf->GetContenido(), 530);
			$pst = new Post("Mis Maestrias",$pstMaf->ToString());
			$pst->Show();
		}
		
		/*!
		 * Muestra los cursos que se estan impartiendo actualmente o los cursos a futuro, dependiendo de los parametros recibidos
		 * \param  $pg Numero de pagina de registros a mostrar
		 * \param $onlyContent Valor booleano que define si se mostrara el post completo o solo el contenido de este. Ejemplo de ello es cuando se invoca este metodo desde una llamada via Ajax, para la paginacion
		 * \param $showActuales Valor booleano que define si se mostraran las maestrias actuales o las proximas
		 */
		public function ShowCursos($pg=-1, $onlyContent=false, $showActuales=true){
			$postList = "";
			//!Se inicializa el objeto que nos permitira obtener la lista de cursos (postgrados)
			$ccurso = new cPostgrado();
			//!Se inicializa el objeto que nos permitira realizar la paginacion de nuestra lista de posts
			$pPager = new PostPager($ccurso, 2);
			//!Se define que posts se mostraran y se genera una condicion
			$condicion = ($showActuales? "actual": "proximo");
			//!Se invoca al PostPager para que nos filtre la lista de Posts en base a la pagina seleccionada y a la condicion
			$cursoResult = $pPager->GetPosts($pg, $condicion);
			//!Si se encontraron resultados...
			if($cursoResult->num_rows > 0){
				while($arreglo = $cursoResult->fetch_array()){
					//if(($showActuales == true && $arreglo["esactual"] == 1) || ($showActuales == false && $arreglo["esactual"] == 0)){
						//!Se genera un post temporal para irlo agregando a la lista de posts a mostrar
						//!Se inicializan sus campos
						$tempPost = new InnerPost("", "", 530, false, true, true);
						$tempPost->editableTitle = true;
						$tempPost->id = $arreglo["id"];
						$tempPost->tabla = "postgrado";
						$tempPost->titulo = $arreglo["codigo"];
						$tempPost->tituloMaxLength = "10";
						//!Se inicializa el conteindo del Post. Este sera una tabla con una serie de filas de distintos campos
						$vTable = new VerticalTable();
						$vTable->rows[] = new VerticalTableRow(array("Nombre", $arreglo["nombre"]), $tempPost->id, "text", "200");
						$vTable->rows[] = new VerticalTableRow(array("Descripcion", $arreglo["descripcion"]), $tempPost->id . "-1", "area");
						
						//!Una vez que se ha definido el contenido y las caracteristicas del post, este se agrega a la lista de posts a mostrar
						$tempPost->contenido = $vTable->ToString();
						$tempPost->plainTextContent = false;
						$postList .= $tempPost->ToString();
					//}
				}
				//!Si la lista de posts esta vacia...				
				if($postList == ""){
					//!Es porque no hay resultados que mostrar
					$tempPost = new InnerPost("No hay resultados", "No hay maestrias que mostrar...<br /><br /><br />", 530);
					$tempPost->id = "noresults";
					$postList .= $tempPost->ToString();
				}
			}
			//!Tambien si el fetch_array devolvio 0 resultados...
			else{
				//!Es porue no hay resultados qeu mostrar
				$tempPost = new InnerPost("No hay resultados", "No hay maestrias que mostrar...", 530);
				$tempPost->id = "noresults";
				$postList .= $tempPost->ToString();
			}
			
			//!Se genera el Post principal y se agrega a su contenido la lista de posts generada anteriormente
			$pst = new Post("Maestrias " . ($showActuales? "Actuales": "Proximas"), $postList, 550, true, false, false);
			$pst->tabla = "postgrado";
			$pst->pie = $pPager->ToString($condicion);
			$pst->contenido .= "<input type='hidden' id='tipocursos' value='$condicion' />";
			if($onlyContent)
				echo $pst->ToContentString();
			else
				echo $pst->ToString();
		}
				
		/*!
		 * Muestra los eventos a relizarse, relacionados con las maestrias
		 * \param  $pg Numero de pagina de registros a mostrar
		 * \param $onlyContent Valor booleano que define si se mostrara el post completo o solo el contenido de este. Ejemplo de ello es cuando se invoca este metodo desde una llamada via Ajax, para la paginacion
		 */
		public function ShowEventos($pg=-1, $onlyContent=false){
			//!El proceso que se sigue aca y en el resto de los Show...() es exactamente igual. Solo cambia el contenido de cada Post a agregar a la lista
			$postList = "";
			$cev = new cEvento();
			$pPager = new PostPager($cev, 4);
			$evResult = $pPager->GetPosts($pg);
			if($evResult->num_rows > 0){
				while($arreglo = $evResult->fetch_array()){
					$tempPost = new InnerPost("", "", 530, false, true, true);
					$tempPost->editableTitle = true;
					$tempPost->id = $arreglo["id"];
					$tempPost->tabla = "evento";
					$tempPost->titulo = $arreglo["titulo"];
					$tempPost->tituloMaxLength = "300";
					
					$vTable = new VerticalTable();
					$vTable->rows[] = new VerticalTableRow(array("Fecha", substr($arreglo["fecha"], 0, 10)), $tempPost->id, "fecha");
					$vTable->rows[] = new VerticalTableRow(array("Lugar", $arreglo["lugar"]), $tempPost->id, "text", "300");
					$vTable->rows[] = new VerticalTableRow(array("Detalle", $arreglo["detalle"]), $tempPost->id, "area");
					
					$tempPost->contenido = $vTable->ToString();
					$tempPost->plainTextContent = false;
					$postList .= $tempPost->ToString();
				}
			}
			else{
				$tempPost = new InnerPost("No hay resultados", "No hay eventos que mostrar...", 530);
				$tempPost->id = "noresults";
				$postList .= $tempPost->ToString();
			}
			
			$pst = new Post("Eventos de las Maestrias", $postList, 550, true, false, false);
			$pst->tabla = "evento";
			$pst->pie = $pPager->ToString();
			if($onlyContent)
				echo $pst->ToContentString();
			else
				echo $pst->ToString();
		}
		
		/*!
		 * Muestra los recursos relacionados con las maestrias
		 */
		public function ShowRecursos(){
			$resmgr = new ResManager();
			$pst = new Post("Recursos Adicionales", $resmgr->GetSubjectsRes() . $resmgr->GetAddRes());
			$pst->Show();
		}

		/*!
		 * Muestra los proyectos de Servicio Social disponibles para ser realizados por los estudiantes de las maestrias
		 * \param  $pg Numero de pagina de registros a mostrar
		 * \param $onlyContent Valor booleano que define si se mostrara el post completo o solo el contenido de este. Ejemplo de ello es cuando se invoca este metodo desde una llamada via Ajax, para la paginacion
		 */		
		public function ShowServSoc($pg=-1, $onlyContent=false){
			$postList = "";
			$cserv = new cServSocial();
			$pPager = new PostPager($cserv, 4);
			$servResult = $pPager->GetPosts($pg);
			if($servResult->num_rows > 0){
				while($arreglo = $servResult->fetch_array()){
					$tempPost = new InnerPost("", "", 530, false, true, true);
					$tempPost->editableTitle = true;
					$tempPost->id = $arreglo["id"];
					$tempPost->tabla = "servsocial";
					$tempPost->titulo = $arreglo["nombre"];
					$tempPost->tituloMaxLength = "300";
					
					$vTable = new VerticalTable();
					$vTable->rows[] = new VerticalTableRow(array("Descripcion", $arreglo["descripcion"]), $tempPost->id, "area");
					$vTable->rows[] = new VerticalTableRow(array("Duracion", $arreglo["duracion"]), $tempPost->id, "text", "200");
					$vTable->rows[] = new VerticalTableRow(array("Total Horas", $arreglo["total_horas"]), $tempPost->id, "numero");
					
					$tempPost->contenido = $vTable->ToString();
					$tempPost->plainTextContent = false;
					$postList .= $tempPost->ToString();
				}
			}
			else{
				$tempPost = new InnerPost("No hay resultados", "No hay servicios sociales que mostrar...", 530);
				$tempPost->id = "noresults";
				$postList .= $tempPost->ToString();
			}
			
			$pst = new Post("Proyectos Disponibles Para Servicio Social", $postList, 550, true, false, false);
			$pst->tabla = "servsocial";
			$pst->pie = $pPager->ToString();
			if($onlyContent)
				echo $pst->ToContentString();
			else
				echo $pst->ToString();
		}
		
		/*!
		 * Muestra los usuarios del sitio web
		 * \param  $pg Numero de pagina de registros a mostrar
		 * \param $onlyContent Valor booleano que define si se mostrara el post completo o solo el contenido de este. Ejemplo de ello es cuando se invoca este metodo desde una llamada via Ajax, para la paginacion
		 */
		public function ShowUsr($pg=-1, $onlyContent=false){
			if($_SESSION["CurrentUser"] != ""){
					$myUser = new cusuario();
					$myUser->GetPorId($_SESSION["CurrentUser"]);
					if($myUser->privilegio == "admin"){
						
						$postList = "";
						$cusr = new cUsuario();
						$pPager = new PostPager($cusr, 5);
						$usrResult = $pPager->GetPosts($pg, "id != 0");
						if($usrResult->num_rows > 0){
							while($arreglo = $usrResult->fetch_array()){
								if($arreglo["id"] == $myUser->id)
									$tempPost = new InnerInnerPost("", "", 530, false, true, false);
								else
									$tempPost = new InnerInnerPost("", "", 530, false, true, true);
									
								$tempPost->editableTitle = false;
								$tempPost->id = $arreglo["id"];
								$tempPost->tabla = "usuario";
								$tempPost->titulo = $arreglo["nombre"];
								$tempPost->displayArea = false;
															
								$vTable = new VerticalTable();
								$vTable->rows[] = new VerticalTableRow(array("Nombre", $arreglo["nombre"]), $tempPost->id, "text", "15");
								$vTable->rows[] = new VerticalTableRow(array("Clave Anterior", ""), $tempPost->id, "password", "10");
								$vTable->rows[] = new VerticalTableRow(array("Nueva Clave", ""), $tempPost->id, "password", "10");
								$vTable->rows[] = new VerticalTableRow(array("Repita la Nueva Clave", ""), $tempPost->id, "password", "10");
								
								$tempPost->contenido = $vTable->ToString();
								$tempPost->plainTextContent = false;
								$postList .= $tempPost->ToString();
							}
						}
						else{
							$tempPost = new InnerPost("No hay resultados", "No hay usuarios que mostrar...", 530, true, false, false);
							$tempPost->id = "noresults";
							$postList .= $tempPost->ToString();
						}
						
						$pst = new Post("Usuarios del Sitio Web", $postList, 550, true, false, false);
						$pst->tabla = "usuario";
						$pst->showHelp = "admin";
						$pst->helpAction = "window.open('../Documentacion/Videos/apollo.usuarios.htm', 'ayuda','height=596,width=928')";
						$pst->pie = $pPager->ToString("id != 0");
						if($onlyContent)
							echo $pst->ToContentString();
						else
							echo $pst->ToString();
				}
				else
					$this->ShowCursos();
			}
			else
				$this->ShowCursos();
		}
    }
?>
