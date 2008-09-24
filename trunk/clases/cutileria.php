<?php 
//include("cconexion.php");

/*!
 * \brief Clase que representa a los registros de la tabla utileria en la base de datos de Apollo
 * Las utilerias son posts o registros que representan a programas asociados o recomendados por la unidad
 * En esta clase se incluye un titulo, contenido y vinculo a dicho programa de utileria
 */
class cUtileria
{
	/*!
	 * Objeto conexion, para hacer las consultas a la base de datos
	 */
	public $con;
	//id, titulo, vinculo, descripcion
	/*!
	 * Reprsenta al id del docente
	 */
	public $id;
	/*!
	 * Representa el titulo de la utileria
	 */
	public $titulo;
	/*!
	 * Representa el hipervinculo de la utileria
	 */
	public $vinculo; 
	/*!
	 * Representa la descripcion detallada de la utileria
	 */
	public $descripcion;
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
		$this->tabla = "utileria";
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
	 * Rellenamos los datos de esta clase con el registro de la tabla utileria que coincida con el ID pasado como parametro
	 * \param $pId el ID del registro con el cual rellenar esta clase
	 */
    public function GetPorId($pId)
    {
    	return($this->Consultar("SELECT id, titulo, vinculo, descripcion FROM utileria WHERE id = $pId;", false));
    }
    
    /*!
     * Obtenemos una lista de las utilerias de la base de datos
     * \param $cond Parametro opcional que define una condicion WHERE a incluir en la consulta de seleccion de los utilerias
     */
    public function GetLista()
    {
    	return($this->Consultar("SELECT id, titulo, vinculo, descripcion FROM utileria" . ($cond == ""? " ": " WHERE $cond ") . " ORDER BY id DESC;", true));
    }
	
	/*!
	 * Obtenemos una lista filtrada de los utilerias de la base de datos
	 * El filtro se hace para poder paginar los resultados mediante la clausula LIMIT en la consulta de seleccion
	 * \param $ini El numero del registro inicial a incluir en el rango de los resultados
	 * \param $len Cantidad de registros a incluir en el rango de los resultados
	 * \param $cond Parametro opcional que define una condicion WHERE a incluir en la consulta de seleccion de los utilerias
	 */
	public function GetListaFiltrada($ini=0, $len=10, $cond="")
	{
		return($this->Consultar("SELECT * FROM utileria" . ($cond == ""? " ": " WHERE $cond ") . "ORDER BY id DESC limit $ini, $len;", true));
	}
	
	/*
	public function GetListaOrden()
    {
    	return($this->Consultar("SELECT id, titulo, vinculo, descripcion FROM utileria GROUP BY id DESC;", true));
    }
    
    public function GetUltimos($pNumero = 10)
    {
    	return($this->Consultar("SELECT id, titulo, vinculo, descripcion FROM utileria DESC LIMIT $pNumero;", true));
    }
    
    public function Insert()
    {
    	$this->Consultar("INSERT INTO 
    	utileria(titulo, vinculo, descripcion, fecha)
    	VALUES ('$this->titulo','$this->vinculo','$this->descripcion');", false);
    }
    
    public function Update()
    {
    	$this->Consultar("UPDATE utileria SET 
    	titulo = '$this->titulo', 
    	vinculo = '$this->vinculo',
    	descripcion = '$this->descripcion'   	
    	WHERE id = $this->id;", false);
    }
	
	public function Delete()
    {
    	$this->Consultar("DELETE FROM utileria WHERE id = $this->id;", false);
    }*/
    
    /*!
     * Realiza la llamada a la clase conexion para realizar las consultas respectivas
     * \param $Consulta La cadena que contiene la consulta SQL a ejecutar
     * \param $GetLista Valor booleano que define si la consulta rellenara esta utileria o devolvera una lista de resultados
     */
    public function Consultar($Consulta, $GetLista)
    {
    	@$this->con->Conectar();
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
        				//id, titulo, vinculo, descripcion
	            		$this->id = $row[0];
    	        		$this->titulo = $row[1];
        	    		$this->vinculo = $row[2];
        	    		$this->descripcion = $row[3];
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