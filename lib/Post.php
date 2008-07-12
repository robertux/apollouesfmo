<?php
    class Post{
    	
		var $id;
		var $tabla;
		var $titulo;
		var $fecha;
		var $contenido;
		var $ancho;
		var $tbox;
		var $showAddWhenAdmin;
		var $showEditWhenAdmin;
		var $showDelWhenAdmin;
		
		public function Post($pTitulo="Titulo", $pContenido="Contenido", $pAncho=550, $pShowAddWhenAdmin=false, $pShowEditWhenAdmin=false, $pShowDelWhenAdmin=false){
			$this->id = $pId;
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
				
				$this->tbox->btnEdit->onClick = "EditPost('$this->titulo')";
				$this->tbox->btnAdd->id = "add-$this->titulo";
				$this->tbox->btnAdd->onClick = "AddPost('$this->titulo', '$this->tabla')";
				$this->tbox->btnEdit->id = "edit-$this->titulo";
				$this->tbox->btnDel->id = "del-$this->titulo";
				$this->tbox->btnDel->onClick = "DelPost('$this->titulo')";
				$this->tbox->btnSave->id = "sav-$this->titulo";
				$this->tbox->btnSave->onClick = "SavePost('$this->titulo')";
				$this->tbox->btnCancel->id = "can-$this->titulo";
				$this->tbox->btnCancel->onClick = "CancelPost('$this->titulo')";

			return "
			<div id='pst-$this->titulo' class='Post' style='width: " . $this->ancho . "px;' >
	    		<div class='PostTitle' style='width: " . ($this->ancho - 12) . "px;'>
					" . $this->tbox->ToString() . "<div id='fch-$this->titulo' class='PostDate'>$this->fecha</div><input type='text' id='txt-$this->titulo' class='innerTitle' value='$this->titulo' disabled='true' />
				</div>
				<div id='cont-$this->titulo' class='PostContent'>
				    <div id='area-$this->titulo' class='innerContent'>
						$this->contenido
					</div>					
				</div>
				<input type='hidden' id='tmp-$this->titulo' value=''/>
				<input type='hidden' id='id-$this->titulo' value='$this->id'/>
				<input type='hidden' id='tbl-$this->titulo' value='$this->tabla'/>
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
			
				$this->tbox->btnEdit->onClick = "EditPost('$this->titulo')";
				$this->tbox->btnAdd->id = "add-$this->titulo";
				$this->tbox->btnAdd->onClick = "AddPost('$this->titulo', '$this->tabla')";
				$this->tbox->btnEdit->id = "edit-$this->titulo";
				$this->tbox->btnDel->id = "del-$this->titulo";
				$this->tbox->btnDel->onClick = "DelPost('$this->titulo')";		
				$this->tbox->btnSave->id = "sav-$this->titulo";
				$this->tbox->btnSave->onClick = "SavePost('$this->titulo')";
				$this->tbox->btnCancel->id = "can-$this->titulo";
				$this->tbox->btnCancel->onClick = "CancelPost('$this->titulo')";
			
			return "
			<div id='pst-$this->titulo' class='innerPost' style='width: " . $this->ancho . "px;'>
    		<div class='PostTitle' style='width: " . ($this->ancho - 4) . "px;'>
				"  . $this->tbox->ToString() . "<div id='fch-$this->titulo' class='PostDate'>$this->fecha</div><input type='text' id='txt-$this->titulo' class='innerTitle' value='$this->titulo' disabled='true' />
			</div>
			<div id='cont-$this->titulo' class='PostContent'>
			    <div id='area-$this->titulo' class='innerContent'>
					$this->contenido
				</div>
				<input type='hidden' id='tmp-$this->titulo' value=''/>
				<input type='hidden' id='id-$this->titulo' value='$this->id'/>
				<input type='hidden' id='tbl-$this->titulo' value='$this->tabla'/>
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
			
				$this->tbox->btnEdit->onClick = "EditPost('$this->titulo')";
				$this->tbox->btnAdd->id = "add-$this->titulo";
				$this->tbox->btnEdit->id = "edit-$this->titulo";
				$this->tbox->btnDel->id = "del-$this->titulo";
				$this->tbox->btnDel->onClick = "DelPost('$this->titulo')";		
				$this->tbox->btnSave->id = "sav-$this->titulo";
				$this->tbox->btnSave->onClick = "SavePost('$this->titulo')";
				$this->tbox->btnCancel->id = "can-$this->titulo";
				$this->tbox->btnCancel->onClick = "CancelPost('$this->titulo')";
			
			return "
			<div id='pst-$this->titulo' class='innerInnerPost' style='width: " . $this->ancho . "px;'>
    		<div class='PostTitle' style='width: " . ($this->ancho - 4) . "px;'>
				" . $this->tbox->ToString() . "<div id='fch-$this->titulo' class='PostDate'>$this->fecha</div><input type='text' id='txt-$this->titulo' class='innerTitle' value='$this->titulo' disabled='true' />
			</div>
			<div id='cont-$this->titulo' class='PostContent'>
			    <div id='area-$this->titulo' class='innerContent'>
					$this->contenido
				</div>
				<input type='hidden' id='tmp-$this->titulo' value=''/>
				<input type='hidden' id='id-$this->titulo' value='$this->id'/>
				<input type='hidden' id='tbl-$this->titulo' value='$this->tabla'/>
			</div>
   		</div>
			
			";
		}
	}
?>
