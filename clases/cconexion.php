<?php

class cConexion
{
	private $host = "localhost";
	private $user = "apollouser";
	private $pass = "apollopwd";
	private $db = "apollo";

	public $mysqli;
    public $error;
	
    public function Conectar()
    {
		// craer el objeto mysqli y abrir la conexion
		$this->mysqli = new mysqli($host, $user, $pass, $db);
		// veamos si hay errores
		if (mysqli_connect_errno()) {
			$this->error = "No me pude conectar!";
    		die($this->error);
		} 
    }
    
}