<?php 

/*!
 * Incluimos la clase conexion
 */
include("cconexion.php");

/*!
 * \brief Clase que representa a los registros de la tabla alumnos en la base de datos de Apollo
 */
class cAlumno
{
	/*!
	 * Objeto conexion, para hacer las consultas a la base de datos
	 */
	private $con;
	//id, apellidos, nombres, direccion, telefono, fechanacimiento, usuario
	/*!
	 * Reprsenta al id del alumno
	 */
	public $id;
	/*!
	 * Representa a los apellidos del alumno
	 */
	public $apellidos;
	/*!
	 * Representa a los nombres del alumno
	 */
	public $nombres;
	/*!
	 * Representa la direccion donde vive el alumno
	 */
	public $direccion;
	/*!
	 * Representa el numero de telefono del alumno
	 */
	public $telefono;
	/*!
	 * Representa la fecha de nacimiento del alumno
	 */
	public $fechanacimiento;
	/*!
	 * Representa el usuario asociado con este alumno, del cual hara uso para iniciar sesion en la pagina
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
		$this->tabla = "alumno";
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
     * Obtenemos una lista de los alumnos de la base de datos
     */
    public function GetLista()
    {
    	return($this->Consultar("SELECT * FROM usuario;", true));
    }
    
	/*!
	 * Rellenamos los datos de esta clase con el registro de la tabla alumnos que coincida con el ID pasado como parametro
	 * \param $pId el ID del registro con el cual rellenar esta clase
	 */
    public function GetPorId($pId)
    {
    	$this->Consultar("SELECT * FROM usuario WHERE id = $pId;", false);
    }
    
	/*!
	 * Rellenamos los datos de esta clase con el registro de la tabla alumnos que coincida con el ID del usuario pasado como parametro
	 * \param $pUsuario el ID del usuario asociado con el alumno
	 */
    public function GetPorUsuario($pUsuario)
    {
    	$this->Consultar("SELECT * FROM usuario WHERE usuario = $pUsuario;", false);
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
     * \param $GetLista Valor booleano que define si la consulta rellenara este alumno o devolvera una lista de resultados
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
        				//id, apellidos, nombres, direccion, telefono, fechanacimiento, usuario
	            		$this->id = $row[0];
    	        		$this->apellidos = $row[1];
        	    		$this->nombres = $row[2];
        	    		$this->direccion = $row[3];
						$this->telefono = $row[4];
						$this->fechanacimiento = $row[5];
						$this->usuario = $row[6];
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