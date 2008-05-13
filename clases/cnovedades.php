<?php 
require_once("cconexion.php");

class cNovedades
{
	private $con;
	//id, titulo, vinculo, descripcion, fecha
	public $id;
	public $titulo;
	public $vinculo; 
	public $descripcion;
	public $fecha;
	
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
    	return($this->Consultar("SELECT id, titulo, vinculo, descripcion, fecha FROM novedades;", true));
    }
    
    public function GetUltimos($pNumero = 10)
    {
    	return($this->Consultar("SELECT id, titulo, vinculo, descripcion, fecha FROM novedades ORDER BY fecha DESC LIMIT $pNumero;", true));
    }
    
    public function Insert()
    {
    	$this->Consultar("INSERT INTO 
    	novedades(titulo, vinculo, descripcion, fecha)
    	VALUES ('$this->titulo','$this->vinculo','$this->descripcion','$this->fecha');", false);
    }
    
    public function Update()
    {
    	$this->Consultar("UPDATE novedades SET 
    	titulo = '$this->titulo', 
    	vinculo = '$this->vinculo',
    	descripcion = '$this->descripcion',
    	fecha= '$this->fecha',   	
    	WHERE id = $this->id;", false);
    }
	
	public function Delete()
    {
    	$this->Consultar("DELETE FROM novedades WHERE id = $this->id;", false);
    }
    
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
        				//id, titulo, vinculo, descripcion, fecha
	            		$this->id = $row[0];
    	        		$this->titulo = $row[1];
        	    		$this->vinculo = $row[2];
        	    		$this->descripcion = $row[3];
						$this->fecha = $row[4];
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