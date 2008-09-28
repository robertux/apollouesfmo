<?php
	/*!
	 * Clase que representa a una caja de controles que muestra los botones de agregar/editar/eliminar/guardar/cancelar en los titulos de los posts
	 */
    class ToolBox{
		/*!
		 * Objeto ToolBoxbutton que representa al boton Agregar
		 */
		public $btnAdd;
		/*!
		 * Objeto ToolBoxbutton que representa al boton Editar
		 */
		public $btnEdit;
		/*!
		 * Objeto ToolBoxbutton que representa al boton Eliminar
		 */
		public $btnDel;
		/*!
		 * Objeto ToolBoxbutton que representa al boton Guardar
		 */
		public $btnSave;
		/*!
		 * Objeto ToolBoxbutton que representa al boton Cancelar
		 */
		public $btnCancel;
		/*!
		 * Objeto ToolBoxbutton que representa al boton Ayuda
		 */
		public $btnHelp;
		
		/*!
		 * Constructor. Inicializa sus campos
		 * \param $addEnabled Define si estara visible el boton de agregar
		 * \param $editEnabled Define si estara visible el boton de editar
		 * \param $delEnabled Define si estara visible el boton de eliminar
		 */
		public function ToolBox($addEnabled=false, $editEnabled=false, $delEnabled=false, $helpEnabled=false){
			$this->btnAdd = new ToolBoxButton("add", $addEnabled);
			$this->btnEdit = new ToolBoxButton("edit", $editEnabled);
			$this->btnDel = new ToolBoxButton("del", $delEnabled);
			$this->btnSave = new ToolBoxButton("sav", true);
			$this->btnCancel = new ToolBoxButton("can", true);
			$this->btnHelp = new ToolBoxButton("hlp", $helpEnabled);
		}
    	
		/*!
		 * Metodo que imprime el control en la pagina
		 */
		public function Show(){
			echo($this->ToString());
		}
		
		/*!
		 * Metodo que genera y devuelve la representacion HTML del control
		 */
		public function ToString(){
			return "
				<div class='toolbox'>
					" . $this->btnAdd->ToString() . $this->btnEdit->ToString() . $this->btnDel->ToString() . $this->btnSave->ToString() . $this->btnCancel->ToString() . $this->btnHelp->ToString() . "
				</div>
			";
		}
    }
	
	/*!
	 * Clase que representa a un boton utilizado en un ToolBox
	 */
	class ToolBoxButton{
		
		/*!
		 * Id del boton
		 */
		public $id;
		/*!
		 * Clase CSS que implementa el boton
		 */
		public $class;
		/*!
		 * Titulo del boton (para mostrarlo en la etiqueta ALT)
		 */
		public $title;
		/*!
		 * URL de la imagen que representa al boton
		 */
		public $imgURL;
		/*!
		 * Accion que realizara el boton cuando hagan clic sobre el
		 */
		public $onClick;
		/*!
		 * Valor booleano que define si el boton estara visible o no
		 */
		public $enabled;
		
		/*!
		 * Constructor. Inicializa sus campos
		 * \param $pClass Clase CSS que utilizara el boton
		 * \param $pEnabled Valor que define si el boton estara inicialmente visible o no
		 * \param $pOnClick Define cual sera la accion del boton cuando hagan clic sobre el
		 */
		public function ToolBoxButton($pClass="add", $pEnabled=false, $pOnClick="#"){
			$this->class = $pClass;
			$this->id = $this->class;
			switch($pClass){
				case "add": $this->title = "agregar";	break;
				case "edit": $this->title = "editar";	break;
				case "del": $this->title = "eliminar";	break;
				case "sav": $this->title = "guardar";	break;
				case "can": $this->title = "cancelar";	break;
				case "hlp": $this->title = "ayuda"; break;
			}			
			$this->enabled = $pEnabled;
			$this->onClick = $pOnClick;
		}
		
		/*!
		 * Metodo que imprime el control en la pagina
		 */
		public function Show(){
			echo($this->ToString());
		}
		
		/*!
		 * Metodo que genera y devuelve el HTML que representa al control
		 */
		public function ToString(){
			if($this->enabled)
				/*return"
					<a href='$this->targetURL'><img src='$this->imgURL' alt='$this->alt' /></a>
				";*/
				return"
					<input type='button' id='$this->id' title='$this->title' class='$this->class' onClick=\"$this->onClick\" />
				";
			else
				return "";
		}
	}
?>
