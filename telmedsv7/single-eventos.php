<?php if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die('Por favor no cargue esta p&aacute;gina directamente. &iexcl;Gracias!'); } ?>
<?php get_header();?>
<?php get_telmeds_head();?>
	<div id="cuerpo">
		<div class="wrapper">
			<div id="singletext" class="contenedor">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<ul id="singletxt">
					<li><a href="#item-1">Información</a></li>
<?php if ( get_post_meta($post->ID, 'IP_temas', true) ) { ?>
					<li><a href="#temas">Temas</a></li>
<?php } ?>
<?php if ( get_post_meta($post->ID, 'IP_geo', true) ) { ?>
					<li><a href="#mapa">Mapa</a></li>
<?php } ?>
					<p class="derecho"><a href="<?php bloginfo('url');?>/eventos/">Archivo de Eventos</a></p>
				</ul>
				<div id="item-1" class="tabdiv">
					<h1><?php the_title();?></h1>
					<div class="ip-info">
<?php if ( get_post_meta($post->ID, 'IP_fecha_inicio', true) ) { ?>
				<p><strong>Fecha de inicio:</strong> <?php
$inicio = get_post_meta($post->ID, "IP_fecha_inicio", $single = true);
$evento = strtotime($inicio);
echo date( 'j ', $evento );
echo 'de ';
$mes = date( 'F', $evento );
	if ($mes=="January") $mes="Enero";
	if ($mes=="February") $mes="Febrero";
	if ($mes=="March") $mes="Marzo";
	if ($mes=="April") $mes="Abril";
	if ($mes=="May") $mes="Mayo";
	if ($mes=="June") $mes="Junio";
	if ($mes=="July") $mes="Julio";
	if ($mes=="August") $mes="Agosto";
	if ($mes=="September") $mes="Setiembre";
	if ($mes=="October") $mes="Octubre";
	if ($mes=="November") $mes="Noviembre";
	if ($mes=="December") $mes="Diciembre";
echo $mes;
echo ' de ';
echo date( 'Y ', $evento );
?></p>
<?php } ?>
<?php if ( get_post_meta($post->ID, 'IP_fecha_final', true) ) { ?>
				<p><strong>Fecha de finalización:</strong> <?php
$final = get_post_meta($post->ID, "IP_fecha_final", $single = true);
$evento = strtotime($final);
echo date( 'j ', $evento );
echo 'de ';
$mes = date( 'F', $evento );
	if ($mes=="January") $mes="Enero";
	if ($mes=="February") $mes="Febrero";
	if ($mes=="March") $mes="Marzo";
	if ($mes=="April") $mes="Abril";
	if ($mes=="May") $mes="Mayo";
	if ($mes=="June") $mes="Junio";
	if ($mes=="July") $mes="Julio";
	if ($mes=="August") $mes="Agosto";
	if ($mes=="September") $mes="Setiembre";
	if ($mes=="October") $mes="Octubre";
	if ($mes=="November") $mes="Noviembre";
	if ($mes=="December") $mes="Diciembre";
echo $mes;
echo ' de ';
echo date( 'Y ', $evento );
?></p>
<?php } ?>
<?php if ( get_post_meta($post->ID, 'IP_lugar', true) ) { ?>
				<p><strong>Lugar:</strong> <?php echo get_post_meta($post->ID, "IP_lugar", $single = true); ?></p>
<?php } ?>
<?php if ( get_post_meta($post->ID, 'IP_costo', true) ) { ?>
				<p><strong>Costo:</strong> <?php echo get_post_meta($post->ID, "IP_costo", $single = true); ?></p>
<?php } ?>
<?php if ( get_post_meta($post->ID, 'IP_info_contacto', true) ) { ?>
				<p><strong>Información de Contacto:</strong> <?php echo get_post_meta($post->ID, "IP_info_contacto", $single = true); ?></p>
<?php } ?>
<?php if ( get_post_meta($post->ID, 'IP_web', true) ) { ?>
				<p><strong>Sitio web del evento:</strong> <a rel="nofollow" target="_blank" rel="external" href="<?php echo get_post_meta($post->ID, 'IP_web', $single = true); ?>"><?php the_title(); ?></a></p>
<?php } ?>
<?php edit_post_link('Editar', '<p>', '</p>'); ?>
					</div>
					<div class="ip-poster">
<?php if ( get_post_meta($post->ID, 'IP_poster', true) ) { ?>
				<a href="<?php echo get_post_meta ($post->ID, 'IP_poster', true);?>" title="<?php the_title(); ?>">
					<img src="<?php bloginfo('template_url');?>/scripts/timthumb.php?zc=1&amp;w=440&amp;src=<?php echo get_post_meta ($post->ID, 'IP_poster', true);?>" alt="<?php the_title();?>" />
				</a>
<?php } ?>
					</div>
					<div class="clear"></div>
				</div>
<?php if ( get_post_meta($post->ID, 'IP_temas', true) ) { ?>
				<div id="temas" class="tabdiv">
					<h2>Temas Expuestos</h2>
<?php if ( post_password_required() ) { 
	echo get_the_password_form(); 
}
elseif ( !post_password_required() ) {
	echo get_post_meta($post->ID, 'IP_temas', true );
}
?>
				</div>
<?php } ?>
<?php if ( get_post_meta($post->ID, 'IP_geo', true) ) { ?>
				<div id="mapa" class="tabdiv">
					<h2>Localización del Evento</h2>
					<div id="map_canvas" style="width: 900px; height: 450px" class="mapa"></div>
				</div>
<?php } ?>
<?php endwhile; else: endif; ?>
		</div>
	</div><!-- termina cuerpo -->
<?php get_footer();?>
