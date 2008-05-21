<?php
    class Post{
    	
		var $titulo;
		var $contenido;
		
		public function Post($pTitulo="Titulo", $pContenido="Contenido"){
			$this->titulo = $pTitulo;
			$this->contenido = $pContenido;
		}
		
		public function Show(){
			echo("
			<div id='Post'>
    		<div id='PostTitle'><p id='innerTitle'>$this->titulo</p></div>
			<div id='PostContent'>
			    <p id='innerContent'>
					$this->contenido
				</p>
			</div>
   		</div>
			
			");
		}
    }
?>
