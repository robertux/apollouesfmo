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
				
				//$this->tbox->btnEdit->onClick="tinyMCE.execCommand('mceRemoveControl', false, 'foobar');";

			return "
			<div id='Post' style='width: " . $this->ancho . "px;' >
    		<div id='PostTitle' style='width: " . ($this->ancho - 12) . "px;'>
				" . $this->tbox->ToString() . "<input type='text' class='innerTitle' value='$this->titulo' />
			</div>
			<div class='PostContent'>
			    <div id='foobar' class='innerContent' disabled='true' cols='80' rows='0' visible='false'>
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
			
			return "
			<div id='innerPost' style='width: " . $this->ancho . "px;'>
    		<div id='PostTitle' style='width: " . ($this->ancho - 4) . "px;'>
				"  . $this->tbox->ToString() . "<p id='innerTitle'>$this->titulo</p>
			</div>
			<div id='PostContent'>
			    <p id='innerContent'>
					$this->contenido
				</p>
			</div>
   		</div>
			
			";
		}
		
	}
	
	class InnerInnerPost extends InnerPost{
		
		public function ToString(){
			return "
			<div id='innerInnerPost' style='width: " . $this->ancho . "px;'>
    		<div id='PostTitle' style='width: " . ($this->ancho - 4) . "px;'>
				" . $this->tbox->ToString() . "<p id='innerTitle'>$this->titulo</p>
			</div>
			<div id='PostContent'>
			    <p id='innerContent'>
					$this->contenido
				</p>
			</div>
   		</div>
			
			";
		}
	}
?>
