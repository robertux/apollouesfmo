<?php

	/*!
	 * Agregamos los archivos que vamos a utilizar
	 */
	define("RUTA", realpath("../"));
	require_once("../incluye.php");
	require_once("CursosContentManager.php");
	require_once("../clases/cpostgrado.php");
	require_once("../clases/cevento.php");
	require_once("../clases/cservsoc.php");	
	require_once("../lib/VerticalTable.php");
	
	/*!
	 * Generamos la estructura basica de la pagina mediante la clase paginaSecundaria
	 */
	$pag = new paginaSecundaria();
	$pag->encabezado();
	$pag->cuerpo();
?>
<div id="wrap">
	<?php
	
		/*!
		 * Mostramos la barra superior para Iniciar/Cerrar sesion
		 */
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
      <li><a href="../Unidad/index.php?opt=about">La Unidad</a></li>
      <li><a href="../Forum/index.php?opt=cat">Foro</a></li>	  
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
				
				/*!
				 * Si el usuario que ha iniciado sesion posee privilegios de administrador, le mostraremos la opcion para administrar los usuarios
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
	<div class="about"><p style="color: #686C7A; font-size: 8pt">
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
