<?php 
require_once("cconexion.php");

class cUsuario
{
	private $con;
	
	private $id;
	//private $consulta;
	public $nombre;
	public $clave;
	
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
    
    public function Get($pNombre, $pClave)
    {
    	$this->Consultar("SELECT * FROM usuario WHERE nombre = '$pNombre' AND clave = '$pClave';");
    }
    
    public function Insert()
    {
    	$this->Consultar("INSERT INTO usuario(clave,nombre) VALUES ('$this->nombre','$this->clave');");
    }
    
    //just in case
    /*public function Insert($pNombre, $pClave)
    {
    	$this->Consultar("INSERT INTO usuario(clave,nombre) VALUES ('$pNombre','$pClave');");
    }*/
    
    public function Update()
    {
    	$this->Consultar("UPDATE usuario SET clave = '$this->clave', nombre = '$this->nombre' WHERE id = $this->id;");
    }
	
	public function Delete()
    {
    	$this->Consultar("DELETE FROM usuario WHERE id = $this->id;");
    }
    
    function Consultar($consulta)
    {
    	$this->con->Conectar();
		// ejecutar la consulta
		if ($resultado = $this->con->mysqli->query($consulta))
		{
    		// hay registros?
    		if ($resultado->num_rows > 0) 
    		{
        		// si
        		// llenemos los datos
        		while($row = $resultado->fetch_array()) 
        		{
            		$this->id = $row[0];
            		$this->clave = $row[1];
            		$this->nombre = $row[2];
        		}
        		// liberar la memoria
    			$resultado->close();
    		}
    		else
    		{
	        	// no
        		$this->error .= "No encontre registros!";
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