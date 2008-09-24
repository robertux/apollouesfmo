<?php

/*!
 *\brief Clase que permite la conexion a la base de datos de Apollo y la ejecucion de consultas SQL
 */
class cConexion
{
	/*!
	 * Nombre del servidor de bases de datos a utilizar para la conexion
	 */
	private $host = "localhost";
	/*!
	 * Nombre del usuario con el cual se conecta a la base de datos
	 */
	private $user = "apollouser";
	/*!
	 * Clave del usuario con la cual se conecta a la base de datos
	 */
	private $pass = "apollopwd";
	/*!
	 * Nombre de la base de datos a la cual conectarse dentro del servidor
	 */
	private $db = "apollo";

	/*!
	 * Objeto que encapsula las funciones basicas para el manejo de bases de datos de MySql
	 */	
	public $mysqli;
	/*!
	 * Variable utilizada para almacenar el mensaje de error producido por alguna consulta
	 */ 
    public $error;
	
	/*!
	 * Establece una conexion con el servidor de la base de datos usando los miembros de esta clase como parametros de conexion
	 */
    public function Conectar()
    {
    	try{
			// crear el objeto mysqli y abrir la conexion
			@$this->mysqli = new mysqli($this->host, $this->user, $this->pass, $this->db);			
		}
		catch(Exception $e){
			//throw new Exception($this->error);
			//exit();
		}
    }
	
	/*!
	 * Getter del miembro host.
	 * Devuelve el valor del miembro privado host
	 */
	public function Host()
	{
		return $this->host;
	}
	
	/*!
	 * Getter del miembro user
	 * Devuelve el valor del miembro privado user
	 */
	public function User()
	{
		return $this->user;
	}
    
	/*!
	 * Getter del miembro pass
	 * Devuelve el valor del miembro privado pass
	 */
	public function Pass()
	{
		return $this->pass;
	}
	
	/*!
	 * Getter del miembro db
	 * Devuelve el valor del miembro privado db
	 */
	public function Db()
	{
		return $this->db;
	}
}