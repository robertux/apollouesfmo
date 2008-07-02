<?php 
include("cconexion.php");

class cInformacion
{
	private $con;
	
	public $nombre;
	public $telefono
	public $fax;
	public $email;
	
	public $error;
	
	// constructor
    public function __construct() 
    {
    	$this->con = new cConexion();
    }
    
    // destructor
    public function __destruct() 
    {
    }
    
    //En este caso, como max row = 1 en la tabla, solo UN registro podemos ingresar.
    public function GetInfo()
    {
    	return($this->Consultar("SELECT * FROM informacion;", true));
    }
    
	//No podemos insertar nada en esta tabla, solo modificar
    /*public function Insert()
    {
    	//$this->Consultar("INSERT INTO costo(nombre,valor,postgrado) VALUES ('$this->nombre',$this->valor,$this->postgrado);", false);
    }*/
    
    public function Update()
    {
    	$this->Consultar("UPDATE informacion SET nombre = '$this->nombre', telefono = $this->telefono, fax = $this->fax, email = $this->email;", false);// WHERE id = $this->id;
    }
	
	//Tampoco podemos borrar informacion
	/*
	public function Delete()
    {
    	//$this->Consultar("DELETE FROM costo WHERE id = $this->id;", false);
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
        		// si
    			if ($GetLista)
    			{
    				return ($resultado);
    			}
    			else
    			{
        			while($row = $resultado->fetch_array()) 
        			{
            			$this->nombre= $row[0];
            			$this->telefono = $row[1];
            			$this->fax = $row[2];
            			$this->email = $row[3];
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