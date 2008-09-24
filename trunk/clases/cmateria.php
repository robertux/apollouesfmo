<?php 

/*!
 * Incluimos la clase conexion
 */
include("cconexion.php");

/*!
 * \brief Clase que representa a los registros de la tabla materia en la base de datos de Apollo
 */
class cMateria
{
	/*!
	 * Objeto conexion, para hacer las consultas a la base de datos
	 */
	private $con;
	/*!
	 * Reprsenta al id de la materia
	 */
	public $id;
	/*!
	 * Representa al nombre de la materia
	 */
	public $nombre; //string
	/*!
	 * Representa al total de unidades valorativas de la materia
	 */
	public $uvs;
	/*!
	 * Representa al tipo de materia [normal, optativa]
	 */
	public $tipo;
	/*!
	 * Representa el id de la materia para la cual esta es requisito
	 */
	public $requisitopara;
	/*!
	 * Representa el id del postgrado asociado con esta materia
	 */
	public $postgrado;
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
		$this->tabla = "materia";
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
     * Obtenemos una lista de los materias de la base de datos
     */
    public function GetLista()
    {
    	return($this->Consultar("SELECT * FROM materia;", true));
    }
    
	/*!
     * Obtenemos una lista de los materias de la base de datos, en base al ID de un postgrado asociado
     * \param $pPostgrado El ID del postgrado asociado con el cual filtrar los resultados
     */
    public function GetListaPostGrado($pPostGrado)
    {
    	return($this->Consultar("SELECT * FROM materia WHERE postgrado = $pPostGrado;", true));
    }
    
	/*!
	 * Rellenamos los datos de esta clase con el registro de la tabla materias que coincida con el ID pasado como parametro
	 * \param $pId el ID del registro con el cual rellenar esta clase
	 */
    public function GetPorId($pId)
    {
    	$this->Consultar("SELECT * FROM materia WHERE id = $pId;", false);
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
     * \param $GetLista Valor booleano que define si la consulta rellenara esta materia o devolvera una lista de resultados
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
    		//echo "Error en la consulta: $this->consulta. ".$this->con->mysqli->error;
		}
		// cerrar la conexion
		@$this->con->mysqli->close();
    }
}
?>