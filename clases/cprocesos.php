<?php 
//include("cconexion.php");

class cProcesos
{
	public $con;
	//id, titulo, vinculo, descripcion
	public $id;
	public $nombre;
	public $imagen; 
	public $vprevia;
	public $descripcion;
	public $tabla;
	
	public $error;
	
	// constructor
    public function __construct() 
    {
    	$this->con = new cConexion();
		$this->tabla = "procesos";
		//$this->con->Conectar();
    }
    
    // destructor
    public function __destruct() 
    {
        //..
    }
    
    public function GetPorId($pId)
    {
    	return($this->Consultar("SELECT id, nombre, imagen, descripcion, vprevia FROM procesos WHERE id = $pId;", false));
    }
    
    //Obtenemos una lista (un resultset) de este objeto
    //Ojo, el objeto NO toma NINGUN valor de esta lista.
    public function GetLista()
    {
    	return($this->Consultar("SELECT id, nombre, imagen, descripcion, vprevia FROM procesos;", true));
    }
	
	public function GetListaFiltrada($ini=0, $len=10)
	{
		return($this->Consultar("SELECT * FROM procesos ORDER BY id limit $ini, $len;", true));
	}
	
	public function GetListaOrden()
    {
    	return($this->Consultar("SELECT id, nombre, imagen, descripcion FROM procesos GROUP BY id DESC;", true));
    }
    
    public function GetUltimos($pNumero = 10)
    {
    	return($this->Consultar("SELECT id, nombre, imagen, descripcion, vprevia FROM procesos DESC LIMIT $pNumero;", true));
    }
    
    public function Insert()
    {
    	$this->Consultar("INSERT INTO 
    	procesos(nombre, imagen, descripcion, fecha)
    	VALUES ('$this->nombre','$this->imagen','$this->descripcion', '$this->vprevia');", false);
    }
    
    public function Update()
    {
    	$this->Consultar("UPDATE procesos SET 
    	nombre = '$this->nombre', 
    	imagen = '$this->imagen',
    	descripcion = '$this->descripcion',
		vprevia = '$this->vprevia'
    	WHERE id = $this->id;", false);
    }
	
	public function Delete()
    {
    	$this->Consultar("DELETE FROM procesos WHERE id = $this->id;", false);
    }
    
    //en este caso es necesario hacer publica esta funcion.
    public function Consultar($Consulta, $GetLista)
    {
    	$this->con->Conectar();
		// ejecutar la consulta
		if ($resultado = $this->con->mysqli->query($Consulta))
		{
    		// hay registros?
    		if ($resultado->num_rows > 0) 
    		{
    			//si
    			if ($GetLista)
    			{
    				return ($resultado);
    			}
    			else
    			{
        			while($row = $resultado->fetch_array()) 
        			{
        				//id, nombre, imagen, descripcion
	            		$this->id = $row[0];
    	        		$this->nombre = $row[1];
        	    		$this->imagen = $row[2];
        	    		$this->descripcion = $row[3];
        			}
        			// liberar la memoria
    				$resultado->close();
    			}
    		}
    		else
    		{
	        	// no
        		$this->error .= "No hay resultados para mostrar!";
    		}
		}
		else 
		{
    		// tiremos el error (si hay)... ojala que no :P
    		echo "Error en la consulta: $this->consulta. ".$this->con->mysqli->error;
		}
		// cerrar la conexion
		$this->con->mysqli->close();
    }
}
?>