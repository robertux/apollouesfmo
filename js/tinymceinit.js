/**
 * @author developer
 */

/*!
 * Metodo que nos permite inicializar el TinyMCE para que muestre los botones en dos filas
 */
function tinymceInitTwoRows(){

	tinyMCE.init({
		mode: "textareas",
		
		
		theme: "advanced",
		plugins: "iespell,advimage",
		
		theme_advanced_buttons1: "fontselect,fontsizeselect,bold,italic,underline",
		theme_advanced_buttons2: "justifyleft,justifycenter,justifyright,justifyfull,|,bullist,numlist,|,link,unlink,image,iespell",
		theme_advanced_buttons3: "",
		
		extended_valid_elements: "a[name|href|target|title|onclick],img[class|src|border=0|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name],hr[class|width|size|noshade],font[face|size|color|style],span[class|align|style]",
		theme_advanced_toolbar_location: "top",
		theme_advanced_toolbar_align: "left",
		theme_advanced_statusbar_location: "bottom",
		theme_advanced_resizing: true
	});
	
}

/*!
 * Metodo que nos permite inicializar el TinyMCE para que muestre los botones en una fila
 */
function tinymceInitOneRow(){

	tinyMCE.init({
		mode: "textareas",
		
		
		theme: "advanced",
		plugins: "iespell,advimage",
		
		theme_advanced_buttons1: "fontselect,fontsizeselect,bold,italic,underline,|,justifyleft,justifycenter,justifyright,justifyfull,|,bullist,numlist,|,link,unlink,image,iespell",
		theme_advanced_buttons2: "",
		theme_advanced_buttons3: "",
		
		extended_valid_elements: "a[name|href|target|title|onclick],img[class|src|border=0|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name],hr[class|width|size|noshade],font[face|size|color|style],span[class|align|style]",
		theme_advanced_toolbar_location: "top",
		theme_advanced_toolbar_align: "left",
		theme_advanced_statusbar_location: "bottom",
		theme_advanced_resizing: true
	});
	
}