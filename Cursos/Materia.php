<?php
    Class Materia{
    	
		public $correl;
		public $codigo;
		public $nombre;
		public $uvs;
		public $prereq;
		
		public function Materia($pCorrel, $pCodigo, $pNombre, $pUvs, $pPrereq){
			$this->correl = $pCorrel;
			$this->codigo = $pCodigo;
			$this->nombre = $pNombre;
			$this->uvs = $pUvs;
			$this->prereq = $pPrereq;
		}
		
		public function GetAsPost(){
			$pst = new InnerInnerPost($this->codigo . $this->nombre, $this->GenerarNotas(), 500);
			return $pst->ToString();
			//return "contenido de la materia ". $this->nombre . "<br />";
		}
		
		public function GenerarNotas(){
			return"
			<table width='80%' border='1px'>
    <tr>
        <th>Porcentaje
        </th>
        <td>20%
        </td>
        <td>20%
        </td>
        <td>20%
        </td>
        <td>20%
        </td>
        <td>20%
        </td>
        <td>
        </td>
        <td>
        </td>
        <td>Total
        </td>
        <td>Promedio
        </td>
    </tr>
    <tr>
        <th>Valor
        </th>
        <td>7.0
        </td>
        <td>10.0
        </td>
        <td>6.55
        </td>
        <td>7.62
        </td>
        <td>
        </td>
        <td>
        </td>
        <td>
        </td>
        <td>
        </td>
        <td>
        </td>
    </tr>
</table>
			";
		}
    }
?>
