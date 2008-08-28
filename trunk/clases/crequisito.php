<?php 

/*!
 * Incluimos la clase conexion
 */
include("cconexion.php");

/*!
 * \brief Clase que representa a los registros de la tabla requisito en la base de datos de Apollo
 */
class cRequisito
{
	/*!
	 * Objeto conexion, para hacer las consultas a la base de datos
	 */
	private $con;
	/*!
	 * Reprsenta al id del requisito
	 */
	public $id;
	/*!
	 * Reprsenta al nombre del requisito
	 */
	public $nombre;
	/*!
	 * Reprsenta al postgrado asociado con el requisito
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
		$this->tabla = "requisito";
    }
    
    /*!
     * Destructor de la clase
     */
    public function __destruct() 
    {
        //..
    }
    
    /*!
     * Obtenemos una lista de los requisitos de la base de datos
     */
    public function GetLista()
    {
    	return($this->Consultar("SELECT * FROM requisito;", true));
    }
    
	/*!
     * Obtenemos una lista de los requisitos de la base de datos, en base al ID de un postgrado
     * \param $pPostgrado El ID del postgrado con el cual filtrar los resultados
     */
    public function GetListaPostGrado($pPostGrado)
    {
    	return($this->Consultar("SELECT * FROM requisito WHERE postgrado = $pPostGrado;", true));
    }
    
	/*!
	 * Rellenamos los datos de esta clase con el registro de la tabla requisito que coincida con el ID pasado como parametro
	 * \param $pId el ID del registro con el cual rellenar esta clase
	 */
    public function GetPorId($pId)
    {
    	$this->Consultar("SELECT * FROM requisito WHERE id = $pId;", false);
    }
    
	/*!
	 * Rellenamos los datos de esta clase con el registro de la tabla requisito que coincida con el nombre pasado como parametro
	 * \param $pNombre el nombre del registro con el cual rellenar esta clase
	 */
    public function GetPorNombre($pNombre)
    {
    	$this->Consultar("SELECT * FROM requisito WHERE nombre = '$pNombre';", false);
    }
    
	/*!
	 * Rellenamos los datos de esta clase con el registro de la tabla requisito que coincida con el ID del postgrado pasado como parametro
	 * \param $pPostgrado el ID del postgrado en el registro con el cual rellenar esta clase
	 */
    public function GetPorPostGrado($pPostGrado)
    {
    	$this->Consultar("SELECT * FROM requisito WHERE postgrado = $pPostGrado;", false);
    }
    /*
    public function Insert()
    {
    	$this->Consultar("INSERT INTO requisito(nombre,postgrado) VALUES ('$this->nombre',$this->postgrado);", false);
    }
    
    public function Update()
    {
    	$this->Consultar("UPDATE requisito SET nombre = '$this->nombre', postgrado = $this->postgrado WHERE id = $this->id;", false);
    }
	
	public function Delete()
    {
    	$this->Consultar("DELETE FROM requisito WHERE id = $this->id;", false);
    }*/
    
    /*!
     * Realiza la llamada a la clase conexion para realizar las consultas respectivas
     * \param $Consulta La cadena que contiene la consulta SQL a ejecutar
     * \param $GetLista Valor booleano que define si la consulta rellenara este requisito o devolvera una lista de resultados
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
            			$this->nombre = $row[1];
            			$this->postgrado = $row[2];
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