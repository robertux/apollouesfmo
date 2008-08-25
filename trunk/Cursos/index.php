<?php
	define("RUTA", realpath("../"));
	require_once("../incluye.php");
	require_once("Curso.php");
	require_once("CursosContentManager.php");
	require_once("Materia.php");
	require_once("ResManager.php");
	require_once("../clases/cpostgrado.php");
	require_once("../lib/VerticalTable.php");
	
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
  <div id="content"> 
  	<div id="banner">
  		<img src="../Media/style/MainBanner.png" alt="" class="img" />
	</div>
	<div id="innerContent">
	    <?php	
			$ccm = new CursosContentManager($_GET["opt"]);
			$ccm->Show();
		?>	
		<div id="rightMenu">
			<ul>
			<li><a href="index.php?opt=actual">Maestrias Actuales</a></li>
			<li><a href="index.php?opt=next">Maestrias Proximas</a></li>
			<li><a href="index.php?opt=event">Eventos</a></li>
			<li><a href="index.php?opt=serv">Servicio Social</a></li>
			</ul>
			<?php 
				if($_SESSION["CurrentUser"] != ""){
					$myUser = new cusuario();
					$myUser->GetPorId($_SESSION["CurrentUser"]);
					if($myUser->privilegio == "admin"){
						echo "
							<div id=\"\">
							<div class='innerTitle' style='margin-top: 25px'>Administracion</div>
							</div>
							<ul>
								<li><a href=\"index.php?opt=usr\">Usuarios</a></li>
							</ul>							
						";
					}
				}
			?>
		  </div>
	</div>
	<br/>
	<br/>
	<br/>
	<div class="about" style="position: relative; top: 20px; width: 700px; border-top: 1px solid #DDDDDD;"><p style="color: black;">
		Universidad de El Salvador Facultad Multidisciplinaria de Occidente<br/>
		Todos los Derechos (C) Reservados - Teléfonos:(503)2449-0349, Fax:(503)2449-0352 Apdo. 1908<br/>
		<a href="../AcercaDe/index.php">Créditos</a></p>
	</div>
  </div>
    <!-- /content -->

  <!--<div class="clearfix"></div>-->
  <div id="footer">
    
  </div>
  <!-- /footer -->
</div>

<?php $pag->pie(); ?>
