<?php
include(RUTA."/clases/cnovedades.php");

class Widget{
		public $Contenido; //protected
		
		public $Titulo;
		public $masURL;
		public $claseCSS;
		
		public function Widget($pTitulo="Esta es una Seccion", $pMasLink="http://url.com", $pContenido,$pClaseCSS){
			$this->Titulo = $pTitulo;
			$this->Contenido = $pContenido;
			$this->claseCSS = $pClaseCSS;
			$this->masURL = $pMasLink;
		}
		
		public function Show($pContenido = ""){
			echo("<div class='$this->claseCSS'>
				<div class='WidgetTitle'><a id='TitleBlock' href='$this->masURL'><div id='TitleText'>$this->Titulo</div></a></div>
				<div class='WidgetContent'>");
				if ($pContenido=="") {
					echo "<p>$this->Contenido</p>";
				}
				else
					echo "<p>$pContenido</p>";
			echo("</div><div class='footer'><a href='$this->masURL'>Ver m&aacute;s...</a></div></div>");
		}
	}

class WidgetNovedades extends Widget{
		
	private $novedades;
	
	public function __construct() 
    {
		$this->novedades = new cNovedades();
		$this->Contenido = "<div class='WidgetContent'><ul>";
		$this->Llenar();		
    }
    
    private function Llenar()
    {
    	$resultado = $this->novedades->GetParaWidget(5);
    	while($row = $resultado->fetch_array())
        {
        	//titulo, vinculo //$t = $row[0]; //$v = $row[1];
        	$this->Contenido .= "<li>$row[0]</li>";
        }
		$resultado->close();
        $this->Contenido .= "</ul></div>";
    }
		
	public function Show(){
		echo("
		<div class='$this->claseCSS'>
		<div class='WidgetTitle'><a id='TitleBlock' href='$this->masURL'><div id='TitleText'>$this->Titulo</div></a></div>
			$this->Contenido
			<div class='footer'><a href='$this->masURL'>Ver m&aacute;s...</a></div>
		</div>
		");
	}
}
?>