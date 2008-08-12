<?php
    class MGalleryManager{
    	
		public $images = array();
		
		public function MGalleryManager(){
			
		}
		
		public function ToString(){
			$strImagses = "";
			foreach($this->images as $image)
				$strImages .= $image->ToString();
			return "
				<div id='motioncontainer' style='position:relative;overflow:hidden;'>
						<div id='motiongallery' style='position:absolute;left:0;top:0;white-space: nowrap;'>
						<nobr id='trueContainer'>
							$strImages
						</nobr>
						</div>
					</div>
			";
		}
		
    }
	
	class MGalleryImage{
		
		public $id;
		public $name;
		public $desc;
		public $src;
		
		public function MGalleryImage($pId, $pName, $pDesc, $pSrc){
			$this->id = $pId;
			$this->name = $pName;
			$this->desc = $pDesc;
			$this->src = $pSrc;
		}
		
		public function ToString(){
			return "<img class='mgalleryimage' src=\"../lib/ShowImage.php?id=$this->id\" id='$this->id' alt='$this->name' onClick='' width='100' height='100' />";
		}
		
		public function Show(){
			echo $this->ToString();
		}
	}
?>
