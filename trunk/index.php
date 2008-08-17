<?php
	require_once("incluye.php");
	$mcm = new MainContentManager();

		session_start();
		echo "<!DOCTYPE html PUBLIC \"-//IETF//DTD HTML 2.0//EN\"><html><head><title>
		Portal Unidad de PostGrados - Universidad de El Salvador</title>\n
		<META HTTP-EQUIV=\"Content-Type\" CONTENT=\"text/html; charset=\"UTF8\">\n
		<META NAME=\"AUTHOR\" CONTENT=\"Roberto Linares - Rodrigo Amaya\">\n
		<META NAME=\"COPYRIGHT\" CONTENT=\"Copyright (c) 2008 by Roberto Linares - Rodrigo Amaya\">\n
		<META NAME=\"KEYWORDS\" CONTENT=\"PostGrados, Maestria, Facultad Multidisciplinaria de Occidente, Universidad de El Salvador, UES, FMO, UES-FMO, Santa Ana\">\n
		<META NAME=\"DESCRIPTION\" CONTENT=\"Hacia la libertad por la Cultura\">\n
		<META NAME=\"ROBOTS\" CONTENT=\"INDEX, FOLLOW\">\n
		<META NAME=\"REVISIT-AFTER\" CONTENT=\"1 DAYS\">\n
		<META NAME=\"RATING\" CONTENT=\"GENERAL\">\n
		<link rel=\"alternate\" type=\"application/rss+xml\" title=\"PostGrados - Ultimas Novedades\" href=\"".URL."rss/feeds.php?genera=novedades\" />
		<link rel=\"alternate\" type=\"application/rss+xml\" title=\"PostGrados - Actividad en el Foro\" href=\"".URL."rss/feeds.php?genera=foro\" />
		<link rel=\"alternate\" type=\"application/rss+xml\" title=\"PostGrados - Noticias sobre los Cursos\" href=\"".URL."rss/feeds.php?genera=cursos\" />
		<link rel=\"stylesheet\" href=\"css/main.css\" type=\"text/css\" media=\"screen, projection\" title=\"PostGrados - UES - FMO Hojas de Estilo\">\n
		<link rel=\"stylesheet\" href=\"css/transpWidgets.css\" type=\"text/css\" media=\"screen, projection\" title=\"PostGrados - UES - FMO Hojas de Estilo\">\n
		<link rel=\"stylesheet\" href=\"css/forms.css\" type=\"text/css\" media=\"screen, projection\" title=\"PostGrados - UES - FMO Hojas de Estilo\">\n
		<link rel=\"stylesheet\" href=\"css/solidBlockMainMenu.css\" type=\"text/css\" media=\"screen, projection\" title=\"PostGrados - UES - FMO Hojas de Estilo\">\n
		<link rel=\"stylesheet\" href=\"css/style.css\" type=\"text/css\" media=\"screen, projection\" title=\"PostGrados - UES - FMO Hojas de Estilo\">\n
		</head>";
?>
   		<div id="loginBox">

				<div class='LoginBoxFrame'>
				<?php
					$vuser = new VisualUsuario();
					$vuser->Show();
				?>				
				</div>

		</div>

<div id="tables" style="position: relative; top: 20px;">
<table width="910" height="60" border="0" align="center" cellpadding="0" cellspacing="0" background="Media/hd3.png">
  <tr>
    <td>
    	<div id="logo" style="top: 0px">
			<div id="principal">Principal</div>
	    </div>
    	<ul id="nav" style="top: -3px; left: 480px;">
	      <li style="padding: 0 7px"><a>Principal</a></li>
	      <li style="padding: 0 7px"><a href="Cursos/index.php?opt=mine">Maestrias</a></li>
	      <li style="padding: 0 7px"><a href="Forum/index.php?opt=cat">Foro</a></li>
	      <li style="padding: 0 7px"><a href="Unidad/index.php?opt=about">La Unidad</a></li>
    	</ul>
    </td>
  </tr>
</table>
<table width="910" border="0" align="center" cellpadding="0" cellspacing="0" style="position: relative;">
  <tr>
    <td width="10" height="600" bgcolor="#FFFFFF">&nbsp;</td>
    <td width="900" bordercolor="#999999" background="Media/Background.jpg">	    			
	<table width="100%" border="0">
      <tr>
        <td><div align="center"><img src="Media/uesfmo.png" width="400" height="105" align="bottom" /></div></td>
      </tr>
      <tr>
        <td><div align="center">
          <p><img src="Media/minerva.png" width="145" height="245" align="top" /></p>
          <p><img src="Media/reflejo.png" width="144" height="59" align="top" /></p>
		  </div>
        </td>
      </tr>
      <tr>
        <td><div align="center"><img src="Media/unidad.png" width="430" height="60" /></div></td>
      </tr>
    </table>
				<div class="WidgetListLeft">
				<?php
					$wgAbout = new Widget("Acerca de la Unidad", "Unidad/index.php?opt=about", $mcm->showAbout(), "WidgetLeft");
					$wgAbout->Show();			
				
					//ejemplo de uso de widget nuevo
					$wdg = new WidgetNovedades();
					$wdg->claseCSS="WidgetLeft";
					$wdg->Titulo="Novedades en la Unidad";
					$wdg->masURL="Unidad/index.php?opt=news";
					$wdg->Show();						
				?>				
				</div>
				<div class="WidgetListRight">
					<?php
						$wgCursos = new Widget("Maestrias Actuales y Proximas", "Cursos/index.php?opt=actual", $mcm->showCourses(), "WidgetRight");
						$wgCursos->Show();												
						
						$wgForo = new Widget("Novedades en el Foro", "Forum/index.php?opt=cat", $mcm->showForum(), "WidgetRight");
						$wgForo->Show();
					?>
				</div>
	</td>
    <td width="10" height="600" background="Media/right.png">&nbsp;</td>
  </tr>
  <tr>
    <td width="10" height="60" bgcolor="#FFFFFF">&nbsp;</td>
    <td width="900" height="60" bgcolor="#FFFFFF"><center><a href="http://srbyte.com">llena este espacio con vinculos importantes :) </a></center></td>
    <td width="10" height="60" background="Media/right.png">&nbsp;</td>
  </tr>
</table>
<table width="910" height="20" border="0" align="center" cellpadding="0" cellspacing="0" background="Media/ft2.png">
  <tr>
    <td></td>
  </tr>
</table>
</div>
</body>
</html>