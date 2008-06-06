<?php
define("RUTA", realpath("../"));
require_once(RUTA."/clases/cnovedades.php");

class VisualNovedades{
	public $nov;
	public $a;
	public $recid;
	public $page;
	public $sql;
	public $file; // archivo.php
	public $showrecs = 10;
	public $pagerange = 10;

	function __construct()
	{
		$this->nov = new cNovedades();
	}

	//HACK completo
	public function GetRecordCount()
	{
		$Consulta = "SELECT COUNT(*) FROM novedades;";
		$this->nov->con->Conectar();
		if ($resultado = $this->nov->con->mysqli->query($Consulta))
		{
			$row = $resultado->fetch_array();
			return $row[0];
		}
	}

	public function ConsultaEscalar($sql)
	{
		$this->nov->Consultar($sql, false);
	}

	public function sqlvalue($val, $quote)
	{
		if ($quote)
			$tmp = $this->sqlstr($val);
		else
			$tmp = $val;
		if ($tmp == "")
			$tmp = "NULL";
		elseif ($quote)
			$tmp = "'".$tmp."'";
		return $tmp;
	}

	public function sqlstr($val)
	{
		return str_replace("'", "''", $val);
	}

	public function sql_select()
	{
		$res = $this->nov->GetLista();
		return $res;
	}

	public function sql_getrecordcount()
	{
		$tmp = $this->GetRecordCount();
		return $tmp;
	}

	public function select()
	{
		$res = $this->sql_select();
		$count = $this->sql_getrecordcount();
		if ($count % $this->showrecs != 0) {
			$pagecount = intval($count / $this->showrecs) + 1;
		}
		else {
			$pagecount = intval($count / $this->showrecs);
		}
		$startrec = $this->showrecs * ($this->page - 1 );
		//if ($startrec == 0) then 
		if ($startrec < $count) {$res->data_seek($startrec);}
		$reccount = min($this->showrecs * $this->page, $count);

		echo '<table class="bd" border="0" cellspacing="1" cellpadding="4"><tr><td>Tabla: novedades</td></tr><tr><td>Registros mostrados '.$reccount.' de '.$count.'</td></tr></table><hr size="1" noshade>'.$this->showpagenav($this->page, $pagecount);

		echo '<br><table class="tbl" border="1" cellspacing="1" cellpadding="5"width="100%">
		<tr>
			<td class="hr">&nbsp;</td>
			<td class="hr">&nbsp;</td>
			<td class="hr">&nbsp;</td>
			<td class="hr">Titulo de la Noticia:</td>
			<td class="hr">Vinculo a la Noticia:</td>
			<td class="hr">Descripcion:</td>
			<td class="hr">Fecha:</td>
		</tr>';

		for ($i = $startrec; $i < $reccount; $i++)
		{
			$row = $res->fetch_array();
			$style = "dr";
			if ($i % 2 != 0) {
				$style = "sr";
			}
			echo '<tr>
	  	<td class="'.$style.'"><a href="'.$this->file.'?a=view&recid='.$i.'">Ver</a></td>
	  	<td class="'.$style.'"><a href="'.$this->file.'?a=edit&recid='.$i.'">Modificar</a></td>
	  	<td class="'.$style.'"><a href="'.$this->file.'?a=del&recid='.$i.'">Eliminar</a></td>
	  	<td class="'.$style.'">'.htmlspecialchars($row["titulo"]).'</td>
	  	<td class="'.$style.'">'.htmlspecialchars($row["vinculo"]).'</td>
	  	<td class="'.$style.'">'.htmlspecialchars($row["descripcion"]).'</td>
	  	<td class="'.$style.'">'.htmlspecialchars($row["fecha"]).'</td></tr>';
		}
		$res->close();
		echo "</table><br>";
	}

	public function sql_insert()
	{
		global $_POST;
		$sql = "insert into `novedades` (`titulo`, `vinculo`, `descripcion`, `fecha`) values (" .$this->sqlvalue(@$_POST["titulo"], true).", " .$this->sqlvalue(@$_POST["vinculo"], true).", " .$this->sqlvalue(@$_POST["descripcion"], true).", " .$this->sqlvalue(@$_POST["fecha"], true).")";
		$this->ConsultaEscalar($sql);
	}

	public function sql_update()
	{
		/*global $_POST;
		$sql = 'update `novedades` set `titulo`="'.@$_POST["titulo"].
		'", `vinculo`="'.@$_POST["vinculo"].
		'", `descripcion`="'.@$_POST["descripcion"].
		'",	`fecha`="'.@$_POST["fecha"].
		'" where "'.$this->primarykeycondition();*/
		//$this->GetPosts();
		$sql = 'update `novedades` set `titulo`="'.$this->nov->titulo.
		'", `vinculo`="'.$this->nov->vinculo.
		'", `descripcion`="'.$this->nov->descripcion.
		'",	`fecha`="'.$this->nov->fecha.
		'" where '.$this->primarykeycondition();
		//echo "\n HEY HEY HEYYY!!! Mira veee!!!    <h2>$sql</h2>";
		$this->ConsultaEscalar($sql);
	}

	public function sql_delete()
	{
		$sql = "delete from `novedades` where ".$this->primarykeycondition();
		$this->ConsultaEscalar($sql);
	}

	public function primarykeycondition()
	{
		global $_POST;
		$pk = "";
		$pk .= "(`id`";
		if (@$_POST["xid"] == "") {
			$pk .= " IS NULL";
		}else{
			$pk .= " = " .$this->sqlvalue(@$_POST["xid"], false);
		};
		$pk .= ")";
		return $pk;
	}

	public function viewrec()
	{
		$res = $this->sql_select();
		$count = $this->sql_getrecordcount();
		$res->data_seek($this->recid);
		$row = $res->fetch_array();
		$this->showrecnav("view", $this->recid, $count);
		echo '<br>';
		$this->showrow($row, $this->recid);
		echo '<br>
		<hr size="1" noshade>
		<table class="bd" border="0" cellspacing="1" cellpadding="4">
		<tr>
			<td><a href="'.$this->file.'?a=add">Agregar Registro</a></td>
			<td><a href="'.$this->file.'?a=edit&recid='.$this->recid.'">Editar Registro</a></td>
			<td><a href="'.$this->file.'?a=del&recid='.$this->recid.'">Eliminar Registro</a></td>
		</tr>
		</table>';
		$res->close();
	}

	public function showrecnav($a, $recid, $count)
	{
		$this->a = $a;
		$this->recid = $recid;
		echo '<table class="bd" border="0" cellspacing="1" cellpadding="4"><tr><td><a href="'.$this->file.'">Pagina principal</a></td>';
		if ($this->recid > 0) {
			echo '<td><a href="'.$this->file.'?a='.$this->a.'&recid='. ($this->recid - 1) .'">Registro Anterior</a></td>';
		} if ($this->recid < $count - 1) {
			echo '<td><a href="'.$this->file.'?a='.$this->a.'&recid='. ($this->recid + 1) .'">Registro Siguiente</a></td>';
		}
		echo '</tr></table><hr size="1" noshade>';
	}

	public function showrow($row, $recid)
	{
		echo '<table class="tbl" border="0" cellspacing="1" cellpadding="5"width="50%"><tr>
		<td class="hr">'.htmlspecialchars("Titulo de la Noticia:").'&nbsp;</td>
		<td class="dr">'.htmlspecialchars($row["titulo"]).'</td></tr><tr>
		<td class="hr">'.htmlspecialchars("Vinculo a la Noticia:").'</td>
		<td class="dr">'.htmlspecialchars($row["vinculo"]).'</td></tr><tr>
		<td class="hr">'.htmlspecialchars("Descripcion:").'</td>
		<td class="dr">'.htmlspecialchars($row["descripcion"]).'</td></tr><tr>
		<td class="hr">'.htmlspecialchars("Fecha:").'</td>
		<td class="dr">'.htmlspecialchars($row["fecha"]).'</td></tr></table>';
	}

	public function showpagenav($page, $pagecount)
	{
		echo '<table class="bd" border="0" cellspacing="1" cellpadding="4">
		<tr><td><a href="'.$this->file.'?a=add">Agregar Registro</a>&nbsp;</td>';
		if ($page > 1) {
			echo '<td><a href="'.$this->file.'?page='. $page - 1 .'">&lt;&lt;&nbsp;Anterior</a>&nbsp;</td>';
		}

		global $pagerange; //hmmmm
		if ($pagecount > 1) {
			if ($pagecount % $pagerange != 0) {
				$rangecount = intval($pagecount / $pagerange) + 1;
			}
			else {
				$rangecount = intval($pagecount / $pagerange);
			}
			for ($i = 1; $i < $rangecount + 1; $i++) {
				$startpage = (($i - 1) * $pagerange) + 1;
				$count = min($i * $pagerange, $pagecount);

				if ((($page >= $startpage) && ($page <= ($i * $pagerange)))) {
					for ($j = $startpage; $j < $count + 1; $j++) {
						if ($j == $page) {
							echo '<td><b>'.$j.'</b></td>';
						}
						else {
							echo '<td><a href="'.$this->file.'?page='.$j.'">'.$j.'</a></td>';
						}
					}
				}
				else {
					echo '<td><a href="'.$this->file.'?page='.$startpage.'">'.$startpage ."..." .$count.'</a></td>';
				}
			}
		}
		if ($page < $pagecount) {
			echo '<td>&nbsp;<a href="'.$this->file.'?page='.$page + 1 .'">Siguiente&nbsp;&gt;&gt;</a>&nbsp;</td>';
		}
		echo '</tr></table>';
	}

	public function addrec()
	{
		echo '<table class="bd" border="0" cellspacing="1" cellpadding="4"><tr><td>
			<a href="'.$this->file.'">Pagina principal</a></td>
			</tr></table><hr size="1" noshade>
			<form enctype="multipart/form-data" action="'.$this->file.'" method="post">
			<p><input type="hidden" name="sql" value="insert"></p>';
		$row = array("id" => "","titulo" => "","vinculo" => "","descripcion" => "","fecha" => "");
		$this->showroweditor();
		echo '<p><input type="submit" name="action" value="Establecer"></p></form>';
	}

	function editrec()
	{
		$this->nov->GetPorId($this->recid);
		$count = $this->sql_getrecordcount();
		$this->showrecnav("edit", $this->recid, $count);
		echo '<br><form enctype="multipart/form-data" action="'.$this->file.'" method="post"><input type="hidden" name="sql" value="update">
		<input type="hidden" name="xid" value="'.$this->nov->id.'">';
		$this->showroweditor();
		echo '<p><input type="submit" name="action" value="Establecer"></p></form>';
		//$row->close();
	}
	
	public function showroweditor()
	{
		echo '<table class="tbl" border="0" cellspacing="1" cellpadding="5"width="50%">
			<tr><td class="hr">'.htmlspecialchars("Titulo de la Noticia:").'&nbsp;</td>
			<td class="dr"><input type="text" name="titulo" value="'.$this->nov->titulo.'"></td>
			</tr>
			<tr><td class="hr">'.htmlspecialchars("Vinculo a la Noticia:").'&nbsp;</td>
			<td class="dr"><textarea cols="35" rows="4" name="vinculo" maxlength="50">'.$this->nov->vinculo.'</textarea></td>
			</tr>
			<tr><td class="hr">'.htmlspecialchars("Descripcion:").'&nbsp;</td>
			<td class="dr"><textarea cols="35" rows="4" name="descripcion" maxlength="100">'.$this->nov->descripcion.'</textarea></td>
			</tr>
			<tr><td class="hr">'.htmlspecialchars("Fecha:").'&nbsp;</td>
			<td class="dr"><input type="text" name="fecha" maxlength="65535" value="'.$this->nov->fecha.'"></td>
			</tr></table>';
	}

	public function deleterec()
	{
		$res = $this->sql_select();
		$count = $this->sql_getrecordcount();
		$res->data_seek($this->recid);
		$row = $res->fetch_assoc();
		$this->showrecnav("del", $this->recid, $count);
		echo '<br><form action="'.$this->file.'" method="post"><input type="hidden" name="sql" value="delete">
		<input type="hidden" name="xid" value="'.$row["id"].'">'.$this->showrow($row, $recid).'<p>
		<input type="submit" name="action" value="Confirmar"></p></form>';
		$res->close();
	}
	
	/*public function GetPosts()
	{
		global $_POST;
	}*/
}
?>