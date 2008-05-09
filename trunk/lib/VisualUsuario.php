<?php
	
	include_once("Usuario.php");

    class VisualUsuario{
    	var $usr;
		
		function Show(){
			if(isset($_GET["action"])){
				if($_GET["action"] == "login"){				
					//if($this->LoadUser($_POST["txtNombre"], $_POST["txtClave"]))
						$this->ShowUserInfo();
					//else
	                    //$this->ShowLoginBox("Nombre de usuario y/o clave invalidos");
				}
				else
					$this->ShowLoginBox("");
			}
			else
				$this->ShowLoginBox("");
			
		}
		
		function LoadUser($usrName, $usrClave){
			
		}
		
		function ShowUserInfo(){
			echo("
			<form id='frmLogout' action='index.php?action=logout' method='POST' accept-charset='utf-8'>				
				<p>
					<div class='LoginBoxFrame'>
						<label for='btnSubmit' class='lblInput'>Bienvenido Usuario Roberto Linares</label>
						<input type='submit' id='btnSubmit' value='Cerrar Sesion' class='btnSubmit'/>					
					</div>
				</p>
			</form>
			");
		}
		
		function ShowLoginBox($errorMsg){
			echo("
			<form id='frmLogin' action='index.php?action=login' method='POST' accept-charset='utf-8'>
						<p>
							<div class='LoginBoxFrame'>
								<label for='txtNombre' class='lblInput'>usuario: </label>
								<input type='text' id='txtNombre' name='txtNombre' class='txtInput'/>
								<label for='txtClave' class='lblInput'>clave: </label>
								<input type='password' id='txtClave' name='txtClave' class='txtInput' />
								<input type='submit' id='btnSubmit' value='Iniciar Sesion' class='btnSubmit'/>
						");
            if($errorMsg != "")
                echo("<input type='label' class='errorMsg' value='$errorMsg' />");                    
             echo("</div></p></form>");
		}
    }		
?>
