<?php

/*!
 * Define una serie de archivos necesarios por las demas clases
 */

/* AQUI SE COLOCAN LOS REQUIRE QUE TODAS LAS PAGINAS NECESITAN */
define("URL", "http://localhost/apollo2/postgrados/");
define("UNIDAD", "Unidad de PostGrados - UES FMOcc");
define("RUTA", realpath("./"));
/*LIBRERIA*/
//require_once("lib/funciones.php");
//require_once("lib/encabezado.php");
require_once(RUTA."/lib/VisualUsuario.php");

/*CLASES*/
require_once(RUTA."/lib/paginaPrincipal.php");
require_once(RUTA."/lib/paginaSecundaria.php");
require_once(RUTA."/lib/widget.php");
require_once(RUTA."/lib/Post.php");
require_once(RUTA."/lib/ToolBox.php");
require_once(RUTA."/lib/PostPager.php");
require_once(RUTA . "/clases/cgeneral.php");
require_once(RUTA . "/clases/cpostgrado.php");
//etc...
?>
