<?php 

/*!
 * Incluimos la clase conexion
 */
require_once("cconexion.php");

/*!
 * \brief Clase que representa a los registros de la tabla general en la base de datos de Apollo
 * La tabla general contiene registros donde se guarda informacion de ambito general del sitio. Por ejemplo el acerca de o la informacion de contacto.
 * Aca se guarda tambien la informacion presentada en la pagina de AcercaDe
 */
class cGeneral
{
	/*!
	 * Objeto conexion, para hacer las consultas a la base de datos
	 */
	private $con;
	/*!
	 * Representa al titulo del mensaje
	 */ 
	public $titulo;
	/*!
	 * Representa el contenido del mensaje
	 */
	public $contenido;
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
		$this->tabla = "general";
    }
    
    /*!
     * Destructor de la clase
     */
    public function __destruct() 
    {
    }
    
	/*!
     * Obtenemos una lista de los mensajes de la tabla general, en la base de datos
     */
    public function GetLista()
    {
    	return($this->Consultar("SELECT titulo, contenido FROM general;", true));
    }
	
	/*!
	 * Rellenamos los datos de esta clase con el registro de la tabla docentes que coincida con el titulo pasado como parametro
	 * \param $pTitulo el titulo del registro con el cual rellenar esta clase
	 */
	public function GetPorTitulo($pTitulo)
    {
    	$this->Consultar("SELECT * FROM general WHERE titulo = '$pTitulo';", false);
    }
    /*
	//No podemos insertar nada en esta tabla, solo modificar
    public function Insert()
    {
    	$this->Consultar("INSERT INTO general(titulo,contenido) VALUES ('$this->titulo','$this->contenido');", false);
    }
    
    public function Update()
    {
    	$this->Consultar("UPDATE general SET contenido = '$this->contenido' WHERE titulo = '$this->titulo';", false);
    }

	public function Delete()
    {
    	$this->Consultar("DELETE FROM general WHERE titulo = '$this->titulo';", false);
    }*/
    
    /*!
     * Realiza la llamada a la clase conexion para realizar las consultas respectivas
     * \param $Consulta La cadena que contiene la consulta SQL a ejecutar
     * \param $GetLista Valor booleano que define si la consulta rellenara este registro general o devolvera una lista de resultados
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
            			$this->titulo= $row[0];
            			$this->contenido = $row[1];
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
    		//echo "Error en la consulta: $this->consulta. ".@$this->con->mysqli->error;
		}
		// cerrar la conexion
		@$this->con->mysqli->close();
    }
}
?>