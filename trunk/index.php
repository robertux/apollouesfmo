<?php
	require_once("incluye.php");
	$pag = new paginaPrincipal();
	$pag->encabezado();
	$pag->cuerpo();
	
	$mcm = new MainContentManager();
?>
    	<div id="fondoPrincipal">
    		<div id="contenidoPrincipal">
    			<!--<div id="loginBox">
    				<?php 
						$vuser = new VisualUsuario();
						$vuser->Show();
					?>
				</div>-->
				<div class="WidgetListLeft">
					<?php
						//ejemplo de uso de widget nuevo
						$wdg = new Widget();
						$wdg->claseCSS="WidgetLeft";
						$wdg->Titulo="Novedades en la Unidad";
						$wdg->masURL="Unidad/index.php?opt=news";
						$wdg->Show();
						
						//$wgForo = new Widget("Novedades en el Foro", $mcm->showForum(), "WidgetLeft", "Ir al Foro", "Forum/index.php?opt=cat");
						//$wgForo->Show();
					?>				
				</div>
				<div class="WidgetListRight">
					<?php /*
						$wgCursos = new Widget("Cursos Actuales y Proximos", $mcm->showCourses(), "WidgetRight", "Ir a Todos los Cursos", "Cursos/index.php?opt=actual");
						$wgCursos->Show();
						
						$wgAbout = new Widget("Acerca de la Unidad", $mcm->showAbout(), "WidgetRight", "Ver mas Informacion", "Unidad/index.php?opt=about");
						$wgAbout->Show();*/
					?>
				</div>
    		</div>
    	</div>
<?php $pag->pie(); ?>