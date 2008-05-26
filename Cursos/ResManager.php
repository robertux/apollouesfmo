<?php
    Class ResManager{
    	
		public function GetSubjectsRes(){
			$pstmaf = new InnerInnerPost("Maestria en Administracion Financiera", "
			<table border='1'>
				<tr><th>Programa de la Materia</th><td id='Left'>Tipo: Documento PDF, Tamanio: 1.2 MB</td><td id='Left'><a href='#'>Descargar</a></td></tr>
				<tr><th>Libro Electronico de Finanzas</th><td id='Left'>Tipo: Doumento PDF, Tamanio: 6.5 MB</td><td id='Left'><a href='#'>Descargar</a></td></tr>
				<tr><th>Tarea 1</th><td id='Left'>Tipo: Documento de Word, Tamanio: 512 KB</td><td id='Left'><a href='#'>Descargar</a></td></tr>
			</table>
			", 500);
			$pstmpds = new InnerInnerPost("Maestria en Profesionalizacion de la Docencia Superior", "
			<table border='1'>
				<tr><th>Programa de la Materia</th><td id='Left'>Tipo: Documento PDF, Tamanio: 1.2 MB</td><td id='Left'><a href='#'>Descargar</a></td></tr>
				<tr><th>Recursos para la Clase</th><td id='Left'>Tipo: Documento ZIP, Tamanio: 4.2 MB</td><td id='Left'><a href='#'>Descargar</a></td></tr>
			</table>
			", 500);
			$pst1 = new InnerPost("Recursos de Mis Maestrias", $pstmaf->ToString() . $pstmpds->ToString(), 500);
			return $pst1->ToString();
		}
		
		public function GetAddRes(){
			$pst = new InnerPost("Agregar un recurso", "
				<form id='frmUploadFile' action='index.php?opt=stuff&action=upload' method='post'>
					<p id='PostInnerContent'>
						<table border='1' width='480px'>
							<tr><th><label class='lblInput' for'cmbMaestria' name='lblMaestria' id='lblMaestria'>Seleccione la Maestria</label></th>
								<td id='Left'><select name='cmbMaestria'><option value=''>Maestria en Administracion Financiera</option><option value=''>Maestria en Profesionalizacion de la Docencia Superior</option></select></td></tr>
							<tr><th><label class='lblInput' for'txtResName' name='lblResName' id='lblResName'>Escriba un nombre para el nuevo recurso</label></th>
								<td id='Left'><input type='text' name='txtResName' id='txtResName' /></td></tr>
							<tr><th><label class='lblInput' for='FileUploader'/>Seleccione el archivo a subir: </label></th>
								<td id='Left'><input name='file' type='file' id='FileUploader' /></td></tr>
							<tr><th></th><td id='Right'><input type='submit' id='btnSubmitUpload' value='Subir archivo' /></td></tr>
						</table>
					</p>
				</form>
			", 500);
			return $pst->ToString();
		}
		
    }
?>
