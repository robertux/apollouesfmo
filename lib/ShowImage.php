<?php
	$PATH = realpath("../");	
	require_once($PATH . "/clases/cprocesos.php");
	require_once($PATH . "/clases/cconexion.php");
    $id = $_GET["id"];
	Header( "Content-type: jpeg");
	$cproc = new cprocesos();
	$cproc->GetPorId($id);
    echo $cproc->imagen;
?>