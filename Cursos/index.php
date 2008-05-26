<?php
	define("URL", "http://localhost/apollo/");//"http://ramayac.no-ip.biz/apollo/"); //"http://www.uesocc.edu.sv/postgrados/" 
	define("RUTA", realpath("../"));
	require_once("../incluye.php");
	require_once("Curso.php");
	require_once("CursosContentManager.php");
	require_once("Materia.php");
	require_once("ResManager.php");
	
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
      <h1>Maestrias</h1>      
    </div>
    <ul id="nav">
      <li><a href="../index.php">Principal</a></li>
      <li><a>Maestrias</a></li>
      <li><a href="../Forum/index.php?opt=cat">Foro</a></li>
      <li><a href="../Unidad/index.php?opt=about">La Unidad</a></li>
    </ul>
  </div>
  <!-- /header -->
  <div id="content"> <img src="../Media/style/MainBanner.png" alt="" class="img" />
    <?php	
		$ccm = new CursosContentManager($_GET["opt"]);
		$ccm->Show();
	?>
	</div>
  <div id="rightMenu">
	<ul>
	<li><a href="index.php?opt=mine">Mis Maestrias</a></li>
	<li><a href="index.php?opt=actual">Maestrias Actuales</a></li>
	<li><a href="index.php?opt=next">Maestrias Proximas</a></li>
	<li><a href="index.php?opt=event">Eventos</a></li>
	<li><a href="index.php?opt=stuff">Recursos Adicionales</a></li>
	<li><a href="index.php?opt=serv">Servicio Social</a></li>
	</ul>
  </div>
    <!-- /content -->

  <!--<div class="clearfix"></div>-->
  <div id="footer">
    
  </div>
  <!-- /footer -->
</div>

<?php $pag->pie(); ?>
