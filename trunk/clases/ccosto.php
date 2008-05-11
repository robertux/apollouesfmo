<?php 
require_once("cconexion.php");

class cCosto
{
	private $con;
	
	public $id;
	public $nombre;
	public $valor;
	public $postgrado;
	
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
    
    //Obtenemos una lista (un resultset) de este objeto
    //Ojo, el objeto NO toma NINGUN valor de esta lista.
    public function GetLista()
    {
    	return($this->Consultar("SELECT * FROM costo;", true));
    }
    
    public function GetId($pId)
    {
    	$this->Consultar("SELECT * FROM costo WHERE id = $pId;", false);
    }
    
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
    		echo "Error en la consulta: $this->consulta. ".$this->con->mysqli->error;
		}
		// cerrar la conexion
		$this->con->mysqli->close();
    }
}
?>