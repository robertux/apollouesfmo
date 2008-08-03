<?php 
//include("cconexion.php");

class cUtileria
{
	//que pena... poner publico esto :$
	public $con;
	//id, titulo, vinculo, descripcion
	public $id;
	public $titulo;
	public $vinculo; 
	public $descripcion;
	public $tabla;
	
	public $error;
	
	// constructor
    public function __construct() 
    {
    	$this->con = new cConexion();
		$this->tabla = "utileria";
		//$this->con->Conectar();
    }
    
    // destructor
    public function __destruct() 
    {
        //..
    }
    
    public function GetPorId($pId)
    {
    	return($this->Consultar("SELECT id, titulo, vinculo, descripcion FROM utileria WHERE id = $pId;", false));
    }
    
    //Obtenemos una lista (un resultset) de este objeto
    //Ojo, el objeto NO toma NINGUN valor de esta lista.
    public function GetLista()
    {
    	return($this->Consultar("SELECT id, titulo, vinculo, descripcion FROM utileria;", true));
    }
	
	public function GetListaFiltrada($ini=0, $len=10)
	{
		return($this->Consultar("SELECT * FROM utileria ORDER BY id limit $ini, $len;", true));
	}
	
	public function GetListaOrden()
    {
    	return($this->Consultar("SELECT id, titulo, vinculo, descripcion FROM utileria GROUP BY id DESC;", true));
    }
    
    public function GetUltimos($pNumero = 10)
    {
    	return($this->Consultar("SELECT id, titulo, vinculo, descripcion FROM utileria DESC LIMIT $pNumero;", true));
    }
    
    public function Insert()
    {
    	$this->Consultar("INSERT INTO 
    	utileria(titulo, vinculo, descripcion, fecha)
    	VALUES ('$this->titulo','$this->vinculo','$this->descripcion');", false);
    }
    
    public function Update()
    {
    	$this->Consultar("UPDATE utileria SET 
    	titulo = '$this->titulo', 
    	vinculo = '$this->vinculo',
    	descripcion = '$this->descripcion'   	
    	WHERE id = $this->id;", false);
    }
	
	public function Delete()
    {
    	$this->Consultar("DELETE FROM utileria WHERE id = $this->id;", false);
    }
    
    //en este caso es necesario hacer publica esta funcion.
    public function Consultar($Consulta, $GetLista)
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
        				//id, titulo, vinculo, descripcion
	            		$this->id = $row[0];
    	        		$this->titulo = $row[1];
        	    		$this->vinculo = $row[2];
        	    		$this->descripcion = $row[3];
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