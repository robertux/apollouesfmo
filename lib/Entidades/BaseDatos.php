<?php


    class BaseDatos{
    	var $servidor;
    	var $usuario;
		var $clave;
		var $nombrebd;
		
		var $conn;
		
		function __construct($phost, $puser, $ppwd, $pbdname){
			$this->servidor = $phost;
			$this->usuario = $puser;
			$this->clave = $ppwd;
			$this->nombrebd = $pbdname;
		}
		
		function __construct(){
			$this->servidor = "localhost";
			$this->usuario = "apollouser";
			$this->clave = "apollopwd";
			$this->nombrebd = "apollo";
		}
		
		function Conectar(){
			$this->conn = mysql_connect($this->$host, $this->usuario, $this->clave);
			$this->SelectDb();
		}
		
		function Desconectar(){
			mysql_close($this->conn);
		}
		
		function SelectDb(){
			mysql_select_db("apollo", $this->conn);
		}
		
		function EjecutarConsulta($queryString){
			return mysql_query($queryString, $this->conn);
		}
		
    }
?>
