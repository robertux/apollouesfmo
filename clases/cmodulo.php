<?php 

/*!
 * Incluimos la clase conexion
 */
include("cconexion.php");

/*!
 * \brief Clase que representa a los registros de la tabla modulo en la base de datos de Apollo
 */
class cModulo
{
	/*!
	 * Objeto conexion, para hacer las consultas a la base de datos
	 */
	private $con;
	//id, correlativo, docente, fechainicio, duracion, notafinal, curso, materia
	/*!
	 * Reprsenta al id del modulo
	 */
	public $id;
	/*!
	 * Representa al numero correlativo del modulo
	 */
	public $correlativo; 
	/*!
	 * Representa al docente asociado con el modulo
	 */	
	public $docente;
	/*!
	 * Representa la fecha de inicio del modulo
	 */
	public $fechainicio;
	/*!
	 * Representa la duracion del modulo
	 */
	public $duracion;
	/*!
	 * Representa la nota final del modulo
	 */
	public $notafinal;
	/*!
	 * Representa el curso asociado con este modulo
	 */
	public $curso;
	/*!
	 * Representa la materia asociada con este modulo
	 */
	public $materia;
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
		$this->tabla = "modulo";
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
     * Obtenemos una lista de los modulos de la base de datos
     */
    public function GetLista()
    {
    	return($this->Consultar("SELECT * FROM modulo;", true));
    }
    
	/*!
	 * Rellenamos los datos de esta clase con el registro de la tabla modulos que coincida con el ID pasado como parametro
	 * \param $pId el ID del registro con el cual rellenar esta clase
	 */
    public function GetPorId($pId)
    {
    	$this->Consultar("SELECT * FROM modulo WHERE id = $pId;", false);
    }
    
	/*!
	 * Rellenamos los datos de esta clase con el registro de la tabla modulos que coincida con el ID del docente pasado como parametro
	 * \param $pDocente el ID del docente en el registro con el cual rellenar esta clase
	 */
    public function GetPorDocente($pDocente)
    {
    	$this->Consultar("SELECT * FROM modulo WHERE docente = $pDocente;", false);
    }
    
	/*!
	 * Rellenamos los datos de esta clase con el registro de la tabla modulos que coincida con el ID del curso pasado como parametro
	 * \param $pICurso el ID del curso en el registro con el cual rellenar esta clase
	 */
    public function GetPorCurso($pCurso)
    {
    	$this->Consultar("SELECT * FROM modulo WHERE curso = $pCurso;", false);
    }
    
	/*!
	 * Rellenamos los datos de esta clase con el registro de la tabla modulos que coincida con el ID de la materia pasada como parametro
	 * \param $pMateria el ID de la materia en el registro con el cual rellenar esta clase
	 */
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
    
    /*!
     * Realiza la llamada a la clase conexion para realizar las consultas respectivas
     * \param $Consulta La cadena que contiene la consulta SQL a ejecutar
     * \param $GetLista Valor booleano que define si la consulta rellenara este modulo o devolvera una lista de resultados
     */
    function Consultar($Consulta, $GetLista)
    {
    	$this->con->Conectar();
		// ejecutar la consulta
		if ($resultado = @$this->con->mysqli->query($Consulta))
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
        			while($row = @$resultado->fetch_array()) 
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
    		//echo "Error en la consulta: $this->consulta. ".$this->con->mysqli->error;
		}
		// cerrar la conexion
		@$this->con->mysqli->close();
    }
}
?>