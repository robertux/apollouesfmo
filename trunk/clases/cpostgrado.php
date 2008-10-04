<?php 

/*!
 * Incluimos la clase conexion
 */
include_once("cconexion.php");

/*!
 * \brief Clase que representa a los registros de la tabla postgrados en la base de datos de Apollo
 * Los postgrados son carreras que se estudian despues de haber cursado y aprobado una carrera universitaria
 * En esta clase se incluye los campos de la tabla postgrados
 */
class cPostGrado
{
	/*!
	 * Objeto conexion, para hacer las consultas a la base de datos
	 */
	private $con;
	/*!
	 * Reprsenta al id del postgrado
	 */	
	public $id;
	/*!
	 * Representa el nombre del postgrado
	 */
	public $nombre;
	/*!
	 * Representa la descripcion detallada de este postgrado
	 */
	public $descripcion;
	/*!
	 * Representa el codigo de carrera de este postgrado
	 */
	public $codigo;
	/*!
	 * Representa si este postgrado se esta impartiendo actualmente o es para un futuro
	 */
	public $esactual;
	/*!
	 * Variable utilizada para almacenar el mensaje de error producido por alguna consulta
	 */
	public $tabla;
	/*!
	 * Constructor de la clase
	 * Instancia el objeto Conexion y asigna el nombre de la tabla que esta clase representa
	 */
	public $error;
	
	/*!
	 * Constructor de la clase
	 * Instancia el objeto Conexion y asigna el nombre de la tabla que esta clase representa
	 */
    public function __construct() 
    {
    	$this->con = new cConexion();
		$this->tabla = "postgrado";
    }
    
    /*!
     * Destructor de la clase
     */
    public function __destruct() 
    {
        //...
    }
    
    /*!
     * Obtenemos una lista de los postgrados de la base de datos
     * \param $cond Parametro opcional que define una condicion WHERE a incluir en la consulta de seleccion de los postgrados
     */
    public function GetLista($cond="")
    {
    	if($cond != ""){
	    	$numCond = 1;
	    	if($cond == "actual") $numCond = 1;
			if($cond == "proximo") $numCond = 0;
	    	return($this->Consultar("SELECT * FROM postgrado WHERE esactual=$numCond ;", true));
		}
		else
			return($this->Consultar("SELECT * FROM postgrado;", true));
    }
	
	/*!
	 * Obtenemos una lista filtrada de los postgrados de la base de datos
	 * El filtro se hace para poder paginar los resultados mediante la clausula LIMIT en la consulta de seleccion
	 * \param $ini El numero del registro inicial a incluir en el rango de los resultados
	 * \param $len Cantidad de registros a incluir en el rango de los resultados
	 * \param $cond Parametro opcional que define una condicion WHERE a incluir en la consulta de seleccion de los postgrados
	 */
	public function GetListaFiltrada($ini=0, $len=10, $cond = "")
	{	
		$numCond = 1;
    	if($cond == "actual") $numCond = 1;
		if($cond == "proximo") $numCond = 0;	
		return($this->Consultar("SELECT * FROM postgrado WHERE esactual=$numCond ORDER BY id DESC limit $ini, $len;", true));
	}
    
    /*!
	 * Rellenamos los datos de esta clase con el registro de la tabla postgrado que coincida con el ID pasado como parametro
	 * \param $pId el ID del registro con el cual rellenar esta clase
	 */
    public function GetPorId($pId)
    {
    	$this->Consultar("SELECT * FROM postgrado WHERE id = $pId;", false);
    }
    
	/*
    //id,nombre,notaminima,totaluvs,cumminimo,abreviatura,maxalum,presentacion,descripcion
	public function Insert()
    {
    	$this->Consultar("INSERT INTO 
    	postgrado(nombre,notaminima,inicioclases,grado_obtener,poblacion,horario,inversion,descripcion,codigo,mision,vision,desarrollo,duracion,esactual)
    	VALUES ('$this->nombre',$this->notaminima,'$this->inicioclases','$this->grado_obtener','$this->poblacion', '$this->horario', $this->inversion,'$this->descripcion', '$this->codigo', '$this->mision', '$this->vision', '$this->desarrollo', '$this->duracion', $this->esactual);", false);
    }
    
    public function Update()
    {
    	$this->Consultar("UPDATE postgrado SET 
    	nombre = '$this->nombre', 
    	notaminima = $this->notaminima,
    	inicioclases = '$this->inicioclases',
    	grado_obtener= '$this->grado_obtener',
    	poblacion = '$this->poblacion',
    	horario = '$this->horario',
    	inversion = $this->inversion,    	
    	descripcion = '$this->descripcion',
		codigo = '$this->codigo',
		mision = '$this->mision',
		vision = '$this->vision',
		desarrollo = '$this->desarrollo',
		duracion = '$this->duracion'
		esactual = $this->esactual;
		
    	WHERE id = $this->id;", false);
    }
	
	public function Delete()
    {
    	$this->Consultar("DELETE FROM postgrado WHERE id = $this->id;", false);
    }
    */
    
    /*!
     * Realiza la llamada a la clase conexion para realizar las consultas respectivas
     * \param $Consulta La cadena que contiene la consulta SQL a ejecutar
     * \param $GetLista Valor booleano que define si la consulta rellenara este postgrado o devolvera una lista de resultados
     */
    function Consultar($Consulta, $GetLista)
    {
    	@$this->con->Conectar();
		// ejecutar la consulta
		if ($resultado = @$this->con->mysqli->query($Consulta))
		{
    		// hay registros?
    		if ($resultado->num_rows > 0) 
    		{
        		// si
    			if ($GetLista)
    			{
    				return ($resultado);
    			}
    			else
    			{
        			while($row = @$resultado->fetch_array()) 
        			{
	        			//id,nombre,notaminima,totaluvs,cumminimo,abreviatura,maxalum,presentacion,descripcion
    	        		$this->id = $row['id'];
        	    		$this->nombre = $row['nombre'];
						$this->descripcion = $row['descripcion'];
						$this->codigo = $row['codigo'];
						$this->esactual = $row['esactual'];
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