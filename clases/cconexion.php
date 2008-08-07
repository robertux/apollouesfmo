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
		// crear el objeto mysqli y abrir la conexion
		$this->mysqli = new mysqli($this->host, $this->user, $this->pass, $this->db);
		// veamos si hay errores
		if (mysqli_connect_errno()) {
			$this->error = "No me pude conectar!";
    		die($this->error);
		}
    }
	
	public function Host()
	{
		return $this->host;
	}
	
	public function User()
	{
		return $this->user;
	}
    
	public function Pass()
	{
		return $this->pass;
	}
	
	public function Db()
	{
		return $this->db;
	}
}