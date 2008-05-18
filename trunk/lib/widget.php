<?php
include(RUTA."clases/cnovedades.php");

class Widget{
		
	private $novedades;
	private $contenido;
	
	public $Titulo;
	public $masURL;
	public $claseCSS;
	
	public function __construct() 
    {
		$this->novedades = new cNovedades();
		$this->contenido = "<div class='WidgetContent'><ul>";
		$this->Poblar();		
    }
    
    function Poblar()
    {
    	$resultado = $this->novedades->GetParaWidget(5);
    	while($row = $resultado->fetch_array())
        {
        	//titulo, vinculo
        	//$t = $row[0];
        	//$v = $row[1];
        	$this->contenido .= "<li><a href='$row[1]'>$row[0]</a></li>";
        }
		$resultado->close();
        $this->contenido .= "</ul></div>";
    }

		
	function Show(){
		echo("
		<div class='$this->claseCSS'>
		<div class='WidgetTitle'><a id='TitleText' href='$this->masURL'>$this->Titulo</a></div>
			$this->contenido
			<div class='footer'><a href='$this->masURL'>Ver m&aacute;s...</a></div>
		</div>
		");
	}
}
?>