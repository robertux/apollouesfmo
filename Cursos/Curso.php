<?php
    class Curso{
    	
		public $titulo;
		public $codigo;
		public $planEstudios;
		public $materias;
		
		
		public function Curso(){
			
		}
		
		public function Show(){
			
		}
    }
	
	class CursoMAF extends Curso{
		
		
		public function CursoMAF(){
			$this->titulo = "Maestria en Administracion Financiera";
			$this->codigo = "M30807";
			$this->planEstudios = 2005;
			$this->materias = array();
			$this->materias[] = new Materia("1", "EDE138", "Economia de la Empresa", 2, "");
			$this->materias[] = new Materia("2", "AFB138", "Adminsitracion Financiera Basica", 2, "");
			$this->materias[] = new Materia("3", "AME138", "Administracion Moderna", 2, "");
			$this->materias[] = new Materia("4", "MCF138", "Metodos Cuantitativos Para las Finanzas", 3, "");
		}
		
		public function GetTitulo(){
			return $this->codigo . " - " . $this->titulo . " (plan " . $this->planEstudios . ")";
		}
		
		public function GetContenido(){
			$strContent = "";
			foreach($this->materias as $mat){
				$strContent.= $mat->GetAsPost();
			}
			return $strContent;
		}
	}
?>
