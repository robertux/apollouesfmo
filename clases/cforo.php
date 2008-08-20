<?php 
//include("cconexion.php");

class cForo
{
	private $con;
	
	public $subject;
	public $id;
	public $fid;
	public $forum_name;
	public $poster;
	public $posted;
	public $last_post;
	
	public $error;
	
	// constructor
    public function __construct() 
    {
    	$this->con = new cConexion();
    }
    
    // destructor
    public function __destruct() 
    {
        //...
    }
	
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