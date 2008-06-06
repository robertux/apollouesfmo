<?php
    class ToolBox{

		public $btnAdd;
		public $btnEdit;
		public $btnDel;
		
		public function ToolBox($addEnabled=false, $editEnabled=false, $delEnabled=false){
			$this->btnAdd = new ToolBoxButton("add", $addEnabled);
			$this->btnEdit = new ToolBoxButton("edit", $editEnabled);
			$this->btnDel = new ToolBoxButton("del", $delEnabled);
		}
    	
		public function Show(){
			echo($this->ToString());
		}
		
		public function ToString(){
			return "
				<div id='toolbox'>
					" . $this->btnAdd->ToString() . $this->btnEdit->ToString() . $this->btnDel->ToString() . "
				</div>
			";
		}
    }
	
	class ToolBoxButton{
		
		public $alt;
		public $title;
		public $imgURL;
		public $onClick;
		public $enabled;
		
		public function ToolBoxButton($pNombre="add", $pEnabled=false, $pOnClick="#"){
			$this->alt = $pNombre;
			switch($pNombre){
				case "add": $this->title = "agregar";	break;
				case "edit": $this->title = "editar";	break;
				case "del": $this->title = "eliminar";		break;
			}			
			$this->enabled = $pEnabled;
			$this->onClick = $pOnClick;
		}
		
		public function Show(){
			echo($this->ToString());
		}
		
		public function ToString(){
			if($this->enabled)
				/*return"
					<a href='$this->targetURL'><img src='$this->imgURL' alt='$this->alt' /></a>
				";*/
				return"
					<input type='button' title='$this->title' id='$this->alt' onClick='$this->onClick' />
				";
			else
				return "";
		}
	}
?>
