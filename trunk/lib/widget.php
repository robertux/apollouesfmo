<?php
	class Widget{
		
		var $titulo;
		var $contenido;
		var $clase;
		var $masTexto;
		var $masLink;
		
		function Widget($pTitulo="WidgetTitle", $pContenido="WidgetContent", $pClase, $pMasTexto="", $pMasLink=""){
			$this->titulo = $pTitulo;
			$this->contenido = $pContenido;
			$this->clase = $pClase;
			$this->masTexto = $pMasTexto;
			$this->masLink = $pMasLink;
		}
		
		function Show(){
			echo("
			<div class='$this->clase'>
				<div class='WidgetTitle'>$this->titulo</div>
				<div class='WidgetContent'>
					<p>$this->contenido</p>
				</div>
				<div class='footer'><a href='$this->masLink'>$this->masTexto</a></div>
			</div>
			");
		}
	}
?>
