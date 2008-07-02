<?php 
include("cconexion.php");

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
	
	public $presentacion;
	public $descripcion;
	
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
    
    //id,nombre,notaminima,totaluvs,cumminimo,abreviatura,maxalum,presentacion,descripcion
	public function Insert()
    {
    	$this->Consultar("INSERT INTO 
    	postgrado(nombre,notaminima,totaluvs,cumminimo,abreviatura,maxalum,presentacion,descripcion)
    	VALUES ('$this->nombre',$this->notaminima,$this->totaluvs,$this->cumminimo,'$this->abreviatura', $this->maxalum, '$this->presentacion','$this->descripcion');", false);
    }
    
    public function Update()
    {
    	$this->Consultar("UPDATE postgrado SET 
    	nombre = '$this->nombre', 
    	notaminima = $this->notaminima,
    	totaluvs = $this->totaluvs,
    	cumminimo= $this->cumminimo,
    	abreviatura = '$this->abreviatura',
    	maxalum = $this->maxalum,
    	presentacion = '$this->presentacion',    	
    	descripcion = '$this->descripcion' 
    	WHERE id = $this->id;", false);
    }
	
	public function Delete()
    {
    	$this->Consultar("DELETE FROM postgrado WHERE id = $this->id;", false);
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
        		// si
    			if ($GetLista)
    			{
    				return ($resultado);
    			}
    			else
    			{
        			while($row = $resultado->fetch_array()) 
        			{
	        			//id,nombre,notaminima,totaluvs,cumminimo,abreviatura,maxalum,presentacion,descripcion
    	        		$this->id = $row[0];
        	    		$this->nombre = $row[1];
            			$this->notaminima = $row[2];
            			$this->totaluvs = $row[3];
            			$this->comminimo = $row[4];
            			$this->abreviatura = $row[5];
            			$this->maxalum = $row[6];
						$this->presentacion = $row[7];
						$this->descripcion = $row[8];
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