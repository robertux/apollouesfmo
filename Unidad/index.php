<?php
	define("RUTA", realpath("../"));
	require_once("../incluye.php");
	require_once("UnidadContentManager.php");	
	require_once("../clases/cgeneral.php");
	require_once("../clases/cnovedades.php");
	require_once("../clases/cutileria.php");	
	require_once("../clases/cdocente.php");
	require_once("../clases/cprocesos.php");	
	require_once("../lib/VerticalTable.php");
	require_once("../lib/MGalleryManager.php");
	
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
      <h1>La Unidad</h1>
    </div>
    <ul id="nav">
      <li><a href="../index.php">Principal</a></li>
      <li><a href="../Cursos/index.php?opt=mine">Maestrias</a></li>
      <li><a href="../Forum/index.php?opt=cat">Foro</a></li>
      <li><a>La Unidad</a></li>
    </ul>
  </div>
  <!-- /header -->
  <div id="content"> 
  	<div id="banner">
	  	<img src="../Media/style/MainBanner.png" alt="" class="img">
	</div>
	<div id="innerContent">		
    	<?php
			$ucm = new UnidadContentManager($_GET["opt"]);
			$ucm->Show();
		?>
		<div id="rightMenu">
			<ul>
				<li><a href="index.php?opt=about">Acerca de la Unidad</a></li>
				<li><a href="index.php?opt=proc">Procesos Academicos</a></li>
				<li><a href="index.php?opt=profs">Docentes</a></li>
				<li><a href="index.php?opt=news">Noticias</a></li>
				<li><a href="index.php?opt=util">Programas de Utileria</a></li>
				<li><a href="index.php?opt=contact">Contacto/Suscripcion</a></li>
			</ul>
	  	</div>
	  </div>
  </div>    
    <!-- /content -->

  <!--<div class="clearfix"></div>-->
  <div id="footer">
    
  </div>
  <!-- /footer -->
</div>
<?php $pag->pie(); ?>