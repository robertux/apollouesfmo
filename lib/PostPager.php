<?php

	/*!
	 * \brief Clase que se encarga de realizar la paginacion de registros en una tabla con el objetivo de mostrarlos en un Post.
	 * Tambien se encarga e mostrar la barra inferior en los posts donde muestra informacion del rango de registros que se muestran actualmente y los botones de Pagina Anterior y Pagina Siguiente
	 */
    class PostPager{
    	
		/*!
		 * La pagina en la que se encuentra actualmente
		 */
		var $currentPage;
		/*!
		 * La cantidad de registros a mostrar por cada pagina
		 */
		var $pageLen;
		/*!
		 * Instancia de la clase PostPagerButton, para el boton de Siguiente Pagina
		 */
		var $btnNext;
		/*!
		 * Instancia de la clase PostPagerButton, para el boton de Pagine Anterior
		 */
		var $btnPrev;
		/*!
		 * Representa al total de registros que se tienen
		 */
		var $totRegs;
		/*!
		 * Reprsenta el numero del primer registro del rango de la pagina actual
		 */
		var $iniReg;
		/*!
		 * Reprsenta el numero del ultimo registro del rango de la pagina actual
		 */
		var $finReg;
		/*!
		 * Representa una entidad (como las de la carpeta /clases) que permitira invocar sus metodos como GetLista() o GetListaFiltrada() para poder hacer la paginacion
		 */
		var $entidad;
		
		/*!
		 * Constructor. Crea una nueva instancia de la clase PostPager en base a los parametros recibidos y otros tomados por defecto
		 * \param $pEntidad El nombre de la tabla que se esta paginando
		 * \param $pPageLen La cantidad de registros a mostrar por pagina
		 */
		function PostPager($pEntidad, $pPageLen=5){
			$this->pageLen = $pPageLen;
			$this->currentPage = 0;
			$this->totRegs = 0;
			$this->btnNext = new PostPagerButton("Pagina Siguiente", "pgrNext");
			$this->btnPrev = new PostPagerButton("Pagina Anterior", "pgrPrev");
			$this->entidad = $pEntidad;
		}
		
		/*!
		 * Metodo que devuelve la lista filtrada de posts en base a la pagina actual y una posible condicion.
		 * A este resultado se le puede aplicar un fetch para mostrar los registros
		 * \param $page La pagina a mostrar
		 * \param $condicion Si existe alguna condicion para la paginacion. Ejemplo, en la seccion de Maestrias, estas pueden pertenecer a la subseccion de actuales o a la subseccion de proximas
		 */
		function GetPosts($page = -1, $condicion=""){
			$this->CalcRegs($page);
			return $this->entidad->GetListaFiltrada($this->iniReg-1, $this->pageLen, $condicion);
		}		
		
		/*!
		 * Genera una barra con informacion de los registros de la pagina actual y los botones de Pagina Anterior y Pagina Siguiente
		 * \param $condicion Condicio a aplicar si fuera necesario, al momento de generar la informacion de la pagina actual
		 */
		function ToString($condicion=""){
			//!Se calculan los datos del registro inicial y final de la pagina actual
			$this->CalcRegs(-1, $condicion);
			//!Se define que botones se van a mostrar en base al calculo anterior
			if($this->iniReg == 1)
				$this->btnPrev->enabled = false;
			if($this->finReg == $this->totRegs)
				$this->btnNext->enabled = false;
			
			//$path = $_SERVER['SCRIPT_NAME'];
			
			//$this->btnNext->url = $path . "?opt=news&page=" . ($this->currentPage + 1);
			//$this->btnPrev->url = $path . "?opt=news&page=" . ($this->currentPage - 1) ;
			$currentUser = "-1";
			if($_SESSION['CurrentUser'] != "")
				$currentUser = $_SESSION['CurrentUser'];
			
			if($condicion != "")
				$condicion = ", \"" . $condicion . "\"";
			//!Se definen los eventos Clic de los botones. Estas son llamadas a las funciones del archivo PostPager.js
			$this->btnPrev->onClick = "prevPage(\"" . $this->entidad->tabla . "\", " . $currentUser . $condicion . ")";
			$this->btnNext->onClick = "nextPage(\"" . $this->entidad->tabla . "\", " . $currentUser . $condicion . ")";
			
			//!Se genera el codigo HTML del postPager
			return "
				<div class='TextPager'>Mostrando registros del <div id='iniReg' class='bold'>$this->iniReg</div> al <div id='finReg' class='bold'>$this->finReg</div> de los <div id='totRegs' class='bold'>$this->totRegs</div> totales</div>
				<input id='currentPage' type='hidden' value='$this->currentPage' />
				<input id='totRegs' type='hidden' value='$this->totRegs' />
				<input id='pageLen' type='hidden' value='$this->pageLen' />
				<div class='ButtonPagerList'>" . $this->btnPrev->ToString() . $this->btnNext->ToString() . "</div>";
		}
		
		/*!
		 * Calcula los valores de registro inicial y final en base a la pagina actual, para que puedan ser mostrados en el postPager
		 * \param $page La pagina actual
		 * \param $condicion Condicion a aplicar para generar los registros
		 */
		function CalcRegs($page = -1, $condicion=""){
			if($page == -1){
				if(isset($_GET["page"]))
					$this->currentPage = $_GET["page"];
			}
			else
				$this->currentPage = $page;
				
			$this->totRegs = $this->GetTotalPosts($condicion);
			
			//!Se realizan los calculos de iniReg y finReg en base a la pagina actual y los registros a mostrar por pagina			
			$this->iniReg = ($this->currentPage * $this->pageLen) + 1;
			$this->finReg = ($this->currentPage * $this->pageLen) + $this->pageLen;
			if($this->finReg > $this->totRegs) 
				$this->finReg = $this->totRegs;
		}
		
		/*!
		 * Devuelve la cantidad total de registros que posee una tabla;
		 */
		function GetTotalPosts($condicion=""){
			$res = $this->entidad->GetLista($condicion);
			return $res->num_rows;
		}
    }
	
	
	/*-----------------------------------------------------------------------------------------------------*/

	/*!
	 * \brief Boton utilizado en el PostPager con el objetivo de moverse entre las paginas
	 */
	class PostPagerButton{
		
		/*!
		 * Titulo del boton
		 */
		var $title;
		/*!
		 * Clase CSS que utiliza el boton
		 */
		var $class;
		/*!
		 * Accion que realizara el boton cuando hagan clic sobre el
		 */
		var $onClick;
		/*!
		 * Valor boleano que definira si este boton estara visible o no
		 */
		var $enabled;
		
		/*!
		 * Constructor. Inicializa sus valores en base a los parametros recibidos
		 * \param $pTitle Titulo del boton
		 * \param $pClass Clase CSS que utilizara el boton
		 */
		function PostPagerButton($pTitle, $pClass){
			$this->title = $pTitle;
			$this->class = $pClass;
			$this->enabled = true;
		}
		
		/*!
		 * Genera y devuelve el codigo HTML que representa al boton
		 */
		function ToString(){
			$display = "none";
			if($this->enabled)
				$display = "inline";
				
			return "
				<a class='btn-$this->class' onClick='$this->onClick' style='display: $display'>
					<div class='txt-$this->class'>
						$this->title
					</div>
					<div class='img-$this->class'>
					</div>
				</a>
				";
		}
	}
?>
