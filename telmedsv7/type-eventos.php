<?php if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die('Por favor no cargue esta p&aacute;gina directamente. &iexcl;Gracias!'); } ?>
<?php get_header();?>
<?php get_telmeds_head();?>
	<div id="cuerpo">
		<div class="wrapper">
			<div id="singletext" class="contenedor">
				<ul id="singletxt">
					<li><a href="<?php bloginfo('url');?>/">Inicio</a></li>
					<li class="ui-tabs-selected"><a href="#item-1">Eventos</a></li>
				</ul>
				<div id="item-1" class="tabdiv">
<!--<?php
query_posts('post_type=eventos&showposts=-1&orderby=meta_value&meta_key=IP_fecha_inicio&order=ASC');
$posts = get_posts('post_type=eventos&numberposts=-1&orderby=meta_value&meta_key=IP_fecha_inicio&order=ASC&offset=0'); 
foreach ($posts as $post) : start_wp();
	$fecha_evento = get_post_meta($post->ID, "IP_fecha_inicio", $single = true);
	$fecha_hoy = date("Y-m-d");
	$hoy = strtotime($fecha_hoy);
	$evento = strtotime($fecha_evento);
	if ($evento >= $hoy) { ?>
					<div class="eventos-main">
						<small class="cal">
							<strong class="mes"><?php echo date( 'M ', $evento );?></strong>
							<strong class="dia"><?php echo date( 'j ', $evento );?></strong>
							<strong class="ano"><?php echo date( 'Y', $evento )?></strong>
						</small>
						<h3><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title();?></a></h3>
						<p><?php echo get_post_meta($post->ID, "IP_lugar", $single = true);?></p>
						<div class="clear"></div>
					</div>
	<?php }
endforeach;
?>-->
<?php
query_posts('post_type=eventos&showposts=10&orderby=meta_value&meta_key=IP_fecha_inicio&order=DESC'.'&paged='.$paged);
$posts = get_posts('post_type=eventos&numberposts=10&orderby=meta_value&meta_key=IP_fecha_inicio&order=DESC&offset=0'.'&paged='.$paged); 
foreach ($posts as $post) : start_wp();
$fecha_evento = get_post_meta($post->ID, "IP_fecha_inicio", $single = true);
$evento = strtotime($fecha_evento);
$fecha_hoy = date("Y-m-d");
$hoy = strtotime($fecha_hoy);
if ($evento >= $hoy) { 
	$expirado = 'prox';
}
else {
	$expirado = 'expirado';
}
?>
					<div class="eventos-main <?php echo $expirado ?>">
						<small class="cal">
							<strong class="mes"><?php echo date( 'M ', $evento );?></strong>
							<strong class="dia"><?php echo date( 'j ', $evento );?></strong>
							<strong class="ano"><?php echo date( 'Y', $evento )?></strong>
						</small>
						<h3><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title();?></a></h3>
						<p><?php if ( post_password_required($post) ) { echo '<img src="' . get_bloginfo(template_url) . '/images/candado.gif" alt="Algunos contenidos pueden estar protegidos." />'; } else { /*nada que mostrar*/ } ?> <?php echo get_post_meta($post->ID, "IP_lugar", $single = true);?></p>
						<div class="clear"></div>
					</div>
<?php endforeach;?>
				</div>
<?php wp_pagenavi(); ?>
			</div>
		</div>
	</div><!-- termina cuerpo -->
<?php get_footer();?>
