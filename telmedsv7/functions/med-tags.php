<?php if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die('Por favor no cargue esta p&aacute;gina directamente. &iexcl;Gracias!'); } 

function get_telmeds_head() {
	if ( file_exists( TEMPLATEPATH . '/head.php') )
	load_template( TEMPLATEPATH . '/head.php');
}

function get_404() {
	if ( file_exists( TEMPLATEPATH . '/404.php') )
	load_template( TEMPLATEPATH . '/404.php');
}

function get_header_reto() {
	if ( file_exists( TEMPLATEPATH . '/header-reto.php') )
	load_template( TEMPLATEPATH . '/header-reto.php');
}

function get_header_sve() {
	if ( file_exists( TEMPLATEPATH . '/header-sve.php') )
	load_template( TEMPLATEPATH . '/header-sve.php');
}

// 404

function get_header_404() {
	if ( file_exists( TEMPLATEPATH . '/header-404.php') )
	load_template( TEMPLATEPATH . '/header-404.php');
}

function get_footer_404() {
	if ( file_exists( TEMPLATEPATH . '/footer-404.php') )
	load_template( TEMPLATEPATH . '/footer-404.php');
}

?>
