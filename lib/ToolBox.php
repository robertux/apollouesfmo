<?php
	//Caja de controles que muestra los botones de agregar/editar/eliminar/guardar/cancelar en los titulos de los posts
    class ToolBox{

		public $btnAdd;
		public $btnEdit;
		public $btnDel;
		public $btnSave;
		public $btnCancel;
		
		//Constructor
		public function ToolBox($addEnabled=false, $editEnabled=false, $delEnabled=false){
			$this->btnAdd = new ToolBoxButton("add", $addEnabled);
			$this->btnEdit = new ToolBoxButton("edit", $editEnabled);
			$this->btnDel = new ToolBoxButton("del", $delEnabled);
			$this->btnSave = new ToolBoxButton("sav", true);
			$this->btnCancel = new ToolBoxButton("can", true);
		}
    	
		//Imprime el control en la pagina
		public function Show(){
			echo($this->ToString());
		}
		
		//Genera y devuelve la representacion HTML del control
		public function ToString(){
			return "
				<div class='toolbox'>
					" . $this->btnAdd->ToString() . $this->btnEdit->ToString() . $this->btnDel->ToString() . $this->btnSave->ToString() . $this->btnCancel->ToString() . "
				</div>
			";
		}
    }
	
	//Boton utilizado en un ToolBox
	class ToolBoxButton{
		
		public $id;
		public $class;
		public $title;
		public $imgURL;
		public $onClick;
		public $enabled;
		
		//Constructor
		public function ToolBoxButton($pClass="add", $pEnabled=false, $pOnClick="#"){
			$this->class = $pClass;
			$this->id = $this->class;
			switch($pClass){
				case "add": $this->title = "agregar";	break;
				case "edit": $this->title = "editar";	break;
				case "del": $this->title = "eliminar";	break;
				case "sav": $this->title = "guardar";	break;
				case "can": $this->title = "cancelar";	break;
			}			
			$this->enabled = $pEnabled;
			$this->onClick = $pOnClick;
		}
		
		//Imprime el control en la pagina
		public function Show(){
			echo($this->ToString());
		}
		
		//Genera y devuelve el HTML que representa al control
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
