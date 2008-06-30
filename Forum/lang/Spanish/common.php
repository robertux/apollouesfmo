<?php

// Determine what locale to use
switch (PHP_OS)
{
	case 'WINNT':
	case 'WIN32':
		$locale = 'spanish';
		break;

	case 'FreeBSD':
	case 'NetBSD':
	case 'OpenBSD':
		$locale = 'es_ES.ISO8859-1';
		break;

	default:
		$locale = 'es_ES';
		break;
}

// Attempt to set the locale (required for fulltext indexing to work correctly)
setlocale(LC_CTYPE, $locale);


// Language definitions for frequently used strings
$lang_common = array(

// Text orientation and encoding
'lang_direction'		=>	'ltr',	// ltr (Left-To-Right) or rtl (Right-To-Left)
'lang_encoding'			=>	'iso-8859-1',
'lang_multibyte'		=>	false,

// Notices
'Bad request'			=>	'Solicitud err�nea. El enlace seguido es incorrecto o ha caducado.',
'No view'				=>	'Careces de permisos para ver estos foros.',
'No permission'			=>	'Careces de permisos para acceder a esta p�gina',
'Bad referrer'			=>	'HTTP_REFERER err�neo. Has estado dirigido a esta p�gina desde una fuente no autorizada. Si el problema continua por favor aseg�rate que la \'URL base\' est� correctamente configurada en Admin/Options y que est�s visitando el foro desde esta URL. Puedes encontrar m�s informaci�n sobre este tema en la documentaci�n de PunBB.',

// Topic/forum indicators
'New icon'				=>	'Hay mensajes nuevos',
'Normal icon'			=>	'<!-- -->',
'Closed icon'			=>	'Este tema est� cerrado',
'Redirect icon'			=>	'Foro redirigido',

// Miscellaneous
'Announcement'			=>	'Aviso',
'Options'				=>	'Opciones',
'Actions'				=>	'Acciones',
'Submit'				=>	'Enviar',	// "name" of submit buttons
'Ban message'			=>	'Est�s expulsado de este foro. ',
'Ban message 2'			=>	'La expulsi�n expira al final de',
'Ban message 3'			=>	'El administrador o moderador que te ha expulsado ha dejado el siguiente mensaje:',
'Ban message 4'			=>	'Por favor dirigir cualquier pregunta al administrador del foro en',
'Never'					=>	'Nunca',
'Today'					=>	'Hoy',
'Yesterday'				=>	'Ayer',
'Info'					=>	'Info',		// a common table header
'Go back'				=>	'Volver atr�s',
'Maintenance'			=>	'Mantenimiento',
'Redirecting'			=>	'Redirigiendo',
'Click redirect'		=>	'Hacer un clic aqu� si no quieres esperar m�s (o si tu explorador no te reenv�a autom�ticamente)',
'on'					=>	'activo',		// as in "BBCode is on"
'off'					=>	'inactivo',
'Invalid e-mail'		=>	'La direcci�n de correo que has entrado no es v�lida.',
'required field'		=>	'es un campo requerido en este formulario.',	// for javascript form validation
'Last post'				=>	'Ultimo mensaje',
'by'					=>	'por',	// as in last post by someuser
'New posts'				=>	'Mensajes&nbsp;nuevos',	// the link that leads to the first new post (use &nbsp; for spaces)
'New posts info'		=>	'Ir al primer mensaje nuevo de este tema.',	// the popup text for new posts links
'Username'				=>	'Nombre de usuario (seud�nimo)',
'Password'				=>	'Contrase�a',
'E-mail'				=>	'E-mail',
'Send e-mail'			=>	'Envia e-mail',
'Moderated by'			=>	'Moderado por',
'Registered'			=>	'Registrado',
'Subject'				=>	'Asunto',
'Message'				=>	'Mensaje',
'Topic'					=>	'Tema',
'Forum'					=>	'Foro',
'Posts'					=>	'Mensajes',
'Replies'				=>	'Respuestas',
'Author'				=>	'Autor',
'Pages'					=>	'P�ginas',
'BBCode'				=>	'BBCode',	// You probably shouldn't change this
'img tag'				=>	'Marcador [img]',
'Smilies'				=>	'Smileys',
'and'					=>	'y',
'Image link'			=>	'imagen',	// This is displayed (i.e. <image>) instead of images when "Show images" is disabled in the profile
'wrote'					=>	'dijo',	// For [quote]'s
'Code'					=>	'C�digo',		// For [code]'s
'Mailer'				=>	'Administrador de correo',	// As in "MyForums Mailer" in the signature of outgoing e-mails
'Important information'	=>	'Informaci�n importante',
'Write message legend'	=>	'Escribe tu mensaje y env�alo',

// Title
'Title'					=>	'T�tulo',
'Member'				=>	'Miembro',	// Default title
'Moderator'				=>	'Moderador',
'Administrator'			=>	'Administrador',
'Banned'				=>	'Expulsado',
'Guest'					=>	'Invitado',

// Stuff for include/parser.php
'BBCode error'			=>	'La sintaxis del BBCode en este mensaje es err�nea.',
'BBCode error 1'		=>	'Falta el marcador de inicio para un [/quote].',
'BBCode error 2'		=>	'Falta el marcador de fin para un [code].',
'BBCode error 3'		=>	'Falta el marcador de inicio para un [/code].',
'BBCode error 4'		=>	'Falta uno o m�s marcadores de fin para un [quote].',
'BBCode error 5'		=>	'Falta uno o m�s marcadores de inicio para un [/quote].',

// Stuff for the navigator (top of every page)
'Index'					=>	'Inicio del Foro',
'User list'				=>	'Lista de usuarios',
'Rules'					=>  'Reglas',
'Search'				=>  'Busca',
'Register'				=>  'Reg�strate',
'Login'					=>  'Entrar',
'Not logged in'			=>  'No te has registrado',
'Profile'				=>	'Perfil',
'Logout'				=>	'Salir',
'Logged in as'			=>	'Identificado como',
'Admin'					=>	'Administraci�n',
'Last visit'			=>	'Ultima visita',
'Show new posts'		=>	'Muestra mensajes nuevos desde la �ltima visita',
'Mark all as read'		=>	'Marca todos los temas como leidos',
'Link separator'		=>	'  -',	// The text that separates links in the navigator

// Stuff for the page footer
'Board footer'			=>	'Pie del foro',
'Search links'			=>	'Busca enlaces',
'Show recent posts'		=>	'Muestra mensajes recientes',
'Show unanswered posts'	=>	'Muestra mensajes sin respuesta',
'Show your posts'		=>	'Muestra mis mensajes',
'Show subscriptions'	=>	'Muestra mis temas suscritos',
'Jump to'				=>	'Ir a',
'Go'					=>	' Ir',		// submit button in forum jump
'Move topic'			=>  'Mueve tema',
'Open topic'			=>  'Abre tema',
'Close topic'			=>  'Cierra tema',
'Unstick topic'			=>  'Desmarca permanente',
'Stick topic'			=>  'Marca como permanente',
'Moderate forum'		=>	'Moderar el foro',
'Delete posts'			=>	'Borra mensajes m�ltiples',
'Debug table'			=>	'Informaci�n de depuraci�n',

//For extern.php RSS feed
'RSS Desc Active'		=>	'Ultimos temas activos en',	// board_title will be appended to this string
'RSS Desc New'			=>	'Ultimos temas en',	// board_title will be appended to this string
'Posted'				=>	'Enviado'	// The date/time the topic was started

);
