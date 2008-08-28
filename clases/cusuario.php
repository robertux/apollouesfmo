<?php 
//include_once("cconexion.php");

/*!
 * \brief Clase que representa a los registros de la tabla docentes en la base de datos de Apollo
 * Los usuarios son capaces de iniciar y cerrar sesion dentro del sitio para obtener privilegios administrativos y agregar/editar/eliminar elementos
 */
class cUsuario
{
	/*!
	 * Objeto conexion, para hacer las consultas a la base de datos
	 */
	private $con;
	/*!
	 * Reprsenta al id del usuario
	 */
	public $id;
	//private $consulta;
	/*!
	 * Represenat el nombre del usuario
	 */
	public $nombre;
	/*!
	 * Representa la clave de acceso encriptada del usuario
	 */
	public $clave;
	/*!
	 * Representa el tipo de privilegio que posee este usuario
	 */
	public $privilegio;
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
    	$this->id = 0;
		$this->nombre = "";
		$this->clave = "";
		$this->privilegio = "";
    	$this->con = new cConexion();
		$this->tabla = "usuario";
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
     * \param $cond Parametro opcional que define una condicion WHERE a incluir en la consulta de seleccion de los usuarios
     */
    public function GetLista($cond = "")
    {
    	return($this->Consultar("SELECT * FROM usuario" . ($cond == ""? " ": " WHERE $cond ") . " ORDER BY id DESC;", true));
    }
	
	/*!
	 * Obtenemos una lista filtrada de los usuarios de la base de datos
	 * El filtro se hace para poder paginar los resultados mediante la clausula LIMIT en la consulta de seleccion
	 * \param $ini El numero del registro inicial a incluir en el rango de los resultados
	 * \param $len Cantidad de registros a incluir en el rango de los resultados
	 * \param $cond Parametro opcional que define una condicion WHERE a incluir en la consulta de seleccion de los usuarios
	 */
	public function GetListaFiltrada($ini=0, $len=10, $cond="")
	{
		return($this->Consultar("SELECT * FROM usuario" . ($cond == ""? " ": " WHERE $cond ") . "ORDER BY id DESC limit $ini, $len;", true));
	}
    
	/*!
	 * Rellenamos los datos de esta clase con el registro de la tabla docentes que coincida con el nombre y clave pasados como parametros
	 * \param $pNombre El nombre del usuario a obtener
	 * \param $pClave La clave del usuario a obtener
	 */
    public function GetPorNombreClave($pNombre, $pClave)
    {
    	return $this->Consultar("SELECT * FROM usuario WHERE nombre = '$pNombre' AND clave = '$pClave';", false);
    }
	
	/*!
	 * Rellenamos los datos de esta clase con el registro de la tabla procesos que coincida con el ID pasado como parametro
	 * \param $pId el ID del registro con el cual rellenar esta clase
	 */
	public function GetPorId($pId)
	{
		return $this->Consultar("SELECT * FROM usuario WHERE id = '$pId';", false);
	}
    /*
    public function Insert()
    {
    	$this->Consultar("INSERT INTO usuario(id, clave, nombre) VALUES ('$this->id', '$this->nombre','$this->clave');", false);
    }
    
    //?
    /*public function Insert($pNombre, $pClave)
    {
    	$this->Consultar("INSERT INTO usuario(clave,nombre) VALUES ('$pNombre','$pClave');");
    }*/
    /*
    public function Update()
    {
    	$this->Consultar("UPDATE usuario SET clave = '$this->clave', nombre = '$this->nombre' WHERE id = $this->id;", false);
    }
	
	public function Delete()
    {
    	$this->Consultar("DELETE FROM usuario WHERE id = $this->id;", false);
    }*/
    
    /*!
     * Realiza la llamada a la clase conexion para realizar las consultas respectivas
     * \param $Consulta La cadena que contiene la consulta SQL a ejecutar
     * \param $GetLista Valor booleano que define si la consulta rellenara este usuario o devolvera una lista de resultados
     */
    function Consultar($Consulta, $GetLista)
    {
    	$this->con->Conectar();
		$resultConsulta = false;
		// ejecutar la consulta
		if ($resultado = $this->con->mysqli->query($Consulta))
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
        			while($row = $resultado->fetch_array()) 
        			{
	            		$this->id = $row[0];
    	        		$this->clave = $row[1];
        	    		$this->nombre = $row[2];
						$conTemp = new cConexion();
						$conTemp->Conectar();
						$resPriv = $conTemp->mysqli->query("SELECT p.nombre FROM privilegio p INNER JOIN asignacion a ON p.id = a.privilegio INNER JOIN usuario u ON a.usuario = u.id WHERE u.id=$this->id;");
						if($resRow = $resPriv->fetch_array())
							$this->privilegio = $resRow[0];
						$conTemp->mysqli->close();
        			}
        			// liberar la memoria
    				$resultado->close();
    			}
				$resultConsulta = true;
    		}
    		else
    		{
	        	// no
        		$this->error .= "No hay resultados para mostrar!";
				return false;
    		}
		}
		else 
		{
    		// tiremos el error (si hay)... ojala que no :P
    		echo "Error en la consulta: $this->consulta. ".$this->con->mysqli->error;
		}
		// cerrar la conexion
		$this->con->mysqli->close();
		return $resultConsulta;
    }
}
?>