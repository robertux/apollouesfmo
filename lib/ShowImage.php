<?php
	/*!
	 * Script que se encarga de tomar una imagen de la base de datos y mostrarla en una etiqueta IMG
	 * Este script es invocado por la clase MGalleryManager, para mostrar las imagenes de la seccion de Procesos de la Unidad
	 */
	$PATH = realpath("../");	
	require_once($PATH . "/clases/cprocesos.php");
	require_once($PATH . "/clases/cconexion.php");
    $id = $_GET["id"];
	Header( "Content-type: jpeg");
	$cproc = new cprocesos();
	$cproc->GetPorId($id);
    echo $cproc->imagen;
?>
