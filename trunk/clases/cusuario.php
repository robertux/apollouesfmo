<?php 
//include_once("cconexion.php");

class cUsuario
{
	private $con;
	
	public $id;
	//private $consulta;
	public $nombre;
	public $clave;
	public $privilegio;
	public $tabla;
	
	public $error;
	
	// constructor
    public function __construct() 
    {
    	$this->id = 0;
		$this->nombre = "";
		$this->clave = "";
		$this->privilegio = "";
    	$this->con = new cConexion();
		$this->tabla = "usuario";
		//$this->con->Conectar();
    }
    
    // destructor
    public function __destruct() 
    {
        //..
    }

    //Obtenemos una lista (un resultset) de este objeto
    //Ojo, el objeto NO toma NINGUN valor de esta lista.
    public function GetLista($cond = "")
    {
    	return($this->Consultar("SELECT * FROM usuario" . ($cond == ""? " ": " WHERE $cond ") . " ORDER BY id DESC;", true));
    }
	
	public function GetListaFiltrada($ini=0, $len=10, $cond="")
	{
		return($this->Consultar("SELECT * FROM usuario" . ($cond == ""? " ": " WHERE $cond ") . "ORDER BY id DESC limit $ini, $len;", true));
	}
    
    public function GetPorNombreClave($pNombre, $pClave)
    {
    	return $this->Consultar("SELECT * FROM usuario WHERE nombre = '$pNombre' AND clave = '$pClave';", false);
    }
	
	public function GetPorId($pId)
	{
		return $this->Consultar("SELECT * FROM usuario WHERE id = '$pId';", false);
	}
    
    public function Insert()
    {
    	$this->Consultar("INSERT INTO usuario(id, clave, nombre) VALUES ('$this->id', '$this->nombre','$this->clave');", false);
    }
    
    //?
    /*public function Insert($pNombre, $pClave)
    {
    	$this->Consultar("INSERT INTO usuario(clave,nombre) VALUES ('$pNombre','$pClave');");
    }*/
    
    public function Update()
    {
    	$this->Consultar("UPDATE usuario SET clave = '$this->clave', nombre = '$this->nombre' WHERE id = $this->id;", false);
    }
	
	public function Delete()
    {
    	$this->Consultar("DELETE FROM usuario WHERE id = $this->id;", false);
    }
    
    function Consultar($Consulta, $GetLista)
    {
    	$this->con->Conectar();
		$resultConsulta = false;
		// ejecutar la consulta
		if ($resultado = $this->con->mysqli->query($Consulta))
		{
    		// hay registros?
    		if ($resultado->num_rows > 0) 
    		{
        		// si
    			if ($GetLista)
    			{
    				return ($resultado);
    			}
    			else
    			{
        			while($row = $resultado->fetch_array()) 
        			{
	            		$this->id = $row[0];
    	        		$this->clave = $row[1];
        	    		$this->nombre = $row[2];
						$conTemp = new cConexion();
						$conTemp->Conectar();
						$resPriv = $conTemp->mysqli->query("SELECT p.nombre FROM privilegio p INNER JOIN asignacion a ON p.id = a.privilegio INNER JOIN usuario u ON a.usuario = u.id WHERE u.id=$this->id;");
						if($resRow = $resPriv->fetch_array())
							$this->privilegio = $resRow[0];
						$conTemp->mysqli->close();
        			}
        			// liberar la memoria
    				$resultado->close();
    			}
				$resultConsulta = true;
    		}
    		else
    		{
	        	// no
        		$this->error .= "No hay resultados para mostrar!";
				return false;
    		}
		}
		else 
		{
    		// tiremos el error (si hay)... ojala que no :P
    		echo "Error en la consulta: $this->consulta. ".$this->con->mysqli->error;
		}
		// cerrar la conexion
		$this->con->mysqli->close();
		return $resultConsulta;
    }
}
?>