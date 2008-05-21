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
	
	$pst1 = new Post("
		El ciego y el creativo","
--------------------------------------------------------------------------------

Dicen que una vez, había un ciego sentado en la vereda, con una gorra a sus pies y un pedazo de madera que, escrito con tiza blanca, decía: 'POR FAVOR AYUDEME, SOY CIEGO'.

Un creativo de publicidad que pasaba frente a él, se detuvo y observó unas pocas monedas en la gorra. Sin pedirle permiso tomó el cartel, lo dió vuelta, tomó una tiza y escribió otro anuncio. Volvió a poner el pedazo de madera sobre los pies del ciego y se fué. Por la tarde el creativo volvió a pasar frente al ciego que pedía limosna, su gorra estaba llena de billetes y monedas.

El ciego reconoció sus pasos y le preguntó si había sido él quien rescribió su cartel y sobre todo, qué había puesto.

El publicista le contestó 'Nada que no sea tan cierto como tu anuncio, pero con otras palabras, sonrió y siguió su camino. El ciego nunca lo supo, pero su nuevo cartel decía: 
' HOY ES PRIMAVERA, Y NO PUEDO VERLA'.

Cambiemos de estrategia cuando no nos sale algo, y verán que puede que resulte de esa manera.

Cuántas veces en nuestras vidas las cosas no salen, y nos enojamos, peleamos y nos entristecemos cuando tal vez debemos cambiar una pequeña cosa para que las cosas salgan bien.

Quizá tenemos problemas con las personas a nuestro alrededor y nunca recibimos ayuda, cuando lo que debemos hacer es simplemente sonreír.
Sin importar cual sea tu situación, haz un alto, analiza, revisa . Si es necesario corrige e incluso cambia todo si es necesario. Afortunadamente en la carretera de la vida, Jesús siempre nos permite virar en 'U'.
");
	$pst1->Show();
	?>
	</div>
  <div id="rightMenu">
	<ul>
	<li><a href="index.php?opt=mine">Mis Cursos</a></li>
	<li><a href="index.php?opt=actual">Cursos Actuales</a></li>
	<li><a href="index.php?opt=next">Cursos Proximos</a></li>
	<li><a href="index.php?opt=stuff">Material Didactico</a></li>
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
