<?php
	require_once("incluye.php");
	$pag = new pagina();
	$pag->encabezado("");
	$pag->cuerpo();
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
					<div class="WidgetLeft">
						<div class="WidgetTitle">Novedades en la Unidad</h3></div>
						<div class="WidgetContent">
							<p>widget1</p>
						</div>
					</div>
					<div class="WidgetLeft">
						<div class="WidgetTitle">Novedades en Foro</h3></div>
						<div class="WidgetContent">
							<p>widget2</p>
						</div>
					</div>					
				</div>
				<div class="WidgetListRight">
					<div class="WidgetRight">
						<div class="WidgetTitle">Cursos Actuales y Proximos</h3></div>
						<div class="WidgetContent">
							<p>widget3</p>
						</div>
					</div>
					<div class="WidgetRight">
						<div class="WidgetTitle">Acerca de la Unidad</h3></div>
						<div class="WidgetContent">
							<p>widget4</p>
						</div>
					</div>
				</div>
    		</div>
    	</div>
<?php
	$pag->pie();
?>
