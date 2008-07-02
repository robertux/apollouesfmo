<?php 
include("cconexion.php");

class cPresentaDoc
{
	private $con;
	//id, nombre
	public $id;
	public $nombre;
	
	public $error;
	
	// constructor
    public function __construct() 
    {
    	$this->con = new cConexion();
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
    	return($this->Consultar("SELECT * FROM presentadoc;", true));
    }
    
    public function GetPorId($pId)
    {
    	$this->Consultar("SELECT * FROM presentadoc WHERE id = $pId;", false);
    }
    
    public function Insert()
    {
    	$this->Consultar("INSERT INTO presentadoc(descripcion) VALUES ('$this->descripcion');", false);
    }
    
    public function Update()
    {
    	$this->Consultar("UPDATE presentadoc SET descripcion = '".$this->descripcion."' WHERE id = ".$this->id, false);
    }
	
	public function Delete()
    {
    	$this->Consultar("DELETE FROM presentadoc WHERE id = $this->id;", false);
    }
    
    function Consultar($Consulta, $GetLista)
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
        				//id, descripcion
	            		$this->id = $row[0];
    	        		$this->descripcion = $row[1];
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