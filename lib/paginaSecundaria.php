<?php
    class paginaSecundaria{
    	
		public function encabezado(){
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
			echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"../css/style.css\" />";
			echo "</head>";
		}
		
		public function cuerpo(){
			echo "<body>";
		}
    }
?>
