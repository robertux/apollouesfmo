<?php

class paginaPrincipal{
	
	public function encabezado()
	{
		session_start();
		echo "<!DOCTYPE html PUBLIC \"-//IETF//DTD HTML 2.0//EN\"><html><head><title>";
		echo "Portal Unidad de PostGrados - Universidad de El Salvador</title>\n";
		echo "<META HTTP-EQUIV=\"Content-Type\" CONTENT=\"text/html; charset=\"UTF8\">\n";
		echo "<META NAME=\"AUTHOR\" CONTENT=\"Roberto Linares - Rodrigo Amaya\">\n";
		echo "<META NAME=\"COPYRIGHT\" CONTENT=\"Copyright (c) 2008 by Roberto Linares - Rodrigo Amaya\">\n";
		echo "<META NAME=\"KEYWORDS\" CONTENT=\"PostGrados, Maestria, Facultad Multidisciplinaria de Occidente, Universidad de El Salvador, UES, FMO, UES-FMO, Santa Ana\">\n";
		echo "<META NAME=\"DESCRIPTION\" CONTENT=\"Hacia la libertad por la Cultura\">\n";
		echo "<META NAME=\"ROBOTS\" CONTENT=\"INDEX, FOLLOW\">\n";
		echo "<META NAME=\"REVISIT-AFTER\" CONTENT=\"1 DAYS\">\n";	
		echo "<META NAME=\"RATING\" CONTENT=\"GENERAL\">\n";
		echo "<link rel=\"alternate\" type=\"application/rss+xml\" title=\"PostGrados - Ultimas Novedades\" href=\"".URL."rss/feeds.php?genera=novedades\" />";
		echo "<link rel=\"alternate\" type=\"application/rss+xml\" title=\"PostGrados - Actividad en el Foro\" href=\"".URL."rss/feeds.php?genera=foro\" />";
		echo "<link rel=\"alternate\" type=\"application/rss+xml\" title=\"PostGrados - Noticias sobre los Cursos\" href=\"".URL."rss/feeds.php?genera=cursos\" />";
		echo "<link rel=\"stylesheet\" href=\"css/main.css\" type=\"text/css\" media=\"screen, projection\" title=\"PostGrados - UES - FMO Hojas de Estilo\">\n";
		if(eregi("MSIE", $_REQUEST["HTTP_USER_AGENT"]))
			echo "<link rel=\"stylesheet\" href=\"css/transpWidgetsIE.css\" type=\"text/css\" media=\"screen, projection\" title=\"PostGrados - UES - FMO Hojas de Estilo\"> \n";
		else
			echo "<link rel=\"stylesheet\" href=\"css/transpWidgets.css\" type=\"text/css\" media=\"screen, projection\" title=\"PostGrados - UES - FMO Hojas de Estilo\"> \n";			
		echo "<link rel=\"stylesheet\" href=\"css/forms.css\" type=\"text/css\" media=\"screen, projection\" title=\"PostGrados - UES - FMO Hojas de Estilo\">\n";
		echo "<link rel=\"stylesheet\" href=\"css/solidBlockMainMenu.css\" type=\"text/css\" media=\"screen, projection\" title=\"PostGrados - UES - FMO Hojas de Estilo\">\n";
		//echo "<script type=\"text/javascript\" src=\"/calendario/calendario/javascripts.js\"></script>\n";
		//echo "<script type=\"text/javascript\" src=\"/includes/funciones.js\"></script>\n";
		//if (isset($_SESSION['autentificado']) && $_SESSION["autentificado"] == $_SESSION["aut"]){ }	
		echo "</head>";
	}
	
	public function cuerpo()
	{
		echo "<body>";
	}

	public function pie()
	{
		echo "</body></html>";
	}

}	
?>