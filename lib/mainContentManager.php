<?php
		
    class mainContentManager{
    	
		public function showNews(){
			 return "<ul>
			      <li><a href=\"Unidad/index.php?opt=news&newid=3\">Primer prototipo del sitio web</a></li>
			      <li><a href=\"Unidad/index.php?opt=news&newid=2\">Estudiantes asignados al servicio social</a></li>
			      <li><a href=\"Unidad/index.php?opt=news&newid=1\">Se requieren estudiantes para servicio social</a></li>
			    </ul>";
		}
		
		public function showForum(){
			 return "<ul>
			      <li><a href=\"Forum/index.php?opt=cat&catid=4\">Las utilerias no me funcionan en mi sistema</a></li>
			      <li><a href=\"Forum/index.php?opt=cat&catid=3\">RE: RE: Como me suscribo al foro?</a></li>
			      <li><a href=\"Forum/index.php?opt=cat&catid=2\">RE: Como me suscribo al foro?</a></li>
			      <li><a href=\"Forum/index.php?opt=cat&catid=1\">Como me suscribo al foro?</a></li>
			    </ul>";
		}
		
		public function showCourses(){
			 return "<ul>
			      <li><a href=\"Cursos/index.php?opt=actual&curid=1\">Maestria en la Profecionalizacion de la Docencia Superior</a></li>
			      <li><a href=\"Cursos/index.php?opt=actual&curid=2\">Maestria en Metodos y Tecnicas de Investigacion</a></li>
			      <li><a href=\"Cursos/index.php?opt=actual&curid=1\">Maestria en Administracion Financiera</a></li>
			    </ul>";			
		}
		
		public function showAbout(){
			$about = new cGeneral();
			$about->GetPorTitulo("about");
			return substr($about->contenido,0,250) . "...";
		}
		
    }
?>
