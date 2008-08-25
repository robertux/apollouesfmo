<?php 
include_once("cconexion.php");

class cPostGrado
{
	private $con;
	
	public $id;
	public $nombre;
	public $notaminima;
	public $inicioclases;
	public $grado_obtener;
	public $poblacion;
	public $horario;	
	
	public $inversion;
	public $descripcion;
	public $codigo;
	public $mision;
	public $vision;
	public $desarrollo;
	public $duracion;
	public $esactual;
	public $tabla;
	
	public $error;
	
	// constructor
    public function __construct() 
    {
    	$this->con = new cConexion();
		$this->tabla = "postgrado";
    }
    
    // destructor
    public function __destruct() 
    {
        //...
    }
    
    //Obtenemos una lista (un resultset) de este objeto
    //Ojo, el objeto NO toma NINGUN valor de esta lista.
    public function GetLista($cond="")
    {
    	$numCond = 1;
    	if($cond == "actual") $numCond = 1;
		if($cond == "proximo") $numCond = 0;
    	return($this->Consultar("SELECT * FROM postgrado WHERE esactual=$numCond ;", true));
    }
	
	public function GetListaFiltrada($ini=0, $len=10, $cond = "")
	{	
		$numCond = 1;
    	if($cond == "actual") $numCond = 1;
		if($cond == "proximo") $numCond = 0;	
		return($this->Consultar("SELECT * FROM postgrado WHERE esactual=$numCond ORDER BY id DESC limit $ini, $len;", true));
	}
    
    //Just for now...
    public function GetPorId($pId)
    {
    	$this->Consultar("SELECT * FROM postgrado WHERE id = $pId;", false);
    }
    
    //id,nombre,notaminima,totaluvs,cumminimo,abreviatura,maxalum,presentacion,descripcion
	public function Insert()
    {
    	$this->Consultar("INSERT INTO 
    	postgrado(nombre,notaminima,inicioclases,grado_obtener,poblacion,horario,inversion,descripcion,codigo,mision,vision,desarrollo,duracion,esactual)
    	VALUES ('$this->nombre',$this->notaminima,'$this->inicioclases','$this->grado_obtener','$this->poblacion', '$this->horario', $this->inversion,'$this->descripcion', '$this->codigo', '$this->mision', '$this->vision', '$this->desarrollo', '$this->duracion', $this->esactual);", false);
    }
    
    public function Update()
    {
    	$this->Consultar("UPDATE postgrado SET 
    	nombre = '$this->nombre', 
    	notaminima = $this->notaminima,
    	inicioclases = '$this->inicioclases',
    	grado_obtener= '$this->grado_obtener',
    	poblacion = '$this->poblacion',
    	horario = '$this->horario',
    	inversion = $this->inversion,    	
    	descripcion = '$this->descripcion',
		codigo = '$this->codigo',
		mision = '$this->mision',
		vision = '$this->vision',
		desarrollo = '$this->desarrollo',
		duracion = '$this->duracion'
		esactual = $this->esactual;
		
    	WHERE id = $this->id;", false);
    }
	
	public function Delete()
    {
    	$this->Consultar("DELETE FROM postgrado WHERE id = $this->id;", false);
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
	        			//id,nombre,notaminima,totaluvs,cumminimo,abreviatura,maxalum,presentacion,descripcion
    	        		$this->id = $row['id'];
        	    		$this->nombre = $row['nombre'];
            			$this->notaminima = $row['notaminima'];
            			$this->inicioclases = $row['inicioclases'];
            			$this->grado_obtener = $row['grado_obtener'];
            			$this->poblacion = $row['poblacion'];
            			$this->horario = $row['horario'];
						$this->inversion = $row['inversion'];
						$this->descripcion = $row['descripcion'];
						$this->codigo = $row['codigo'];
						$this->mision = $row['mision'];
						$this->vision = $row['vision'];
						$this->desarrollo = $row['desarrollo'];
						$this->duracion = $row['duracion'];
						$this->esactual = $row['esactual'];
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