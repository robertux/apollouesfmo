<?php 
require_once("cconexion.php");

class cInscripcion
{
	private $con;
	//id, alumno, curso, fecha, notafinal, estado
	public $id;
	public $alumno; 
	public $curso;
	public $fecha;
	public $notafinal;
	public $estado;
	
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
    	return($this->Consultar("SELECT * FROM inscripcion;", true));
    }
    
    public function GetPorId($pId)
    {
    	$this->Consultar("SELECT * FROM inscripcion WHERE id = $pId;", false);
    }
    
    public function GetPorAlumno($pAlumno)
    {
    	$this->Consultar("SELECT * FROM inscripcion WHERE alumno = $pAlumno;", false);
    }
    
    public function GetPorCurso($pCurso)
    {
    	$this->Consultar("SELECT * FROM inscripcion WHERE curso = $pCurso;", false);
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
        				//id, alumno, curso, fecha, notafinal, estado
	            		$this->id = $row[0];
    	        		$this->alumno = $row[1];
        	    		$this->curso = $row[2];
        	    		$this->fecha = $row[3];
						$this->notafinal = $row[4];
						$this->estado = $row[5];
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