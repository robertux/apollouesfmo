<?php 
require_once("cconexion.php");

class cPostGrado
{
	private $con;
	
	private $id;
	public $nombre;
	public $notaminima;
	public $totaluvs;
	public $cumminimo;
	public $abreviatura;
	public $maxalum;
	
	public $error;
	
	// constructor
    public function __construct() 
    {
    	$this->con = new cConexion();
    }
    
    // destructor
    public function __destruct() 
    {
        //...
    }
    
    //Just for now...
    public function Get($pId)
    {
    	$this->Consultar("SELECT id, nombre, notaminima, totaluvs, cumminimo, abreviatura, maxalum FROM postgrado WHERE id = '$pId';");
    }
    
    public function Insert()
    {
    	//...
    }
    
    public function Update()
    {
    	//...
    }
	
	public function Delete()
    {
    	//$this->Consultar("DELETE FROM postgrado WHERE id = $this->id;");
    }
    
    function Consultar($consulta)
    {
    	$this->con->Conectar();
		// ejecutar la consulta
		if ($resultado = $this->con->mysqli->query($consulta))
		{
    		// hay registros?
    		if ($resultado->num_rows > 0) 
    		{
        		// si
        		// llenemos los datos
        		while($row = $resultado->fetch_array()) 
        		{
        			//id, nombre, notaminima, totaluvs, cumminimo, abreviatura, maxalum
            		$this->id = $row[0];
            		$this->nombre = $row[1];
            		$this->notaminima = $row[2];
            		$this->totaluvs = $row[3];
            		$this->comminimo = $row[4];
            		$this->abreviatura = $row[5];
            		$this->maxalum = $row[6];
        		}
        		// liberar la memoria
    			$resultado->close();
    		}
    		else
    		{
	        	// no
        		$this->error .= "No encontre registros!";
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