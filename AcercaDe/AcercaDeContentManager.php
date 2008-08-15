<?php

    class AcercaDeContentManager{
    	
		var $opcion;
		
		public function AcercaDeContentManager(){
		}
		
		public function Show(){
			$postList = "";
			$gen = new cGeneral();
			
			//Info tecnica del proyecto
				$tempPost = new InnerPost("", "", 530, false, false, false);
				$tempPost->id = "proyecto";
				$tempPost->titulo = "Informacion del Proyecto";
				$gen->GetPorTitulo('proyecto');
				$tempPost->contenido = $gen->contenido;
				$tempPost->editableTitle = false;
				$postList .= $tempPost->ToString();			
			
			//Autores del proyecto
				$tempPost = new InnerPost("", "", 530, false, false, false);
				$tempPost->id = "autores";
				$tempPost->titulo = "Autores del proyecto";
				$gen->GetPorTitulo('autores');
				$tempPost->contenido = $gen->contenido;
				$tempPost->editableTitle = false;
				$postList .= $tempPost->ToString();
				
			//Agradecimientos a los 
				$tempPost = new InnerPost("", "", 530, false, false, false);
				$tempPost->id = "supervisores";
				$tempPost->titulo = "Agradecimientos";
				$gen->GetPorTitulo('supervisores');
				$tempPost->contenido = $gen->contenido;
				$tempPost->editableTitle = false;
				$postList .= $tempPost->ToString();
			
			$pst = new Post("Acerca de este Proyecto", $postList, 550, false, false, false);
			$pst->Show();
		}
    }
?>
