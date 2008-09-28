<?php

	/*!
	 * \brief La clase Post es la base para mostrar informacion en las paginas secundarias.
	 * Consiste en un cuadrado con un titulo, alternativamente una fecha y un contenido, el cual puede ser texto plano o mas avanzado y complejo con una tabla con multiples filas
	 * Ademas de eso, un Post puede contener otros Posts, especialmente innerPosts para subclasificar la iformacion que se muestra en ellos
	 * La informacion de los Posts es agregable/modificable/eliminable si se poseen los permisos. Ademas tambien se puede paginar su contenido desde los ContentManagers
	 */
    class Post{
    	
		/*!
		 * Identificador unico del Post. Necesario para reconocerlo y modificarlo desde el EditInPlace
		 */
		var $id;
		/*!
		 * La tabla a la cual pertenece el registro representado en este post
		 */
		var $tabla;
		/*!
		 * El titulo que se muestra en la parte superior del post
		 */
		var $titulo;
		/*!
		 * La fecha que aparece junto al titulo del post
		 */
		var $fecha;
		/*!
		 * Contenido del post
		 */
		var $contenido;
		/*!
		 * Ancho del elemento
		 */
		var $ancho;
		/*!
		 * Objeto que contiene los botones de edicion del post
		 */
		var $tbox;
		/*!
		 * Valor booleano que indica si a este post le podran agregar mas subposts si el usuario tiene privilegios de administracion
		 */
		var $showAddWhenAdmin;
		/*!
		 * Valor booleano que indica si este post sera modificable por un usuario con privilegios de administracion
		 */
		var $showEditWhenAdmin;
		/*!
		 * Valor booleano que indica si este post sera modificable por un usuario con privilegios de administracion
		 */
		var $showDelWhenAdmin;
		/*!
		 * Valor booleano que indica si la ayuda de este post sera visible por todos(always), por un usuario con privilegios de administracion(admin) o por ningun usuario(never)
		 */
		public $showHelp;
		/*!
		 * Variable que almacena la URL de la pagina de ayuda correspondiente a este post.
		 */		
		public $helpAction;
		/*!
		 * Contenido de la parte inferior del Post. Comunmente aqui va el PostPager
		 */		
		var $pie;
		/*!
		 * Valor booleano que define si sera posible editar el titulo del post cuando se esta en modo de edicion
		 */
		var $editableTitle;
		/*!
		 * Valor booleano que define si el contenido del post es texto plano o no
		 */
		var $plainTextContent;
		/*!
		 * ID del usuario que ha iniciado sesion actualmente
		 */
		var $uid;
		/*!
		 * Maxima longitud que podra tener el campo titulo del post
		 */
		var $tituloMaxLength;
		
		/*!
		 * Constructor Inicializa los campos del post
		 * \param $pTitulo El titulo del post
		 * \param $pContenido El contenido del post
		 * \param $pAncho El ancho que tendra el post
		 * \param $pShowAddWhenAdmin Si se le podran agregar subposts por un usuario administrador
		 * \param $pShowEditWhenAdmin Si un usuario administrador podra editar este post
		 * \param $pShowDelWhenAdmin Si un usuario administrador podra borrar este post
		 */
		public function Post($pTitulo="Titulo", $pContenido="Contenido", $pAncho=550, $pShowAddWhenAdmin=false, $pShowEditWhenAdmin=false, $pShowDelWhenAdmin=false){
			$this->id = $pId;
			$this->titulo = $pTitulo;
			$this->contenido = $pContenido;
			$this->ancho = $pAncho;
			$this->tbox = new ToolBox();
		 	$this->showAddWhenAdmin = $pShowAddWhenAdmin;			
		 	$this->showEditWhenAdmin = $pShowEditWhenAdmin;
			$this->showDelWhenAdmin = $pShowDelWhenAdmin;
			$this->showHelp = "never";
			$this->pie = "";
			$this->editableTitle = true;
			$this->plainTextContent = true;
		}
		
		/*!
		 * Este metodo se encarga de definir la accion del clic de cada boton, los cuales son llamadas a metodos del archivo EditInPlace, pasandole algunos parametros necesarios
		 */
		public function SetTBox(){						
			
			if($this->editableTitle)
				$this->tbox->btnEdit->onClick = "EditPost('$this->id', '$this->plainTextContent')";
			else
				$this->tbox->btnEdit->onClick = "EditPostContent('$this->id', '$this->plainTextContent')";
			$this->tbox->btnAdd->id = "add-$this->id";
			$this->tbox->btnAdd->onClick = "AddPost('$this->id', '$this->tabla','" . $this->uid . "')";
			$this->tbox->btnEdit->id = "edit-$this->id";
			$this->tbox->btnDel->id = "del-$this->id";
			$this->tbox->btnDel->onClick = "DelPost('$this->id','" . $this->uid . "')";
			$this->tbox->btnSave->id = "sav-$this->id";
			$this->tbox->btnSave->onClick = "SavePost('$this->id', '" . $this->uid . "', '$this->plainTextContent')";
			$this->tbox->btnCancel->id = "can-$this->id";
			$this->tbox->btnCancel->onClick = "CancelPost('$this->id', '$this->plainTextContent')";
		}
		
		/*!
		 * Este metodo se encarga de configurar la toolBox (caja que contiene los botones de agregar/editar/eliminar/guardar/cancelar)
		 * Verificara si algun usuario ha iniciado sesion y de ser asi si posee privilegios de administrador. Si ese es el caso, y si se han configurado de esa forma sus propiedades, mostrara los botones de edicion
		 */
		public function CheckUser(){
			$myUser = new cusuario();
			$myUser->GetPorId($_SESSION["CurrentUser"]);
			if($myUser->privilegio == "admin"){
				if($this->showAddWhenAdmin)
					$this->tbox->btnAdd->enabled = true;
				if($this->showEditWhenAdmin)
					$this->tbox->btnEdit->enabled = true;
				if($this->showDelWhenAdmin)
					$this->tbox->btnDel->enabled = true;
				if($this->showHelp == "admin")
					$this->tbox->btnHelp->enabled = true;
			}
			if($this->showHelp == "always")
				$this->tbox->btnHelp->enabled = true;
			elseif($this->showHelp == "never")
				$this->tbox->btnHelp->enabled = false;
			$this->tbox->btnHelp->onClick = $this->helpAction;
			$this->uid = $_SESSION["CurrentUser"];
		}
		
		/*!
		 * Este metodo devuelve el codigo HTML que representa a este Post
		 */
		public function ToString(){
				return "<div id='pst-$this->id' class='Post' style='width: " . $this->ancho . "px;' >" .
					$this->toContentString() .
	   			"</div>";
		}
		
		/*!
		 * Este metodo devuelve nada mas la parte del contenido del codigo HTML que representa a este Post.
		 * Este metodo es invocado usualmente cuando se ha cambiado de pagina (hablando de paginacion)
		 */
		public function ToContentString(){
			//!Verificamos el usuario
			$this->CheckUser();
			//!Configuramos los botones de edicion
			$this->SetTBox();
			//!Verificamos si habra que mostrar la fecha junto al titulo
			$fechaField = "";
			if($this->fecha != ""){
				$fechaField = "<input type='text' id='fch-$this->id' class='PostDate' value='$this->fecha' disabled='true' style='width: 18%' ></inpurt>";
			}
			
			//!Definimos el footer, que comunmente lo ocupa el PostPager
			$footer = "";
			if($this->pie != "")
				$footer = "<div class='PostFooter' style='width: " . $this->ancho . "px;'>$this->pie</div>";
			
			//!Se define la longitud maxima para el titulo
			if($this->tituloMaxLength != "")
				$this->tituloMaxLength = " maxlength='" . $this->tituloMaxLength . "'";

			//!En base a todo lo anterior, se genera el HTML del Post
			return "			
	    		<div class='PostTitle' style='width: " . ($this->ancho - 12) . "px;'>
					" . $this->tbox->ToString() . $fechaField .
					"<input type='text' id='txt-$this->id' class='innerTitle' value='$this->titulo' disabled='true' $this->maxLength />
				</div>
				<div id='cont-$this->id' class='PostContent'>
				    <div id='area-$this->id' class='innerContent'>
						$this->contenido
					</div>					
				</div>
				<input type='hidden' id='tmpcnt-$this->id' value=''/>
				<input type='hidden' id='tmptit-$this->id' value=''/>
				<input type='hidden' id='tmpfch-$this->id' value=''/>
				<input type='hidden' id='id-$this->id' value='$this->id'/>
				<input type='hidden' id='tbl-$this->id' value='$this->tabla'/>
				$footer			
			";			
		}
		
		/*!
		 * Imprime este Post en la posicion actual
		 */
		public function Show(){			
			echo($this->ToString());
		}
    }
	


	/*!
	 * \brief Clase que representa a un Post interno. Con las mismas caracteristicas heredadas del anterior pero con un estilo y un ancho menor
	 * Esto debido a que comunmente se ocupa para listar una serie de elementos como contenido de un Post superior
	 */
	class InnerPost extends Post{
		
		/*!
		 * Devuelve el codigo HTML que representa a este Post
		 */
		public function ToString(){
			return "<div id='pst-$this->id' class='innerPost' style='width: " . $this->ancho . "px;'>" .
			$this->ToContentString() .
			"</div>";
		}
		
		/*!
		 * Devuelve nada mas el contenido del codigo HTML que representa a este post
		 * Notaran que en la estructura es casi igual a su padre a diferencia de algunos nombres de las etiquetas y las clases CSS que utiliza
		 */
		public function ToContentString(){			
			$this->CheckUser();			
			$this->SetTBox();
			$fechaField = "";
			if($this->fecha != ""){
				$fechaField = "<input type='text' id='fch-$this->id' class='PostDate' value='$this->fecha' disabled='true' style='width: 18%' ></input>";
			}
			
			$footer = "";
			if($this->pie != "")
				$footer = "<div class='PostFooter'>$this->pie</div>";
			
			if($this->tituloMaxLength != "")
				$this->tituloMaxLength = " maxlength='" . $this->tituloMaxLength . "'";
			
			return "			
    			<div class='PostTitle' style='width: " . ($this->ancho - 4) . "px;'>
					"  . $this->tbox->ToString() . $fechaField .
					"<input type='text' id='txt-$this->id' class='innerTitle' value='$this->titulo' disabled='true' $this->tituloMaxLength />
				</div>
				<div id='cont-$this->id' class='PostContent'>
				    <div id='area-$this->id' class='innerContent'>
						$this->contenido
					</div>					
				</div>
				<input type='hidden' id='tmpcnt-$this->id' value=''/>	
				<input type='hidden' id='tmptit-$this->id' value=''/>
				<input type='hidden' id='tmpfch-$this->id' value=''/>
				<input type='hidden' id='id-$this->id' value='$this->id'/>
				<input type='hidden' id='tbl-$this->id' value='$this->tabla'/>
				$footer			
			";
		}		
	}
	
	/*!
	 * Representa a una clase de Post aun mas interna, capaz de ser contenida por un InnerPost
	 */
	class InnerInnerPost extends InnerPost{
		
		/*!
		 * Valor booleano que define si se mostrara nada mas el titulo del post o tambien su area. Utilizado en la parte de Administracion de Usuarios
		 */
		public $displayArea = true;
		
		/*!
		 * Devuelve el codigo HTML que representa a este post
		 */
		public function ToString(){			
			return "<div id='pst-$this->id' class='innerInnerPost' style='width: " . $this->ancho . "px;'>" . 
			$this->ToContentString() . 
			"</div>";			
		}
		
		/*!
		 * Devuelve nada mas el contenido del codigo HTML que representa a este post
		 * Notaran que en la estructura es casi igual a su padre a diferencia de algunos nombres de las etiquetas y las clases CSS que utiliza
		 */		
		public function ToContentString(){			
			$this->CheckUser();			
			$this->SetTBox();
			$fechaField = "";
			if($this->fecha != ""){
				$fechaField = "<input type='text' id='fch-$this->id' class='PostDate' value='$this->fecha' disabled='true' style='width: 18%' ></input>";
			}
			
			$footer = "";
			if($this->pie != "")
				$footer = "<div class='PostFooter'>$this->pie</div>";
			
			if($this->tituloMaxLength != "")
				$this->tituloMaxLength = " maxlength='" . $this->tituloMaxLength . "'";
			
			$display = " style='display: none' ";
			if($this->displayArea)
				$display = " style='display: block' ";
			
			return "			
	    		<div class='PostTitle' style='width: " . ($this->ancho - 4) . "px;'>
					" . $this->tbox->ToString() . $fechaField .
					"<input type='text' id='txt-$this->id' class='innerTitle' value='$this->titulo' disabled='true' $this->tituloMaxLength />
				</div>
				<div id='cont-$this->id' class='PostContent' >
				    <div id='area-$this->id' class='innerContent' $display >
						$this->contenido
					</div>
					<input type='hidden' id='tmpcnt-$this->id' value=''/>
					<input type='hidden' id='tmptit-$this->id' value=''/>
					<input type='hidden' id='tmpfch-$this->id' value=''/>
					<input type='hidden' id='id-$this->id' value='$this->id'/>
					<input type='hidden' id='tbl-$this->id' value='$this->tabla'/>
				</div>
				$footer			
			";
		}
	}
?>
