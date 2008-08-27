<?php
    class CursosContentManager{
    	
		var  $opcion;
		
		public function CursosContentManager($opt = "actual"){
			$this->opcion = $opt;
		}
		
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
				case "stuff": $this->ShowRecursos();
					break;
				case "serv": $this->ShowServSoc();
					break;
				default: $this->ShowCursos(-1, false, true);
			}
		}
		
		public function ShowMisCursos(){
			$cmaf = new CursoMAF();
			$pstMaf = new InnerPost($cmaf->GetTitulo(), $cmaf->GetContenido(), 530);
			$pst = new Post("Mis Maestrias",$pstMaf->ToString());
			$pst->Show();
		}
		
		public function ShowCursos($pg=-1, $onlyContent=false, $showActuales=true){
			$postList = "";
			$ccurso = new cPostgrado();
			$pPager = new PostPager($ccurso, 2);
			$condicion = ($showActuales? "actual": "proximo");
			$cursoResult = $pPager->GetPosts($pg, $condicion);
			if($cursoResult->num_rows > 0){
				while($arreglo = $cursoResult->fetch_array()){
					//if(($showActuales == true && $arreglo["esactual"] == 1) || ($showActuales == false && $arreglo["esactual"] == 0)){
						$tempPost = new InnerPost("", "", 530, false, true, true);
						$tempPost->editableTitle = true;
						$tempPost->id = $arreglo["id"];
						$tempPost->tabla = "postgrado";
						$tempPost->titulo = $arreglo["codigo"];
						
						$vTable = new VerticalTable();
						$vTable->rows[] = new VerticalTableRow(array("Nombre", $arreglo["nombre"]), $tempPost->id);
						$vTable->rows[] = new VerticalTableRow(array("Descripcion", $arreglo["descripcion"]), $tempPost->id . "-1", "area");
						$vTable->rows[] = new VerticalTableRow(array("Mision", $arreglo["mision"]), $tempPost->id . "-2", "area");
						$vTable->rows[] = new VerticalTableRow(array("Vision", $arreglo["vision"]), $tempPost->id . "-3", "area");
						$vTable->rows[] = new VerticalTableRow(array("Desarrollo del Programa", $arreglo["desarrollo"]), $tempPost->id);
						$vTable->rows[] = new VerticalTableRow(array("Duracion", $arreglo["duracion"]), $tempPost->id);
						$vTable->rows[] = new VerticalTableRow(array("Calificacion Minima de Aprobacion", $arreglo["notaminima"]), $tempPost->id, "numero");
						$vTable->rows[] = new VerticalTableRow(array("Inicio de Clases", substr($arreglo["inicioclases"],0,10)), $tempPost->id, "fecha");
						$vTable->rows[] = new VerticalTableRow(array("Grado a Obtener", $arreglo["grado_obtener"]), $tempPost->id);
						$vTable->rows[] = new VerticalTableRow(array("Poblacion a la que se Dirige el Programa", $arreglo["poblacion"]), $tempPost->id . "-4", "area");
						$vTable->rows[] = new VerticalTableRow(array("Horario", $arreglo["horario"]), $tempPost->id . "-5", "area");
						$vTable->rows[] = new VerticalTableRow(array("Inversion", $arreglo["inversion"]), $tempPost->id, "numero");
						
						$tempPost->contenido = $vTable->ToString();
						$tempPost->plainTextContent = false;
						$postList .= $tempPost->ToString();
					//}
				}
				if($postList == ""){
					$tempPost = new InnerPost("No hay resultados", "No hay maestrias que mostrar...<br /><br /><br />", 530);
					$tempPost->id = "noresults";
					$postList .= $tempPost->ToString();
				}
			}
			else{
				$tempPost = new InnerPost("No hay resultados", "No hay maestrias que mostrar...", 530);
				$tempPost->id = "noresults";
				$postList .= $tempPost->ToString();
			}
			
			$pst = new Post("Maestrias " . ($showActuales? "Actuales": "Proximas"), $postList, 550, true, false, false);
			$pst->tabla = "postgrado";
			$pst->pie = $pPager->ToString($condicion);
			$pst->contenido .= "<input type='hidden' id='tipocursos' value='$condicion' />";
			if($onlyContent)
				echo $pst->ToContentString();
			else
				echo $pst->ToString();
		}
				
		public function ShowEventos($pg=-1, $onlyContent=false){
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
					
					$vTable = new VerticalTable();
					$vTable->rows[] = new VerticalTableRow(array("Fecha", $arreglo["fecha"]), $tempPost->id, "fecha");
					$vTable->rows[] = new VerticalTableRow(array("Lugar", $arreglo["lugar"]), $tempPost->id);
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
		
		public function ShowRecursos(){
			$resmgr = new ResManager();
			$pst = new Post("Recursos Adicionales", $resmgr->GetSubjectsRes() . $resmgr->GetAddRes());
			$pst->Show();
		}
		
		public function ShowServSoc(){
			$pstServSoc = new InnerPost("Mi Servicio Social", "
				<table border='1' width='100%'>
					<tr><th>Nombre:</th><td id='Left'>Cursos Introductorios a los Aspirantes Universitarios</td></tr>
					<tr><th>Descripcion:</th><td id='Left'>Cursos Introductorios a los Aspirantes Universitarios</td></tr>
					<tr><th>Inicio:</th><td id='Left'>10 de Noviembre de 2007</td></tr>
					<tr><th>Duracion:</th><td id='Left'>2 meses</td></tr>
					<tr><th>Horas totales:</th><td id='Left'>150</td></tr>
					<tr><th>Asesor:</th><td id='Left'>Lic. Juan Perez</td></tr>
					<tr><th>Estado:</th><td id='Left'>Pendiente</td></tr>
				</table>
			", 500);
			$pst = new Post("Servicio Social", $pstServSoc->ToString());
			$pst->Show();
		}		
    }
?>
