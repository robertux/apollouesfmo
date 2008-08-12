<?php
	require_once("../classes/cprocesos.php");
    $id = $_GET["id"];
	Header( "Content-type: jpeg");
	$cproc = new cprocesos();
	$cproc->GetPorId($id);
    echo $cproc->imagen;
?>
