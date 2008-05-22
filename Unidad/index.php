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
			$pst1 = new Post("Lorem Ipsum Primero", "Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Etiam quis magna sed nunc volutpat tempus. Nunc a erat in eros consectetuer fringilla. Maecenas nisl. Nam mi mauris, tempus vulputate, blandit et, semper a, mauris. Aliquam viverra, odio eget suscipit blandit, turpis enim tristique sapien, a commodo nisl tellus eu ligula. Mauris ut nisl vitae tortor adipiscing congue. Cras aliquam. Suspendisse dignissim dapibus orci. Sed feugiat. Suspendisse potenti. Curabitur fringilla. Mauris est orci, iaculis a, dignissim ac, elementum eget, diam. In luctus rhoncus urna. Duis tortor libero, faucibus vel, cursus a, vehicula nec, libero. Quisque nec eros. Quisque pellentesque mollis lectus. Pellentesque ultricies. Nulla in velit.");
			$pst1->Show();
			
			$pst2 = new Post("Lorem Ipsum Segundo", "Morbi molestie mattis mauris. Mauris diam metus, congue sit amet, posuere et, egestas vitae, nisi. Nullam semper euismod purus. Mauris vitae nisl. Proin magna magna, auctor sed, congue a, auctor ut, massa. Aliquam erat volutpat. Curabitur adipiscing auctor mauris. Aliquam hendrerit. Integer purus. Praesent lacinia elit volutpat tortor. Sed massa. <br /><br />Nam dictum. Quisque ut nisl. Morbi blandit. Nullam fermentum convallis sem. Aliquam eget diam rhoncus leo pellentesque tincidunt. Integer vel nulla. Donec quis mauris. Aenean eget mauris. Phasellus eget diam. Donec odio mi, ullamcorper eget, eleifend sit amet, venenatis ut, justo. Phasellus aliquam. Ut sollicitudin tincidunt leo. Curabitur massa nisl, tincidunt faucibus, vehicula eleifend, egestas quis, nulla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vestibulum in ipsum. Curabitur vitae massa a arcu fringilla tempus. ");
			$pst2->Show();
			
			$pst3 = new Post("Lorem Ipsum Tercero", "Pellentesque ultricies vulputate lacus. Nulla facilisi. Etiam rhoncus dapibus eros. Ut at lorem. Suspendisse potenti. Curabitur diam. Aliquam nec libero at purus gravida elementum. Suspendisse et massa id est fringilla rhoncus. Aliquam nec enim. Nulla eu ante ac mi posuere egestas. Praesent risus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec eleifend vestibulum nunc. In hac habitasse platea dictumst. Donec non risus. Etiam eleifend mauris eu urna. Duis ultricies ipsum eget lorem. Sed fringilla. In libero lectus, gravida vitae, tempor at, euismod et, quam. <br /><br />");
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

