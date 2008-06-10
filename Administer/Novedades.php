<?php
define("RUTA", realpath("../"));
require_once(RUTA."/incluye.php");
require_once(RUTA."/lib/VisualNovedades.php");

$pag = new paginaSecundaria();
$pag->encabezado();
$pag->cuerpo();
?>
<div id="wrap">	
	<?php
		$vuser = new VisualUsuario();
		$vuser->Show();
	?>
  <div id="header">
    <div id="logo">
      <h1>Administer</h1>
    </div>
    <ul id="nav">
      <li><a href="../index.php">Principal</a></li>
      <li><a href="../Cursos/index.php?opt=mine">Maestrias</a></li>
      <li><a href="../Forum/index.php?opt=cat">Foro</a></li>
      <li><a href="../Unidad/index.php?opt=about">La Unidad</a></li>
    </ul>
  </div>
<div id="content"><img src="../Media/style/MainBanner.png" alt="" class="img" />
	<div id='Post' style='width: 747px;'>
	 <div id='PostTitle' style='width: 735px;'>
		<p id='innerTitle'>Administre las Novedades de la Unidad de PostGrados</p>
	 </div><br/><br/>
	  <div id='PostContent'>
			<?php
			/**
			* Prueba del objeto VisualNovedades
			*/
			//echo "<br><h1>Esta es una pagina de PRUEBA, aun no esta finalizada!</h1><br>";
			$visualnov = new VisualNovedades();
			
			$visualnov->file = "Novedades.php";
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
			//echo "\n<b>DEBUG: accion : $visualnov->a, id : $visualnov->recid, sql : $visualnov->sql </b>";
		    //echo "descripcion =" . @$_GET["descripcion"] ."\n";
			$visualnov->CommitSQL();
			$visualnov->ShowAction();
			?>
	  </div>
	 </div>
  </div>
    <!--<div id="rightMenu">
	<ul>
	<li><a href="index.php?opt=about">Acerca de la Unidad</a></li>
	<li><a href="index.php?opt=proc">Procesos Academicos</a></li>
	<li><a href="index.php?opt=news">Noticias</a></li>
	<li><a href="index.php?opt=util">Programas de Utileria</a></li>
	<li><a href="index.php?opt=contact">Contacto/Suscripcion</a></li>
	</ul>
  </div>-->
    <!-- /content -->

  <!--<div class="clearfix"></div>-->
  <div id="footer">
    
  </div>
  <!-- /footer -->
</div>
<?php $pag->pie(); ?>