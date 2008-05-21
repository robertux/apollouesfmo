<?php
	define("URL", "http://localhost/apollo/");//"http://ramayac.no-ip.biz/apollo/"); //"http://www.uesocc.edu.sv/postgrados/" 
	define("RUTA", realpath("../"));
	require_once("../incluye.php");
	
	$pag = new paginaSecundaria();
	$pag->encabezado();
	$pag->cuerpo();
?>
<div id="wrap">
  <div id="header">
    <div id="logo">
      <h1>Foro</h1>
    </div>
    <ul id="nav">
      <li><a href="../index.php">Principal</a></li>
      <li><a href="../Cursos/index.php?opt=mine">Cursos</a></li>
      <li><a>Foro</a></li>
      <li><a href="../Unidad/index.php?opt=about">La Unidad</a></li>
    </ul>
  </div>
  <!-- /header -->
  <div id="content"> <img src="../Media/style/MainBanner.png" alt="" class="img" />
    <p id="innerContent">
	<br /><br /><br />
	Contenido principal del Foro
	<br /><br /><br />
		<br /><br /><br />
	<br /><br /><br />
	<br /><br /><br />
	</p>
  </div>
    <div id="rightMenu">
	<ul>
	<li><a href="index.php?opt=cat">Categorias</a></li>
	<li><a href="index.php?opt=recent">Temas Recientes</a></li>
	<li><a href="index.php?opt=starred">Destacados</a></li>
	<li><a href="index.php?opt=mine">Mis Temas</a></li>
	<li><a href="index.php?opt=rules">Normas</a></li>
	</ul>
  </div>
    <!-- /content -->

  <!--<div class="clearfix"></div>-->
  <div id="footer">
    
  </div>
  <!-- /footer -->
</div>
<?php $pag->pie(); ?>
