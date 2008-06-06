<?php
    class CursosContentManager{
    	
		var  $opcion;
		
		public function CursosContentManager($opt = "mine"){
			$this->opcion = $opt;
		}
		
		public function Show(){
			switch($this->opcion){
				case "mine": $this->ShowMisCursos();
					break;
				case "actual": $this->ShowCursosActuales();
					break;
				case "next": $this->ShowCursosProximos();				
					break;
				case "event": $this->ShowEventos();
					break;
				case "stuff": $this->ShowRecursos();
					break;
				case "serv": $this->ShowServSoc();
					break;
				default: $this->ShowMisCursos();
			}
		}
		
		public function ShowMisCursos(){
			$cmaf = new CursoMAF();
			$pstMaf = new InnerPost($cmaf->GetTitulo(), $cmaf->GetContenido(), 530);
			$pst = new Post("Mis Maestrias",$pstMaf->ToString());
			$pst->Show();
		}
		
		public function ShowCursosActuales(){
			$cmaf = new CursoMAF();
			$cmpds = new CursoMPDS();

			$pstCursoMAF = new InnerPost($cmaf->GetTitulo(), $cmaf->GetDescripcionActual(), 530);
			$pstCursoMAF->tbox->btnEdit->enabled = true;
			$pstCursoMPDS = new InnerPost($cmpds->GetTitulo(), $cmpds->GetDescripcionActual(), 530);
			$pstCursoMPDS->tbox->btnEdit->enabled = true;
			
			$pst = new Post("Maestrias Actuales", $pstCursoMAF->ToString() . $pstCursoMPDS->ToString());			
			$pst->Show();
		}
		
		public function ShowCursosProximos(){
			$cmaf = new CursoMAF();
			$cmpds = new CursoMPDS();

			$pstCursoMAF = new InnerPost($cmaf->GetTitulo(), $cmaf->GetDescripcionProximo(), 530);
			$pstCursoMAF->tbox->btnEdit->enabled = true;
			$pstCursoMPDS = new InnerPost($cmpds->GetTitulo(), $cmpds->GetDescripcionProximo(), 530);
			$pstCursoMPDS->tbox->btnEdit->enabled = true;
			
			$pst = new Post("Maestrias Proximas", $pstCursoMAF->ToString() . $pstCursoMPDS->ToString());
			$pst->Show();
		}
		
		public function ShowEventos(){
			$pstEv1 = new InnerPost("22/05/08 - Primer examen corto","
				<table border='1' width='100%'>
					<tr><th>Hora:</th><td id='left'>06:30 p.m.</td></tr>
					<tr><th>Lugar:</th><td id='left'>Aula S2C</td></tr>
					<tr><th>Detalle:</th><td id='left'>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Sed in eros. Praesent sed ligula. Nullam quam. Etiam posuere cursus eros. Duis in sapien. Pellentesque non augue. Maecenas ut lacus nec tellus vehicula vulputate. Phasellus sem libero, vehicula sed, tempor at, facilisis a, mi. Duis lobortis urna a nunc. Nunc condimentum, diam eget tristique consectetuer, est risus ultricies erat, sit amet auctor enim risus a ligula. Vivamus id tortor eget massa molestie rhoncus. Nulla at arcu. Ut egestas tempus metus. Nullam pellentesque dui ac libero. Pellentesque libero dolor, aliquet sed, aliquam tincidunt, egestas nec, tortor. Fusce ligula nunc, iaculis ac, fermentum ac, egestas eu, quam.
</td></tr>
				</table>
			",500);
			$pstEv2 = new InnerPost("20/05/08 - Entrega de primera tarea evaluada","
				<table border='1' width='100%'>
					<tr><th>Hora:</th><td id='left'>02:30 p.m.</td></tr>
					<tr><th>Lugar:</th><td id='left'>Cubiculo del departamento</td></tr>
					<tr><th>Detalle:</th><td id='left'>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Sed in eros. Praesent sed ligula. Nullam quam. Etiam posuere cursus eros. Duis in sapien. Pellentesque non augue. Maecenas ut lacus nec tellus vehicula vulputate. Phasellus sem libero, vehicula sed, tempor at, facilisis a, mi. Duis lobortis urna a nunc. Nunc condimentum, diam eget tristique consectetuer, est risus ultricies erat, sit amet auctor enim risus a ligula. Vivamus id tortor eget massa molestie rhoncus. Nulla at arcu. Ut egestas tempus metus. Nullam pellentesque dui ac libero. Pellentesque libero dolor, aliquet sed, aliquam tincidunt, egestas nec, tortor. Fusce ligula nunc, iaculis ac, fermentum ac, egestas eu, quam.
</td></tr>
				</table>
			",500);
			$pstEv3 = new InnerPost("12/05/08 - Inicio de clases","
				<table border='1' width='100%'>
					<tr><th>Hora:</th><td id='left'>06:30 p.m.</td></tr>
					<tr><th>Lugar:</th><td id='left'>Aula S2E</td></tr>
					<tr><th>Detalle:</th><td id='left'>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Sed in eros. Praesent sed ligula. Nullam quam. Etiam posuere cursus eros. Duis in sapien. Pellentesque non augue. Maecenas ut lacus nec tellus vehicula vulputate. Phasellus sem libero, vehicula sed, tempor at, facilisis a, mi. Duis lobortis urna a nunc. Nunc condimentum, diam eget tristique consectetuer, est risus ultricies erat, sit amet auctor enim risus a ligula. Vivamus id tortor eget massa molestie rhoncus. Nulla at arcu. Ut egestas tempus metus. Nullam pellentesque dui ac libero. Pellentesque libero dolor, aliquet sed, aliquam tincidunt, egestas nec, tortor. Fusce ligula nunc, iaculis ac, fermentum ac, egestas eu, quam.
</td></tr>
				</table>
			",500);
			
			$pstEv1->tbox->btnEdit->enabled = true;
			$pstEv1->tbox->btnDel->enabled = true;
			$pstEv2->tbox->btnEdit->enabled = true;
			$pstEv2->tbox->btnDel->enabled = true;
			$pstEv3->tbox->btnEdit->enabled = true;
			$pstEv3->tbox->btnDel->enabled = true;
			
			$pst = new Post("Eventos de las Maestrias", $pstEv1->ToString() . $pstEv2->ToString() . $pstEv3->ToString());
			$pst->Show();
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
