<?php
	
	/*!
	 * Pagina principal del AcercaDe.Muestra una plantilla similar a todas las demas paginas al hacer uso de la clase paginaSecundaria
	 * Su menu vertical se reduce a nada mas "Volver a Pagina Principal"
	 */

	define("RUTA", realpath("../"));
	require_once("../incluye.php");	
	require_once("../clases/cgeneral.php");
	require_once("../clases/cnovedades.php");
	require_once("../clases/cutileria.php");	
	require_once("../clases/cdocente.php");
	require_once("../clases/cprocesos.php");	
	require_once("../lib/VerticalTable.php");
	require_once("../lib/MGalleryManager.php");
	require_once("AcercaDeContentManager.php");
	
	/*!
	 * Instanciamos la clase paginaSecundaria e invocamos a sus metodos que nos generan el HTML basico
	 */
	$pag = new paginaSecundaria();
	$pag->encabezado();
	$pag->cuerpo();
?>
<div id="wrap">	
	<?php
		/*!
		 * Mostramos la barra superior para login/logout
		 */
		$vuser = new VisualUsuario();
		$vuser->Show();
	?>
  <div id="header">
  	<?php 
		/*!
		 * Mostramos el banner principal y el menu principal
		 */	
	 ?>
    <div id="logo">
      <h1>Acerca De...</h1>
    </div>
    <ul id="nav">
      <li><a href="../index.php">Principal</a></li>
      <li><a href="../Cursos/index.php?opt=mine">Maestrias</a></li>
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
			/*!
			 * El contenido lo tomamos de la invocacion al metodo Show() de la clase AcercaDeContentManager
			 */
			$cm = new AcercaDeContentManager();
			$cm->Show();
			
			/*
			 * Mostramos el menu lateral. Con la unica opcion de regresar a la pagina principal
			 */ 
		?>
	    <div id="rightMenu">
			<ul>
			<li><a href="../index.php">Regresar a la pagina principal</a></li>
			<!-- <li><a href="index.php?opt=proc">Procesos Academicos</a></li>
			<li><a href="index.php?opt=profs">Docentes</a></li>
			<li><a href="index.php?opt=news">Noticias</a></li>
			<li><a href="index.php?opt=util">Programas de Utileria</a></li>
			<li><a href="index.php?opt=contact">Contacto/Suscripcion</a></li> -->
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