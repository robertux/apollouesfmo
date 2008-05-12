<?php 
require_once("cconexion.php");

class cEvaluacion
{
	private $con;
	//id, fecha, porcentaje, nota, modulo
	public $id;
	public $fecha;
	public $porcentaje;
	public $nota;
	public $modulo;
	
	public $error;
	
	// constructor
    public function __construct() 
    {
    	$this->con = new cConexion();
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
    	return($this->Consultar("SELECT * FROM evaluacion;", true));
    }
    
    public function GetListaModulo($pModulo)
    {
    	$this->Consultar("SELECT * FROM evaluacion WHERE modulo = $pModulo;", true);
    }
    
    public function GetPorId($pId)
    {
    	$this->Consultar("SELECT * FROM evaluacion WHERE id = $pId;", false);
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
    			//si
    			if ($GetLista)
    			{
    				return ($resultado);
    			}
    			else
    			{
        			while($row = $resultado->fetch_array()) 
        			{
        				//id, fecha, porcentaje, nota, modulo
	            		$this->id = $row[0];
    	        		$this->fecha = $row[1];
        	    		$this->porcentaje = $row[2];
        	    		$this->nota = $row[3];
						$this->modulo = $row[4];
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