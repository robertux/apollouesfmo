<?php 

/*!
 * Incluimos la clase conexion
 */
include_once("cconexion.php");

/*!
 * \brief Clase que representa a los registros de la tabla evento en la base de datos de Apollo
 * Los eventos son actividades futuras a realizar en las maestrias.
 * En esta clase se incluyen detalles como la fecha y lugar del evento a realizarse
 */
class cEvento
{
	/*!
	 * Objeto conexion, para hacer las consultas a la base de datos
	 */
	private $con;
	//id, apellidos, nombres, gradoacademico, usuario
	/*!
	 * Reprsenta al id del evento
	 */
	public $id;
	/*!
	 * Representa al postgrado asociado con este evento
	 */
	public $postgrado;
	/*!
	 * Representa el titulo o nombre del evento
	 */
	public $titulo;
	/*!
	 * Representa la fecha en la que se llevara a cabo el evento
	 */
	public $fecha;
	/*!
	 * Representa el lugar donde se llevara a cabo el evento
	 */
	public $lugar;
	/*!
	 * Representa todos los detalles que describen de que se trata el evento
	 */
	public $detalle;
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
		$this->tabla = "evento";
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
     * Obtenemos una lista de los eventos de la base de datos
     * \param $cond Parametro opcional que define una condicion WHERE a incluir en la consulta de seleccion de los eventos
     */
    public function GetLista($cond="")
    {
    	return($this->Consultar("SELECT * FROM evento" . ($cond == ""? " ": " WHERE $cond ") . "ORDER BY id DESC;", true));
    }
	
	/*!
	 * Obtenemos una lista filtrada de los eventos de la base de datos
	 * El filtro se hace para poder paginar los resultados mediante la clausula LIMIT en la consulta de seleccion
	 * \param $ini El numero del registro inicial a incluir en el rango de los resultados
	 * \param $len Cantidad de registros a incluir en el rango de los resultados
	 * \param $cond Parametro opcional que define una condicion WHERE a incluir en la consulta de seleccion de los eventos
	 */
	public function GetListaFiltrada($ini=0, $len=10, $cond="")
	{
		return($this->Consultar("SELECT * FROM evento" . ($cond == ""? " ": " WHERE $cond ") . "ORDER BY id DESC limit $ini, $len;", true));
	}
    
	/*!
	 * Rellenamos los datos de esta clase con el registro de la tabla eventos que coincida con el ID pasado como parametro
	 * \param $pId el ID del registro con el cual rellenar esta clase
	 */
    public function GetPorId($pId)
    {
    	$this->Consultar("SELECT * FROM evento WHERE id = $pId;", false);
    }
        
    /*public function GetNombre($pNombre)
    {
    	$this->Consultar("SELECT * FROM materia WHERE nombre = '$pNombre';", false);
    }
    
    public function GetPostGrado($pPostGrado)
    {
    	$this->Consultar("SELECT * FROM materia WHERE postgrado = $pPostGrado;", false);
    }
    
    public function Insert()
    {
    	$this->Consultar("INSERT INTO materia(nombre,uvs,tipo,requisitopara,postgrado) VALUES ('$this->nombre',$this->uvs,$this->tipo,'$this->requisitopara',$this->postgrado);", false);
    }
    
    public function Update()
    {
    	$this->Consultar("UPDATE materia SET nombre = '$this->nombre', uvs = $this->uvs, tipo = $this->tipo, requisitopara = '$this->requisitopara', postgrado = $this->postgrado WHERE id = $this->id;", false);
    }
	
	public function Delete()
    {
    	$this->Consultar("DELETE FROM materia WHERE id = $this->id;", false);
    }*/

    /*!
     * Realiza la llamada a la clase conexion para realizar las consultas respectivas
     * \param $Consulta La cadena que contiene la consulta SQL a ejecutar
     * \param $GetLista Valor booleano que define si la consulta rellenara este evento o devolvera una lista de resultados
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
        				////id, apellidos, nombres, gradoacademico, usuario
	            		$this->id = $row[0];
    	        		$this->postgrado = $row[1];
        	    		$this->titulo = $row[2];
        	    		$this->fecha = $row[3];
						$this->lugar = $row[4];
						$this->detalle = $wor[5];
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