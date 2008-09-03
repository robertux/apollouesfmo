<?php

	/*!
	 * Inclusion de los archivos necesarios
	 */
	define("RUTA", realpath("../"));
	require_once("../incluye.php");
	require_once("UnidadContentManager.php");	
	require_once("../clases/cgeneral.php");
	require_once("../clases/cnovedades.php");
	require_once("../clases/cutileria.php");	
	require_once("../clases/cdocente.php");
	require_once("../clases/cprocesos.php");
	require_once("../clases/cusuario.php");
	require_once("../lib/VerticalTable.php");
	require_once("../lib/MGalleryManager.php");
	
	/*!
	 * Se crea una instancia de la pagina secundaria para que esta genere la estructura basica de la pagina
	 */
	$pag = new paginaSecundaria();
	$pag->encabezado();
	$pag->cuerpo();
?>
<div id="wrap">	
	<?php
		/*!
		 * Se crea la barra superior para Iniciar/Cerrar sesion
		 */
		$vuser = new VisualUsuario();
		$vuser->Show();
	?>
  <div id="header">
    <div id="logo">
      <h1>La Unidad</h1>
    </div>
    <ul id="nav">
      <li><a href="../index.php">Principal</a></li>
      <li><a href="../Cursos/index.php?opt=actual">Maestrias</a></li>
      <li><a>La Unidad</a></li>
      <li><a href="../Forum/index.php?opt=cat">Foro</a></li>	  
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
			<?php 
				/*!
				 * Si hay un usuario logueado y este tiene permisos de administrador, se le mostrara la opcion de administrar usuarios
				 */
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
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
	<br/>
	<div class="about"><p style="color: #686C7A; font-size: 8pt"">
		Universidad de El Salvador Facultad Multidisciplinaria de Occidente<br/>
		Todos los Derechos (C) Reservados - Teléfonos:(503)2449-0349, Fax:(503)2449-0352 Apdo. 1908<br/>
			<a href="../AcercaDe/index.php">Créditos</a> - <a href="http://www.uesocc.edu.sv">Pagina Principal de la UES FMOcc</a></p>
	</div>
	<br/>
  </div>
    <!-- /content -->
  <!--<div class="clearfix"></div>-->
  <div id="footer">
    
  </div>
  <!-- /footer -->
</div>
<?php $pag->pie(); ?>