<?php 
include_once("cconexion.php");

class cEvento
{
	private $con;
	//id, apellidos, nombres, gradoacademico, usuario
	public $id;
	public $postgrado;
	public $titulo;
	public $fecha;
	public $lugar;
	public $detalle;
	public $tabla;
	
	public $error;
	
	// constructor
    public function __construct() 
    {
    	$this->con = new cConexion();
		$this->tabla = "evento";
		//$this->con->Conectar();
    }
    
    // destructor
    public function __destruct() 
    {
        //..
    }
    
    //Obtenemos una lista (un resultset) de este objeto
    //Ojo, el objeto NO toma NINGUN valor de esta lista.
    public function GetLista($cond="")
    {
    	return($this->Consultar("SELECT * FROM evento" . ($cond == ""? " ": " WHERE $cond ") . "ORDER BY id DESC;", true));
    }
	
	public function GetListaFiltrada($ini=0, $len=10, $cond="")
	{
		return($this->Consultar("SELECT * FROM evento" . ($cond == ""? " ": " WHERE $cond ") . "ORDER BY id DESC limit $ini, $len;", true));
	}
    
    public function GetPorId($pId)
    {
    	$this->Consultar("SELECT * FROM evento WHERE id = $pId;", false);
    }
        
    /*public function GetNombre($pNombre)
    {
    	$this->Consultar("SELECT * FROM materia WHERE nombre = '$pNombre';", false);
    }
    
    public function GetPostGrado($pPostGrado)
    {
    	$this->Consultar("SELECT * FROM materia WHERE postgrado = $pPostGrado;", false);
    }
    
    public function Insert()
    {
    	$this->Consultar("INSERT INTO materia(nombre,uvs,tipo,requisitopara,postgrado) VALUES ('$this->nombre',$this->uvs,$this->tipo,'$this->requisitopara',$this->postgrado);", false);
    }
    
    public function Update()
    {
    	$this->Consultar("UPDATE materia SET nombre = '$this->nombre', uvs = $this->uvs, tipo = $this->tipo, requisitopara = '$this->requisitopara', postgrado = $this->postgrado WHERE id = $this->id;", false);
    }
	
	public function Delete()
    {
    	$this->Consultar("DELETE FROM materia WHERE id = $this->id;", false);
    }*/
    
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
        				////id, apellidos, nombres, gradoacademico, usuario
	            		$this->id = $row[0];
    	        		$this->postgrado = $row[1];
        	    		$this->titulo = $row[2];
        	    		$this->fecha = $row[3];
						$this->lugar = $row[4];
						$this->detalle = $wor[5];
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