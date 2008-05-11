<?php 
require_once("cconexion.php");

class cRequisito
{
	private $con;
	
	public $id;
	public $nombre;
	public $postgrado;
	
	public $error;
	
	// constructor
    public function __construct() 
    {
    	$this->con = new cConexion();
		//$this->con->Conectar();
    }
    
    // destructor
    public function __destruct() 
    {
        //..
    }
    
    //Obtenemos una lista (un resultset) de este objeto
    //Ojo, el objeto NO toma NINGUN valor de esta lista.
    public function GetLista()
    {
    	return($this->Consultar("SELECT * FROM requisito;", true));
    }
    
    public function GetId($pId)
    {
    	$this->Consultar("SELECT * FROM requisito WHERE id = $pId;");
    }
    
    public function GetNombre($pNombre)
    {
    	$this->Consultar("SELECT * FROM requisito WHERE nombre = '$pNombre';");
    }
    
    public function GetPostGrado($pPostGrado)
    {
    	$this->Consultar("SELECT * FROM requisito WHERE postgrado = $pPostGrado;");
    }
    
    public function Insert()
    {
    	$this->Consultar("INSERT INTO requisito(nombre,postgrado) VALUES ('$this->nombre',$this->postgrado);");
    }
    
    public function Update()
    {
    	$this->Consultar("UPDATE requisito SET nombre = '$this->nombre', postgrado = $this->postgrado WHERE id = $this->id;");
    }
	
	public function Delete()
    {
    	$this->Consultar("DELETE FROM requisito WHERE id = $this->id;");
    }
    
    function Consultar($Consulta, $GetLista)
    {
    	$this->con->Conectar();
		// ejecutar la consulta
		if ($resultado = $this->con->mysqli->query($consulta))
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