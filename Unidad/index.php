<?php
	define("URL", "http://localhost/apollo/");//"http://ramayac.no-ip.biz/apollo/"); //"http://www.uesocc.edu.sv/postgrados/" 
	define("RUTA", realpath("../"));
	require_once("../incluye.php");
	
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
  <div id="content"> <img src="../Media/style/MainBanner.png" alt="" class="img" />
    	<?php
			$pst1 = new Post("Titulo del Primer Post", "Pellentesque ultricies vulputate lacus. Nulla facilisi. Etiam rhoncus dapibus eros. Ut at lorem. Suspendisse potenti. Curabitur diam. Aliquam nec libero at purus gravida elementum. Suspendisse et massa id est fringilla rhoncus. Aliquam nec enim. Nulla eu ante ac mi posuere egestas. Praesent risus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec eleifend vestibulum nunc. In hac habitasse platea dictumst. Donec non risus. Etiam eleifend mauris eu urna. Duis ultricies ipsum eget lorem. Sed fringilla. In libero lectus, gravida vitae, tempor at, euismod et, quam. <br /><br />");
			$pst1->Show();
			
			$pst2 = new Post("Titulo del Segundo Post", "Pellentesque ultricies vulputate lacus. Nulla facilisi. Etiam rhoncus dapibus eros. Ut at lorem. Suspendisse potenti. Curabitur diam. Aliquam nec libero at purus gravida elementum. Suspendisse et massa id est fringilla rhoncus. Aliquam nec enim. Nulla eu ante ac mi posuere egestas. Praesent risus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec eleifend vestibulum nunc. In hac habitasse platea dictumst. Donec non risus. Etiam eleifend mauris eu urna. Duis ultricies ipsum eget lorem. Sed fringilla. In libero lectus, gravida vitae, tempor at, euismod et, quam. <br /><br />");
			$pst2->Show();
			
			$pst3 = new Post("Titulo del Segundo Post", "Pellentesque ultricies vulputate lacus. Nulla facilisi. Etiam rhoncus dapibus eros. Ut at lorem. Suspendisse potenti. Curabitur diam. Aliquam nec libero at purus gravida elementum. Suspendisse et massa id est fringilla rhoncus. Aliquam nec enim. Nulla eu ante ac mi posuere egestas. Praesent risus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec eleifend vestibulum nunc. In hac habitasse platea dictumst. Donec non risus. Etiam eleifend mauris eu urna. Duis ultricies ipsum eget lorem. Sed fringilla. In libero lectus, gravida vitae, tempor at, euismod et, quam. <br /><br />");
			$pst3->Show();
		?>
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

