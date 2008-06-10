<?php
//include_once("../incluye.php");
require_once("cfeed.php");
//require_once("../clases/cconexion.php");
define("RUTA", realpath("../"));
require_once(RUTA."clases/cnovedades.php");
require_once(RUTA."clases/cforo.php");

/**
 * Ultimas Novedades		novedades
 * Actividad en el Foro		foro
 * Noticias sobre los Cursos	cursos
 */

class GenerarFeedsPostGrado
{
	public $generare;
	private $rss;
	
	// constructor
    public function __construct() 
    {    	
		$this->rss = new UniversalFeedCreator();
		$this->rss->useCached();
		
		$image = new FeedImage();
		$image->title = "Minerva logo";
		$image->url = URL."media/minerva_small.gif";
		$image->link = URL."index.php";
		$image->description = "Click para visitar el sitio de la Unidad de PostGrados, UES - FMOcc.";
		$this->rss->image = $image;
    }
    
    // destructor
    public function __destruct() { }
	
	public function Genero()
	{
		switch ($this->generare) {
			case "novedades":
				$this->Novedades();
				break;
			case "cursos":
				$this->Cursos();
				break;
			case "foro":
				$this->Foros();
				break;
			default:
				break;
		}
	}

	private function Novedades()
	{
		$this->rss->title = "Novedades";
		$this->rss->description = "Noticias recientes en la Unidad de PostGrados";
		$this->rss->link = URL."index.php?section=revista";
		$this->rss->syndicationURL = URL."rss/feeds.php?genera=novedades";
		
		$this->novedades = new cNovedades();
		
		$listanovedades = $this->novedades->GetUltimos();
		if ($listanovedades)
		{			
			while($row = $listanovedades->fetch_array())
			{
    			$item = new FeedItem();
    			$item->title = $row[1];
    			$item->link = $row[2];
    			$item->description = $row[3];
    			$item->date = $row[4];
    			$item->source = URL;
    			$item->author = UNIDAD;
    			
    			$this->rss->addItem($item);
			}
			$listanovedades->close();
		}
		else 
		{
			$this->FeedError();
		}
		$this->rss->saveFeed("RSS2.0", "postgrado-novedades.xml"); 
	}
	
	private function Cursos()
	{
		$this->rss->title = "Cursos";
		$this->rss->description = "Avisos sobre los Cursos de la Unidad de PostGrados";
		$this->rss->link = URL."cursos/index.php";
		$this->rss->syndicationURL = URL."rss/feeds.php?genera=cursos";
		
		//$this->novedades = new cNovedades();
		/*
		$listanovedades = $this->novedades->GetUltimos();
		if ($listanovedades)
		{			
			while($row = $listanovedades->fetch_array())
			{
    			$item = new FeedItem();
    			$item->title = $row[1];
    			$item->link = $row[2];
    			$item->description = $row[3];
    			$item->date = $row[4];
    			$item->source = URL;
    			$item->author = UNIDAD;
    			
    			$this->rss->addItem($item);
			}
			$listanovedades->close();
		}
		else 
		{*/
			$this->FeedError();
		//}
		$this->rss->saveFeed("RSS2.0", "postgrado-cursos.xml"); 
	}
	
	private function Foros()
	{
		$this->rss->title = "Foros";
		$this->rss->description = "Ultimas entradas en el Foro de la Unidad de PostGrados";
		$this->rss->link = URL."foro/index.php";
		$this->rss->syndicationURL = URL."rss/feeds.php?genera=foro";
		
		$forum = new cForo();
		
		$query = $forum->GetListaPosts();
		if ($query)
		{	
			while ($disc_actual = $query->fetch_assoc())
			{
				$item = new FeedItem();
				$item->title = $disc_actual['forum_name'];
    			$item->link = "";
    			$item->description = $disc_actual['subject'];
    			$item->date = $disc_actual['last_post'];
    			$item->source = URL;
    			$item->author = $disc_actual['poster'];
				/*$this->subject = ;
				$this->id = $disc_actual['id'];
				$this->fid = $disc_actual['fid'];
				$this->forum_name = ;
				$this->poster = 
				$this->posted = $disc_actual['posted'];
				$this->last_post = ;*/
				$this->rss->addItem($item);
			}			
			$query->close();
		}
		else 
		{
			$this->FeedError();
		}
		$this->rss->saveFeed("RSS2.0", "postgrado-foros.xml"); 
	}
	
	private function FeedError()
	{
		$item = new FeedItem();
    	$item->title = "No hay nada que mostrar";
    	$item->link = URL;
    	$item->description = "No hay nada que mostrar.";
    	$now = new FeedDate();
    	$item->date = $now->rfc822();
    	$item->source = URL;
    	$item->author = UNIDAD;
    	$this->rss->addItem($item);	
	}
	
}

$gfpg = new GenerarFeedsPostGrado();
//$gfpg->generare = $_GET[genera]; 
$gfpg->generare = "foro";
$gfpg->Genero();
?>