<?php if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die('Por favor no cargue esta p&aacute;gina directamente. &iexcl;Gracias!'); } ?>
<?php header("HTTP/1.0 404 Not Found"); header("Status: 404 Not Found"); ?>
<?php get_header_404();?>
	<div id="cuerpo">
		<a href="<?php bloginfo('url');?>/">Telmeds.org</a>
	</div><!-- termina cuerpo -->
	<div id="der">
		<h1>Lo sentimos... pero no tenemos esta página</h1><br />
		<p>Lo sentimos, pero probablemente el enlace que te ha traido a esta página ya no funciona. Esto puede deberse a una de las siguientes razones:</p>
		<ul>
			<li>Has escrito la dirección mal.</li>
			<li>El documento no existe.</li>
			<li>El documento se ha movido a otra dirección.</li>
			<li>Tenemos un enlace roto.</li>
<?php function random_404() {
$vector = array(
	1 => "Te gustan las páginas 404... :0",
	2 => "Simplemente, está página no existe",
	3 => "Alguien se la llevo porque la necesitaba...",
	4 => "O quizás existía, pero la estamos editando...",
	5 => "Los aliens la destruyeron... <a id='lol' href='http://www.telmeds.net/wp-content/themes/telmedsv7/js/tic.html?iframe'>¿Los retas?</a>",
	6 => "Es un producto de tu imaginación...",
);
$numero = rand(1,6);
echo "$vector[$numero]";
}?>
			<li><?php random_404(); ?></li>
		</ul>
		<p>Puedes utilizar nuestro buscador para encontrar lo que necesites</p>
		<form action="<?php bloginfo('url');?>/" id="searchform" method="get"><input type="text" class="text" id="s" name="s" value="Buscar en Telmeds.org" maxlength="250" onfocus="this.value=(this.value=='Buscar en Telmeds.org') ? '' : this.value;" onblur="this.value=(this.value=='') ? 'Buscar en Telmeds.org' : this.value;"/><input type="submit" value="Buscar" id="searchsubmit" /></form>
		<p>Te ofrecemos algunas alternativas para que encuentres contenido similar:</p>
		<ul>
			<li><a href="<?php bloginfo('url');?>/">Ir a la portada de Telmeds.org</a></li>
			<li><a href="<?php bloginfo('url');?>/atlas/">Atlas Virtual de Medicina</a></li>
			<li><a href="<?php bloginfo('url');?>/libros/">Libros de Medicina</a></li>
			<li><a href="<?php bloginfo('url');?>/mapa/">Mapa de Telmeds.org</a></li>
			<li><a href="<?php bloginfo('url');?>/preguntas/">¿Preguntas?</a></li>
			<li><a href="<?php bloginfo('url');?>/contacto/">Contáctenos</a></li>
			<li>o puedes visitar nuestros <a href="<?php bloginfo('url');?>/foros/">foros</a></li>
		</ul>
	</div><!-- termina cuerpo -->	
<?php get_footer_404();?>
