<?php
include_once("../incluye.php");
require_once("cfeed.php");
require_once("../clases/cconexion.php");

$rss = new UniversalFeedCreator();
$rss->useCached();
$rss->title = "UES Novedades en la Unidad de PostGrados";
$rss->description = "noticias recientes en la Unidad de PostGrados";
$rss->link = URL."index.php?section=revista";
$rss->syndicationURL = URL."rss/testfeed.php";

$image = new FeedImage();
$image->title = "Minerva logo";
$image->url = URL."media/minerva_small.gif";
$image->link = URL."index.php";
$image->description = "Click para visitar el sitio de la Unidad de PostGrados.";
$rss->image = $image;

$con = new cConexion();
$consulta = "SELECT * FROM novedades ORDER BY fecha DESC LIMIT 10;";
$con->Conectar();
// ejecutar la consulta
if ($resultado = $con->mysqli->query($consulta))
{
	// hay registros?
	if ($resultado->num_rows > 0)
	{
		while($row = $resultado->fetch_array())
		{
    		$item = new FeedItem();
    		$item->title = $row[0];
    		$item->link = $row[1];
    		$item->description = $row[2];
    		$item->date = $row[3];
    		$item->source = URL;
    		$item->author = "Unidad de PostGrados";
    		
    		$rss->addItem($item);
		}
	}
	else
	{
		// no
		$item = new FeedItem();
    	$item->title = "No hay nada que mostrar";
    	$item->link = URL;
    	$item->description = "Aun no hay novedades que mostrar.";
    	$now = new FeedDate();
    	$item->date = $now->rfc822();
    	$item->source = URL;
    	$item->author = "Unidad de PostGrados";
    	
    	$rss->addItem($item);
	}
	$resultado->close();
}
else
{
	// tiremos el error (si hay)... ojala que no :P
	$item = new FeedItem();
    $item->title = "Ocurrio un error!";
    $item->link = URL;
    $item->description = "¡Ocurrio un error al obtener las noticias!<br>
    Precisamente en la consulta: " .$consulta ."<br>y el error es: ".$con->mysqli->error;
    $now = new FeedDate();
    $item->date = $now->rfc822();
    $item->source = URL;
    $item->author = "Unidad de PostGrados";
    
    $rss->addItem($item);
}
// cerrar la conexion
$con->mysqli->close();
// salvamos el feed
$rss->saveFeed("RSS2.0", "postgrado-novedades.xml"); 
?>