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
			$pstPreview = new InnerPost("Vista Previa", "
			<table border='1'>
				<tr>
					<td>
						<img src='FlowCharts/UesFmoPostgradosFlowChart.png' alt='Procesos Generales - Unidad de Postgrados' width='100' height='100' />
					</td>
					<td>
						<img src='FlowCharts/UesFmoPostgradosFlowChart.png' alt='Procesos Generales - Unidad de Postgrados' width='100' height='100' />
					</td>
					<td>
						<img src='FlowCharts/UesFmoPostgradosFlowChart.png' alt='Procesos Generales - Unidad de Postgrados' width='100' height='100' />
					</td>
					<td>
						<img src='FlowCharts/UesFmoPostgradosFlowChart.png' alt='Procesos Generales - Unidad de Postgrados' width='100' height='100' />
					</td>
				</tr>
				<tr>
					<td>
						Proceso de Inscripcion
					</td>
					<td>
						Proceso de Clases y Evaluaciones
					</td>
					<td>
						Servicio Social
					</td>
					<td>
						Proceso de Graduacion
					</td>
				</tr>
			</table>
			", 500);
			
			$pstPreview->tbox->btnAdd->enabled = true;
			$pstPreview->tbox->btnEdit->enabled = true;
			$pstPreview->tbox->btnDel->enabled = true;
			$pstContent = new InnerPost("Procesos Generales", "<img src='FlowCharts/UesFmoPostgradosFlowChart.png' alt='Procesos Generales - Unidad de Postgrados' />", 500);			
			$pst = new Post("Procesos Academicos de la Unidad", $pstPreview->ToString() . $pstContent->ToString());
			$pst->Show();
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
					$tempPost->tabla = "docentes";
					$tempPost->titulo = $arreglo["apellidos"] . ", " . $arreglo["nombres"];
					
					$vTable = new VerticalTable();
					$vTable->rows[] = new VerticalTableRow(array("Apellidos", $arreglo["apellidos"]));
					$vTable->rows[] = new VerticalTableRow(array("Nombres", $arreglo["nombres"]));
					$vTable->rows[] = new VerticalTableRow(array("Grado Academico", $arreglo["gradoacademico"]));
					$vTable->rows[] = new VerticalTableRow(array("Descripcion", $arreglo["descripcion"]));
					
					$tempPost->contenido = $vTable->ToString();
					$postList .= $tempPost->ToString();
				}
			}
			else{
				$tempPost = new InnerPost("No hay resultados", "No hay docentes que mostrar...", 530);
				$tempPost->id = "noresults";
				$postList .= $tempPost->ToString();
			}
			
			$pst = new Post("Docentes de la Unidad", $postList, 550, true, false, false);
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
					$vTable->rows[] = new VerticalTableRow(array("Titulo", $arreglo["titulo"]));
					$vTable->rows[] = new VerticalTableRow(array("Vinculo", $arreglo["vinculo"]));
					$vTable->rows[] = new VerticalTableRow(array("Descripcion", $arreglo["descripcion"]));
					
					$tempPost->contenido = $vTable->ToString();
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
				$postList .= $tempPost->ToString();			
			
			//Informacion de suscripcion FEED RSS
				$tempPost = new InnerPost("", "", 530, false, true, false);
				$tempPost->id = "suscripcion";
				$tempPost->titulo = "Suscribete a esta pagina";
				$gen->GetPorTitulo('suscripcion');
				$tempPost->contenido = $gen->contenido;
				$postList .= $tempPost->ToString();
			
			$pst = new Post("Contacto y Suscripcion", $postList, 550, false, false, false);
			//$pst->tbox->btnAdd->enabled = false;
			//$pst->tbox->btnEdit->enabled = false;
			//$pst->tbox->btnDel->enabled = false;
			$pst->Show();
		}
    }
?>
