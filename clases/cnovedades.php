<?php 

/*!
 * Incluimos la clase conexion
 */
require_once("cconexion.php");

/*!
 * \brief Clase que representa a los registros de la tabla docentes en la base de datos de Apollo
 * Las novedades son noticias, informacion relevante asociada con la unidad de postgrados, ordenada en base a la fecha iniciando por la mas reciente.
 * En esta clase se incluye el titulo, fecha y contenido de dichas noticias.
 */
class cNovedades
{
	/*!
	 * Objeto conexion, para hacer las consultas a la base de datos
	 */
	public $con;
	//id, titulo, vinculo, descripcion, fecha
	/*!
	 * Reprsenta al id del docente
	 */
	public $id;
	/*!
	 * Representa el titulo de la noticia
	 */
	public $titulo;
	/*!
	 * Representa el hipervinculo a una pagina web externa que explica con detalle la noticia
	 */
	public $vinculo; 
	/*!
	 * Representa la informacion detallada de la noticia
	 */ 
	public $descripcion;
	/*!
	 * Representa la fecha de publicacion de la noticia
	 */
	public $fecha;
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
		$this->tabla = "novedades";
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
	 * Rellenamos los datos de esta clase con el registro de la tabla novedades que coincida con el ID pasado como parametro
	 * \param $pId el ID del registro con el cual rellenar esta clase
	 */
    public function GetPorId($pId)
    {
    	return($this->Consultar("SELECT id, titulo, vinculo, descripcion, fecha FROM novedades WHERE id = $pId;", false));
    }
	
	/*!
	 * Rellenamos los datos de esta clase con el registro de la tabla novedades que coincida con el titulo pasado como parametro
	 * \param $pTitulo el titulo del registro con el cual rellenar esta clase
	 */
	public function GetPorTitulo($pTitulo)
    {
    	return($this->Consultar("SELECT id, titulo, vinculo, descripcion, fecha FROM novedades WHERE titulo = '$pTitulo';", true));
    }
    
    /*!
     * Obtenemos una lista de las novedades de la base de datos
     * \param $cond Parametro opcional que define una condicion WHERE a incluir en la consulta de seleccion de las novedades
     */
    public function GetLista($cond="")
    {
    	return($this->Consultar("SELECT id, titulo, vinculo, descripcion, fecha FROM novedades"  . ($cond == ""? " ": " WHERE $cond ") . "ORDER BY fecha DESC;", true));
    }
	
	/*!
	 * Obtenemos una lista filtrada de las novedades de la base de datos
	 * El filtro se hace para poder paginar los resultados mediante la clausula LIMIT en la consulta de seleccion
	 * \param $ini El numero del registro inicial a incluir en el rango de los resultados
	 * \param $len Cantidad de registros a incluir en el rango de los resultados
	 * \param $cond Parametro opcional que define una condicion WHERE a incluir en la consulta de seleccion de las novedades
	 */
	public function GetListaFiltrada($ini=0, $len=10, $cond="")
	{
		return($this->Consultar("SELECT id, titulo, vinculo, descripcion, fecha FROM novedades" . ($cond == ""? " ": " WHERE $cond ") . "ORDER BY fecha DESC limit $ini, $len;", true));
	}
    
	/*!
	 * Devuelve una lista con los ultimos registros de la tabla novedades
	 * \param $pNumero La cantidad de registros a devolver en la lista de resultados
	 */
    public function GetUltimos($pNumero = 10)
    {
    	return($this->Consultar("SELECT id, titulo, vinculo, descripcion, fecha FROM novedades ORDER BY fecha DESC LIMIT $pNumero;", true));
    }
    
	/*!
	 * Devuelve una lista con los ultimos registros de la tabla novedades, especificamente para ser usado en el widget de la pagina principal
	 * \param $pNumero La cantidad de registros a devolver en la lista de resultados
	 */
    public function GetParaWidget($pNumero = 5)
    {
    	return($this->Consultar("SELECT titulo, vinculo FROM novedades ORDER BY fecha DESC LIMIT $pNumero;", true));
    }
    /*
    public function Insert()
    {
    	$this->Consultar("INSERT INTO 
    	novedades(titulo, vinculo, descripcion, fecha)
    	VALUES ('$this->titulo','$this->vinculo','$this->descripcion','$this->fecha');", false);
    }
    
    public function Update()
    {
    	$this->Consultar("UPDATE novedades SET 
    	titulo = '$this->titulo', 
    	vinculo = '$this->vinculo',
    	descripcion = '$this->descripcion',
    	fecha= '$this->fecha'  	
    	WHERE id = $this->id;", false);
    }
	
	public function Delete()
    {
    	$this->Consultar("DELETE FROM novedades WHERE id = $this->id;", false);
    }*/
    
    /*!
     * Realiza la llamada a la clase conexion para realizar las consultas respectivas
     * \param $Consulta La cadena que contiene la consulta SQL a ejecutar
     * \param $GetLista Valor booleano que define si la consulta rellenara esta novedad o devolvera una lista de resultados
     */
    public function Consultar($Consulta, $GetLista)
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
        				//id, titulo, vinculo, descripcion, fecha
	            		$this->id = $row[0];
    	        		$this->titulo = $row[1];
        	    		$this->vinculo = $row[2];
        	    		$this->descripcion = $row[3];
						$this->fecha = $row[4];
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