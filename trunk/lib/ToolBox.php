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
		
		public $id;
		public $title;
		public $imgURL;
		public $onClick;
		public $enabled;
		
		public function ToolBoxButton($pId="add", $pEnabled=false, $pOnClick="#"){
			$this->id = $pId;
			switch($pNombre){
				case "add": $this->title = "agregar";	break;
				case "edit": $this->title = "editar";	break;
				case "del": $this->title = "eliminar";	break;
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
					<input type='button' title='$this->title' id='$this->id' onClick='$this->onClick' />
				";
			else
				return "";
		}
	}
?>
