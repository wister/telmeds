<?php if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die('Por favor no cargue esta p&aacute;gina directamente. &iexcl;Gracias!'); } ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
<head>
	<title>Imagen Reto de Telmeds.org</title>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<meta name="author" content="Club de Informática Médica y Telemedicina" />
<?php if ( is_home() ) { ?>
	<meta name="description" content="Telmeds.org es un sitio web con información médica y científica que es diseñado y mantenido por estudiantes de la Facultad de Medicina de la Universidad de Panamá que pertenecen al Club de Informática Médica y Telemedicina." />
	<meta name="robots" content="index,follow" />
<?php } ?>
	<link rel="icon" type="image/png" href="<?php bloginfo('template_directory'); ?>/images/favicon.png" />
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/core.css" />
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/text.css" />
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/reset.css" />
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
	<script type='text/javascript' src="<?php bloginfo('template_directory');?>/js/ui.core.js"></script>
	<script type='text/javascript' src="<?php bloginfo('template_directory');?>/js/ui.tabs.js"></script>
	<script type='text/javascript'>$(document).ready(function(){
		$("#incognita > ul").tabs();
		$("#nav li span").click(function() {
			var hidden = $(this).parents("li").children("ul").is(":hidden");
			$("#nav>li>ul").hide()        
			$("#nav>li").removeClass();
			if (hidden) {
				$(this)
				.parents("li").children("ul").toggle()
				.parents("li").addClass("resalto");
			}
		});
	});
	</script>
<!-- WP-Polls -->
	<script type="text/javascript">
	/* <![CDATA[ */
	var pollsL10n = {
		ajax_url: "<?php bloginfo('url');?>/wp-content/plugins/wp-polls/wp-polls.php",
		text_wait: "Your last request is still being processed. Please wait a while ...",
		text_valid: "Please choose a valid poll answer.",
		text_multiple: "Maximum number of choices allowed: ",
		show_loading: "1",
		show_fading: "1"
	};
	/* ]]> */
	</script>
	<script type="text/javascript" src="<?php bloginfo(url);?>/wp-content/plugins/wp-polls/polls-js.js?ver=2.50"></script>
	<link rel='stylesheet' href="<?php bloginfo('template_directory'); ?>/css/reto.css" type='text/css' media='all' />
<!-- WP-Polls -->
	<meta name="generator" content="Telmeds 7.0" />
	<meta name="keywords" content="">
	<meta name="subject" content="medicina">
	<meta name="revisit-after" content="21">
	<meta name="distribution" content="global">
	<meta name="country" content="Panama" />
<?php telmeds_header_hook(); ?>
	<meta http-equiv="X-UA-Compatible" content="chrome=1" />
	<meta name="google-site-verification" content="a56r4WwowSB_olifdzd0wYBN53CAUcvr4najv-sun9U" />
</head>
