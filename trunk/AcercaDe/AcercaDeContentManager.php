<?php
	
	/*!\brief Clase que gestiona el contenido de la pagina Acerca De.
	 * Contiene opciones como el porque del proyecto, colaboradores, desarrolladores, etc.	
	*/
    class AcercaDeContentManager{
    	
		/*!
		 * Variable estandar de los Content Managers que define las diferentes opciones para el contenido que se puede mostrar en la pagina.
		 * Para este caso, solo existe una unica opcion.
		*/
		var $opcion;
		
		/*!
		 * Constructor de la clase AcercaDeContentManager.
		 * No hace nada por el momento.
		 */
		public function AcercaDeContentManager(){
		}
		
		/*!
		 * Muestra el contenido de la opcion AcercaDe como un Post.
		 * Este post principal contiene tres posts para clasificar la informacion en:
		 *  - Informacion tecnica del proyecto
		 *  - Autores del proyecto
		 *  - Agradecimientos
		 */
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
