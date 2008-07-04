<?php
    class Post{
    	
		var $titulo;
		var $contenido;
		var $ancho;
		var $tbox;
		var $showAddWhenAdmin;
		var $showEditWhenAdmin;
		var $showDelWhenAdmin;
		
		public function Post($pTitulo="Titulo", $pContenido="Contenido", $pAncho=550, $pShowAddWhenAdmin=false, $pShowEditWhenAdmin=false, $pShowDelWhenAdmin=false){
			$this->titulo = $pTitulo;
			$this->contenido = $pContenido;
			$this->ancho = $pAncho;
			$this->tbox = new ToolBox();
		 	$this->showAddWhenAdmin = $pShowAddWhenAdmin;			
		 	$this->showEditWhenAdmin = $pShowEditWhenAdmin;
			$this->showDelWhenAdmin = $pShowDelWhenAdmin;
		}
		
		public function ToString(){

				$myUser = new cusuario();
				$myUser->GetPorId($_SESSION["CurrentUser"]);
				if($myUser->privilegio == "admin"){
					if($this->showAddWhenAdmin)
						$this->tbox->btnAdd->enabled = true;
					if($this->showEditWhenAdmin)
						$this->tbox->btnEdit->enabled = true;
					if($this->showDelWhenAdmin)
						$this->tbox->btnDel->enabled = true;
				}
				
				$this->tbox->btnEdit->onClick = "EditText('$this->titulo')";
				$this->tbox->btnAdd->id = "add-$this->titulo";
				$this->tbox->btnEdit->id = "edit-$this->titulo";
				$this->tbox->btnDel->id = "del-$this->titulo";				
				$this->tbox->btnSave->id = "sav-$this->titulo";
				$this->tbox->btnSave->onClick = "SaveText('$this->titulo')";
				$this->tbox->btnCancel->id = "can-$this->titulo";
				$this->tbox->btnCancel->onClick = "CancelText('$this->titulo')";

			return "
			<div class='Post' style='width: " . $this->ancho . "px;' >
    		<div class='PostTitle' style='width: " . ($this->ancho - 12) . "px;'>
				" . $this->tbox->ToString() . "<input type='text' id='txt-$this->titulo' class='innerTitle' value='$this->titulo' disabled='true' />
			</div>
			<div id='cont-$this->titulo' class='PostContent'>
			    <div id='area-$this->titulo' class='innerContent'>
					$this->contenido
				</div>
				
			</div>
   		</div>
			
			";
		}
		
		public function Show(){
			echo($this->ToString());
		}
    }
	


	class InnerPost extends Post{
		
		public function ToString(){
			
			$myUser = new cusuario();
			$myUser->GetPorId($_SESSION["CurrentUser"]);
			if($myUser->privilegio == "admin"){
				if($this->showAddWhenAdmin)
					$this->tbox->btnAdd->enabled = true;
				if($this->showEditWhenAdmin)
					$this->tbox->btnEdit->enabled = true;
				if($this->showDelWhenAdmin)
					$this->tbox->btnDel->enabled = true;
			}						
			
				$this->tbox->btnEdit->onClick = "EditText('$this->titulo')";
				$this->tbox->btnAdd->id = "add-$this->titulo";
				$this->tbox->btnEdit->id = "edit-$this->titulo";
				$this->tbox->btnDel->id = "del-$this->titulo";				
				$this->tbox->btnSave->id = "sav-$this->titulo";
				$this->tbox->btnSave->onClick = "SaveText('$this->titulo')";
				$this->tbox->btnCancel->id = "can-$this->titulo";
				$this->tbox->btnCancel->onClick = "CancelText('$this->titulo')";
			
			return "
			<div class='innerPost' style='width: " . $this->ancho . "px;'>
    		<div class='PostTitle' style='width: " . ($this->ancho - 4) . "px;'>
				"  . $this->tbox->ToString() . "<input type='text' id='txt-$this->titulo' class='innerTitle' value='$this->titulo' disabled='true' />
			</div>
			<div id='cont-$this->titulo' class='PostContent'>
			    <div id='area-$this->titulo' class='innerContent'>
					$this->contenido
				</div>
			</div>
   		</div>
			
			";
		}
		
	}
	
	class InnerInnerPost extends InnerPost{
		
		public function ToString(){
			
			$myUser = new cusuario();
			$myUser->GetPorId($_SESSION["CurrentUser"]);
			if($myUser->privilegio == "admin"){
				if($this->showAddWhenAdmin)
					$this->tbox->btnAdd->enabled = true;
				if($this->showEditWhenAdmin)
					$this->tbox->btnEdit->enabled = true;
				if($this->showDelWhenAdmin)
					$this->tbox->btnDel->enabled = true;
			}
			
				$this->tbox->btnEdit->onClick = "EditText('$this->titulo')";
				$this->tbox->btnAdd->id = "add-$this->titulo";
				$this->tbox->btnEdit->id = "edit-$this->titulo";
				$this->tbox->btnDel->id = "del-$this->titulo";				
				$this->tbox->btnSave->id = "sav-$this->titulo";
				$this->tbox->btnSave->onClick = "SaveText('$this->titulo')";
				$this->tbox->btnCancel->id = "can-$this->titulo";
				$this->tbox->btnCancel->onClick = "CancelText('$this->titulo')";
			
			return "
			<div class='innerInnerPost' style='width: " . $this->ancho . "px;'>
    		<div class='PostTitle' style='width: " . ($this->ancho - 4) . "px;'>
				" . $this->tbox->ToString() . "<input type='text' id='txt-$this->titulo' class='innerTitle' value='$this->titulo' disabled='true' />
			</div>
			<div id='cont-$this->titulo' class='PostContent'>
			    <div id='area-$this->titulo' class='innerContent'>
					$this->contenido
				</div>
			</div>
   		</div>
			
			";
		}
	}
?>
