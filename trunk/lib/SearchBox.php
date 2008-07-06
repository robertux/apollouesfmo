<?php
    class SearchBox{
    	
		public function ToString(){
			echo("
				<input type='text' id='txtSearchBox' class='searchBox'/>
			");
		}
		
		public function Show(){
			echo($this->ToString());
		}
		
    }
?>
