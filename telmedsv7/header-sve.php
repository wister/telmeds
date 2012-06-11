<?php if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die('Por favor no cargue esta p&aacute;gina directamente. &iexcl;Gracias!'); } ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
<head>
	<title>Telmeds.org &raquo; <?php echo get_post_meta($post->ID, 'IMS_imagen', true); ?></title>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<meta name="author" content="Club de Informática Médica y Telemedicina" />
	<meta name="author" content="<?php echo get_post_meta($post->ID, 'autores', true); ?>" />
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
	<meta name="generator" content="Telmeds 7.0" />
	<meta name="keywords" content="">
	<meta name="subject" content="medicina">
	<meta name="revisit-after" content="21">
	<meta name="distribution" content="global">
	<meta name="country" content="Panama" />
	<meta name="google-site-verification" content="a56r4WwowSB_olifdzd0wYBN53CAUcvr4najv-sun9U" />
<?php telmeds_header_hook(); ?>
</head>
