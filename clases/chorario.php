<?php 
include("cconexion.php");

class cHorario
{
	private $con;
	//id, dia, horainicio, horafin, aula, frecuencia, modulo
	public $id;
	public $dia;
	public $horainicio;
	public $horafin;
	public $aula;
	public $frecuencia;
	public $modulo;
	
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
    	return($this->Consultar("SELECT * FROM horario;", true));
    }
    
    public function GetListaDia($pDia)
    {
    	$this->Consultar("SELECT * FROM horario WHERE dia = $pDia;", true);
    }
    
    public function GetListaAula($pAula)
    {
    	$this->Consultar("SELECT * FROM horario WHERE aula = '$pAula';", true);
    }
    
    public function GetListaModulo($pModulo)
    {
    	$this->Consultar("SELECT * FROM horario WHERE modulo = $pModulo;", true);
    }
    
    public function GetPorId($pId)
    {
    	$this->Consultar("SELECT * FROM horario WHERE id = $pId;", false);
    }
    
    /*public function Insert()
    {
    	//...
    }
    
    public function Update()
    {
    	//...
    }
	
	public function Delete()
    {
    	//...
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
        				//id, dia, horainicio, horafin, aula, frecuencia, modulo
	            		$this->id = $row[0];
    	        		$this->nombre = $row[1];
        	    		$this->uvs = $row[2];
        	    		$this->tipo = $row[3];
						$this->requisitopara = $row[4];
						$this->postgrado = $row[5];
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