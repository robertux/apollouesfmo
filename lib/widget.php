<?php

/*!
 * Inclusiones de archivos necesarios
 */
include(RUTA."/clases/cnovedades.php");
include(RUTA."/clases/cforo.php");

/*!
 * \brief Clase que representa un widget, la forma de mostrar la informacion en la pagina principal
 * Este contiene un titulo, un contenido y un vinculo a "Mas Informacion"
 */
class Widget{
		/*!
		 * Contenido del widget
		 */
		public $Contenido; //protected, era antes lol.
		/*!
		 * Titulo del widget
		 */
		public $Titulo;
		/*!
		 * URL del widget, que apunta a la pagina con mas informacion
		 */
		public $masURL;
		/*!
		 * Clase CSS que utilizara el widget
		 */
		public $claseCSS;
		
		/*!
		 * Constructor. Inicializa sus miembros en base a los parametros recibidos
		 * \param $pTitulo Titulo del widget
		 * \param $pMasLink URL a la pagina de Mas Informacion
		 * \param $pContenido Contenido del widget
		 */
		public function Widget($pTitulo="Esta es una Seccion", $pMasLink="http://url.com", $pContenido,$pClaseCSS){
			$this->Titulo = $pTitulo;
			$this->Contenido = $pContenido;
			$this->claseCSS = $pClaseCSS;
			$this->masURL = $pMasLink;
		}
		
		/*!
		 * Genera e imprime el HTML que representa al widget en base a los valores de sus campos
		 */
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

/*!
 * \brief Clase que muestra las ultimas novedades de la unidad
 */
class WidgetNovedades extends Widget{
	
	/*!
	 * Entidad que representa las novedades
	 */
	private $novedades;
	
	/*!
	 * Constructor. Inicializa los valores del widget
	 */	
	public function __construct() 
    {
		$this->novedades = new cNovedades();
		$this->Contenido = "<div class='WidgetContent'><ul>";
		$this->Llenar();		
    }
    
	/*!
	 * Rellena automaticamente su contenido con la informacion de las novedades de la base de datos
	 */
    private function Llenar()
    {
    	$resultado = $this->novedades->GetParaWidget(5);
		if($resultado->num_rows > 0){
			while($row = $resultado->fetch_array())
	        {
	        	//titulo, vinculo //$t = $row[0]; //$v = $row[1];
	        	$this->Contenido .= "<li>" . (strlen($row[0])>35? substr($row[0],0,38) . "...": $row[0]) . "</li>";
	        }
			$resultado->close();
		}
    	else
			$this->Contenido -= "No hay novedades.";
        $this->Contenido .= "</ul></div>";
    }
		
	/*!
	 * Genera e imprime el codigo HTML que representa a este widget
	 */
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

/*!
 * \brief Clase que muestra los ultimos posts del foro de la unidad
 */
class WidgetForo extends Widget{
		
	private $foro;
	
	public function __construct() 
    {
		$this->foro = new cForo();
		$this->Contenido = "<div class='WidgetContent'><ul>";
		$this->Llenar();		
    }
    
    private function Llenar()
    {
    	$resultado = $this->foro->GetListaPosts();
    	$foo = 1;
		
		if($resultado->num_rows >0){
	    	while($row = $resultado->fetch_array()){
	        	//titulo, vinculo //$t = $row[0]; //$v = $row[1];
	        	$this->Contenido .= "<li>$row[1]: $row[0]</li>";
	        	$foo++;
	        	if ($foo==5) break;
	        }
			$resultado->close();
		}
		else
			$this->Contenido .= "No hay novedades.";
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


/*!
 * \brief Clase que muestra los cursos actuales y proximos en la unidad
 */
class WidgetCursos extends Widget{
		
	private $cursos;
	
	public function __construct() 
    {
		$this->cursos = new cPostgrado();
		$this->Contenido = "<div class='WidgetContent'><ul>";
		$this->Llenar();		
    }
    
    private function Llenar()
    {
    	$resultado = $this->cursos->GetLista();
		$foo = 1;
		
		if($resultado->num_rows > 0){
	    	while($row = $resultado->fetch_array())
	        {
	        	//titulo, vinculo //$t = $row[0]; //$v = $row[1];
	        	$this->Contenido .= "<li>" . (strlen($row[1])>35? substr($row[1],0,38) . "...": $row[1]) . "</li>";
				$foo++;
				if($foo == 5) break;
	        }
			$resultado->close();
		}
		else
			$this->Contenido .= "No hay cursos";
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

/*!
 * \brief Clase que muestra la informacion acerca de la unidad de postgrados
 */
class WidgetAbout extends Widget{
		
	private $about;
	
	public function __construct() 
    {
    	$this->about = new cGeneral();
		$this->about->GetPorTitulo("about");
		$this->Contenido = "<div class='WidgetContent'> " . substr($this->about->contenido,0,250) . "..." .  "</div>";
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