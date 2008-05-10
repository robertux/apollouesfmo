<?php 

class cUsuario
{
	private $id;
	//private $consulta;
	public $nombre;
	public $clave;
	
	public $error;
	
	// constructor
    public function __construct() 
    {
		$this->Conectar();
		
    }
    
    // destructor
    public function __destruct() 
    {
        //..
    }
    
    //Funcion provisional, en lo que realizo el verdadero acceso a datos.
    private function Conectar()
    {
    	// set server access variables
		$host = "localhost";
		$user = "apollouser";
		$pass = "apollopwd";
		$db = "apollo";

		// craer el objeto mysqli y abrir la conexion
		$mysqli = new mysqli($host, $user, $pass, $db);
		// veamos si hay errores
		if (mysqli_connect_errno()) {
			$this->error = "No me pude conectar!";
    		die($this->error);
		} 
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
    public function Insert($pNombre, $pClave)
    {
    	$this->Consultar("INSERT INTO usuario(clave,nombre) VALUES ('$pNombre','$pClave');");
    }
    
    public function Update()
    {
    	$this->Consultar("UPDATE usuario SET clave = '$this->clave', nombre = '$this->nombre' WHERE id = $this->id");
    }
    
    function Consultar($consulta)
    {
		// ejecutar la consulta
		if ($resultado = $mysqli->query($consulta))
		{
    		// hay registros?
    		if ($resultado->num_rows > 0) 
    		{
        		// si
        		// llenemos los datos
        		while($row = $resultado->fetch_array()) 
        		{
            		$this->id = $row[0];
            		$this->nombre = $row[1];
            		$this->clave = $row[2];
        		}
    		}
    		else
    		{
	        	// no
        		$this->error .= "No encontre registros!";
    		}
	   	// liberar la memoria
    	$resultado->close();
		}
		else 
		{
    		// tiremos el error (si hay)... ojala que no :P
    		echo "Error en la consulta: $this->consulta. ".$mysqli->error;
		}
		// cerrar la conexion
		$mysqli->close();
    }
}
?>