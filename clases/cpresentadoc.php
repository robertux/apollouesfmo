<?php 

/*!
 * Incluimos la clase conexion
 */
include("cconexion.php");

/*!
 * \brief Clase que representa a los registros de la tabla presentadoc en la base de datos de Apollo
 * PresentaDoc repreesnta los documentos que debe presentar un aspirante a una maestria, como requisito para la inscripcion en la misma
 */
class cPresentaDoc
{
	/*!
	 * Objeto conexion, para hacer las consultas a la base de datos
	 */
	private $con;
	//id, nombre
	/*!
	 * Reprsenta al id del documento
	 */
	public $id;
	/*!
	 * Representa el nombre del documento
	 */
	public $nombre;
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
		$this->tabla = "presantadoc";
    }
    
    /*!
     * Destructor de la clase
     */
    public function __destruct() 
    {
        //..
    }
    
    /*!
     * Obtenemos una lista de los documentos de la base de datos
     */
    public function GetLista()
    {
    	return($this->Consultar("SELECT * FROM presentadoc;", true));
    }
    
	/*!
	 * Rellenamos los datos de esta clase con el registro de la tabla presentadoc que coincida con el ID pasado como parametro
	 * \param $pId el ID del registro con el cual rellenar esta clase
	 */
    public function GetPorId($pId)
    {
    	$this->Consultar("SELECT * FROM presentadoc WHERE id = $pId;", false);
    }
    
	/*
    public function Insert()
    {
    	$this->Consultar("INSERT INTO presentadoc(descripcion) VALUES ('$this->descripcion');", false);
    }
    
    public function Update()
    {
    	$this->Consultar("UPDATE presentadoc SET descripcion = '".$this->descripcion."' WHERE id = ".$this->id, false);
    }
	
	public function Delete()
    {
    	$this->Consultar("DELETE FROM presentadoc WHERE id = $this->id;", false);
    }*/
    
    /*!
     * Realiza la llamada a la clase conexion para realizar las consultas respectivas
     * \param $Consulta La cadena que contiene la consulta SQL a ejecutar
     * \param $GetLista Valor booleano que define si la consulta rellenara este documento o devolvera una lista de resultados
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
        				//id, descripcion
	            		$this->id = $row[0];
    	        		$this->descripcion = $row[1];
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