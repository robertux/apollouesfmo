<?php
	
	include_once("Usuario.php");

    class VisualUsuario{
    	var $usr;
		
		function Show(){
			if(isset($_GET["action"])){
				if($_GET["action"] == "login"){				
					if($this->LoadUser($_POST["txtNombre"], $_POST["txtClave"]))
						$this->ShowUserInfo();
					else
	                    $this->ShowLoginBox("Nombre de usuario y/o clave invalidos");
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
			header("www.google.com");
		}
		
		function ShowLoginBox($errorMsg){
			echo("
			<form action='index.php?action=login' method='POST' accept-charset='utf-8'>
						<p>
							<div class='LoginBoxFrame'>
								<input type='text' id='txtNombre' name='txtNombre' class='txtInput'/>
								<input type='password' id='txtClave' name='txtClave' class='txtInput' />
								<input type='submit' value='Login' class='btnSubmit'/>							
							</div>	
						");
            if($errorMsg != "")
                echo("<input type='label' class='errorMsg' value='$errorMsg' />");                    
             echo("</p></form>");
		}
    }		
?>
