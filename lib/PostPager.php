<?php

    class PostPager{
    	
		var $currentPage;
		var $pageLen;
		var $btnNext;
		var $btnPrev;
		var $totRegs;
		var $iniReg;
		var $finReg;
		var $entidad;
		
		function PostPager($pEntidad, $pPageLen=5){
			$this->pageLen = $pPageLen;
			$this->currentPage = 0;
			$this->totRegs = 0;
			$this->btnNext = new PostPagerButton("Pagina Siguiente", "pgrNext");
			$this->btnPrev = new PostPagerButton("Pagina Anterior", "pgrPrev");
			$this->entidad = $pEntidad;
		}
		
		function GetPosts($page = -1){
			$this->CalcRegs($page);
			return $this->entidad->GetListaFiltrada($this->iniReg-1, $this->pageLen);
		}		
		
		function ToString(){
									
			$this->CalcRegs();
			if($this->iniReg == 1)
				$this->btnPrev->enabled = false;
			if($this->finReg == $this->totRegs)
				$this->btnNext->enabled = false;
			
			//$path = $_SERVER['SCRIPT_NAME'];
			
			//$this->btnNext->url = $path . "?opt=news&page=" . ($this->currentPage + 1);
			//$this->btnPrev->url = $path . "?opt=news&page=" . ($this->currentPage - 1) ;
			$this->btnNext->onClick = "nextPage(\"" . $this->entidad->tabla . "\", " . $_SESSION['CurrentUser'] . ")";
			$this->btnPrev->onClick = "prevPage(\"" . $this->entidad->tabla . "\", " . $_SESSION['CurrentUser'] . ")";
				
			return "
				<div class='TextPager'>Mostrando registros del <div id='iniReg' class='bold'>$this->iniReg</div> al <div id='finReg' class='bold'>$this->finReg</div> de los <div id='totRegs' class='bold'>$this->totRegs</div> totales</div>
				<input id='currentPage' type='hidden' value='$this->currentPage' />
				<input id='totRegs' type='hidden' value='$this->totRegs' />
				<input id='pageLen' type='hidden' value='$this->pageLen' />
				<div class='ButtonPagerList'>" . $this->btnPrev->ToString() . $this->btnNext->ToString() . "</div>";
		}
		
		function CalcRegs($page = -1){
			if($page == -1){
				if(isset($_GET["page"]))
					$this->currentPage = $_GET["page"];
			}
			else
				$this->currentPage = $page;
				
			$this->totRegs = $this->GetTotalPosts();
			
			$this->iniReg = ($this->currentPage * $this->pageLen) + 1;
			$this->finReg = ($this->currentPage * $this->pageLen) + $this->pageLen;
			if($this->finReg > $this->totRegs) 
				$this->finReg = $this->totRegs;
		}
				
		function GetTotalPosts(){
			$res = $this->entidad->GetLista();
			return $res->num_rows;
		}
    }
	
	
	/*-----------------------------------------------------------------------------------------------------*/
	
	class PostPagerButton{
		
		var $title;
		var $class;
		//var $url;
		var $onClick;
		var $enabled;
		
		function PostPagerButton($pTitle, $pClass){
			$this->title = $pTitle;
			$this->class = $pClass;
			$this->enabled = true;
		}
		
		function ToString(){
			$display = "none";
			if($this->enabled)
				$display = "inline";
				
			return "
				<a class='btn-$this->class' onClick='$this->onClick' style='display: $display'>
					<div class='txt-$this->class'>
						$this->title
					</div>
					<div class='img-$this->class'>
					</div>
				</a>
				";
		}
	}
?>
