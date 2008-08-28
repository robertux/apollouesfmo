<?php 
//include("cconexion.php");

/*!
 * \brief Clase que representa al foro implementado en la unidad
 */
class cForo
{
	/*!
	 * Objeto conexion, para hacer las consultas a la base de datos
	 */
	private $con;
	/*!
	 * Representa el asunto del mensaje del foro
	 */
	public $subject;
	/*!
	 * Representa el id de este registro
	 */
	public $id;
	/*!
	 * Representa un id secundario utilizado internamente por el foro
	 */
	public $fid;
	/*!
	 * Representa el nombre de la seccion del foro a la que pertenece este registro
	 */
	public $forum_name;
	/*!
	 * Representa el nombre del autor de este post
	 */
	public $poster;
	/*!
	 * 
	 */
	public $posted;
	/*!
	 * 
	 */
	public $last_post;
	/*!
	 * Variable utilizada para almacenar el mensaje de error producido por alguna consulta
	 */
	public $error;
	
	/*!
	 * Constructor. Inicializa la conexion
	 */
    public function __construct() 
    {
    	$this->con = new cConexion();
    }
    
    /*!
     * Destructor
     */
    public function __destruct() 
    {
        //...
    }
	
	/*!
	 * Devuelve una lista conteniendo los ultimos posts del foro
	 */
    public function GetListaPosts()
    {
	//Borrado por motivos de erroes extravagantes
	/*$consulta = $this->Consultar(
	"SELECT t.id, t.poster, t.subject, t.posted, t.last_post, f.id AS fid, f.forum_name
	FROM foro_topics AS t 
	INNER JOIN foro_forums AS f ON f.id=t.forum_id 
	JOIN foro_forum_perms AS fp ON (fp.forum_id=f.id AND fp.group_id=3)
	WHERE (fp.read_forum IS NULL OR fp.read_forum=0)");*/
	$consulta = $this->Consultar("SELECT t.subject AS fid, f.forum_name
FROM foro_topics AS t INNER JOIN foro_forums AS f ON f.id=t.forum_id
WHERE (t.num_views<=1)");
	//consulta original que utiliza el foro, medio funciona.
	/*$consulta = $this->Consultar('SELECT t.id, t.poster, t.subject, t.posted, t.last_post, f.id AS fid, f.forum_name FROM '.$this->prefijo.'topics AS t INNER JOIN '.$this->prefijo.'forums AS f ON f.id=t.forum_id LEFT JOIN '.$this->prefijo.'forum_perms AS fp ON (fp.forum_id=f.id AND fp.group_id=3) WHERE (fp.read_forum IS NULL OR fp.read_forum=1) DESC LIMIT'.$pNum);*/
		return $consulta;
    }

    /*!
     * Realiza la llamada a la clase conexion para realizar las consultas respectivas
     * \param $Consulta La cadena que contiene la consulta SQL a ejecutar
     */    
    function Consultar($Consulta)
    {
    	$this->con->Conectar();
		// ejecutar la consulta
		if ($resultado = $this->con->mysqli->query($Consulta))
		{
    		// hay registros?
    		if ($resultado->num_rows > 0) 
    		{
   				return ($resultado);
    		}
    		else
    		{
        		$this->error .= "No hay resultados para mostrar!";
    		}
		}
		else 
		{
    		// tiremos el error (si hay)... ojala que no :P
    		$this->resultado .=  "Error en la consulta: $this->consulta. ".$this->con->mysqli->error;
		}
		// cerrar la conexion
		$this->con->mysqli->close();
    }
}
?>