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
			}
		}
		
		public function ShowMisCursos(){
			$cmaf = new CursoMAF();
			$pstMaf = new InnerPost($cmaf->GetTitulo(), $cmaf->GetContenido(), 530);
			$pst = new Post("Mis Maestrias",$pstMaf->ToString());
			$pst->Show();
		}
    }
?>
