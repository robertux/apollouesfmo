<?php

    class UnidadContentManager{
    	
		var $opcion;
		
		public function UnidadContentManager($opt="about"){
			$this->opcion=$opt;
		}
		
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
				default: $this->ShowAbout();
			}
		}
		
		public function ShowAbout($pg=-1, $onlyContent=false){
			
			$about = new cGeneral();
			$aboutResult = $about->GetPorTitulo("about");
			
			$pst = new Post("Acerca de la Unidad", $about->contenido,530, false, true, false);
			$pst->editableTitle = false;
			$pst->Show();
		}
		
		public function ShowProcs($pg=-1, $onlyContent=false){
			
			$MGManager = new MGalleryManager();
			$cprof = new cProcesos();
			$profResult = $cprof->GetLista();
			$metaInfo = "";
			if($profResult->num_rows > 0){
				while($arreglo = $profResult->fetch_array()){
					$MGManager->images[] = new MGalleryImage($arreglo["id"], $arreglo["nombre"], $arreglo["descripcion"], $arreglo["imagen"]);
					$metaInfo .= "<input type='hidden' id='descr-". $arreglo["id"] ."' value='". $arreglo["descripcion"] ."' />";
				}
			}
			$pstPreview = new InnerPost("Vista Previa", $MGManager->ToString(), 530, true, false, false);
			$pstPreview->tabla = "procesos";
			$pstPreview->id = "prev";
			
			if($MGManager->images[0] != null){
				$pstContent = new InnerPost($MGManager->images[0]->name, $MGManager->images[0]->ToString(false), 530, false, true, true);
				$pstContent->id = "cont";
				$vTable = new VerticalTable();
				$vTable->rows[] = new VerticalTableRow(array("Descripcion", $MGManager->images[0]->desc), $pstContent->id, "area");
				$pstContent->contenido .= $vTable->ToString();
				$pstContent->plainTextContent = false;
				$pstContent->tabla = "procesos";
				$metaInfo .= "<input type=hidden id='id-bigimg' value='". $MGManager->images[0]->id ."'>";
			}	
			else
				$pstContent = new InnerPost("No hay imagenes que mostrar", "No hay imagenes que mostrar", 500);
			$pst = new Post("Procesos Academicos de la Unidad", $pstPreview->ToString() . $pstContent->ToString() . $metaInfo);
			$pts->tabla = "procesos";
			if($onlyContent)
				echo $pst->ToContentString();
			else
				echo $pst->ToString();
		}
		
		public function ShowProfs($pg=-1, $onlyContent=false){
			
			$postList = "";
			$cprof = new cDocente();
			$pPager = new PostPager($cprof, 2);
			$profResult = $pPager->GetPosts($pg);
			if($profResult->num_rows > 0){
				while($arreglo = $profResult->fetch_array()){
					$tempPost = new InnerPost("", "", 530, false, true, true);
					$tempPost->editableTitle = false;
					$tempPost->id = $arreglo["id"];
					$tempPost->tabla = "docente";
					$tempPost->titulo = $arreglo["apellidos"] . ", " . $arreglo["nombres"];
					
					$vTable = new VerticalTable();
					$vTable->rows[] = new VerticalTableRow(array("Apellidos", $arreglo["apellidos"]), $tempPost->id);
					$vTable->rows[] = new VerticalTableRow(array("Nombres", $arreglo["nombres"]), $tempPost->id);
					$vTable->rows[] = new VerticalTableRow(array("Grado Academico", $arreglo["gradoacademico"]), $tempPost->id);
					$vTable->rows[] = new VerticalTableRow(array("Descripcion", $arreglo["descripcion"]), $tempPost->id, "area");
					
					$tempPost->contenido = $vTable->ToString();
					$tempPost->plainTextContent = false;
					$postList .= $tempPost->ToString();
				}
			}
			else{
				$tempPost = new InnerPost("No hay resultados", "No hay docentes que mostrar...", 530);
				$tempPost->id = "noresults";
				$postList .= $tempPost->ToString();
			}
			
			$pst = new Post("Docentes de la Unidad", $postList, 550, true, false, false);
			$pst->tabla = "docente";
			$pst->pie = $pPager->ToString();
			if($onlyContent)
				echo $pst->ToContentString();
			else
				echo $pst->ToString();
		}
		
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
					$tempPost->contenido = substr($arreglo["descripcion"],3,strlen($arreglo["descripcion"])-4);
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
			$pst->pie = $pPager->ToString();
			if($onlyContent)
				echo $pst->ToContentString();
			else
				echo $pst->ToString();
		}
		
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
					$vTable->rows[] = new VerticalTableRow(array("Titulo", $arreglo["titulo"]), $arreglo["id"]);
					$vTable->rows[] = new VerticalTableRow(array("Vinculo", $arreglo["vinculo"]), $arreglo["id"]);
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
				$tempPost = new InnerPost("", "", 530, false, true, false);
				$tempPost->id = "suscripcion";
				$tempPost->titulo = "Suscribete a esta pagina";
				$gen->GetPorTitulo('suscripcion');
				$tempPost->contenido = $gen->contenido;
				$tempPost->editableTitle = false;
				$postList .= $tempPost->ToString();
			
			$pst = new Post("Contacto y Suscripcion", $postList, 550, false, false, false);
			//$pst->tbox->btnAdd->enabled = false;
			//$pst->tbox->btnEdit->enabled = false;
			//$pst->tbox->btnDel->enabled = false;
			$pst->Show();
		}
    }
?>
