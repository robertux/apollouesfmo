<?php
	define("URL", "http://localhost/apollo/");//"http://ramayac.no-ip.biz/apollo/"); //"http://www.uesocc.edu.sv/postgrados/" 
	define("RUTA", realpath("./"));
	
	require_once("incluye.php");
	$pag = new paginaPrincipal();
	$pag->encabezado();
	$pag->cuerpo();
	
	$mcm = new MainContentManager();
?>
   		<div id="loginBox">
			<?php
				$vuser = new VisualUsuario();
				$vuser->Show();
			?>
		</div>
    	<div id="fondoPrincipal">
    		<div id="contenidoPrincipal">
    			<?php
					$principal = new MainMenu();
					$principal->Show();
				?>
				<div class="WidgetListLeft">
					<?php
						//ejemplo de uso de widget nuevo
						$wdg = new WidgetNovedades();
						$wdg->claseCSS="WidgetLeft";
						$wdg->Titulo="Novedades en la Unidad";
						$wdg->masURL="Unidad/index.php?opt=news";
						$wdg->Show();

						$wgForo = new Widget("Novedades en el Foro", "Forum/index.php?opt=cat", $mcm->showForum(), "WidgetLeft");
						$wgForo->Show();
					?>				
				</div>
				<div class="WidgetListRight">
					<?php
						$wgCursos = new Widget("Maestrias Actuales y Proximas", "Cursos/index.php?opt=actual", $mcm->showCourses(), "WidgetRight");
						$wgCursos->Show();
						
						$wgAbout = new Widget("Acerca de la Unidad", "Unidad/index.php?opt=about", $mcm->showAbout(), "WidgetRight");
						$wgAbout->Show();
					?>
				</div>
    		</div>
    	</div>
<?php $pag->pie(); ?>