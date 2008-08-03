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
    public function GetLista()
    {
    	return($this->Consultar("SELECT * FROM foro_users;", true));
    }
    
    public function GetPorNombreClave($pNombre, $pClave)
    {
    	return $this->Consultar("SELECT * FROM foro_users WHERE username = '$pNombre' AND password = '$pClave';", false);
    }
	
	public function GetPorId($pId)
	{
		return $this->Consultar("SELECT * FROM foro_users WHERE id = '$pId';", false);
	}
    
    public function Insert()
    {
    	$this->Consultar("INSERT INTO foro_users(id, password, username) VALUES ('$this->id', '$this->nombre','$this->clave');", false);
    }
    
    //?
    /*public function Insert($pNombre, $pClave)
    {
    	$this->Consultar("INSERT INTO usuario(clave,nombre) VALUES ('$pNombre','$pClave');");
    }*/
    
    public function Update()
    {
    	$this->Consultar("UPDATE foro_users SET password = '$this->clave', username = '$this->nombre' WHERE id = $this->id;", false);
    }
	
	public function Delete()
    {
    	$this->Consultar("DELETE FROM foro_users WHERE id = $this->id;", false);
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
						$resPriv = $conTemp->mysqli->query("SELECT nombre FROM privilegio p INNER JOIN asignacion a ON p.id = a.privilegio INNER JOIN foro_users u ON a.usuario = u.id WHERE u.id=$this->id;");
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