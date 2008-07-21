<?php

define("RUTA", realpath("../"));
require_once(RUTA."/clases/cnovedades.php");

    class PostPager{
    	
		var $currentPage;
		var $pageLen;
		var $btnNext;
		var $btnPrev;
		var $totRegs;
		var $iniReg;
		var $finReg;
		
		function PostPager($pPageLen=5){
			$this->pageLen = $pPageLen;
			$this->currentPage = 0;
			$this->totRegs = 0;
			$this->btnNext = new PostPagerButton("Pagina Siguiente", "pgrNext");
			$this->btnPrev = new PostPagerButton("Pagina Anterior", "pgrPrev");
		}
		
		function GetPosts(){
			if(isset($_GET["page"]))
				$this->currentPage = $_GET["page"];
			$lastNovs = new cNovedades();
			$this->CalcRegs();
			return $lastNovs->GetListaFiltrada($this->iniReg-1, $this->pageLen);
		}
		
		function ToString(){
									
			$this->CalcRegs();
			if($this->iniReg == 1)
				$this->btnPrev->enabled = false;
			if($this->finReg == $this->totRegs)
				$this->btnNext->enabled = false;
			
			$path = $_SERVER['SCRIPT_NAME'];
			
			$this->btnNext->url = $path . "?opt=news&page=" . ($this->currentPage + 1);
			$this->btnPrev->url = $path . "?opt=news&page=" . ($this->currentPage - 1) ;
				
			return "
				<div class='TextPager'>Mostrando registros del <b>$this->iniReg</b> al <b>$this->finReg</b> de los <b>$this->totRegs</b> totales</div>
				<div class='ButtonPagerList'>" . $this->btnPrev->ToString() . $this->btnNext->ToString() . "</div>";
		}
		
		function CalcRegs(){
			if(isset($_GET["page"]))
				$this->currentPage = $_GET["page"];
				
			$this->totRegs = $this->GetTotalPosts();
			
			$this->iniReg = ($this->currentPage * $this->pageLen) + 1;
			$this->finReg = ($this->currentPage * $this->pageLen) + $this->pageLen;
			if($this->finReg > $this->totRegs) 
				$this->finReg = $this->totRegs;
		}
		
		function GetTotalPosts(){
			$lastNovs = new cNovedades();
			$res = $lastNovs->GetLista();
			return $res->num_rows;
		}
    }
	
	
	/*-----------------------------------------------------------------------------------------------------*/
	
	class PostPagerButton{
		
		var $title;
		var $class;
		var $url;
		var $enabled;
		
		function PostPagerButton($pTitle, $pClass){
			$this->title = $pTitle;
			$this->class = $pClass;
			$this->enabled = true;
		}
		
		function ToString(){
			if($this->enabled){
				return "
					<a class='btn-$this->class' href='$this->url'>
						<div class='txt-$this->class'>
							$this->title
						</div>
						<div class='img-$this->class'>
						</div>
					</a>
				";
			}
			else
				return "";
		}
	}
?>
