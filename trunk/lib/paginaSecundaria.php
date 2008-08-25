<?php

    class paginaSecundaria
    {
		//Agrega el encabezado. Todas las inclusiones de los css y js necesarias
		public function encabezado()
		{
			session_start();
			//Los doctype
			echo "<!DOCTYPE html PUBLIC \"-//IETF//DTD HTML 2.0//EN\"><html><head><title>";
			echo "Portal Unidad de PostGrados - Universidad de El Salvador</title>\n";
			//Los meta, para que Google y los demas nos indexen, jajaja
			echo "<META HTTP-EQUIV=\"Content-Type\" CONTENT=\"text/html; charset=\"utf-8\">\n";
			echo "<META NAME=\"AUTHOR\" CONTENT=\"Roberto Linares - Rodrigo Amaya\">\n";
			echo "<META NAME=\"COPYRIGHT\" CONTENT=\"Copyright (c) 2008 by Roberto Linares - Rodrigo Amaya\">\n";
			echo "<META NAME=\"KEYWORDS\" CONTENT=\"PostGrados, Maestria, Facultad Multidisciplinaria de Occidente, Universidad de El Salvador, UES, FMO, UES-FMO, Santa Ana\">\n";
			echo "<META NAME=\"DESCRIPTION\" CONTENT=\"Hacia la libertad por la Cultura\">\n";
			echo "<META NAME=\"ROBOTS\" CONTENT=\"INDEX, FOLLOW\">\n";
			echo "<META NAME=\"REVISIT-AFTER\" CONTENT=\"1 DAYS\">\n";
			echo "<META NAME=\"RATING\" CONTENT=\"GENERAL\">\n";
			//Los stylesheets, para darle plante al sitio. Sino, se ve chafa
			echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"../css/style.css\" />";
			echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"../css/rightMenu.css\" />";
			echo "<link rel=\"stylesheet\" href=\"../css/forms.css\" type=\"text/css\" media=\"screen, projection\" title=\"PostGrados - UES - FMO Hojas de Estilo\">\n";			
			echo "<link rel=\"stylesheet\" href=\"../css/main.css\" type=\"text/css\" media=\"screen, projection\" title=\"PostGrados - UES - FMO Hojas de Estilo\">\n";
			echo "<link rel=\"stylesheet\" href=\"../css/posts.css\" type=\"text/css\" media=\"screen, projection\" title=\"PostGrados - UES - FMO Hojas de Estilo\">\n";
			echo "<link rel=\"stylesheet\" href=\"../css/tables.css\" type=\"text/css\" media=\"screen, projection\" title=\"PostGrados - UES - FMO Hojas de Estilo\">\n";
			echo "<link rel=\"stylesheet\" href=\"../css/toolbox.css\" type=\"text/css\" media=\"screen, projection\" title=\"PostGrados - UES - FMO Hojas de Estilo\">\n";			
			echo "<link rel=\"stylesheet\" href=\"../css/postPager.css\" type=\"text/css\" media=\"screen, projection\" title=\"PostGrados - UES - FMO Hojas de Estilo\">\n";						

			//el estilo del jscalendar			
			echo "<link rel=\"stylesheet\" href=\"../js/jscalendar/calendar-system.css\" type=\"text/css\" media=\"screen, projection\" title=\"PostGrados - UES - FMO Hojas de Estilo\">\n";			
			
			//Y ahora...... tatatatannnnn. LOS JAVASCRIPT! efectos efectos efectos!
			
			//TinyMCE:
			echo "<script language=\"javascript\" type=\"text/javascript\" src=\"../js/tiny_mce/tiny_mce.js\"></script>";			
			echo "
				<script language=\"javascript\" type=\"text/javascript\" src=\"../js/tinymceinit.js \"></script>
				<script language=\"javascript\" type=\"text/javascript\">
					tinyMCE.init({
					mode : \"textareas\",
					
					
					theme : \"advanced\",
					plugins : \"iespell,advimage\",
					
					theme_advanced_buttons1 : \"fontselect,fontsizeselect,bold,italic,underline\",
					theme_advanced_buttons2 : \"justifyleft,justifycenter,justifyright,justifyfull,|,bullist,numlist,|,link,unlink,image,iespell\",
					theme_advanced_buttons3 : \"\",
					
					extended_valid_elements : \"a[name|href|target|title|onclick],img[class|src|border=0|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name],hr[class|width|size|noshade],font[face|size|color|style],span[class|align|style]\",		
					theme_advanced_toolbar_location : \"top\",
					theme_advanced_toolbar_align : \"left\",
					theme_advanced_statusbar_location : \"bottom\",
					theme_advanced_resizing : true
					});										
					
				</script>
				";
			
			//Otros muy necesarios:
			echo "<script language=\"javascript\" type=\"text/javascript\" src=\"../js/EditInPlace.js\"></script>";
			echo "<script language=\"javascript\" type=\"text/javascript\" src=\"../js/AjaxManagerClient.js\"></script>";
			echo "<script language=\"javascript\" type=\"text/javascript\" src=\"../js/PostPager.js\"></script>";
			
			//El jsCalendar y sus dependencias:
			echo "<script language=\"javascript\" type=\"text/javascript\" src=\"../js/jscalendar/calendar.js\"></script>";
			echo "<script language=\"javascript\" type=\"text/javascript\" src=\"../js/jscalendar/lang/calendar-es.js\"></script>";
			echo "<script language=\"javascript\" type=\"text/javascript\" src=\"../js/jscalendar/calendar-setup.js\"></script>";														
      		
			//El Motion Gallery, tomado de Dynamic Drive.
			echo "
				<link rel=\"stylesheet\" type=\"text/css\" href=\"../css/gallerystyle.css\" />
				<!-- Do not edit IE conditional style below -->
				<!--[if gte IE 5.5]>
					<style type=\"text/css\">
						#motioncontainer {
							width:expression(Math.min(this.offsetWidth, maxwidth)+'px');
						}
					</style>
				<![endif]-->
				<!-- End Conditional Style -->
				
				<script type=\"text/javascript\" src=\"../js/motiongallery/motiongallery.js\">
				
				/***********************************************
				* CMotion Image Gallery- © Dynamic Drive DHTML code library (www.dynamicdrive.com)
				* Visit http://www.dynamicDrive.com for hundreds of DHTML scripts
				* This notice must stay intact for legal use
				* Modified by Jscheuer1 for autowidth and optional starting positions
				***********************************************/
				
				</script> ";
				
			echo "</head>";						
			
		}
		
		//Aqui inicia el cuerpo
		public function cuerpo()
		{
			echo "<body>";			
		}
		
		
		//Y aqui finaliza el cuerpo
		public function pie()
		{
			echo "
			</body></html>";
		}
    }
?>