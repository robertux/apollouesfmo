<?php 
//include("cconexion.php");

/*!
 * \brief Clase que representa a los registros de la tabla procesos en la base de datos de Apollo
 * Los procesos son actividades que se llevan a cabo dentro de la unidad,mayormente por los estudiantes como por ejemplo Inscripcion, Servicio Social, Graduacion, etc.
 * En esta clase se incluye imagenes y descripcion de dichos procesos
 */
class cProcesos
{
	/*!
	 * Objeto conexion, para hacer las consultas a la base de datos
	 */
	public $con;
	//id, titulo, vinculo, descripcion
	/*!
	 * Reprsenta al id del proceso
	 */
	public $id;
	/*!
	 * Representa el nombre del proceso
	 */
	public $nombre;
	/*!
	 * Representa la imagen del proceso
	 */
	public $imagen; 
	/*!
	 * Representa la imagen de vista previa del proceso
	 */
	public $vprevia;
	/*!
	 * Representa la descripcion de este proceso
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
		$this->tabla = "procesos";
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
	 * Rellenamos los datos de esta clase con el registro de la tabla procesos que coincida con el ID pasado como parametro
	 * \param $pId el ID del registro con el cual rellenar esta clase
	 */
    public function GetPorId($pId)
    {
    	return($this->Consultar("SELECT id, nombre, imagen, descripcion, vprevia FROM procesos WHERE id = $pId;", false));
    }
    
    /*!
     * Obtenemos una lista de los procesos de la base de datos
     * \param $cond Parametro opcional que define una condicion WHERE a incluir en la consulta de seleccion de los procesos
     */
    public function GetLista($cond="")
    {
    	return($this->Consultar("SELECT id, nombre, imagen, descripcion, vprevia FROM procesos " . ($cond == ""? " ": " WHERE $cond ") . "ORDER BY id;", true));
    }
	
	/*!
	 * Obtenemos una lista filtrada de los procesos de la base de datos
	 * El filtro se hace para poder paginar los resultados mediante la clausula LIMIT en la consulta de seleccion
	 * \param $ini El numero del registro inicial a incluir en el rango de los resultados
	 * \param $len Cantidad de registros a incluir en el rango de los resultados
	 * \param $cond Parametro opcional que define una condicion WHERE a incluir en la consulta de seleccion de los procesos
	 */
	public function GetListaFiltrada($ini=0, $len=10, $cond="")
	{
		return($this->Consultar("SELECT * FROM procesos" . ($cond == ""? " ": " WHERE $cond ") . "ORDER BY id limit $ini, $len;", true));
	}
	/*
	public function GetListaOrden()
    {
    	return($this->Consultar("SELECT id, nombre, imagen, descripcion FROM procesos GROUP BY id DESC;", true));
    }
    
    public function GetUltimos($pNumero = 10)
    {
    	return($this->Consultar("SELECT id, nombre, imagen, descripcion, vprevia FROM procesos DESC LIMIT $pNumero;", true));
    }
    
    public function Insert()
    {
    	$this->Consultar("INSERT INTO 
    	procesos(nombre, imagen, descripcion, fecha)
    	VALUES ('$this->nombre','$this->imagen','$this->descripcion', '$this->vprevia');", false);
    }
    
    public function Update()
    {
    	$this->Consultar("UPDATE procesos SET 
    	nombre = '$this->nombre', 
    	imagen = '$this->imagen',
    	descripcion = '$this->descripcion',
		vprevia = '$this->vprevia'
    	WHERE id = $this->id;", false);
    }
	
	public function Delete()
    {
    	$this->Consultar("DELETE FROM procesos WHERE id = $this->id;", false);
    }*/
    
    /*!
     * Realiza la llamada a la clase conexion para realizar las consultas respectivas
     * \param $Consulta La cadena que contiene la consulta SQL a ejecutar
     * \param $GetLista Valor booleano que define si la consulta rellenara este proceso o devolvera una lista de resultados
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
        				//id, nombre, imagen, descripcion
	            		$this->id = $row[0];
    	        		$this->nombre = $row[1];
        	    		$this->imagen = $row[2];
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