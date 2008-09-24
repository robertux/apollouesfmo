<?php 

/*!
 * Incluimos la clase conexion
 */
include_once("cconexion.php");

/*!
 * \brief Clase que representa a los registros de la tabla docentes en la base de datos de Apollo
 * Los docentes son los que imparten las catedras en las maestrias actuales(vigentes).
 * En esta clase se incluye cierta informacion del perfil de dicho docente para el conocimiento de los demas
 */
class cDocente
{
	/*!
	 * Objeto conexion, para hacer las consultas a la base de datos
	 */
	private $con;
	//id, apellidos, nombres, gradoacademico, usuario
	/*!
	 * Reprsenta al id del docente
	 */
	public $id;
	/*!
	 * Representa los apellidos del docente
	 */
	public $apellidos;
	/*!
	 * Representa los nombres del docente
	 */
	public $nombres;
	/*!
	 * Representa el grado academico (Licenciado? Ingeniero? Master? ...) del docente
	 */
	public $gradoacademico;
	/*!
	 * Representa el usuario asociado con este docente, del cual hara uso para iniciar sesion en la pagina
	 */
	public $usuario;
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
		$this->tabla = "docente";
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
     * Obtenemos una lista de los docentes de la base de datos
     * \param $cond Parametro opcional que define una condicion WHERE a incluir en la consulta de seleccion de los docentes
     */
    public function GetLista($cond="")
    {
    	return($this->Consultar("SELECT * FROM docente" . ($cond == ""? " ": " WHERE $cond ") . ";", true));
    }
	
	/*!
	 * Obtenemos una lista filtrada de los docentes de la base de datos
	 * El filtro se hace para poder paginar los resultados mediante la clausula LIMIT en la consulta de seleccion
	 * \param $ini El numero del registro inicial a incluir en el rango de los resultados
	 * \param $len Cantidad de registros a incluir en el rango de los resultados
	 * \param $cond Parametro opcional que define una condicion WHERE a incluir en la consulta de seleccion de los docentes
	 */
	public function GetListaFiltrada($ini=0, $len=10, $cond="")
	{
		return($this->Consultar("SELECT * FROM docente" . ($cond == ""? " ": " WHERE $cond ") . "ORDER BY id limit $ini, $len;", true));
	}
    
	/*!
	 * Rellenamos los datos de esta clase con el registro de la tabla docentes que coincida con el ID pasado como parametro
	 * \param $pId el ID del registro con el cual rellenar esta clase
	 */
    public function GetPorId($pId)
    {
    	$this->Consultar("SELECT * FROM docente WHERE id = $pId;", false);
    }

	/*!
	 * Rellenamos los datos de esta clase con el registro de la tabla docentes que coincida con el ID del usuario pasado como parametro
	 * \param $pUsuario el ID del usuario asociado con el docente
	 */
    public function GetPorUsuario($pUsuario)
    {
    	$this->Consultar("SELECT * FROM docente WHERE usuario = $pUsuario;", false);
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
     * \param $GetLista Valor booleano que define si la consulta rellenara este docente o devolvera una lista de resultados
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
        				////id, apellidos, nombres, gradoacademico, usuario
	            		$this->id = $row[0];
    	        		$this->apellidos = $row[1];
        	    		$this->nombres = $row[2];
        	    		$this->gradoacademico = $row[3];
						$this->usuario = $row[4];
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