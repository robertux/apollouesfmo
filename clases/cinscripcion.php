<?php 

/*!
 * Incluimos la clase conexion
 */
include("cconexion.php");

/*!
 * \brief Clase que representa a los registros de la tabla inscripcion en la base de datos de Apollo
 */
class cInscripcion
{
	/*!
	 * Objeto conexion, para hacer las consultas a la base de datos
	 */
	private $con;
	//id, alumno, curso, fecha, notafinal, estado
	/*!
	 * Reprsenta al id de la inscripcion
	 */
	public $id;
	/*!
	 * Representa al alumno asociado con esta inscripcion
	 */
	public $alumno; 
	/*!
	 * Representa al curso asociado con esta inscripcion
	 */
	public $curso;
	/*!
	 * Representa a la fecha en la que se llevo a cabo esta inscripcion
	 */
	public $fecha;
	/*!
	 * Representa (o representara) la nota final de esta inscripcion
	 */
	public $notafinal;
	/*!
	 * Representa el estado de esta inscripcion
	 */
	public $estado;
	/*!
	 * Variable utilizada para saber la tabla que representa esta clase
	 */
	public $tabla;
	/*!
	 * Variable utilizada para almacenar el mensaje de error producido por alguna consulta
	 */
	public $error;
	
	/*!
	 * Constructor de la clase
	 * Instancia el objeto Conexion y asigna el nombre de la tabla que esta clase representa
	 */
    public function __construct() 
    {
    	$this->con = new cConexion();
		$this->tabla = "inscripcion";
		//$this->con->Conectar();
    }
    
    /*!
     * Destructor de la clase
     */
    public function __destruct() 
    {
        //..
    }
    
    /*!
     * Obtenemos una lista de las inscripcions de la base de datos
     */
    public function GetLista()
    {
    	return($this->Consultar("SELECT * FROM inscripcion;", true));
    }
    
	/*!
	 * Rellenamos los datos de esta clase con el registro de la tabla inscripcion que coincida con el ID pasado como parametro
	 * \param $pId el ID del registro con el cual rellenar esta clase
	 */
    public function GetPorId($pId)
    {
    	$this->Consultar("SELECT * FROM inscripcion WHERE id = $pId;", false);
    }
    
	/*!
	 * Rellenamos los datos de esta clase con el registro de la tabla inscripcion que coincida con el ID del alumno pasado como parametro
	 * \param $pAlumno el ID del alumno asociado con el cual rellenar esta clase
	 */
    public function GetPorAlumno($pAlumno)
    {
    	$this->Consultar("SELECT * FROM inscripcion WHERE alumno = $pAlumno;", false);
    }
    
	/*!
	 * Rellenamos los datos de esta clase con el registro de la tabla inscripcion que coincida con el ID del curso pasado como parametro
	 * \param $pId el ID del curso asociado con el cual rellenar esta clase
	 */
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
    
    /*!
     * Realiza la llamada a la clase conexion para realizar las consultas respectivas
     * \param $Consulta La cadena que contiene la consulta SQL a ejecutar
     * \param $GetLista Valor booleano que define si la consulta rellenara esta inscripcion o devolvera una lista de resultados
     */
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