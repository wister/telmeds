<?php if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die('Por favor no cargue esta p&aacute;gina directamente. &iexcl;Gracias!'); } 

function mensaje() {
	if ( !in_array( bb_get_location(), array( 'login-page', 'register-page' ) ) ) login_form();
}

?>
