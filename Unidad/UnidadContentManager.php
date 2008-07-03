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
			
			$pst = new Post("Acerca de la Unidad", "
			<p id='PostInnerContent'>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Sed in eros. Praesent sed ligula. Nullam quam. Etiam posuere cursus eros. Duis in sapien. Pellentesque non augue. Maecenas ut lacus nec tellus vehicula vulputate. Phasellus sem libero, vehicula sed, tempor at, facilisis a, mi. Duis lobortis urna a nunc. Nunc condimentum, diam eget tristique consectetuer, est risus ultricies erat, sit amet auctor enim risus a ligula. Vivamus id tortor eget massa molestie rhoncus. Nulla at arcu. Ut egestas tempus metus. Nullam pellentesque dui ac libero. Pellentesque libero dolor, aliquet sed, aliquam tincidunt, egestas nec, tortor. Fusce ligula nunc, iaculis ac, fermentum ac, egestas eu, quam.</p>

			<p id='PostInnerContent'>Vivamus quis tellus id enim tempor semper. Nullam mi. Quisque ante augue, feugiat at, malesuada at, fringilla quis, risus. Suspendisse lectus. Sed luctus arcu in elit. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Phasellus rutrum lacinia neque. Nunc a orci. Curabitur dignissim, ipsum at sodales pretium, arcu sem ultricies erat, egestas molestie tortor tellus id justo. Proin mollis imperdiet elit. Quisque leo. Vivamus gravida leo quis erat. Fusce purus. Donec mauris dui, facilisis in, consectetuer et, cursus vitae, ante. Mauris urna. Ut id tellus. Cras dolor nisi, blandit eget, interdum quis, congue vel, nunc.</p>

			<p id='PostInnerContent'>Vivamus vitae massa. Maecenas tortor. Cras rhoncus urna et metus. Nulla commodo, risus eget tristique blandit, augue tellus vulputate pede, nec porttitor nibh augue a nibh. Nam sagittis nulla in elit dignissim scelerisque. Aliquam erat volutpat. Curabitur feugiat bibendum augue. Mauris ultrices, massa ut viverra euismod, nunc est lacinia urna, eget eleifend turpis enim id nisi. Proin semper nunc ut sapien. Nullam sagittis vestibulum lacus. Praesent in turpis eu ligula convallis fringilla. Aliquam erat volutpat. In adipiscing ante et odio. Integer enim enim, sollicitudin sit amet, posuere in, ultrices vel, tortor. In fringilla, augue congue blandit rhoncus, lectus ipsum vehicula mauris, et pharetra sapien est vitae diam. Cras convallis ipsum nec velit. Vestibulum rhoncus feugiat tellus. </p>
			
			",550, false, true, false);
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
