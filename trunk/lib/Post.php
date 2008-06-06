<?php
    class Post{
    	
		var $titulo;
		var $contenido;
		var $ancho;
		var $tbox;
		
		public function Post($pTitulo="Titulo", $pContenido="Contenido", $pAncho=550){
			$this->titulo = $pTitulo;
			$this->contenido = $pContenido;
			$this->ancho = $pAncho;
			$this->tbox = new ToolBox();
		}
		
		public function ToString(){
			return "
			<div id='Post' style='width: " . $this->ancho . "px;'>
    		<div id='PostTitle' style='width: " . ($this->ancho - 12) . "px;'>
				" . $this->tbox->ToString() . "<p id='innerTitle'>$this->titulo</p>
			</div>
			<div id='PostContent'>
			    <p id='innerContent'>
					$this->contenido
				</p>
			</div>
   		</div>
			
			";
		}
		
		public function Show(){
			echo($this->ToString());
		}
    }
	


	class InnerPost extends Post{
		
		public function ToString(){
			return "
			<div id='innerPost' style='width: " . $this->ancho . "px;'>
    		<div id='PostTitle' style='width: " . ($this->ancho - 4) . "px;'>
				"  . $this->tbox->ToString() . "<p id='innerTitle'>$this->titulo</p>
			</div>
			<div id='PostContent'>
			    <p id='innerContent'>
					$this->contenido
				</p>
			</div>
   		</div>
			
			";
		}
		
	}
	
	class InnerInnerPost extends InnerPost{
		
		public function ToString(){
			return "
			<div id='innerInnerPost' style='width: " . $this->ancho . "px;'>
    		<div id='PostTitle' style='width: " . ($this->ancho - 4) . "px;'>
				" . $this->tbox->ToString() . "<p id='innerTitle'>$this->titulo</p>
			</div>
			<div id='PostContent'>
			    <p id='innerContent'>
					$this->contenido
				</p>
			</div>
   		</div>
			
			";
		}
	}
?>
