<?php 

/*!
 * Incluimos la clase conexion
 */
include("cconexion.php");

/*!
 * \brief Clase que representa a los registros de la tabla costo en la base de datos de Apollo
 */
class cCosto
{
	/*!
	 * Objeto conexion, para hacer las consultas a la base de datos
	 */
	private $con;
	/*!
	 * Reprsenta al id del costo
	 */
	public $id;
	/*!
	 * Representa el nombre del costo
	 */
	public $nombre;
	/*!
	 * Representa el valor del costo
	 */ 
	public $valor;
	/*!
	 * Representa el ID del postgrado asociado con este costo
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
		$this->tabla = "costo";
    }
    
    /*!
     * Destructor de la clase
     */
    public function __destruct() 
    {
        //...
    }
    
    /*!
     * Obtenemos una lista de los costos de la base de datos
     */
    public function GetLista()
    {
    	return($this->Consultar("SELECT * FROM costo;", true));
    }
    
	/*!
	 * Obtenemos una lista de los costos de la base de datos, en base al ID del postgrado asociado con estos
	 * \param $pPostGrado el ID del postgrado asociado con los costos que se desean obtener
	 */
    public function GetListaPostGrado($pPostGrado)
    {
    	return($this->Consultar("SELECT * FROM costo WHERE postgrado = $pPostGrado;", true));
    }
    
	/*!
	 * Rellenamos los datos de esta clase con el registro de la tabla costo que coincida con el ID pasado como parametro
	 * \param $pId el ID del registro con el cual rellenar esta clase
	 */
    public function GetPorId($pId)
    {
    	$this->Consultar("SELECT * FROM costo WHERE id = $pId;", false);
    }
    
	/*
    public function Insert()
    {
    	$this->Consultar("INSERT INTO costo(nombre,valor,postgrado) VALUES ('$this->nombre',$this->valor,$this->postgrado);", false);
    }
    
    public function Update()
    {
    	$this->Consultar("UPDATE costo SET nombre = '$this->nombre', valor = $this->valor, postgrado = $this->postgrado WHERE id = $this->id;", false);
    }
	
	public function Delete()
    {
    	$this->Consultar("DELETE FROM costo WHERE id = $this->id;", false);
    }*/
    
    /*!
     * Realiza la llamada a la clase conexion para realizar las consultas respectivas
     * \param $Consulta La cadena que contiene la consulta SQL a ejecutar
     * \param $GetLista Valor booleano que define si la consulta rellenara este costo o devolvera una lista de resultados
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
        		// si
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
            			$this->valor = $row[2];
            			$this->postgrado = $row[3];
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