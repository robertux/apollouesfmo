<?php

/*!
 * \brief Clase que representa a una tabla en la que se muestra una serie de filas con informacion editable y de diferentes tipos
 * Estos tipos pueden ser texto plano, numerico, fecha, file uplaods y texto enriquecido
 */
class VerticalTable{
    
	/*!
	 * Arreglo de objetos VerticalTableRow
	 */
	public $rows = array();
	/*!
	 * Valor del borde de la tabla
	 */
	public $border;
	/*!
	 * Valor del ancho de la tabla
	 */
	public $width;

	/*!
	 * Constructor. Inicializa sus campos
	 * \param $pWidth Define el ancho inicial de la tabla
	 */
	public function VerticalTable($pWidth = "100%"){
		$this->border = $pBorder;
		$this->width = $pWidth;
	}

	/*!
	 * Genera y devuelve el codigo HTML que representa la tabla, usando la informacion de sus miembros
	 */
	public function ToString(){
		$returnValue = "<table width='$this->width'>";
		foreach($this->rows as $row){
			$returnValue .= $row->ToString();
		}
		$returnValue .= "</table>";
		return $returnValue;
	}

}


/*!
 * \brief Clase que representa a una fila que forma parte de una VerticalTable
 * Esta puede contener una serie variada de valores pero por defecto viene configurara para mostrar nada mas dos, un nombre y un valor modificable, el cual puede ser de diferentes tipos
 */
class VerticalTableRow{

	/*!
	 * Arreglo de objetos VerticalTableCell que contienen la informacion de la fila
	 */	
	public $cells = array();
	
	/*!
	 * Constructor. Inicializa sus miembros en base a los parametros recibidos
	 * \param $pCells, Lista de valores con los cuales generar las celdas de la tabla. Comunmense solo son dos
	 * \param $id El id del registro que representa esta fila y la tabla a la que ella pertenece
	 * \param typeContent Cadena que define el tipo de contenido de la fila
	 * \param $maxLength Longitud maxima del control INPUT de la fila
	 */
	public function VerticalTableRow($pCells, $id=-1, $typeContent = "text", $maxLength = ""){
		/*foreach($pCells as $pCell){
			$this->cells[] = new VerticalTableCell($pCell);
		}*/		
		$this->cells[] = new VerticalTableCell($pCells[0], true);
		if($maxLength != "")
			$maxLength = " maxlength='" . $maxLength . "'";
		//!En base al tipo de contenido que se va a mostrar, asi es la etiqueta que se genera para la segunda celda.
		switch($typeContent){
		case "text":
			$this->cells[] = new VerticalTableCell("<input id='input-$id' name='input-$id' class='PostInput' type='text' value='" . $pCells[1] . "' disabled='true' $maxLength />", false);
			break;
		case "area":
			$this->cells[] = new VerticalTableCell("<div id='div-$id' name='div-$id'  class='PostInput'>" . $pCells[1]. "</div>", false);
			break;
		case "file":
			$this->cells[] = new VerticalTableCell("<input type='hidden' name='MAX_FILE_SIZE' value='20000000'><input id='upld-$id' name='upld' class='PostInputEdit' type='file' disabled='true' />", false);
			break;
		case "numero":
			$this->cells[] = new VerticalTableCell("<input id='input-$id' name='input-$id' class='PostInput' type='text' value='" . $pCells[1] . "' disabled='true' maxlength='11' onkeydown=' return FilterText(event)' />", false);
			break;
		case "fecha":
			$this->cells[] = new VerticalTableCell("<input type='text' id='fch-$id' class='PostDate' value='" . $pCells[1] . "' disabled='true' ></input>", false);
			break;
		case "password":
			$this->cells[] = new VerticalTableCell("<input id='input-$id' name='input-$id' class='PostInput' type='password' value='" . $pCells[1] . "' disabled='true' $maxLength />", false);
			break;
		}
	}
	
	/*!
	 * Genera y devuelve el codigo HTML que representa la fila
	 */
	public function ToString(){
		$returnValue = "<tr style='width: 100%'>";
		foreach($this->cells as $cell){
			$returnValue .= $cell->ToString();
		}
		$returnValue .= "</tr>";
		return $returnValue;
	}
	
	/*!
	 * Imprime el codigo HTML de la fila
	 */
	public function Show(){
		echo $this->ToString();
	}
	
}	

/*!
 * \brief Reprensenta una celda a formar parte de una VerticalTableRow
 */
class VerticalTableCell{
	
	/*!
	 * El valor que posee la celda
	 */
	public $value = "";
	/*!
	 * Valor booleano que define si la celda es de tipo header o normal
	 */
	public $header = false;
	/*!
	 * Longitud maxima de esta celda
	 */
	public $maxLength = "";
	
	/*!
	 * Constructor. Inicializa sus miembros en base a los parametros recibidos
	 * \param $pValue Valor a mostrar en esta celda
	 * \param $pHeader Valor que define si esta celda es un header o una celda normal
	 */
	public function VerticalTableCell($pValue, $pHeader=false){
		$this->value = $pValue;
		$this->header = $pHeader;
	}
	
	/*!
	 * Metodo que genera y devuelve el codigo HTML que representa a esta celda
	 */
	public function ToString(){
		if($this->header)
			return "<th>$this->value</th>";
		else
			return "<td  style='height: 100%'>$this->value</td>";
	}
	
	/*!
	 * Imprime el codigo HTML de esta celda
	 */
	public function Show(){
		echo $this->ToString();
	}
}

?>
