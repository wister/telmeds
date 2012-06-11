<?php
$_head_profile_attr = '';
if ( bb_is_profile() ) {
	global $self;
	if ( !$self ) {
		$_head_profile_attr = ' profile="http://www.w3.org/2006/03/hcard"';
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
<head<?php echo $_head_profile_attr; ?>>
	<title><?php bb_title() ?></title>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<meta name="author" content="Club de Informática Médica y Telemedicina" />
	<link rel="icon" type="image/png" href="http://www.telmeds.org/wp-content/themes/telmedsv7/images/favicon.png" />
	<link rel="stylesheet" type="text/css" href="http://www.telmeds.org/wp-content/themes/telmedsv7/css/core.css" />
	<link rel="stylesheet" type="text/css" href="http://www.telmeds.org/wp-content/themes/telmedsv7/css/text.css" />
	<link rel="stylesheet" type="text/css" href="http://www.telmeds.org/wp-content/themes/telmedsv7/css/reset.css" />
	<link rel="stylesheet" href="<?php bb_stylesheet_uri(); ?>" type="text/css" />
<?php bb_feed_head(); ?>
<?php bb_head(); ?>
	<script type="text/javascript" src="http://www.telmeds.org/wp-content/themes/telmedsv7/js/jquery.js"></script>
	<script type='text/javascript'>$(document).ready(function(){
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

</head>
<body id="telmeds" >
	<div id="cabeza">
		<div class="wrapper">
			<h1><a href="http://www.telmeds.org/">Telmeds.org</a></h1>
			<form action="<?php bb_uri('search.php', null, BB_URI_CONTEXT_FORM_ACTION); ?>" id="searchform" method="get"><input type="text" class="text" id="q" name="q" value="Buscar en Telmeds.org" maxlength="250" onfocus="this.value=(this.value=='Buscar en Telmeds.org') ? '' : this.value;" onblur="this.value=(this.value=='') ? 'Buscar en Telmeds.org' : this.value;"/><input type="submit" value="Buscar" id="searchsubmit" /></form>
			<ul id="nav">
				<li id="inicio" class="resalto"><a href="http://www.telmeds.org/">Inicio</a></li>
				<li><a href="http://www.telmeds.org/atlas/">Atlas</a><span> &raquo; </span><ul class="sublistaatlas">
					<li><a href="http://www.telmeds.org/atlas/anatomia/">Anatomía</a></li>
					<li><a href="http://www.telmeds.org/atlas/bacteriologia/">Bacteriología</a></li>
					<li><a href="http://www.telmeds.org/atlas/dermatologia/">Dermatología</a></li>
					<li><a href="http://www.telmeds.org/atlas/electrocardiografia/">Electrocardiografía</a></li>
					<li><a href="http://www.telmeds.org/atlas/embriologia">Embriología</a></li>
					<li><a href="http://www.telmeds.org/atlas/hematologia/">Hematología</a></li>
					<li><a href="http://www.telmeds.org/atlas/histologia/">Histología</a></li>
					<li><a href="http://www.telmeds.org/atlas/micologia/">Micología</a></li>
					<li><a href="http://www.telmeds.org/atlas/neurorradiologia/">Neurorradiología</a></li>
					<li><a href="http://www.telmeds.org/atlas/otorrinolaringologia">Otorrinolaringología</a></li>
					<li><a href="http://www.telmeds.org/atlas/parasitologia/">Parasitología</a></li>
					<li><a href="http://www.telmeds.org/atlas/patologia/">Patología</a></li>
					<li><a href="http://www.telmeds.org/atlas/radiologia/">Radiología</a></li>
					<li><a href="http://www.telmeds.org/atlas/virologia/">Virología</a></li>

				</ul></li>
				<li><span>Secciones &raquo;</span><ul class="sublistainfo">
					<li><a href="http://www.telmeds.org/articulos/">Artículos</a></li>
					<li><a href="http://www.telmeds.org/casos-clinicos/">Casos Clínicos</a></li>
					<li><a href="http://www.telmeds.org/imagen-medica/">Imagen Médica</a></li>
					<li><a href="http://www.telmeds.org/videos/">Videos</a></li>

					<li><a href="http://www.telmeds.org/imagen-reto/">Imagen Reto</a></li>
					<li><a href="http://www.telmeds.org/quizes/">Quizes</a></li>
					<li><a href="http://www.telmeds.org/capsula-medica/">Cápsula Médica</a></li>
					<li><a href="http://www.telmeds.org/perlas/">Perlas</a></li>
					<li><a href="http://www.telmeds.org/prosalud/">ProSalud</a></li>
					<li><a href="http://www.telmeds.org/noticias/">Noticias</a></li>
					<li><a href="http://www.telmeds.org/documentos-virtuales/">Sala Virtual de Estudiantes</a></li>
					<li><a href="http://www.telmeds.org/clases-virtuales/">Sala Virtual de Profesores</a></li>
					<li><a href="http://www.telmeds.org/foros/forum/6">Paciente Virtual</a></li>
					<li><a href="http://www.telmeds.org/eventos/">Eventos</a></li>
					<li><a href="http://www.telmeds.org/enlaces/">Enlaces</a></li>
				</ul></li>
				<li><span>Nosotros &raquo; </span><ul class="sublistanosotros">
					<li><a href="http://www.telmeds.org/nosotros/">Nosotros</a></li>
					<li><a href="http://www.telmeds.org/cimte/">CIMTe</a></li>
					<li><a href="http://www.telmeds.org/directiva/">Directiva</a></li>
					<li><a href="http://www.telmeds.org/estatutos/">Estatutos</a></li>
					<li><a href="http://www.telmeds.org/galeria-de-presidentes/">Presidentes</a></li>
					<li><a href="http://www.telmeds.org/miembros/">Miembros</a></li>
					<li><a href="http://www.telmeds.org/colaboradores/">Colaboradores</a></li>
					<li><a href="http://www.telmeds.org/logros/">Actividades</a></li>
					<li><a href="http://www.telmeds.org/mapa/">Mapa del sitio</a></li>
					<li><a href="http://www.telmeds.org/preguntas/">¿Preguntas?</a></li>
					<li><a href="http://www.telmeds.org/contacto/">Contáctenos</a></li>
				</ul></li>
				<li id="residencias" class="residencias"><a href="http://www.telmeds.org/residencias-medicas/">Residencias</a></li>
				<li id="foros" class="foros"><a href="http://www.telmeds.org/foros/">Comunidad</a></li>
			</ul>
		</div>
	</div><!-- termina cabeza del sitio -->