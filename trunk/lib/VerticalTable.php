<?php

class VerticalTable{
    
	public $rows = array();
	public $border;
	public $width;

	public function VerticalTable($pBorder = "1", $pWidth = "100%"){
		$this->border = $pBorder;
		$this->width = $pWidth;
	}

	public function ToString(){
		$returnValue = "<table border='$this->border' width='$this->width'>";
		foreach($this->rows as $row){
			$returnValue .= $row->ToString();
		}
		$returnValue .= "</table>";
		return $returnValue;
	}

}


class VerticalTableRow{
	
	public $cells = array();	
	
	public function VerticalTableRow($pCells, $id=-1, $areaContent = false){
		/*foreach($pCells as $pCell){
			$this->cells[] = new VerticalTableCell($pCell);
		}*/		
		$this->cells[] = new VerticalTableCell($pCells[0], true);
		if($areaContent)
			$this->cells[] = new VerticalTableCell("<div id='div-$id' class='PostInput'>" . $pCells[1]. "</div>", false);
		else
			$this->cells[] = new VerticalTableCell("<input id='input-$id' class='PostInput' type='text' value='" . $pCells[1] . "' disabled='true' />", false);
	}
	
	public function ToString(){
		$returnValue = "<tr style='width: 100%'>";
		foreach($this->cells as $cell){
			$returnValue .= $cell->ToString();
		}
		$returnValue .= "</tr>";
		return $returnValue;
	}
	
	public function Show(){
		echo $this->ToString();
	}
	
}	

class VerticalTableCell{
	
	public $value = "";
	public $header = false;
	
	public function VerticalTableCell($pValue, $pHeader=false){
		$this->value = $pValue;
		$this->header = $pHeader;
	}
	
	public function ToString(){
		if($this->header)
			return "<th>$this->value</th>";
		else
			return "<td  style='height: 100%'>$this->value</td>";
	}
	
	public function Show(){
		echo $this->ToString();
	}
}

?>
