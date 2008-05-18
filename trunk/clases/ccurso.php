<?php 
include("cconexion.php");

class cCurso
{
	private $con;
	
	public $id;
	public $fechainicio;
	public $postgrado;
	
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
    	return($this->Consultar("SELECT * FROM curso;", true));
    }
    
    public function GetListaPostGrado($pPostGrado)
    {
    	return($this->Consultar("SELECT * FROM curso WHERE postgrado = $pPostGrado;", true));
    }
    
    public function GetPorId($pId)
    {
    	$this->Consultar("SELECT * FROM curso WHERE id = $pId;", false);
    }
    
    /*public function Insert()
    {
    	$this->Consultar("INSERT INTO curso(fechainicio,postgrado) VALUES ('$this->fechainicio',$this->postgrado);", false);
    }
    
    public function Update()
    {
    	$this->Consultar("UPDATE curso SET fechainicio = '$this->fechainicio', postgrado = $this->postgrado WHERE id = $this->id;", false);
    }
	
	public function Delete()
    {
    	$this->Consultar("DELETE FROM curso WHERE id = $this->id;", false);
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
	            		$this->id = $row[0];
    	        		$this->fechainicio = $row[1];
						$this->postgrado = $row[2];
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