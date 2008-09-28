<?php
	/*!
	 * \brief Clase que se encarga de manejar el contenido de la seccion La Unidad
	 * Entre sus opciones se encuentran las de mostrar el acerca de la unidad, los procesos, docentes, noticias, contacto, etc.
	 */
    class UnidadContentManager{
    	
		/*!
		 * Campo que define cual opcion se mostrara en la pagina
		 */
		var $opcion;		
		
		/*!
		 * Constructor. Inicializa la opcion a mostrar en base al parametro recibido
		 * \param $opt Opcion que se desea mostrar en el ContentManager
		 */
		public function UnidadContentManager($opt="about"){
			$this->opcion=$opt;
		}
		
		/*!
		 * Invoca al metodo Show correspondiente, en base a la opcion seleccionada.
		 */
		public function Show(){
			switch($this->opcion){
				case "about": $this->ShowAbout();
					break;
				case "proc": $this->ShowProcs();
					break;
				case "profs": $this->ShowProfs();
					break;
				case "news": $this->ShowNews();
					break;
				case "util": $this->ShowUtils();
					break;
				case "contact": $this->ShowContact();
					break;
				case "usr": $this->ShowUsr();
					break;
				default: $this->ShowAbout();
			}
		}
		
		/*!
		 * Muestra informacion relevante acerca de la unidad de postgrados
		 * \param  $pg Numero de pagina de registros a mostrar
		 * \param $onlyContent Valor booleano que define si se mostrara el post completo o solo el contenido de este. Ejemplo de ello es cuando se invoca este metodo desde una llamada via Ajax, para la paginacion
		 */
		public function ShowAbout($pg=-1, $onlyContent=false){
			//!Se inicializa el objeto que nos permitira obtener el valor de acerca de la unidad
			$about = new cGeneral();
			$about->GetPorTitulo("about");
			//!Se genera el Post principal y se agrega a su contenido la informacion del acerca de
			$pst = new Post("Acerca de la Unidad", $about->contenido,530, false, true, false);
			$pst->id = "Acerca de la Unidad";
			$pst->editableTitle = false;
			$pst->Show();
		}
		
		/*!
		 * Muestra la lista de procesos academicos que se pueden realizar en la unidad
		 * \param  $pg Numero de pagina de registros a mostrar
		 * \param $onlyContent Valor booleano que define si se mostrara el post completo o solo el contenido de este. Ejemplo de ello es cuando se invoca este metodo desde una llamada via Ajax, para la paginacion
		 */
		public function ShowProcs($pg=-1, $onlyContent=false){
						
			//Se inicializa el MGalleryManager, que nos permitira mostrar la tira de imagenes deslizables			
			$MGManager = new MGalleryManager();
			//!Se inicializa el objeto que nos permitira obtener la lista de cursos (postgrados)
			$cprof = new cProcesos();
			//!Se obtiene la lista de registros
			$profResult = $cprof->GetLista();
			$metaInfo = "";
			if($profResult->num_rows > 0){
				while($arreglo = $profResult->fetch_array()){
					//!Se agregan las imagenes al MGalleryManager
					$MGManager->images[] = new MGalleryImage($arreglo["id"], $arreglo["nombre"], $arreglo["descripcion"], $arreglo["imagen"]);
					$metaInfo .= "<input type='hidden' id='descr-". $arreglo["id"] ."' value='". $arreglo["descripcion"] ."' />";
				}
			}
			//!Se genera el Post con la tira de imagenes
			$pstPreview = new InnerPost("Vista Previa", $MGManager->ToString(), 530, true, false, false);
			$pstPreview->tabla = "procesos";
			$pstPreview->id = "prev";
			
			//!Se genera el Post con la vista detallada de una imagen
			if($MGManager->images[0] != null){
				$pstContent = new InnerPost($MGManager->images[0]->name, $MGManager->images[0]->ToString(false), 530, false, true, true);
				$pstContent->id = "cont";
				$vTable = new VerticalTable();
				$vTable->rows[] = new VerticalTableRow(array("Descripcion", $MGManager->images[0]->desc), $pstContent->id, "area");
				$pstContent->contenido .= $vTable->ToString();
				$pstContent->plainTextContent = false;
				$pstContent->tabla = "procesos";
				$pstContent->tituloMaxLength = "20";
				$metaInfo .= "<input type=hidden id='id-bigimg' value='". $MGManager->images[0]->id ."'>";
			}	
			else
				$pstContent = new InnerPost("No hay imagenes que mostrar", "No hay imagenes que mostrar", 500);
			//!Se genera el post Principal que contendra a todo lo demas
			$pst = new Post("Procesos Academicos de la Unidad", $pstPreview->ToString() . $pstContent->ToString() . $metaInfo);
			$pts->tabla = "procesos";
			if($onlyContent)
				echo $pst->ToContentString();
			else
				echo $pst->ToString();
		}
		
		/*!
		 * Muestra los docentes registrados en la base de datos de la unidad
		 * \param  $pg Numero de pagina de registros a mostrar
		 * \param $onlyContent Valor booleano que define si se mostrara el post completo o solo el contenido de este. Ejemplo de ello es cuando se invoca este metodo desde una llamada via Ajax, para la paginacion
		 */
		public function ShowProfs($pg=-1, $onlyContent=false){
			
			$postList = "";
			//!Se inicializa el objeto que nos permitira obtener la lista de cursos (postgrados)
			$cprof = new cDocente();
			//!Se inicializa el objeto que nos permitira realizar la paginacion de nuestra lista de posts
			$pPager = new PostPager($cprof, 2);
			//!Se invoca al PostPager para que nos filtre la lista de Posts en base a la pagina seleccionada y a la condicion
			$profResult = $pPager->GetPosts($pg);
			//!Si se encontraron resultados...
			if($profResult->num_rows > 0){
				while($arreglo = $profResult->fetch_array()){
					//!Se genera un post temporal para irlo agregando a la lista de posts a mostrar
					//!Se inicializan sus campos
					$tempPost = new InnerPost("", "", 530, false, true, true);
					$tempPost->editableTitle = false;
					$tempPost->id = $arreglo["id"];
					$tempPost->tabla = "docente";
					$tempPost->titulo = $arreglo["apellidos"] . ", " . $arreglo["nombres"];
					//!Se inicializa el conteindo del Post. Este sera una tabla con una serie de filas de distintos campos
					$vTable = new VerticalTable();
					$vTable->rows[] = new VerticalTableRow(array("Apellidos", $arreglo["apellidos"]), $tempPost->id, "text", "200");
					$vTable->rows[] = new VerticalTableRow(array("Nombres", $arreglo["nombres"]), $tempPost->id, "text", "200");
					$vTable->rows[] = new VerticalTableRow(array("Grado Academico", $arreglo["gradoacademico"]), $tempPost->id, "text", "50");
					$vTable->rows[] = new VerticalTableRow(array("Descripcion", $arreglo["descripcion"]), $tempPost->id, "area");
					
					//!Una vez que se ha definido el contenido y las caracteristicas del post, este se agrega a la lista de posts a mostrar
					$tempPost->contenido = $vTable->ToString();
					$tempPost->plainTextContent = false;
					$postList .= $tempPost->ToString();
				}
			}
			//!Si la lista de posts esta vacia...
			else{
				//!Es porque no hay resultados que mostrar
				$tempPost = new InnerPost("No hay resultados", "No hay docentes que mostrar...", 530);
				$tempPost->id = "noresults";
				$postList .= $tempPost->ToString();
			}
			//!Se genera el Post principal y se agrega a su contenido la lista de posts generada anteriormente
			$pst = new Post("Docentes de la Unidad", $postList, 550, true, false, false);
			$pst->tabla = "docente";
			$pst->pie = $pPager->ToString();
			if($onlyContent)
				echo $pst->ToContentString();
			else
				echo $pst->ToString();
		}
		
		/*!
		 * Muestra las novedades de la unidad
		 * \param  $pg Numero de pagina de registros a mostrar
		 * \param $onlyContent Valor booleano que define si se mostrara el post completo o solo el contenido de este. Ejemplo de ello es cuando se invoca este metodo desde una llamada via Ajax, para la paginacion
		 */
		public function ShowNews($pg=-1, $onlyContent=false){
			$postList = "";
			
			/*$tempNov = new cNovedades();
			$tempNov->GetPorId(0);
			$pstPst = new InnerPost($tempNov->titulo, substr($tempNov->descripcion,3, strlen($tempNov->descripcion) - 4), 530);
			$postList .= $pstPst->ToString();*/
			
			$lastNovs = new cNovedades();
			//$novResult = $lastNovs->GetUltimos(10);
			$pPager = new PostPager($lastNovs);
			$novResult = $pPager->GetPosts($pg);
			if($novResult->num_rows > 0){
				while($arreglo = $novResult->fetch_array()){
					$tempPost = new InnerPost("", "", 530, false, true, true);
					$tempPost->id = $arreglo["id"];
					$tempPost->tabla = "novedades";
					$tempPost->fecha = substr($arreglo["fecha"],0,10);
					$tempPost->titulo = $arreglo["titulo"];
					$tempPost->tituloMaxLength = "50";
					//$tempPost->contenido = substr($arreglo["descripcion"],3,strlen($arreglo["descripcion"])-4);
					$tempPost->contenido = $arreglo["descripcion"];
					$postList .= $tempPost->ToString();
				}	
			}
			else{
				$tempPost = new InnerPost("No hay resultados", "No hay noticias que mostrar...", 530);
				$tempPost->id = "noresults";
				$postList .= $tempPost->ToString();
			}
			$pst = new Post("Noticias de la Unidad", $postList, 550, true, false, false);
			$pst->tabla = "novedades";
			$pst->showHelp = "admin";
			$pst->helpAction = "window.open('../Documentacion/Videos/apollo.novedades.htm', 'ayuda','height=596,width=928')";
			$pst->pie = $pPager->ToString();
			if($onlyContent)
				echo $pst->ToContentString();
			else
				echo $pst->ToString();
		}
		
		/*!
		 * Muestra los programas de utileria registrados en la base de datos de la unidad
		 * \param  $pg Numero de pagina de registros a mostrar
		 * \param $onlyContent Valor booleano que define si se mostrara el post completo o solo el contenido de este. Ejemplo de ello es cuando se invoca este metodo desde una llamada via Ajax, para la paginacion
		 */
		public function ShowUtils($pg=-1, $onlyContent=false){
			$postList = "";
			
			$lastUtil = new cUtileria();
			$pPager = new PostPager($lastUtil);
			$utiResult = $pPager->GetPosts($pg);
			if($utiResult->num_rows > 0){
				while($arreglo = $utiResult->fetch_array()){
					$tempPost = new InnerPost("", "", 530, false, true, true);
					$tempPost->editableTitle = false;
					$tempPost->id = $arreglo["id"];
					$tempPost->tabla = "utileria";
					$tempPost->titulo = $arreglo["titulo"];
					
					$vTable = new VerticalTable();
					$vTable->rows[] = new VerticalTableRow(array("Titulo", $arreglo["titulo"]), $arreglo["id"], "text", "50");
					$vTable->rows[] = new VerticalTableRow(array("Vinculo", $arreglo["vinculo"]), $arreglo["id"], "text", "100");
					$vTable->rows[] = new VerticalTableRow(array("Descripcion", $arreglo["descripcion"]), $arreglo["id"], "area");
					
					$tempPost->contenido = $vTable->ToString();
					$tempPost->plainTextContent = false;
					//$tempPost->contenido = substr($arreglo["descripcion"],3,strlen($arreglo["descripcion"])-4);
					//$tempPost->contenido .= "<br/>Sigue este vinculo para descargar este programa: <a href='".$arreglo["vinculo"]."' >".$arreglo["vinculo"]."</a>";
					$postList .= $tempPost->ToString();
				}
			}
			else{
				$tempPost = new InnerPost("No hay resultados", "No hay utilidades que mostrar...", 530);
				$tempPost->id = "noresults";
				$postList .= $tempPost->ToString();
			}
			$pst = new Post("Programas de Utileria", $postList, 550, true, false, false);
			$pst->tabla = "utileria";
			$pst->pie = $pPager->ToString();
			if($onlyContent)
				echo $pst->ToContentString();
			else
				echo $pst->ToString();
		}
		
		/*!
		 * Muestra informacion de contacto y suscripcion a las noticias de la unidad
		 * \param  $pg Numero de pagina de registros a mostrar
		 * \param $onlyContent Valor booleano que define si se mostrara el post completo o solo el contenido de este. Ejemplo de ello es cuando se invoca este metodo desde una llamada via Ajax, para la paginacion
		 */
		public function ShowContact(){
			$postList = "";
			$gen = new cGeneral();
			
			//Info de contacto con la secretaria, //add, edit, delete
				$tempPost = new InnerPost("", "", 530, false, true, false);
				$tempPost->id = "contacto";
				$tempPost->titulo = "Informacion de Contacto";
				$gen->GetPorTitulo('contacto');
				$tempPost->contenido = $gen->contenido;
				$tempPost->editableTitle = false;
				$postList .= $tempPost->ToString();			
			
			//Informacion de suscripcion FEED RSS
				$tempPost = new InnerPost("", "", 530, false, false, false);
				$tempPost->id = "suscripcion";
				$tempPost->titulo = "Suscribete a esta pagina";
				$tempPost->showHelp = "always";
				$tempPost->helpAction = "window.open('../Documentacion/Videos/apollo.suscripcion.htm', 'ayuda','height=596,width=928')";
				//$gen->GetPorTitulo('suscripcion');
				//$tempPost->contenido = $gen->contenido;
				$tempPost->contenido = '<center>';
				$tempPost->contenido .= '<a href="../rss/feeds.php?genera=novedades" type="application/rss+xml">Ultimas Novedades <img src="../Media/feed.png" alt="" border="0"></a><br/>';
				$tempPost->contenido .= '<a href="../rss/feeds.php?genera=foro" type="application/rss+xml">Actividad en el Foro <img src="../Media/feed.png" alt="" border="0"></a><br/>';
				$tempPost->contenido .= '<a href="../rss/feeds.php?genera=cursos" type="application/rss+xml">Noticias sobre los Cursos <img src="../Media/feed.png" alt="" border="0"></a><br/></center>';
				
				$tempPost->editableTitle = false;
				$postList .= $tempPost->ToString();
			
			$pst = new Post("Contacto y Suscripcion", $postList, 550, false, false, false);
			//$pst->tbox->btnAdd->enabled = false;
			//$pst->tbox->btnEdit->enabled = false;
			//$pst->tbox->btnDel->enabled = false;
			$pst->Show();
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
					$this->ShowAbout();
			}
			else
				$this->ShowAbout();
		}
    }
?>
