<?php 

/*!
 * Incluimos la clase conexion
 */
include("cconexion.php");

/*!
 * \brief Clase que representa a los registros de la tabla evaluacion en la base de datos de Apollo
 */
class cEvaluacion
{
	/*!
	 * Objeto conexion, para hacer las consultas a la base de datos
	 */
	private $con;
	//id, fecha, porcentaje, nota, modulo
	/*!
	 * Reprsenta al id de la evaluacion
	 */
	public $id;
	/*!
	 * Representa la fecha de la evaluacion
	 */
	public $fecha;
	/*!
	 * Representa el porcentaje de la nota global con el que es valorada esta evaluacion
	 */
	public $porcentaje;
	/*!
	 * Representa la nota obtenida en la evaluacion
	 */
	public $nota;
	/*!
	 * Representa el modulo en el que fue realizada esta evaluacion
	 */
	public $modulo;
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
		$this->tabla = "evaluacion";
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
     * Obtenemos una lista de las evaluaciones de la base de datos
     */
    public function GetLista()
    {
    	return($this->Consultar("SELECT * FROM evaluacion;", true));
    }
    
	/*!
	 * Obtenemos una lista de las evaluaciones que tengan un ID del modulo que coincida con el ID pasado como parametro
	 * \param $pModulo ID del Modulo que deben poseer los registros a seleccionar
	 */
    public function GetListaModulo($pModulo)
    {
    	$this->Consultar("SELECT * FROM evaluacion WHERE modulo = $pModulo;", true);
    }
	
    /*!
	 * Rellenamos los datos de esta clase con el registro de la tabla evaluacion que coincida con el ID pasado como parametro
	 * \param $pId el ID del registro con el cual rellenar esta clase
	 */
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
    
    /*!
     * Realiza la llamada a la clase conexion para realizar las consultas respectivas
     * \param $Consulta La cadena que contiene la consulta SQL a ejecutar
     * \param $GetLista Valor booleano que define si la consulta rellenara este alumno o devolvera una lista de resultados
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
    		//echo "Error en la consulta: $this->consulta. ".$this->con->mysqli->error;
		}
		// cerrar la conexion
		@$this->con->mysqli->close();
    }
}
?>