<?php 
include("cconexion.php");

class cGeneral
{
	private $con;
	
	public $titulo;
	public $contenido;
	
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
    
    public function GetLista()
    {
    	return($this->Consultar("SELECT titulo, contenido FROM general;", true));
    }
	
	public function GetPorTitulo($pTitulo)
    {
    	$this->Consultar("SELECT * FROM general WHERE titulo = '$pTitulo';", false);
    }
    
	//No podemos insertar nada en esta tabla, solo modificar
    public function Insert()
    {
    	$this->Consultar("INSERT INTO general(titulo,contenido) VALUES ('$this->titulo','$this->contenido');", false);
    }
    
    public function Update()
    {
    	$this->Consultar("UPDATE general SET contenido = '$this->contenido' WHERE titulo = '$this->titulo';", false);
    }

	public function Delete()
    {
    	$this->Consultar("DELETE FROM general WHERE titulo = '$this->titulo';", false);
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
        		// si
    			if ($GetLista)
    			{
    				return ($resultado);
    			}
    			else
    			{
        			while($row = $resultado->fetch_array()) 
        			{
            			$this->titulo= $row[0];
            			$this->contenido = $row[1];
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