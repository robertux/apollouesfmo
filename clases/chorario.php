<?php 

/*!
 * Incluimos la clase conexion
 */
include("cconexion.php");

/*!
 * \brief Clase que representa a los registros de la tabla horario en la base de datos de Apollo
 */
class cHorario
{
	/*!
	 * Objeto conexion, para hacer las consultas a la base de datos
	 */
	private $con;
	//id, dia, horainicio, horafin, aula, frecuencia, modulo
	/*!
	 * Reprsenta al id del horario
	 */
	public $id;
	/*!
	 * Representa el dia de la semana para este horario
	 */
	public $dia;
	/*!
	 * Representa la hora de inicio de este horario
	 */
	public $horainicio;
	/*!
	 * Representa la hora de finalizacion de este horario
	 */
	public $horafin;
	/*!
	 * Representa el aula relacionada con este horario
	 */
	public $aula;
	/*!
	 * Representa la frecuencia de repeticion de este horario
	 */
	public $frecuencia;
	/*!
	 * Representa el modulo asociado con este horario
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
		$this->tabla = "horario";
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
     * Obtenemos una lista de los horarios de la base de datos
     */
    public function GetLista()
    {
    	return($this->Consultar("SELECT * FROM horario;", true));
    }
    
	/*!
     * Obtenemos una lista de los horarios de la base de datos, en base a un dia especifico
     * \param $pDia El dia en base al cual filtrar los horarios
     */
    public function GetListaDia($pDia)
    {
    	$this->Consultar("SELECT * FROM horario WHERE dia = $pDia;", true);
    }
    
	/*!
     * Obtenemos una lista de los horarios de la base de datos, en base a un aula
     * \param $pAula El aula en base a la cual filtrar los horarios
     */
    public function GetListaAula($pAula)
    {
    	$this->Consultar("SELECT * FROM horario WHERE aula = '$pAula';", true);
    }
    
	/*!
     * Obtenemos una lista de los horarios de la base de datos, en base al modulo asociado
     * \param $pModulo El modulo en base al cual filtrar los horarios
     */
    public function GetListaModulo($pModulo)
    {
    	$this->Consultar("SELECT * FROM horario WHERE modulo = $pModulo;", true);
    }
    
	/*!
	 * Rellenamos los datos de esta clase con el registro de la tabla horario que coincida con el ID pasado como parametro
	 * \param $pId el ID del registro con el cual rellenar esta clase
	 */
    public function GetPorId($pId)
    {
    	$this->Consultar("SELECT * FROM horario WHERE id = $pId;", false);
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
     * \param $GetLista Valor booleano que define si la consulta rellenara este horario o devolvera una lista de resultados
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
        				//id, dia, horainicio, horafin, aula, frecuencia, modulo
	            		$this->id = $row[0];
    	        		$this->nombre = $row[1];
        	    		$this->uvs = $row[2];
        	    		$this->tipo = $row[3];
						$this->requisitopara = $row[4];
						$this->postgrado = $row[5];
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