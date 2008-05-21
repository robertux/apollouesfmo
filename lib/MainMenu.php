<?php
    class MainMenu{
    	
		public function Show(){
			echo("
				<div id='vdividermenu'>
					<ul>
						<li><a id='current'>Principal</a></li>
						<li><a href='Cursos/index.php?opt=mine'>Cursos</a></li>
						<li><a href='Forum/index.php?opt=cat'>Foro</a></li>
						<li><a href='Unidad/index.php?opt=about'>La Unidad</a></li>
					</ul>
				</div>	
			");
		}
		
    }
?>
