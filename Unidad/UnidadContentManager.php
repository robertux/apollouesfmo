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
				case "news": $this->ShowNews();				
					break;
				case "util": $this->ShowUtils();
					break;
				case "contact": $this->ShowContact();
					break;
				default: $this->ShowAbout();
			}
		}
		
		public function ShowAbout(){
			
			$aboutContent = "Acerca de la unidad. <br>. <br>. <br>.";
			$aboutNews = new cNovedades();
			$aboutResult = $aboutNews->GetPorTitulo("about");
			if($aboutResult->num_rows > 0){
				$aboutArray = $aboutResult->fetch_array();
				$aboutContent = $aboutArray["descripcion"];
			}
			
			$pst = new Post("Acerca de la Unidad", $aboutContent,550, false, true, false);
			/*$myUser = new cusuario();
			if($myUser->GetPorId($_SESSION["CurrentUser"])){
				if($myUser->privilegio == "admin"){
					$pst->tbox->btnEdit->enabled = true;
				}
			}*/
			$pst->Show();
		}
		
		public function ShowProcs(){
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
		
		public function ShowNews(){
			$postList = "";
			
			/*$tempNov = new cNovedades();
			$tempNov->GetPorId(0);
			$pstPst = new InnerPost($tempNov->titulo, substr($tempNov->descripcion,3, strlen($tempNov->descripcion) - 4), 530);
			$postList .= $pstPst->ToString();*/
			
			$lastNovs = new cNovedades();
			$novResult = $lastNovs->GetUltimos(10);
			if($novResult->num_rows > 0){
				while($arreglo = $novResult->fetch_array()){
					$tempPost = new InnerPost("", "", 530, false, true, true);
					$tempPost->titulo = substr($arreglo["fecha"],0,10) . " | " . $arreglo["titulo"];
					$tempPost->contenido = substr($arreglo["descripcion"],3,strlen($arreglo["descripcion"])-4);
					$postList .= $tempPost->ToString();
				}				
			}
			else{
				$tempPost = new InnerPost("No hay resultados", "No hay noticias que mostrar", 530);
				$postList .= $tempPost->ToString();
			}
			$pst = new Post("Noticias de la Unidad", $postList, 550, true, false, false);
			$pst->Show();
		}
		
		public function ShowUtils(){
			$pst = new Post("Programas de Utileria", "");
			$pst->Show();
		}
		
		public function ShowContact(){
			$pst = new Post("Contacto Suscripcion", "");
			$pst->Show();
		}
    }
?>
