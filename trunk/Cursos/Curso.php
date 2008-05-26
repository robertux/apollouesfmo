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
		
		public function GetDescripcionProximo(){
			return "
				Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aliquam dui magna, porttitor id, tincidunt eu, mollis at, nisl. Nam sit amet tellus. Morbi hendrerit, velit ac dictum imperdiet, est orci cursus neque, id bibendum dolor felis in erat. In in nunc. Sed dapibus, est posuere facilisis vehicula, metus massa consectetuer augue, ut venenatis orci eros rutrum sapien. Fusce sed ipsum. Suspendisse potenti. Integer faucibus scelerisque dui. Nunc nec odio eu justo malesuada porttitor. Sed suscipit ipsum non metus. Morbi lobortis dui eu nibh. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Morbi quis nunc. Sed elementum ultrices mauris. Nunc suscipit iaculis quam. Pellentesque pulvinar. Fusce elit ante, aliquam et, vestibulum in, pretium nec, nisi. Pellentesque adipiscing. Integer ut magna a eros aliquam placerat. Curabitur lorem.			
			";
		}
		
		public function GetDescripcionActual(){
			return "
				Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aliquam dui magna, porttitor id, tincidunt eu, mollis at, nisl. Nam sit amet tellus. Morbi hendrerit, velit ac dictum imperdiet, est orci cursus neque, id bibendum dolor felis in erat. In in nunc. Sed dapibus, est posuere facilisis vehicula, metus massa consectetuer augue, ut venenatis orci eros rutrum sapien. Fusce sed ipsum. Suspendisse potenti. Integer faucibus scelerisque dui. Nunc nec odio eu justo malesuada porttitor. Sed suscipit ipsum non metus. Morbi lobortis dui eu nibh. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Morbi quis nunc. Sed elementum ultrices mauris. Nunc suscipit iaculis quam. Pellentesque pulvinar. Fusce elit ante, aliquam et, vestibulum in, pretium nec, nisi. Pellentesque adipiscing. Integer ut magna a eros aliquam placerat. Curabitur lorem.
			";
		}
	}
	
	class CursoMPDS extends Curso{
		
		
		public function CursoMPDS(){
			$this->titulo = "Maestria en Profesionalizacion de la Docencia Superior";
			$this->codigo = "M30464";
			$this->planEstudios = 2001;
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
		
		public function GetDescripcionProximo(){
			return"
				<p id='PostInnerContent'>
				Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aliquam dui magna, porttitor id, tincidunt eu, mollis at, nisl. Nam sit amet tellus. Morbi hendrerit, velit ac dictum imperdiet, est orci cursus neque, id bibendum dolor felis in erat. In in nunc. Sed dapibus, est posuere facilisis vehicula, metus massa consectetuer augue, ut venenatis orci eros rutrum sapien. Fusce sed ipsum. Suspendisse potenti. Integer faucibus scelerisque dui. Nunc nec odio eu justo malesuada porttitor. Sed suscipit ipsum non metus. Morbi lobortis dui eu nibh. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Morbi quis nunc. Sed elementum ultrices mauris. Nunc suscipit iaculis quam. Pellentesque pulvinar. Fusce elit ante, aliquam et, vestibulum in, pretium nec, nisi. Pellentesque adipiscing. Integer ut magna a eros aliquam placerat. Curabitur lorem.
				</p>
				<p id='PostInnerContent'>
					<div id='Titulo'>Mision</div>
				</p>
				<p id='PostInnerContent'>	
					Proin tincidunt accumsan enim. Vivamus arcu. In feugiat vestibulum ante. Ut nec magna id nunc gravida consectetuer. Donec faucibus dapibus neque. Ut quis nisi quis augue sodales aliquet. Aenean vel neque. Ut vel eros nec velit vulputate imperdiet. Morbi ac tortor. Vivamus nisi. Nullam diam. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
				</p>
				<p id='PostInnerContent'>
					<div id='Titulo'>Vision</div>
				</p>
				<p id='PostInnerContent'>
					Proin tincidunt accumsan enim. Vivamus arcu. In feugiat vestibulum ante. Ut nec magna id nunc gravida consectetuer. Donec faucibus dapibus neque. Ut quis nisi quis augue sodales aliquet. Aenean vel neque. Ut vel eros nec velit vulputate imperdiet. Morbi ac tortor. Vivamus nisi. Nullam diam. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
				</p>
				<p id='PostInnerContent'>
				<table border='1'>
					<tr><th>Desarrollo del Programa:</td> <td id='Left'>2008 - 2010</td></tr>
					<tr><th>Duracion:</td> <td id='Left'>Seis ciclos de estudio (dos anios y medio), mas trabajo de graduacion</td></tr>
					<tr><th>Calificacion Minima de Aprobacion:</td> <td id='Left'>7.0</td></tr>
					<tr><th>Inicio de Clases:</td> <td id='Left'>21 de Febrero de 2008</td></tr>
					<tr><th>Grado a Obtener:</td> <td id='Left'>Maestria en la Profesionalizacion de la Docencia Superior</td></tr>
					<tr><th>Poblacion a la que se Dirige el Programa:</td> <td id='Left'><ul><li>Profesionales de educacion superior publica o privada</li><li>Profesionales que laboran en diversos ambitos relacionados con la educacion en El Salvador</li></ul></td></tr>
					<tr><th>Horario:</td> <td id='Left'><ul id='ContentList'><li>Viernes: 5:30 - 8:30 pm</li><li>Sabado: 8:00 - 12:00pm</li></ul><br />Aula: SALA DE MAESTRIA</td></tr>
					<tr><th>Inversion:</td> <td id='Left'><ul id='ContentList'><li>Solicitud de Admision: $11.43</li><li>Matricula Anual: $50.00</li><li>5 mensualidades por ciclo: $80.00</li></ul></td></tr>
				</table>
				</p>
			";
		}
		
		public function GetDescripcionActual(){
			return"
				Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aliquam dui magna, porttitor id, tincidunt eu, mollis at, nisl. Nam sit amet tellus. Morbi hendrerit, velit ac dictum imperdiet, est orci cursus neque, id bibendum dolor felis in erat. In in nunc. Sed dapibus, est posuere facilisis vehicula, metus massa consectetuer augue, ut venenatis orci eros rutrum sapien. Fusce sed ipsum. Suspendisse potenti. Integer faucibus scelerisque dui. Nunc nec odio eu justo malesuada porttitor. Sed suscipit ipsum non metus. Morbi lobortis dui eu nibh. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Morbi quis nunc. Sed elementum ultrices mauris. Nunc suscipit iaculis quam. Pellentesque pulvinar. Fusce elit ante, aliquam et, vestibulum in, pretium nec, nisi. Pellentesque adipiscing. Integer ut magna a eros aliquam placerat. Curabitur lorem.
			";
		}
	}
?>
