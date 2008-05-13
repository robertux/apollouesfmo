<?php
	require_once("incluye.php");
	$pag = new paginaPrincipal();
	$pag->encabezado("");
	$pag->cuerpo("");
?>
    	<div id="fondoPrincipal">
    		<div id="contenidoPrincipal">
    			<div id="loginBox">
    				<?php 
						$vuser = new VisualUsuario();
						$vuser->Show();
					?>
				</div>
				<div class="WidgetListLeft">
					<?php
						$wgUnidad = new Widget("Novedades en la Unidad", "Contenido del Widget Autogenerado", "WidgetLeft", "Ir a la Revista de la Unidad", "Unidad/index.php?section=revista");
						$wgUnidad->Show();
						
						$wgForo = new Widget("Novedades en el Foro", "Contenido del Widget Autogenerado", "WidgetLeft", "Ir al Foro", "Foro/index.php");
						$wgForo->Show();
					?>				
				</div>
				<div class="WidgetListRight">
					<?php
						$wgCursos = new Widget("Cursos Actuales y Proximos", "Contenido del Widget Autogenerado", "WidgetRight", "Ir a Todos los Cursos", "Cursos/index.php");
						$wgCursos->Show();
						
						$wgAbout = new Widget("Acerca de la Unidad", "Contenido del Widget Autogenerado", "WidgetRight", "Ver mas Informacion", "Unidad/index.php");
						$wgAbout->Show();
					?>
				</div>
    		</div>
    	</div>
<?php $pag->pie(); ?>