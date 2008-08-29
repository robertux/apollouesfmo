<?php

	/*!
	 * \brief Clase que se encarga de gestiorar el MotionGallery, que permite mostrar una serie de imagenes y deslizarlas a lo largo de la parte interior de un marco
	 * Esta clase crea el div donde se muestra el MotionGallery y se le agregan las imagenes que mostrara
	 */
    class MGalleryManager{
    	
		/*!
		 * Arreglo de objetos MGalleryImage, para mostrarlos en la tira de imagens del MotionGallery
		 */
		public $images = array();
		
		/*!
		 * Constructor de la clase
		 */
		public function MGalleryManager(){
			
		}
		
		/*!
		 * Devuelve una cadena con el codigo HTML que muestra el MotionGallery conpuesto de la tira de imagenes deslizables
		 */
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
	
	/*!
	 * \brief Clase que representa a una imagen asignable al MGalleryManager
	 * Contiene todos los miembros necesarios para crear una etiqueta IMG en la cual mostrar la imagen que representa. Esta imagen se obtiene de la base de datos haciendo uso de un script externo llamado ViewImage.php
	 */
	class MGalleryImage{
		
		/*!
		 * El ID del elemento IMG
		 */
		public $id;
		/*!
		 * El nombre de la imagen
		 */
		public $name;
		/*!
		 * La descripcion de la imagen
		 */
		public $desc;
		/*!
		 * La imagen en si. Valor a incluir en el atributo SRC del elemento IMG
		 */
		public $src;
		
		/*!
		 * Constructor. Inicializa los campos que requiere el MGalleryImage para mostrar la imagen
		 * \param $pId ID de la imagen a mostrar. Tambien es el ID del registro de la tabla procesos, que contiene la imagen
		 * \param $pName Nombre de la imagen. Campo tomado tambien de la base de datos
		 * \param $pDesc Descripcion de la imagen
		 * \param $pSrc Fuente de la imagen
		 */
		public function MGalleryImage($pId, $pName, $pDesc, $pSrc){
			$this->id = $pId;
			$this->name = $pName;
			$this->desc = $pDesc;
			$this->src = $pSrc;
		}
		
		/*!
		 * Genera el codigo HTML necesario para mostrar el elemento IMG con todas las propiedades de este objeto, invocando al script ShowImage.php para obtener el contenido real de la imagen de la base de datos, en base al ID de la imagen
		 */
		public function ToString($isThumb=true){
			if($isThumb)
				return "<img class='mgalleryimage' src=\"../lib/ShowImage.php?id=$this->id\" id='img-$this->id' alt='$this->name' onClick='ShowBigImage($this->id)' onMouseOver='ShowImgTitle($this->id)' onMouseOut='ClearImgTitle()' width='100' height='100' />";
			else
				return "<img class='mgalleryimage' src=\"../lib/ShowImage.php?id=$this->id\" id='img-big' alt='$this->name' width='500' onClick=''/>";
		}
		
		public function Show(){
			echo $this->ToString();
		}
	}
?>
