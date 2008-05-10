<?php
class pagina{

public function encabezado($accion="")
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
	echo "<link rel=\"stylesheet\" href=\"media/main.css\" type=\"text/css\" media=\"screen, projection\" title=\"PostGrados - UES - FMO Hojas de Estilo\">\n";
	echo "<link rel=\"stylesheet\" href=\"media/transpWidgets.css\" type=\"text/css\" media=\"screen, projection\" title=\"PostGrados - UES - FMO Hojas de Estilo\">\n";
	echo "<link rel=\"stylesheet\" href=\"media/forms.css\" type=\"text/css\" media=\"screen, projection\" title=\"PostGrados - UES - FMO Hojas de Estilo\">\n";
	//echo "<script type=\"text/javascript\" src=\"/calendario/calendario/javascripts.js\"></script>\n";
	//echo "<script type=\"text/javascript\" src=\"/includes/funciones.js\"></script>\n";
	//if (isset($_SESSION['autentificado']) && $_SESSION["autentificado"] == $_SESSION["aut"]){ }
	echo "</head>";
	$this->cuerpo();
}

public function cuerpo($accion="")
{
	if($accion=="")
	{
		echo "<body>";
	}
	else
	{
		echo "<body topmargin=\"0\" leftmargin=\"0\" marginheight=\"0\" marginwidth=\"0\"  vlink=\"#f6f9ff\" link=\"#f6f9ff\" $accion >";
	}
}

public function pie()
{
	$retorna = "";
	$retorna .= "</body></html>";
	return ($devuelve);
}
	
/*function algo_que_hace_cuando_esta_logueado($accion)
{
	switch($accion){
		case bla:
			$menu = pagina::muestra_bla();
		break;
		default:
			$menu = pagina::muestra_nada();
		}
	return ($menu);
}*/
}
?>