<?php 
require_once("cconexion.php");

class cPostGrado
{
	private $con;
	
	public $id;
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
    
    //Obtenemos una lista (un resultset) de este objeto
    //Ojo, el objeto NO toma NINGUN valor de esta lista.
    public function GetLista()
    {
    	return($this->Consultar("SELECT * FROM postgrado;", true));
    }
    
    //Just for now...
    public function GetPorId($pId)
    {
    	$this->Consultar("SELECT * FROM postgrado WHERE id = $pId;", false);
    }
    
    /*public function Insert()
    {
    	//...
    }
    
    public function Update()
    {
    	//...
    }
	
	public function Delete()
    {
    	//...
    }*/
    
    function Consultar($Consulta, $GetLista)
    {
    	$this->con->Conectar();
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