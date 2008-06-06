<?php
define("RUTA", realpath("../"));
require_once(RUTA."/lib/VisualNovedades.php");

/**
* Prueba del objeto VisualNovedades
*/
session_start();
echo '<html><head><title>apollo -- novedades</title><meta name="generator" http-equiv="content-type" content="text/html"></head><body>';
echo '<table class="bd" width="100%"><tr><td class="hr"><h2>Editar Noticias de la Unidad de PostGrados</h2></td></tr></table>';

echo "<br><h1>Esta es una pagina de PRUEBA, aun no esta finalizada!</h1><br>";

$visualnov = new VisualNovedades();
$visualnov->file = "VisualNovedades.php";
$visualnov->a = @$_GET["a"];
$visualnov->recid = @$_GET["recid"];
$visualnov->page = @$_GET["page"];
$visualnov->sql = @$_POST["sql"];

$visualnov->nov->id = @$_POST["id"];
$visualnov->nov->titulo = @$_POST["titulo"];
$visualnov->nov->vinculo = @$_POST["vinculo"];
$visualnov->nov->descripcion = @$_POST["descripcion"];
$visualnov->nov->fecha = @$_POST["fecha"];

if (!isset($visualnov->page)) $visualnov->page = 1;

echo "\n<b>DEBUG: accion : $visualnov->a, id : $visualnov->recid, sql : $visualnov->sql </b>";
echo "descripcion =" . @$_GET["descripcion"] ."\n";

switch ($visualnov->sql) {
	case "insert":
		$visualnov->sql_insert();
		break;
	case "update":
		$visualnov->sql_update();
		break;
	case "delete":
		$visualnov->sql_delete();
		break;
}

switch ($visualnov->a) {
	case "add":
		$visualnov->addrec();
		break;
	case "view":
		$visualnov->viewrec(); //corregir esto
		break;
	case "edit":
		$visualnov->editrec();
		break;
	case "del":
		$visualnov->deleterec();
		break;
	default:
		$visualnov->select();
		break;
}
echo '<table class="bd" width="100%"><tr><td class="hr"><center>Unidad de PostGrados, UES-FMOcc</center></td></tr></table></body></html>';
?>