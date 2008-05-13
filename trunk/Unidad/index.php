<?php
	require_once("../incluye.php");
	$pag = new paginaSecundaria();
	$pag->encabezado();
	$pag->cuerpo();
?>
<div id="wrap">
  <div id="header">
    <div id="logo">
      <h1>La Unidad</h1>
      <div>Cipriano Esmerejildo de los Angeles Pinzon    <a href="../index.php?action=logout">[Cerrar Sesion]</a></div>
    </div>
    <ul id="nav">
      <li><a href="../index.php">Principal</a></li>
      <li><a href="../Cursos/index.php?opt=mine">Cursos</a></li>
      <li><a href="../Forum/index.php?opt=cat">Foro</a></li>
      <li><a>La Unidad</a></li>
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
	<li><a href="index.php?opt=about">Acerca de la Unidad</a></li>
	<li><a href="index.php?opt=proc">Procesos Academicos</a></li>
	<li><a href="index.php?opt=news">Noticias</a></li>
	<li><a href="index.php?opt=util">Programas de Utileria</a></li>
	<li><a href="index.php?opt=contact">Contacto/Suscripcion</a></li>
	</ul>
  </div>
    <!-- /content -->

  <!--<div class="clearfix"></div>-->
  <div id="footer">
    
  </div>
  <!-- /footer -->
</div>
<?php $pag->pie(); ?>

