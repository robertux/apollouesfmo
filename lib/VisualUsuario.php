<?php
	
	//include_once("Usuario.php");
	define("RUTA", realpath("../"));
	require_once(RUTA."/clases/cusuario.php");

    class VisualUsuario{
    	var $usr;
		
		function VisualUsuario(){
			$usr = new cUsuario();
		}
		
		//Muestra el loginBox, en base a una accion (login/logout) y a las variables de sesion
		function Show(){ 
						
			if(isset($_GET["action"])){ //el usuario desea hacer alguna accion con el login?
				if($_GET["action"] == "login"){ //la acicon a realizar es login?
					if($this->LoadUser($_POST["txtNombre"], $_POST["txtClave"])){  //el nombre y clave de usuario coincidio con un registro en la bd?
						$this->ShowUserInfo();						//Muestra al usuario encontrado!!!
						$_SESSION["CurrentUser"] = $this->usr->id;	//Registra la nueva variable de sesion!
					}
					else{
						$this->ShowLoginBox("Nombre de usuario y/o clave invalidos");	//Caso contrario, muestra un mensaje de error
						$_SESSION["CurrentUser"] = "";								//Quita el registro de la sesion!!!
					}
				}
				else{ //el usuario desea desloguearse?
					$this->ShowLoginBox("");			//Muestra el loginbox
					$_SESSION["CurrentUser"] = "";		//Quita registros existentes en la sesion!!!
				}
			}
			else{
				if($_SESSION["CurrentUser"] != ""){ //existe algun usuario registrado en la sesion?
					if($this->LoadUserById($_SESSION["CurrentUser"])){
						$this->ShowUserInfo();
					}
				}
				else
					$this->ShowLoginBox("");
			}							
		}

		//Verifica si el usuario y clave pasados coinciden con un registro en la bd
		function LoadUser($usrName, $usrClave){			
			$this->usr = new cUsuario();
			$claveEncriptada = sha1($usrClave);
			if($this->usr->GetPorNombreClave($usrName, $claveEncriptada)){				
				return true;
			}
			return false;
			
		}
		
		function loadUserById($pId){
			$this->usr = new cUsuario();
			if($this->usr->GetPorId($pId)){		
				return true;
			}
			return false;
		}
		
		//Muestra un mensaje de bienvenida con el nombre del usuario logueado mas el boton para desloguearse
		function ShowUserInfo(){
			echo("
			<form id='frmLogout' action='index.php?action=logout' method='POST' accept-charset='utf-8'>				
				<p>
					<div class='LoginBoxFrame'>
						<div class='LoginBoxInnerFrame'>
							<label for='btnSubmit' class='lblInput'>Bienvenido <b>" . $this->usr->nombre . " [" . $this->usr->privilegio . "]</b></label>
							<input type='submit' id='btnSubmit' value='Cerrar Sesion' class='btnSubmit'/>
						</div>
					</div>
				</p>
			</form>
			");
		}
		
		//Muestra el cuadro de login con sus textbox y boton submit. Alternativamente puede mostrar un mensaje de error
		function ShowLoginBox($errorMsg){
			echo("
			<form id='frmLogin' action='index.php?action=login' method='POST' accept-charset='utf-8'>
						<p>
							<div class='LoginBoxFrame'>
								<div class='LoginBoxInnerFrame'>
									<label for='txtNombre' class='lblInput'>usuario: </label>
									<input type='text' id='txtNombre' name='txtNombre' class='txtInput'/>
									<label for='txtClave' class='lblInput'>clave: </label>
									<input type='password' id='txtClave' name='txtClave' class='txtInput' />
									<input type='submit' id='btnSubmit' value='Iniciar Sesion' class='btnSubmit'/>
						");
            if($errorMsg != "")
                echo("<input type='label' class='errorMsg' value='$errorMsg' />");                    
             echo("</div></div></p></form>");
		}
    }		
?>
