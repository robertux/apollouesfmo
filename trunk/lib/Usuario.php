<?php

	require_once("BaseDatos.php");

    class Usuario{
    	var $id;
		var $nombre;
		var $clave;
		
		function Usuario($pid, $pnom, $pclv){
			$this->id = $pid;
			$this->nombre = $pnom;
			$this->clave = $pclv;
		}
		
		function GetFromDb(BaseDatos $bdatos){
			$qString = "SELECT * FROM Usuario WHERE id = $this->id";
			$bdatos->Conectar();
			$res = $bdatos->EjecutarConsulta($qString);
			$usr = mysql_fetch_object($res);
			$this->id = $usr->id;
			$this->nombre = $usr->nombre;
			$this->clave = $usr->clave;
			$bdatos->Desconectar();
		}
		
		function GetFromDbByNomClave($bdatos){
			$qString = "SELECT * FROM Usuario WHERE nombre = '$this->nombre' AND clave = '$this->clave'";
			$bdatos->Conectar();
			$res = $bdatos->EjecutarConsulta($qString);
			$usr = mysql_fetch_object($res);
			$this->id = $usr->id;
			$this->nombre = $usr->nombre;
			$this->clave = $usr->clave;
			$bdatos->Desconectar();
		}
    }
?>
