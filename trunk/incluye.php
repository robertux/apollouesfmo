<?php
/* AQUI SE COLOCAN LOS REQUIRE QUE TODAS LAS PAGINAS NECESITAN */

define("URL", "http://localhost/apollo/");//"http://ramayac.no-ip.biz/apollo/"); //"http://www.uesocc.edu.sv/postgrados/" 
define("RUTA", realpath("./"));
define("UNIDAD", "Unidad de PostGrados - UES FMOcc");

/*LIBRERIA*/
//require_once("lib/funciones.php");
//require_once("lib/encabezado.php");
require_once(RUTA."/lib/VisualUsuario.php");

/*CLASES*/
require_once(RUTA."/lib/paginaPrincipal.php");
require_once(RUTA."/lib/paginaSecundaria.php");
require_once(RUTA."/lib/mainContentManager.php");
require_once(RUTA."/lib/widget.php");
require_once(RUTA."/lib/MainMenu.php");
//etc...
?>
