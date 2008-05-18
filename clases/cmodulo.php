<?php 
include("cconexion.php");

class cModulo
{
	private $con;
	//id, correlativo, docente, fechainicio, duracion, notafinal, curso, materia
	public $id;
	public $correlativo; 
	public $docente;
	public $fechainicio;
	public $duracion;
	public $notafinal;
	public $curso;
	public $materia;
	
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
    	return($this->Consultar("SELECT * FROM modulo;", true));
    }
    
    public function GetPorId($pId)
    {
    	$this->Consultar("SELECT * FROM modulo WHERE id = $pId;", false);
    }
    
    public function GetPorDocente($pDocente)
    {
    	$this->Consultar("SELECT * FROM modulo WHERE docente = $pDocente;", false);
    }
    
    public function GetPorCurso($pCurso)
    {
    	$this->Consultar("SELECT * FROM modulo WHERE curso = $pCurso;", false);
    }
    
    public function GetPorMateria($pMateria)
    {
    	$this->Consultar("SELECT * FROM modulo WHERE materia = $pMateria;", false);
    }
    
    /*public function Insert()
    {
    	$this->Consultar("INSERT INTO 
    	modulo(correlativo, docente, fechainicio, duracion, notafinal, curso, materia)
    	VALUES ($this->correlativo,$this->docente,'$this->fechainicio',$this->duracion,$this->notafinal, $this->curso, $this->materia);", false);
    }
    
    public function Update()
    {
    	$this->Consultar("UPDATE modulo SET 
    	correlativo = $this->nombre, 
    	docente = $this->docente,
    	fechainicio = '$this->fechainicio',
    	duracion= $this->duracion,
    	notafinal = $this->notafinal,
    	curso = $this->curso,
    	materia = $this->materia    	
    	WHERE id = $this->id;", false);
    }
	
	public function Delete()
    {
    	$this->Consultar("DELETE FROM modulo WHERE id = $this->id;", false);
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
        				//id, correlativo, docente, fechainicio, duracion, notafinal, curso, materia
	            		$this->id = $row[0];
    	        		$this->correlativo = $row[1];
        	    		$this->docente = $row[2];
        	    		$this->fechainicio = $row[3];
						$this->duracion = $row[4];
						$this->notafinal = $row[5];
						$this->curso = $row[6];
						$this->materia = $row[7];
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